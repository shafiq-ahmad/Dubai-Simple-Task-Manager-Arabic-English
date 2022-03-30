@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Tasks</h2>
            </div>
            <div class="pull-right">
				<a class="btn btn-success" href="{{ route('admins.create') }}"><i class="fa fa-file-o" aria-hidden="true"></i> Create</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Login</th>
            <th>E-Mail</th>
            <th>Role</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u['id'] }}</td>
            <td>{{ $u['name'] }}</td>
            <td>{{ $u['username'] }}</td>
            <td>{{ $u['email'] }}</td>
            <td>{{ $u['role']->name }}</td>
            <td>
				<a class="btn btn-success" href="{{ route('admins.edit', $u['id']) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				<a class="btn btn-success" href="{{ url('/gd/admins/password') }}"><i class="fa fa-key" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
  
		<div class="d-flex justify-content-center">
			{!! $users->links() !!}
		</div>
      
@endsection