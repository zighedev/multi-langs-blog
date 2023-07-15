@extends('layouts.app')

@section('title')
{{ __('words.members') }}
@endsection

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>		
	<span class="active">{{ __('words.members') }}</span>	
</section>
@endsection

@section('content')

@if($users->count() == 0)
	<div class="text-center"><strong>{{__('words.no data to show') }}</strong></div>
@else
<table class="table">
	<thead class="text-center">
		<th>#</th>
		<th>{{ __('words.name') }}</th>		
		<th>{{ __('words.articles') }}</th>
		<th>{{ __('words.created_at') }}</th>
		<th></th>
	</thead>
	<tbody class="text-center">
	@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ $user->name }}</td>				
		<td>
		@if($user->total_articles == 0)
			{{ $user->total_articles }}
		@else
			<a href="#" class="active">{{ $user->total_articles }}</a>
		@endif
		</td>
		<td>{{ $user->created_at }}</td>
		
		<td>
			<a class="btn btn-danger confirm" data-id="{{$user->id}}" onclick="document.getElementById('delete-btn').dataset.id = {{$user->id}}">
				<i class="fas fa-trash"></i>
			</a>
			<form id="delete-form{{$user->id}}" action="{{ route('admin.members.destroy', $user->id) }}" method="POST" class="d-none">
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
	{{ $users->links() }}
</section>
@endsection

@section('confirm-message')
<div id="confirm-window" class="d-none">
@include('includes.messages.confirm', ['message' => __('words.delete member confirm')])
</div>
@endsection