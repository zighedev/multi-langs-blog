@extends('layouts.app')

@section('title')
{{ __('words.articles') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>			
	<span class="active">{{ __('words.articles') }}</span>	
</section>
@endsection

@section('content')

@if($articles->count() == 0)
	<div class="text-center"><strong>{{__('words.no data to show') }}</strong></div>
@else

<table class="table">
	<thead class="text-center">
		<th>#</th>
		<th>{{ __('words.title') }}</th>
		@if(auth()->user()->role === 'admin')
		<th>{{ __('words.owner') }}</th>
		@endif
		<th>{{ __('words.approval') }}</th>
		<th>{{ __('words.category') }}</th>
		<th>{{ __('words.created_at') }}</th>
		<th></th>
	</thead>
	<tbody class="text-center">
	@foreach($articles as $article)
	<tr>
		<td>{{ $article->id }}</td>
		<td>{{ $article->title }}</td>
		@if(auth()->user()->role === 'admin')
		<td>
			<a href="{{ route('admin.articles.index') }}?me" class="bg-link">
				{{ $article->user->id ===  auth()->user()->id ? __('words.me') : '' }}
			</a>
		</td>
		@endif
		@if($article->approval == 1)<td><i class="fas fa-check text-success"></i></td>
		@else
		<td><i class="fas fa-times text-danger"></i></td>
		@endif
				
		<td>
			<a href="{{ route('admin.articles.index') }}?category={{$article->category->id}}" class="bg-link">
				{{ $article->category->name }}
			</a>
		</td>
		<td>{{ $article->created_at }}</td>
		
		<td>
			<a class="btn btn-success" href="{{ route('article', $article->id) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
			@can('update', $article)
			<a class="btn btn-primary" href="{{ route('admin.articles.edit', $article->id) }}"><i class="fas fa-pen"></i></a>
			@endcan
			@can('delete', $article)
			<a class="btn btn-danger confirm" data-id="{{$article->id}}" onclick="document.getElementById('delete-btn').dataset.id = {{$article->id}}">
				<i class="fas fa-trash"></i>
			</a>
			<form id="delete-form{{$article->id}}" action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-none">
				@method('DELETE')
			    @csrf
			</form>
			@endcan
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@endif
@endsection

@section('page_pagination')
<section class="page_pagination">
	{{ $articles->links() }}
</section>
@endsection

@section('confirm-message')
<div id="confirm-window" class="d-none">
@include('includes.messages.confirm', ['message' => __('words.delete article confirm')])
</div>
@endsection