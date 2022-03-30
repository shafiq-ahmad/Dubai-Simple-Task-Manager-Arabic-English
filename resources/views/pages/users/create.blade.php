@extends('layouts.app')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Admin</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admins.index') }}"> Back</a>
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
   
<form action="{{ route('admins.store') }}" method="POST">
    @csrf
  
   @include('pages.users.fields')

<div class="btn-group mt-4" role="group" aria-label="Basic example">
  <button class="btn btn-success">Create</button>
  <a class="btn btn-secondary" href="{{ route('admins.index') }}"> Back</a>
</div>
   
</form>
@endsection