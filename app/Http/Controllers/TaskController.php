<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\Task_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$page_title="Tasks";
		$view = 'taskView';
		$user = Auth::user();
		$project_id = $request->query('project_id','');
		if(isset($user->username) && $user->role->name == 'Admin'){
			$view='pages.tasks.index';
			$tasks = Task::with('project')
				->withCount('comments');
			if($project_id) $tasks = $tasks->where('project_id', $project_id);
			$tasks = $tasks
				->orderBy('id', 'DESC')
				->paginate();
			return view($view, compact('tasks', 'page_title'));
		}else{
			$valid = $request->validate([
				'project_id'=> 'required'
			]);
			$project_id = $request->query('project_id','');
			$project = Project::find($project_id);
			$tasks = Task::with('project')
				->withCount('comments')
				->orderBy('id', 'DESC')
				->where('project_id', $project_id)->get();
		}
		return view('taskView', compact('tasks', 'page_title', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$company = Auth::guard('company')->user();
		$project = Project::where('id', $request->project_id)
			->where('company_id', $company->id)
			->first();
		if($project){
			$request->merge(['status'=>'Pending']);
			$request->merge(['user'=>'']);
			$request->merge(['created_at'=>date('Y-m-d H:i:s')]);
			$request->merge(['updated_at'=>date('Y-m-d H:i:s')]);
			Task::create(
				$request->only('project_id', 'due_date', 'title', 'desc', 'status', 'user', 'created_at', 'updated_at')
			);
		}
		//dd($project->toArray());
		$url = url('/tasks') . '?project_id=' . $project->id;
        return Redirect::to($url);
    }

    public function create()
    {
		$company = Auth::guard('company')->user();
		$projects = Project::where('company_id', $company->id)
			->get();
		
        return view('pages.tasks.create', compact('projects'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Task $task)
    {
		/*$valid = $request->validate([
			'project_id'=> 'required'
		]);*/
		$task_id = $request->query('task_id','');
		$task = Task::find($task_id);
		if(!$task) return redirect()->route('tasks.index')->with('danger','Task not found');
		$project = Project::find($task->project_id);
		if(!$task) return redirect()->route('tasks.index')->with('danger','Project not found');
		$comments = Task_comment::with('task')
			->where('task_id', $task_id)
				->orderBy('id', 'DESC')->get();
		$page_title="Task: " . $task->title;
		$user = Auth::guard('company')->user();
			//dd($project->company_id);
			//dd($user->id);
		$url = '/task-comment';
		return view('commentView', compact('comments', 'page_title', 'task', 'project', 'user','url'));
    }

    public function pending(Request $request)
    {
		$valid = $request->validate([
			'task_id'=> 'required',
			'status'=> 'required'
		]);
		$user = Auth::user();
		//dd($user->name);
		$request->merge(['user' => $user->name]);
		$task = Task::find($request->task_id);
			//->where('status', $request->status)
			//->first();
		$status = $request->input('status');
		if($status == 'Approved' || $status == 'Refused'){
			$task->update($request->only('status', 'user'));
			return redirect()->route('tasks.index')->with('success','Task ' . $status);
		}
		return redirect()->route('tasks.index')->with('success','Invalid Status');
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
		try{
			$task = $task->with('project')
				->where('id', $task->id)
				->first();
				$date = date('Y-m-d H:i:s');
			DB::beginTransaction();
			DB::table('archives')->insert([
				'task' => $task->title,
				'company' => $task->project->company_id,
				'project' => $task->project->title,
				'status' => $task->status,
				'user' => $task->user,
				'desc' => $task->desc,
				'deadline' => $task->due_date,
				'created_at' => $date,
				'updated_at' => $date
			]);
		 
			DB::delete('DELETE FROM task_comments WHERE task_id=' . $task->id);
			DB::delete('DELETE FROM tasks WHERE id=' . $task->id);
			
			DB::commit();
			return redirect()
					->route('tasks.index')
					->with('success','Task deleted successfully');
		}catch (\Illuminate\Database\QueryException $e){
			DB::rollBack();
			if($e->getCode()==23000){
				return redirect()->route('projects.index')->with('error','Delete all comments of this task first');
			}
		}
    }
}
