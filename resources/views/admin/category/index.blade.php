@extends('layouts.app')

@section('title')
{{ __('words.categories') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>			
	<span class="active">{{ __('words.categories') }}</span>	
</section>
@endsection

@section('content')

@if($categories->count() == 0)
	<div class="text-center"><strong>{{__('words.no data to show') }}</strong></div>
@else

<table class="table">
	<thead class="text-center">
		<th>#</th>
		<th>{{ __('words.name') }}</th>
		<th>{{ __('words.visibility') }}</th>
		<th>{{ __('words.ads') }}</th>
		<th>{{ __('words.created_at') }}</th>
		<th></th>
	</thead>
	<tbody class="text-center">
	@foreach($categories as $category)
	<tr>
		<td>{{ $category->id }}</td>
		<td>{{ $category->translate(app()->getLocale())->name }}</td>
		@if($category->visibility == 1)<td><i class="fas fa-check text-success"></i></td>
		@else
		<td><i class="fas fa-times text-danger"></i></td>
		@endif
		@if($category->ads == 1)
		<td><i class="fas fa-check text-success"></i></td>
		@else
		<td><i class="fas fa-times text-danger"></i></td>
		@endif
		
		<td>{{ $category->created_at }}</td>
		
		<td>
			<a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}"><i class="fas fa-pen"></i></a>
			<a class="btn btn-danger confirm" data-id="{{$category->id}}" onclick="document.getElementById('delete-btn').dataset.id = {{$category->id}}">
				<i class="fas fa-trash"></i>
			</a>
			<form id="delete-form{{$category->id}}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-none">
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
	{{ $categories->links() }}
</section>
@endsection

@section('confirm-message')
<div id="confirm-window" class="d-none">
@include('includes.messages.confirm', ['message' => __('words.delete category confirm')])
</div>
@endsection