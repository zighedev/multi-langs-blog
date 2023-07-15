<div class="row">
	<div class="col-3 col-md-3 text-end">
		<a class="text-dark bg-light arr-top" href="#">&uarr;</a>
	</div>
	
	<div class="col-12 mb-4 d-flex justify-content-center">
		@if($settings->youtube)<a class="link mx-1" href="{{$settings->youtube}}"><i class="fab fa-youtube"></i></a>@endif
		@if($settings->facebook)<a class="link mx-1" href="{{$settings->facebook}}"><i class="fab fa-facebook-f"></i></a>@endif
		@if($settings->twitter)<a class="link mx-1" href="{{$settings->twitter}}"><i class="fab fa-twitter"></i></a>@endif
		@if($settings->instagram)<a class="link mx-1" href="{{$settings->instagram}}"><i class="fab fa-instagram"></i></a>@endif
	</div>
	<div class="col-4 d-flex flex-column align-items-center">
		@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
		<a rel="alternate" hreflang="{{ $localeCode }}" class="link text-sm" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
			{{ $properties['native'] }}
		</a>
		@endforeach
	</div>
	<div class="col-4 d-flex flex-column align-items-center">
		<a href="#" class="link text-sm">{{ __('words.categories') }}</a>
		<a href="#" class="link text-sm">{{ __('words.tags') }}</a>
		<a href="#" class="link text-sm">{{ __('words.latest articles') }}</a>
		<a href="#" class="link text-sm">{{ __('words.most popular') }}</a>
	</div>
	<div class="col-4 d-flex flex-column align-items-center">
		<a href="{{ route('home') }}">
			<span class="active text-sm">{{ $settings->translate(app()->getLocale())->site_name ?? $_ENV['APP_NAME'] }}</span>
		</a>
		@if($settings->about)<a class="link text-sm" href="{{ route('about') }}">{{ __('words.about') }}</a>@endif
		@if($settings->contact)<a class="link text-sm" href="{{ route('contact') }}">{{ __('words.contact') }}</a>@endif
		@if($settings->privacy_policy)<a class="link text-sm" href="{{ route('about') }}">{{ __('words.privacy policy') }}</a>@endif
	</div>
	
</div>

<div class="mt-4 text-light bg-black text-center text-sm">
	&copy {{ $settings->translate(app()->getLocale())->site_name ?? $_ENV['APP_NAME'] }} - {{now()->format('Y')}}
</div>

