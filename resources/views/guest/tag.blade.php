@extends('layouts.app')


@if($tag->title)
@section('title'){{$tag->title}}@endsection
@endif

@if($tag->description)
@section('description'){{$tag->description}}@endsection
@else
@section('description'){{$tag->title}}@endsection
@endif


@section('page_title')
<section class="page_title direction">
	{{$tag->name}}		
</section>
@endsection

@section('content')
<section class="content">
@include('includes.guest.articles')
</div>
</section>
@endsection

@section('page_pagination')
<section class="page_pagination">
	{{ $articles->links() }}
</section>
@endsection