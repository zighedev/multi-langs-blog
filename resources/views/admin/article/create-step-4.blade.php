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
	<span class="step current">4</span>
	<span class="step">5</span>
	<span class="step">6</span>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}">
        @csrf
		
		<input type="hidden" name="step" value="4">
		
		<div class="px-1 mb-4">
			<b>{{__('words.content')}}</b>
            <div class="pt-2">
				<ul class="nav nav-tabs" role="tablist">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<li class="nav-item" role="presentation">
						<button class="nav-link text-dark {{$loop->index == 0  ? 'active' : ''}}" id="{{$localeCode}}_content-tab" data-bs-toggle="tab" data-bs-target="#{{$localeCode}}_content"
							type="button" role="tab" aria-controls="{{$localeCode}}_content" aria-selected="{{$loop->index == 0  ? 'true' : 'false'}}">
							{{$properties['native']}}
						</button>
					</li>
					@endforeach  
				</ul>
				<div class="tab-content">
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<div class="tab-pane fade p-2 bg-white {{$loop->index == 0 ? 'show active' : ''}}" 
					id="{{$localeCode}}_content" role="tabpanel" aria-labelledby="{{$localeCode}}_content-tab">
						<div class="@error($localeCode.'.content') is-invalid @enderror" 
						name="{{$localeCode}}[content]" id="{{$localeCode}}_editor"></div>
					</div>
					@endforeach
				</div>
			</div>
			@error('*.content')
			<strong class="text-danger text-sm">{{$message}}</strong>
			@enderror
        </div>
		
          <div class="row mb-5">
            <div class="col-md-12">
            	<a href="?previous=3" class="btn btn-secondary svg-rotate">
                    <i class="fas fa-arrow-right fa-rotate-180"></i> {{ __('words.previous') }}
                </a>
				<button type="submit" class="btn main-btn svg-rotate">
                    {{ __('words.next') }} <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
		
	</form>

@endsection

@section('scripts')
	@parent
<script src="{{asset('js/ckeditor.js')}}"></script>

@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
<script src="{{asset('js/translations')}}/{{$localeCode}}.js"></script>
<script>
	ClassicEditor
        .create( document.querySelector( '#{{$localeCode}}_editor' ),
			{language: '{{$localeCode}}'}
		)
        .catch( error => {
            console.error( error );
        } );
</script>
@endforeach

@endsection