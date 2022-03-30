@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Tasks</h2>
            </div>
            <div class="pull-right">
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
            <th>Status</th>
            <th>Description</th>
            <th>Project</th>
            <th width="100px">Deadline</th>
            <th width="100px">Comments</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($tasks as $p)
        <tr>
            <td>{{ $p['id'] }}</td>
            <td>{{ $p['title'] }}</td>
            <td>{{ $p['status'] }}</td>
            <td>{{ $p['desc'] }}</td>
            <td>{{ $p['project']->title }}</td>
            <td>{{ $p['due_date'] }}</td>
            <td>{{ $p['comments_count'] }}</td>
            <td>
                <form action="{{ route('tasks.destroy',$p['id']) }}" method="POST">
    
                    <a class="btn btn-success" href="{{ route('comments.index') }}?task_id={{ $p['id'] }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
					@if($p['status'] == 'Pending')
                    <a class="btn btn-primary" href="{{ route('tasks.pending') }}?task_id={{ $p['id'] }}&status=Approved"><i class="fa fa-check" aria-hidden="true"></i></a>
                    <a class="btn btn-danger" href="{{ route('tasks.pending') }}?task_id={{ $p['id'] }}&status=Refused"><i class="fa fa-times" aria-hidden="true"></i></a>
					@endif
                    @csrf
                    @method('DELETE')
      
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
		<div class="d-flex justify-content-center">
			{!! $tasks->links() !!}
		</div>
      
@endsection