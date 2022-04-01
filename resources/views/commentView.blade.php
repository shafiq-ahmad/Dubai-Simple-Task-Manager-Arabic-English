@extends('layouts.app')
 
@section('title', $page_title)
 
@section('sidebar')
    @parent

@endsection
 
@section('content')

<h3 class="page-heading">Project: {{ $project->title }}</h3>
<div class="task table-responsive">
<table class="table table-bordered">
	<tr>
		<th>Task</th>
		<th>Description</th>
		<th>Deadline</th>
		<th>Status</th>
	</tr>
	
	<tr>
		<td>{{ $task->title }}</td>
		<td>{{ $task->desc }}</td>
		<td>{{ date('d-m-Y', strtotime($task->due_date)) }}</td>
		<td>{{ $task->status }}</td>
	</tr>
	
</table>
</div>
<hr/>
<h3 class="mt-4 mb-2">Comments</h3>
	<div class="row">
	@foreach ($comments as $c) 
		<div class="col-12">
				<div class="comment">
					<span class="info" style="color:red;">{{ $c['by'] }}: </span><span class="info">{{ $c['comment'] }}</span>
				</div>
		</div>
	@endforeach
	</div>
@if((isset($user->role_id) && $user->role_id ==1) || (isset($user->title) && $user->id == $project->company_id))
	<div class="form">
	<form action="{{ url($url) }}" method="POST">
    @csrf

    <input type="hidden" name="task_id" class="form-control" value="{{ $task->id }}">
  <div class="form-group mb-3">
    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Write your comment here..."></textarea>
  </div>
  <div class="row">
  <div class="col-6">&nbsp;</div>
  <div class="col-6">
  <button class="btn btn-primary mr-2" style="float:right;">Submit</button>
  </div>
  </div>
</form>
</div>
@endif
<style>
	.comment {border: 1px solid #aaa; margin-bottom:10px; padding:0 15px; line-height:40px;}
</style>
@endsection