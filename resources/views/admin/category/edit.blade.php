@extends('layouts.app')

@section('title')
{{ __('words.categories') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>	
	<a href="{{route('admin.categories.index')}}" class="link-secondary">{{ __('words.categories') }}</a>		
	<span class="active">{{ __('words.edit') }}</span>	
</section>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
		@method('PUT')
        @csrf
		
    	<div class="px-1 mb-3">
			<b>{{__('words.parent')}}</b>
            <select class="form-control @error('parent') is-invalid @enderror" name="parent">
				@if(!$category->parent)
				<option class="d-none" value="">-- {{ __('words.choose') }} --</option>
				@endif
				@foreach($categories as $cat)
				@if( $cat->id == $category->parent)
				<option class="text-primary" value="{{ $category->id }}">{{ $cat->name }}</option>
				@endif
				@endforeach
				@foreach($categories as $cat)
				@if( $cat->id != $category->parent)
				<option value="{{ $cat->id }}">{{ $cat->name }}</option>
				@endif
				@endforeach
			</select>
			@error('parent')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
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
						value="{{ old($localeCode.'.name') ?? $category->translate($localeCode)->name }}" name="{{$localeCode}}[name]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.name')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>

		<div class="px-1 mb-3">
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
						value="{{old($localeCode.'.description') ?? $category->translate($localeCode)->description}}" name="{{$localeCode}}[description]">
					</div>
					@endforeach
				</div>
			</div>
			@error('*.description')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
		<div class="px-1 d-flex bg-white border mb-3" style="width: fit-content;">
			<b class="col-form-label">{{ __('Visibility') }}</b>
            <label class="switch mx-2">
				<input id="visibility" type="checkbox" name="visibility" {{ $category->visibility == 1 ? 'checked' : '' }}>
				<span class="slider"></span>
			</label>
		</div>
		
		<div class="px-1 d-flex bg-white border mb-4" style="width: fit-content;">
			<b class="col-form-label">{{ __('ads') }}</b>
            <label class="switch mx-2">
				<input id="ads" type="checkbox" name="ads" {{ $category->ads == 1 ? 'checked' : '' }}>
				<span class="slider"></span>
			</label>
		</div>
            
        
        <div class="mb-5">
			<button type="submit" class="btn main-btn">
				{{ __('words.save') }} <i class="fas fa-save"></i>
			</button>
        </div>
		
	</form>

@endsection