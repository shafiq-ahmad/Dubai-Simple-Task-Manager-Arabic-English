@extends('layouts.app')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Company</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('/gd/companies') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('companies.store') }}" method="POST">
    @csrf
  
     @include('pages.companies.fields')
	 
<div class="btn-group mt-4" role="group" aria-label="Basic example">
  <button class="btn btn-success">Create</button>
  <a class="btn btn-secondary" href="{{ route('companies.index') }}"> Back</a>
</div>
   
</form>
@endsection