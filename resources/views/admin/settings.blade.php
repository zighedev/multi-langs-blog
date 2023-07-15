@extends('layouts.app')

@section('title')
{{ __('words.settings') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>		
	<span class="active">{{ __('words.settings') }}</span>	
</section>
@endsection

@section('content')

<div id="settings">
	<form method="POST" action="{{ route('admin.settings.update') }}">
		@method('PUT')
		@csrf
		
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
		
		<b class="dropdown-toggle @error('*.site_name') text-danger @enderror" data-target="#name">{{__('words.site name')}}</b>
		<div id="name" class="border-start border-dark p-1 mb-3" style="display: none;">
			<ul class="nav nav-tabs" role="tablist">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				<li class="nav-item" role="presentation">
					<button class="nav-link text-dark {{$loop->index == 0  ? 'active' : ''}}" id="{{$localeCode}}_site_name-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_site_name"
						type="button" role="tab" aria-controls="{{$localeCode}}_site_name" aria-selected="{{$loop->index == 0  ? 'true' : 'false'}}">
						{{$properties['native']}}
					</button>
				</li>
				@endforeach  
			</ul>
			<div class="tab-content">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
				id="{{$localeCode}}_site_name" role="tabpanel" aria-labelledby="{{$localeCode}}_site_name-tab">
					<input type="text" class="form-control @error($localeCode.'.site_name') is-invalid @enderror" 
					value="{{old($localeCode.'.site_name') ?? $settings->translate($localeCode)->site_name}}" name="{{$localeCode}}[site_name]">
				</div>
				@endforeach
			</div>
		</div>

		<b class="dropdown-toggle @error('*.description') text-danger @enderror" data-target="#description">{{__('words.site description')}}</b>
		<div id="description" class="border-start border-dark p-1 mb-3" style="display: none;">
			<ul class="nav nav-tabs" role="tablist">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				<li class="nav-item" role="presentation">
					<button class="nav-link text-dark {{$loop->index == 0 ? 'active' : ''}}" id="{{$localeCode}}_site_desc-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_site_desc"
						type="button" role="tab" aria-controls="{{$localeCode}}_site_desc" aria-selected="{{$loop->index == 0 ? 'true' : 'false'}}">
						{{$properties['native']}}
					</button>
				</li>
				@endforeach  
			</ul>
			<div class="tab-content">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
				id="{{$localeCode}}_site_desc" role="tabpanel" aria-labelledby="{{$localeCode}}_site_desc-tab">
					<textarea class="form-control @error($localeCode.'.description') is-invalid @enderror" 
					name="{{$localeCode}}[description]">{{old($localeCode.'.description') ?? $settings->translate($localeCode)->description}}</textarea>
				</div>
				@endforeach
			</div>
		</div>

		<b class="dropdown-toggle @error('*.notification') text-danger @enderror" data-target="#notification">{{__('words.notification message')}}</b>
		<div id="notification" class="border-start border-dark p-1 mb-3" style="display: none;">
			<ul class="nav nav-tabs" role="tablist">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				<li class="nav-item" role="presentation">
					<button class="nav-link text-dark {{$loop->index == 0 ? 'active' : ''}}" id="{{$localeCode}}_notification-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_notification"
						type="button" role="tab" aria-controls="{{$localeCode}}_notification" aria-selected="{{$loop->index == 0 ? 'true' : 'false'}}">
						{{$properties['native']}}
					</button>
				</li>
				@endforeach  
			</ul>
			<div class="tab-content">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
				id="{{$localeCode}}_notification" role="tabpanel" aria-labelledby="{{$localeCode}}_notification-tab">
					<textarea class="form-control @error($localeCode.'.notification') is-invalid @enderror" 
					name="{{$localeCode}}[notification]">{{old($localeCode.'.notification') ?? $settings->translate($localeCode)->notification}}</textarea>
				</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 mt-3">
				<b class="@error('phone') text-danger @enderror">{{__('words.phone')}}</b>
				<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? $settings->phone}}">
			</div>
			<div class="col-lg-6 mt-3">
				<b class="@error('email') text-danger @enderror">{{__('words.email')}}</b>
				<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? $settings->email}}">
			</div>
			<div class="col-lg-6 mt-3">
				<b class="@error('youtube') text-danger @enderror">{{__('words.youtube')}}</b>
				<input type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{old('youtube') ?? $settings->youtube}}">
			</div>
			<div class="col-lg-6 mt-3">
				<b class="@error('facebook') text-danger @enderror">{{__('words.facebook')}}</b>
				<input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{old('facebook') ?? $settings->facebook}}">
			</div>
			<div class="col-lg-6 mt-3">
				<b class="@error('instagram') text-danger @enderror">{{__('words.instagram')}}</b>
				<input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{old('instagram') ?? $settings->instagram}}">
			</div>
			<div class="col-lg-6 mt-3">
				<b class="@error('twitter') text-danger @enderror">{{__('words.twitter')}}</b>
				<input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{old('twitter') ?? $settings->twitter}}">
			</div>
			
			<div class="mt-5">
				<button type="submit" class="btn main-btn">
					{{ __('words.save') }} <i class="fas fa-save"></i>
				</button>
			</div>
		</div>
		
	</form>

</div>

@endsection