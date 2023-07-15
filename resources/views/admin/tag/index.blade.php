@extends('layouts.app')

@section('title')
{{ __('words.tags') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>		
	<span class="active">{{ __('words.tags') }}</span>	
</section>
@endsection

@section('content')

@if($tags->count() == 0)
	<div class="text-center"><strong>{{__('words.no data to show') }}</strong></div>
@else
<table class="table">
	<thead class="text-center">
		<th>#</th>
		<th>{{ __('words.name') }}</th>
		<th>{{ __('words.created_at') }}</th>
		<th></th>
	</thead>
	<tbody class="text-center">
	@foreach($tags as $tag)
	<tr>
		<td>{{ $tag->id }}</td>
		<td>{{ $tag->translate(app()->getLocale())->name }}</td>				
		<td>{{ $tag->created_at }}</td>
		
		<td>
			<a class="btn btn-primary" href="{{ route('admin.tags.edit', $tag->id) }}"><i class="fas fa-pen"></i></a>
			<a class="btn btn-danger confirm" data-id="{{$tag->id}}" onclick="document.getElementById('delete-btn').dataset.id = {{$tag->id}}">
				<i class="fas fa-trash"></i>
			</a>
			<form id="delete-form{{$tag->id}}" action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="d-none">
				@method('DELETE')
			    @csrf
			</form>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@endif
@endsection

@section('page_pagination')
<section class="page_pagination">
	{{ $tags->links() }}
</section>
@endsection

@section('confirm-message')
<div id="confirm-window" class="d-none">
@include('includes.messages.confirm', ['message' => __('words.delete tag confirm')])
</div>
@endsection