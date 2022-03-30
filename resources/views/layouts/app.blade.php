<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
	<div class="container">
			
			
<header class="row">
<div class="col-4">
    <a class="navbar-brand"
	@if(Auth::guard('web')->check())
        href="{{ url('/gd/companies') }}"
	@elseif(Auth::guard('company')->check())
		href="{{ url('/companies') }}"
	@endif>
      <img src="{{ url('/') }}/images/logo.png" alt="logo">
    </a></div>
<div class="col-8">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/companies') }}">
	@if(Auth::guard('company')->user())
	{{ Auth::guard('company')->user()->title }}
	@elseif(Auth::user())
      Admin
	@endif
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
	  @if(Auth::guard('web')->check())
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('/gd/companies') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/gd/projects') }}">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/gd/tasks') }}">Tasks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/gd/archives') }}">Archives</a>
        </li>
        <li class="nav-item">
		  <form method="POST" action="{{ route('logout') }}">
			  @csrf
			  <button class="btn btn-secondary">Logout</button>
           </form>
        </li>
	  @elseif(Auth::guard('company')->check())
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('/companies') }}">Home</a>
        </li>
        <li class="nav-item">
		  <form method="POST" action="{{ route('logout') }}">
			  @csrf
			  <button class="btn btn-secondary">Logout</button>
           </form>
        </li>
	  @endif
      </ul>
    </div>
  </div>
</nav>
</div>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        @section('sidebar')
            
        @show
 
        <div class="container">
            @yield('content')
        </div>
    </div>
    </body>
	<style>
	h2 {font-size: 24px; font-weight: bold; line-height: 40px;}
	h3 {font-size: 18px; font-weight: bold; text-align:center;}
	.box {padding: 20px 30px;background-color:#ddd;border-radius:10px;margin: 10px 0;height:150px;}
	.box span.info {font-size:70%;}
	.box i {font-size:30px; display:block; line-height: 100px; text-align:center;}
	.navbar-brand img {max-width:50px; max-height:50px;}
	.page-heading {color: #aaa; font-size:30px; font-weight: bold; line-height:90px; text-align: center;}
	</style>
</html>