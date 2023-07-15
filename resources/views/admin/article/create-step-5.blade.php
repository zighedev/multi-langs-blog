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
	<span class="step done">2</span>
	<span class="step done">3</span>
	<span class="step done">4</span>
	<span class="step current">5</span>
	<span class="step">6</span>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}">
        @csrf
		
		<input type="hidden" name="step" value="5">
		
		
		<div class="row mb-5">
			<div class="col-md-3"></div>
            <label for="tags" class="col-md-6 col-form-label">
                {{ __('words.tags') }}
            </label>
			<div class="col-md-3"></div>
			
            <div class="col-md-3"></div>
			<div class="col-md-6">
				<select id="tags" class="form-control  @error('tags') is-invalid @enderror"" name="tags[]" multiple size="12">
					@foreach($tags as $tag)
					<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>
            </div>
			<div class="col-md-3"></div>
			@error('tags')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
		</div>
		
		<div class="row mb-0">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            	<a href="?previous=4" class="btn btn-secondary svg-rotate">
                    <i class="fas fa-arrow-right fa-rotate-180"></i> {{ __('words.previous') }}
                </a>
				<button type="submit" class="btn main-btn svg-rotate">
                    {{ __('words.next') }} <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
		
	</form>

@endsection