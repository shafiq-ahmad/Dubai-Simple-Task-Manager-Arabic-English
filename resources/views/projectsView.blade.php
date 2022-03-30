@extends('layouts.app')
 
@section('title', $page_title)
 
@section('sidebar')
    @parent
	
@endsection
 
@section('content')
<h3 class="page-heading">Projects</h3>
<h3>Company: {{ $company->title }}</h3>
	<div class="row">
	@foreach ($projects as $p) 
		<div class="col-sm-4">
			<a href="{{ url('/tasks') . '?project_id=' . $p['id'] }}" >
				<div class="box">
					{{ $p['title'] }}<br/>
					<span class="info">Task Count: {{ $p['tasks_count'] }}</span><br/>
					<span class="info">Deadline: {{ date('d-m-Y', strtotime($p['deadline'])) }}</span>
				</div>
			</a>
		</div>
	@endforeach
	</div>
@endsection

