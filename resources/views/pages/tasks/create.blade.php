@extends('layouts.app')
  
@section('content')
<div class="row my-2 mt4">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Task</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('/companies') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger my-2">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ url('task/store') }}" method="POST">
    @csrf
  

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 my-2">
            <div class="form-group">
                <strong>Project:</strong>
                <select name="project_id" class="form-control" required>
					<option value="">Select ...</option>
					@foreach($projects as $c)
						<option value="{{ $c['id'] }}">{{ $c['title'] }}</option>
					@endforeach
				</select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 my-2">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title" required value="" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 my-2">
            <div class="form-group">
                <strong>Deadline:</strong>
                <input type="date" name="due_date" class="form-control" required value="" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 my-2">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea type="date" name="desc" rows="5" style="width:100%;"></textarea>
            </div>
        </div>
    </div>
	
<div class="btn-group mt-4" role="group" aria-label="Basic example">
  <button class="btn btn-success">Create</button>
  <a class="btn btn-secondary" href="{{ route('companies.index') }}"> Back</a>
</div>
   
</form>
@endsection