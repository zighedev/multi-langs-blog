<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@section('head')
		@include('includes.head')
		@show
	</head>

	<body>

		
		@section('navbar')
		<header>
			@include('includes.navbar')
		</header>
		@show
		

		<main class="container-fluid direction">
		
			@if (Session::has('success'))
				@include('includes.messages.response', ['message' => Session::get('success'), 'type' => 'success'])
			@endif
			@if (Session::has('fail'))
				@include('includes.messages.response', ['message' => Session::get('fail'), 'type' => 'danger'])
			@endif
						
			@yield('page_path')
			@yield('content')
			@yield('tags')
			@yield('page_pagination')			
			@yield('comments')
			@yield('related')
						
		</main>		
		
		<footer class="container-fluid bg-dark px-3 pt-4">
			@section('footer')
			@include('includes.footer')
			@show
		</footer>		

		@auth
		
			@if(Auth::user()->role == 'admin')
			@include('includes.admin.menu')
			@endif
			
			@yield('confirm-message')
			
		@endauth
		
		@section('scripts')
			@include('includes.scripts.scripts')
			@include('includes.scripts.request_categories')
		@show
		
	</body>

</html>
