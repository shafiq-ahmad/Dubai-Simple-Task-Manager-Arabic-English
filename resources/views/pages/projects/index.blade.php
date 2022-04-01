@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Projects</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mb-2" href="{{ route('projects.create') }}"><i class="fa fa-file" aria-hidden="true"></i> New</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
	@elseif ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
	
  
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Company</th>
            <th width="100px">Deadline</th>
            <th width="150px">Action</th>
        </tr>
        @foreach ($projects as $p)
        <tr>
            <td>{{ $p['id'] }}</td>
            <td>{{ $p['title'] }}</td>
            <td>{{ $p['desc'] }}</td>
            <td>{{ $p['company']->title }}</td>
            <td>{{ $p['deadline'] }}</td>
            <td>
                <form action="{{ route('projects.destroy',$p['id']) }}" method="POST">
    
                    <a class="btn btn-primary" href="{{ route('projects.edit',$p['id']) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
   
                    @csrf
                    @method('DELETE')
      
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
		<div class="d-flex justify-content-center">
			{!! $projects->links() !!}
		</div>
      
@endsection