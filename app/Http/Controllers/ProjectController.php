<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$page_title="Projects";
		$view = 'projectsView';
		$user = Auth::user();
		$company_id = $request->query('company_id','');
		if(isset($user->username) && $user->role->name == 'Admin'){
			$view='pages.projects.index';
			$projects = Project::with('company');
			if($company_id) $projects = $projects->where('company_id', $company_id);
			$projects = $projects
				->orderBy('id', 'DESC')
				->paginate();
			return view($view, compact('projects', 'page_title'));
		}else{
			$company = Company::find($company_id);
			$projects = Project::with('company')
				->withCount('tasks')
				->orderBy('id', 'DESC')
				->where('company_id', $company_id)
				->get();
			
		}
		return view($view, compact('projects', 'page_title','company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$companies = Company::get();
        return view('pages.projects.create', compact('companies'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'title' => 'required',
            'deadline' => 'required',
        ]);
        Project::create($request->only('company_id', 'title', 'desc', 'deadline'));
       
        return redirect()
				->route('projects.index')
				->with('success','Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
		$page_title="Project";
		return view('projectsView', compact('project', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function edit(Project $project)
    {
		$companies = Company::get();
        return view('pages.projects.edit',compact('project','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'company_id' => 'required',
            'title' => 'required',
            'deadline' => 'required',
        ]);
      
        $project->update($request->only('company_id', 'title', 'desc', 'deadline'));
      
        return redirect()
				->route('projects.index')
				->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
		try{
			$project->delete();
			return redirect()
					->route('projects.index')
					->with('success','Project deleted successfully');
		}catch (\Illuminate\Database\QueryException $e){
			if($e->getCode()==23000){
				return redirect()->route('projects.index')->with('error','Delete all tasks of this project first');
			}
		}
    }
}
