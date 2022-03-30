@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Admin</h2>
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
  
    <form action="{{ route('admins.update',$user['id']) }}" method="POST">
        @csrf
        @method('PUT')
   @include('pages.users.fields')
   
<div class="btn-group mt-4" role="group" aria-label="Basic example">
  <button class="btn btn-success">Update</button>
  <a class="btn btn-secondary" href="{{ route('admins.index') }}"> Back</a>
</div>
    </form>
@endsection