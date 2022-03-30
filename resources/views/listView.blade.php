@extends('layouts.app')
 
@section('title', $page_title)
 
@section('sidebar')
    @parent
	
@endsection
 
@section('content')
<h3 class="page-heading">Company Dashboard</h3>
	<div class="row">
	@if(Auth::guard('web')->user())
		<div class="col-sm-4">
			<a href="{{ route('companies.create') }}" >
				<div class="box">
					<i class="fa fa-plus"></i>
				</div>
			</a>
		</div>
	@endif
	@foreach ($companies as $c) 
		<div class="col-sm-4">
			<a href="{{ url('/projects') . '?company_id=' . $c['id'] }}" >
				<div class="box">
					{{ $c['title'] }} <br/>
					<span class="info">Project Count: {{ $c['projects_count'] }}</span>
				</div>
			</a>
		</div>
	@endforeach
	</div>
@endsection