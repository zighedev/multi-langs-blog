@extends('layouts.app')

@section('title')
{{ __('words.dashboard') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>		
	<span class="active">{{ __('words.dashboard') }}</span>	
</section>
@endsection

@section('content')

<div id="dashboard">
	
	<div class="d-flex flex-wrap">
	
		<div class="box">		
			<div>
				<h4>{{ __('words.articles') }}</h4>
				<div class="total"><a href="{{route('admin.articles.index')}}">{{ $articles['total'] }}</a></div>
				<div class="text-center mt-3">				
					<a class="btn dashboard-btn" href="{{ route('admin.articles.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>
			<div class="details">
				<div class="detail">
					<a href="{{route('admin.articles.index')}}?approved" class="d-flex">
						<span class="mx-1">{{ __('words.approved') }}</span>
						<span> {{ $articles['approved'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.articles.index')}}?notapproved" class="d-flex">
						<span class="mx-1">{{ __('words.not approved') }}</span>
						<span> {{ $articles['notApproved'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.articles.index')}}?watched" class="d-flex">
						<span class="mx-1">{{ __('words.watched') }}</span>
						<span> {{ $articles['watched'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.articles.index')}}?notbeenwatched" class="d-flex">
						<span class="mx-1">{{ __('words.not been watched') }}</span>
						<span> {{ $articles['notBeenWatched'] }}</span>
					</a>
				</div>
			</div>
		</div>
		@if(Auth::user()->role == 'admin')
		<div class="box">		
			<div>
				<h4>{{ __('words.categories') }}</h4>
				<div class="total"><a href="{{route('admin.categories.index')}}">{{ $categories['total'] }}</a></div>
				<div class="text-center mt-3">				
					<a class="btn dashboard-btn" href="{{ route('admin.categories.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>
			<div class="details">
				<div class="detail">
					<a href="{{route('admin.categories.index')}}?visible" class="d-flex">
						<span class="mx-1">{{ __('words.visible') }}</span>
						<span> {{ $categories['visible'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.categories.index')}}?invisible" class="d-flex">
						<span class="mx-1">{{ __('words.invisible') }}</span>
						<span> {{ $categories['invisible'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.categories.index')}}?ads" class="d-flex">
						<span class="mx-1">{{ __('words.ads allowed') }}</span>
						<span> {{ $categories['adsAllowed'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.categories.index')}}?noads" class="d-flex">
						<span class="mx-1">{{ __('words.ads not allowed') }}</span>
						<span> {{ $categories['adsNotAllowed'] }}</span>
					</a>
				</div>
			</div>
		</div>
		
		<div class="box">		
			<div>
				<h4>{{ __('words.members') }}</h4>
				<div class="total"><a href="{{route('admin.members.index')}}">{{ $users['total'] }}</a></div>
			</div>
		</div>
		
		<div class="box">		
			<div>
				<h4>{{ __('words.tags') }}</h4>
				<div class="total"><a href="{{route('admin.tags.index')}}">{{ $tags['total'] }}</a></div>
				<div class="text-center mt-3">				
					<a class="btn dashboard-btn" href="{{ route('admin.tags.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>
		</div>
		
		<div class="box">		
			<div>
				<h4>{{ __('words.comments') }}</h4>
				<div class="total"><a href="{{route('admin.comments.index')}}">{{ $comments['total'] }}</a></div>
			</div>
			<div class="details">
				<div class="detail">
					<a href="{{route('admin.comments.index')}}?hasemail" class="d-flex">
						<span class="mx-1">{{ __('words.has email') }}</span>
						<span> {{ $comments['hasEmail'] }}</span>
					</a>
				</div>
				<div class="detail">
					<a href="{{route('admin.comments.index')}}?doesnthaveemail" class="d-flex">
						<span class="mx-1">{{ __('words.doesnt have email') }}</span>
						<span> {{ $comments['doesntHaveEmail'] }}</span>
					</a>
				</div>
			</div>
		</div>
		@endif
	</div>

</div>

@endsection