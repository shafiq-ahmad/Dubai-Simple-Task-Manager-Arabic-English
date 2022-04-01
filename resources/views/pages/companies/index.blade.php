@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Companies</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mb-2" href="{{ url('/gd/companies/create') }}"><i class="fa fa-file" aria-hidden="true"></i> New</a>
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
            <th>Title</th>
            <th>Login</th>
            <th width="150px">Action</th>
        </tr>
        @foreach ($companies as $c)
        <tr>
            <td>{{ $c['id'] }}</td>
            <td>{{ $c['title'] }}</td>
            <td>{{ $c['login'] }}</td>
            <td>
                <form action="{{ route('companies.destroy',$c['id']) }}" method="POST">
    
                    <a class="btn btn-success" href="{{ route('projects.index') }}?company_id={{ $c['id'] }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a class="btn btn-primary" href="{{ route('companies.edit',$c['id']) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
   
                    @csrf
                    @method('DELETE')
      
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
      
@endsection