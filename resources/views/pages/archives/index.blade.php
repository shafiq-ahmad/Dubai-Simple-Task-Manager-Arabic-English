@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $page_title }}</h2>
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
            <th>Task</th>
            <th>Company</th>
            <th>Project</th>
            <th>Status</th>
            <th>User</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Date</th>
        </tr>
        @foreach ($archives as $p)
		
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->task }}</td>
            <td>{{ $p->company }}</td>
            <td>{{ $p->project }}</td>
            <td>{{ $p->status }}</td>
            <td>{{ $p->user }}</td>
            <td>{{ $p->desc }}</td>
            <td>{{ $p->deadline }}</td>
            <td>{{ $p->created_at }}</td>
        </tr>
        @endforeach
    </table>
  
		<div class="d-flex justify-content-center">
			{!! $archives->links() !!}
		</div>
      
@endsection