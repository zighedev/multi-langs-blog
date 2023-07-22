	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title", $_ENV['APP_NAME'])</title>
	<meta name="description" content="@yield('description')">
	
	<!-- favicon -->
	<link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
	
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap-5.1.0.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@if(app()->getLocale() == 'ar')
	<link href="{{ asset('css/direction.css') }}" rel="stylesheet">
	@endif
