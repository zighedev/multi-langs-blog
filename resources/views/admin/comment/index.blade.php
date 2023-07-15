@extends('layouts.app')

@section('title')
{{ __('words.comments') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>		
	<span class="active">{{ __('words.comments') }}</span>	
</section>
@endsection

@section('content')

@if($comments->count() == 0)
	<div class="text-center"><strong>{{__('words.no data to show') }}</strong></div>
@else

<table class="table">
	<thead>
		<th>#</th>
		<th>{{ __('words.name') }}</th>
		<th>{{ __('words.email') }}</th>
		<th>{{ __('words.comment') }}</th>
		<th>{{ __('words.article') }}</th>
		<th>{{ __('words.created_at') }}</th>
		<th>{{ __('words.updated_at') }}</th>
		<th></th>
	</thead>
	@foreach($comments as $comment)
	<tr>
		<td>{{ $comment->id }}</td>
		<td>{{ $comment->name }}</td>
		<td>{{ $comment->email }}</td>
		<td>{{ $comment->comment }}</td>
		<td><a href="#{{ $comment->article->id }}">{{ $comment->article->title }}</a></td>
		<td>{{ $comment->created_at }}</td>
		<td>{{ $comment->updated_at }}</td>
		<td>
			<a class="btn btn-danger confirm" data-id="{{$comment->id}}"  onclick="document.getElementById('delete-btn').dataset.id = {{$comment->id}}">
				<i class="fas fa-trash"></i>
			</a>
			<form id="delete-form{{$comment->id}}" action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-none">
				@method('DELETE')
			    @csrf
			</form>
			@if($comment->email)
			<a class="btn btn-primary" href="{{ route('admin.comments.create') }}?email={{$comment->email}}"><i class="fas fa-reply"></i></a>
			@endif			
		</td>
	</tr>
	@endforeach
</table>
@endif
@endsection

@section('page_pagination')
<section class="page_pagination">
	{{ $comments->links() }}
</section>
@endsection

@section('confirm-message')
<div id="confirm-window" class="d-none">
@include('includes.messages.confirm', ['message' => __('words.delete comment confirm')])
</div>
@endsection