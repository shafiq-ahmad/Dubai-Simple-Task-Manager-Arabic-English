<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task_comment;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Task_commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$page_title="Comments";
		$view='pages.tasks.comments.index';
		$user = Auth::user();
		$task_id = $request->query('task_id','');
		$task = Task::with('project')
			->orderBy('id', 'DESC')
			->where('id', $task_id)
			->first();
		//dd($task->project->company_id);
		$project = Project::find($task->project_id);
		if(isset($user->username) && $user->role->name == 'Admin'){
			$comments = Task_comment::with('task');
				//->withCount('comments');
			if($task_id) $comments = $comments->where('task_id', $task_id);
			$comments = $comments
				->orderBy('id', 'DESC')
				->get();
			//return view($view, compact('comments', 'page_title'));
		}
		//dd($comments->toArray());
		$url = '/gd/tasks/comments';
		return view('commentView', compact('comments', 'page_title', 'task','project', 'user','url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$task = Task::find($request->task_id);
		//dd($task->project->company_id);
		$project = Project::find($task->project_id);
		$request->merge(['created_at' => date('Y-m-d H:i:s')]);
		$request->merge(['updated_at' => date('Y-m-d H:i:s')]);
		$url = '/task?task_id=' . $request->task_id;
		if(Auth::guard('web')->check() && Auth::guard('web')->user()->role_id ==1){
			$request->merge(['by' => 'Admin']);
			$url = '/gd/tasks/comments?task_id=' . $request->task_id;
		}elseif(Auth::guard('company')->check() && Auth::guard('company')->user()->id == $project->company_id){
			$request->merge(['by' => 'Company']);
		}else{
			return redirect()
				->route('comments.index', ['task_id'=>$request->task_id])
				->with('error','Comment failed');
		}

        Task_comment::create($request->only('task_id', 'by', 'comment', 'created_at', 'updated_at'));
		return Redirect::to(url('/') . $url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task_comment  $task_comment
     * @return \Illuminate\Http\Response
     */
    public function show(Task_comment $task_comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task_comment  $task_comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task_comment $task_comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task_comment  $task_comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task_comment $task_comment)
    {
        //
    }
}
