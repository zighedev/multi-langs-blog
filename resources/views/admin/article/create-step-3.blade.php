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
	<span class="step current">3</span>
	<span class="step">4</span>
	<span class="step">5</span>
	<span class="step">6</span>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}">
        @csrf
		
		<input type="hidden" name="step" value="3">
				
		<div class="px-1 mb-4">
			<b>{{__('words.title')}}</b>
            <div class="pt-2">
				<ul class="nav nav-tabs" role="tablist">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<li class="nav-item" role="presentation">
						<button class="nav-link text-dark {{$loop->index == 0  ? 'active' : ''}}" id="{{$localeCode}}_title-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_title"
							type="button" role="tab" aria-controls="{{$localeCode}}_title" aria-selected="{{$loop->index == 0  ? 'true' : 'false'}}">
							{{$properties['native']}}
						</button>
					</li>
					@endforeach  
				</ul>
				<div class="tab-content">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
					id="{{$localeCode}}_title" role="tabpanel" aria-labelledby="{{$localeCode}}_title-tab">
						<input type="text" class="form-control @error($localeCode.'.title') is-invalid @enderror" 
						value="{{ old($localeCode.'.title') }}" name="{{$localeCode}}[title]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.title')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
		<div class="px-1 mb-5">
			<b>{{__('words.description')}}</b>
            <div class="pt-2">
				<ul class="nav nav-tabs" role="tablist">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<li class="nav-item" role="presentation">
						<button class="nav-link text-dark {{$loop->index == 0  ? 'active' : ''}}" id="{{$localeCode}}_description-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_description"
							type="button" role="tab" aria-controls="{{$localeCode}}_description" aria-selected="{{$loop->index == 0  ? 'true' : 'false'}}">
							{{$properties['native']}}
						</button>
					</li>
					@endforeach  
				</ul>
				<div class="tab-content">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
					id="{{$localeCode}}_description" role="tabpanel" aria-labelledby="{{$localeCode}}_description-tab">
						<input type="text" class="form-control @error($localeCode.'.description') is-invalid @enderror" 
						value="{{ old($localeCode.'.description') }}" name="{{$localeCode}}[description]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.description')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
		
        <div class="m-2">
            <a href="?previous=2" class="btn btn-secondary svg-rotate">
				<i class="fas fa-arrow-right fa-rotate-180"></i> {{ __('words.previous') }}
            </a>
			<button type="submit" class="btn main-btn svg-rotate">
				{{ __('words.next') }} <i class="fas fa-arrow-right"></i>
            </button>
        </div>
		
	</form>

@endsection