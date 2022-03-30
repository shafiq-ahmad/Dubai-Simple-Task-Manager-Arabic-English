@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Project</h2>
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
  
    <form action="{{ route('projects.update',$project['id']) }}" method="POST">
        @csrf
        @method('PUT')
   @include('pages.projects.fields')
   
<div class="btn-group mt-4" role="group" aria-label="Basic example">
  <button class="btn btn-success">Update</button>
  <a class="btn btn-secondary" href="{{ route('projects.index') }}"> Back</a>
</div>
    </form>
@endsection