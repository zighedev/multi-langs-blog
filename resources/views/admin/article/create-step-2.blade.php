@extends('layouts.app')

@section('title')
{{ __('words.articles') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>	
	<a href="{{route('admin.articles.index')}}" class="link-secondary">{{ __('words.articles') }}</a>		
	<span class="active">{{ __('words.create') }}</span>	
</section>
@endsection

@section('content')

<div class="steps">
	<span class="step done">1</span>
	<span class="step current">2</span>
	<span class="step">3</span>
	<span class="step">4</span>
	<span class="step">5</span>
	<span class="step">6</span>
</div>

<div class="row">
@if($errors->any())
	<div class="alert alert-danger">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
		</ul>
	</div>	
@endif
</div>

<form method="POST" action="{{ route('admin.articles.store') }}">
        @csrf
		
		<input type="hidden" name="step" value="2">
		
		<div class="row my-2">
			<div class="col-md-3"></div>
            <label for="parent" class="col-md-6 col-form-label">
                {{ __('words.category') }}
            </label>
			<div class="col-md-3"></div>
			
            <div class="col-md-3"></div>
			<div class="col-md-6">
				<input type="text" id="parent" class="form-control" value="{{$parent->name}}" disabled>
            </div>
			<div class="col-md-3"></div>
		</div>
		
		<div class="row my-2">
			<div class="col-md-3"></div>
            <label for="category" class="col-md-6 col-form-label">
                {{ __('words.sub category') }}
            </label>
			<div class="col-md-3"></div>
			
            <div class="col-md-3"></div>
			<div class="col-md-6">
				<select id="category" class="form-control" name="category_id">
					<option class="d-none" value="">-- {{ __('words.choose subcategory') }} --</option>
					@foreach($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
            </div>
			<div class="col-md-3"></div>
		</div>
				
		
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 my-5">
            	<a href="?previous=1" class="btn btn-secondary svg-rotate">
                    <i class="fas fa-arrow-right fa-rotate-180"></i> {{ __('words.previous') }}
                </a>
				<button type="submit" class="btn main-btn svg-rotate">
                    {{ __('words.next') }} <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
		
	</form>

@endsection