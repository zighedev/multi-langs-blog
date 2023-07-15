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
	<span class="step done">5</span>
	<span class="step current">6</span>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf
		
		<input type="hidden" name="step" value="6">
		
		<div class="px-1 mb-3">
            <b class="col-md-6 col-form-label">{{ __('words.image') }}</b>
			<div>
				<label for="image" class="form-control p-0 @error('image') is-invalid @enderror">
					<span class="btn btn-secondary">{{ __('words.choose file') }}</span>
					<input id="image" type="file" name="image" style="display: none;" onchange="$(this).next().text(this.files[0].name);">
					<span >{{ __('words.no file chosen') }}</span>
				</label>
            </div>
			@error('image')			
			<strong class="text-danger text-sm">{{ $message }}</strong>
			@enderror
		</div>
		
		<div class="px-1 mb-4">
			<b>{{__('words.image description')}}</b>
            <div class="pt-2">
				<ul class="nav nav-tabs" role="tablist">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<li class="nav-item" role="presentation">
						<button class="nav-link text-dark {{$loop->index == 0  ? 'active' : ''}}" id="{{$localeCode}}_image_description-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_image_description"
							type="button" role="tab" aria-controls="{{$localeCode}}_image_description" aria-selected="{{$loop->index == 0  ? 'true' : 'false'}}">
							{{$properties['native']}}
						</button>
					</li>
					@endforeach  
				</ul>
				<div class="tab-content">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
					id="{{$localeCode}}_image_description" role="tabpanel" aria-labelledby="{{$localeCode}}_image_description-tab">
						<input type="text" class="form-control @error($localeCode.'.image_description') is-invalid @enderror" 
						value="{{ old($localeCode.'.image_description') }}" name="{{$localeCode}}[image_description]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.image_description')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
		
		<div class="row mb-5">
            <div class="col-md-12">
				<a href="?previous=5" class="btn btn-secondary svg-rotate">
                    <i class="fas fa-arrow-right fa-rotate-180"></i> {{ __('words.previous') }}
                </a>
				<button type="submit" class="btn main-btn">
                    {{ __('words.save') }} <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
		
	</form>

@endsection