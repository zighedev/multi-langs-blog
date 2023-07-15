@extends('layouts.app')

@section('title')
{{ __('words.articles') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>	
	<a href="{{route('admin.articles.index')}}" class="link-secondary">{{ __('words.articles') }}</a>		
	<span class="active">{{ __('words.show') }}</span>	
</section>
@endsection

@section('content')

@endsection