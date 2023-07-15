@extends('layouts.app')


@if($subcategory->title)
@section('title'){{$subcategory->title}}@endsection
@else
@section('title'){{$subcategory->name}}@endsection
@endif

@if($subcategory->description)
@section('description'){{$subcategory->description}}@endsection
@elseif($subcategory->title)
@section('description'){{$subcategory->title}}@endsection
@else
@section('description'){{$subcategory->name}}@endsection
@endif


@section('page_title')
<section class="page_title">
	{{$subcategory->name}}		
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