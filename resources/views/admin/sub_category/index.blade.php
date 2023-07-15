@extends('layouts.app')

@section('title')
{{ __('words.sub categories') }}
@endsection

@section('page_title')
<section class="page_title">
	{{ __('words.sub categories') }}		
</section>
@endsection

@section('content')

@if($subcategories->count() == 0)
	<div class="text-center"><strong>{{__('words.no data to show') }}</strong></div>
@else
<table class="table">
	<thead>
		<th>#</th>
		<th>{{ __('words.name_en') }}</th>
		<th>{{ __('words.name_fr') }}</th>
		<th>{{ __('words.name_ar') }}</th>
		<th>{{ __('words.visibility') }}</th>
		<th>{{ __('words.title') }}</th>
		<th>{{ __('words.description') }}</th>
		<th>{{ __('words.created_at') }}</th>
		<th>{{ __('words.updated_at') }}</th>
		<th></th>
	</thead>
	@foreach($subcategories as $sub)
	<tr>
		<td>{{ $sub->id }}</td>
		<td>{{ $sub->name_en }}</td>
		<td>{{ $sub->name_fr }}</td>
		<td>{{ $sub->name_ar }}</td>
		@if($sub->visibility == 1)
			
		<td class="bg-success text-light text-center border">{{__('words.visible')}}</td>
		@else
		<td class="bg-danger text-light text-center border">{{__('words.invisible')}}</td>
		@endif
		
		@if($sub->title == 1)
		<td class="bg-success text-light text-center border">{{__('words.complete')}}</td>
		@else
		<td class="bg-danger text-light text-center border">{{__('words.incomplete')}}</td>
		@endif
		
		@if($sub->description == 1)
		<td class="bg-success text-light text-center border">{{__('words.complete')}}</td>
		@else
		<td class="bg-danger text-light text-center border">{{__('words.incomplete')}}</td>
		@endif
		
		<td>{{ $sub->created_at }}</td>
		<td>{{ $sub->updated_at }}</td>
		<td>
			<a class="btn btn-primary" href="{{ route('admin.sub-categories.edit', $sub->id) }}"><i class="fas fa-pen"></i></a>
			<a class="btn btn-danger confirm" data-id="{{$sub->id}}" onclick="document.getElementById('delete-btn').dataset.id = {{$sub->id}}">
				<i class="fas fa-trash"></i>
			</a>
			<form id="delete-form{{$sub->id}}" action="{{ route('admin.sub-categories.destroy', $sub->id) }}" method="POST" class="d-none">
				@method('DELETE')
			    @csrf
			</form>
		</td>
	</tr>
	@endforeach
</table>
@endif
@endsection

@section('page_pagination')
<section class="page_pagination">
	{{ $subcategories->links() }}
</section>
@endsection

@section('confirm-message')
<div id="confirm-window" class="d-none">
@include('includes.messages.confirm', ['message' => __('words.delete subcategory confirm')])
</div>
@endsection