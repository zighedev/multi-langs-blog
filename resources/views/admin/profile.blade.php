@extends('layouts.app')

@section('title')
{{ __('words.profile') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>			
	<span class="active">{{ __('words.profile') }}</span>	
</section>
@endsection

@section('content')


<div id="profile">
	<form method="POST" action="{{ route('admin.profile.update') }}">
		@method('PUT')
		@csrf
		
		<div class="row">
			<div class="col-lg-6 mt-3">
				<b>{{__('words.name')}}</b>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? $user->name}}">
			</div>
			<div class="col-lg-6 mt-3">
				<b class="@error('email') text-danger @enderror">{{__('words.email')}}</b>
				<input type="text" class="form-control" value="{{$user->email}}" disabled>
			</div>
			<div class="col-lg-6 mt-3">
				<b>{{__('words.language')}}</b>
				<select class="form-control" name="locale">
				@if($user->locale)
					<option value="{{$user->locale}}">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					@if($user->locale == $localeCode)
					{{ $properties['native'] }}
					@endif
					@endforeach
					</option>
				@else
					<option value="">-- {{ __('words.choose') }} --</option>
				@endif
				
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				@if($user->locale != $localeCode)
					<option value="{{ $localeCode }}">{{ $properties['native'] }}</option>
				@endif
				@endforeach
				</select>
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