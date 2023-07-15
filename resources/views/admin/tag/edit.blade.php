@extends('layouts.app')

@section('title')
{{ __('words.tags') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>	
	<a href="{{route('admin.tags.index')}}" class="link-secondary">{{ __('words.tags') }}</a>		
	<span class="active">{{ __('words.edit') }}</span>	
</section>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.tags.update', $tag->id) }}">
        @method('PUT')
		@csrf
				
		<div class="px-1 mb-3">
			<b>{{__('words.name')}}</b>
            <div class="pt-2">
				<ul class="nav nav-tabs" role="tablist">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<li class="nav-item" role="presentation">
						<button class="nav-link text-dark {{$loop->index == 0  ? 'active' : ''}}" id="{{$localeCode}}_name-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_name"
							type="button" role="tab" aria-controls="{{$localeCode}}_name" aria-selected="{{$loop->index == 0  ? 'true' : 'false'}}">
							{{$properties['native']}}
						</button>
					</li>
					@endforeach  
				</ul>
				<div class="tab-content">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
					id="{{$localeCode}}_name" role="tabpanel" aria-labelledby="{{$localeCode}}_name-tab">
						<input type="text" class="form-control @error($localeCode.'.name') is-invalid @enderror" 
						value="{{ old($localeCode.'.name') ?? $tag->translate($localeCode)->name }}" name="{{$localeCode}}[name]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.name')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
		<div class="px-1 mb-4">
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
						value="{{old($localeCode.'.description') ?? $tag->translate($localeCode)->description}}" name="{{$localeCode}}[description]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.description')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
        <div class="mb-5">
			<button type="submit" class="btn main-btn">
				{{ __('words.save') }} <i class="fas fa-save"></i>
			</button>
        </div>
	</form>

@endsection