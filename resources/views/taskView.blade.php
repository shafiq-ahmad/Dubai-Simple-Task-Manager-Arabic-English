@extends('layouts.app')
 
@section('title', $page_title)
 
@section('sidebar')
    @parent

@endsection
 
@section('content')
<h3 class="page-heading">Tasks</h3>
<h3>Project: {{ $project->title }}</h3>
	<div class="row">
	
	@if(Auth::guard('web')->user())
	@endif
		<div class="col-sm-4">
			<a href="{{ url('task/create') }}" >
				<div class="box">
					<i class="fa fa-plus"></i>
				</div>
			</a>
		</div>
	@foreach ($tasks as $t) 
		<div class="col-sm-4">
			<a href="{{ url('/task') . '?task_id=' . $t['id'] }}" >
				<div class="box">
					{{ $t['title'] }}<br/>
					<span class="info">Comment Count: {{ $t['comments_count'] }}</span><br/>
					<span class="info">Status: {{ $t['status'] }}</span><br/>
					<span class="info">Deadline: {{ date('d-m-Y', strtotime($t['due_date'])) }}</span>
				</div>
			</a>
		</div>
	@endforeach
	</div>
@endsection