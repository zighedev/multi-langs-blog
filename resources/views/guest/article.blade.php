@extends('layouts.app')


@if($article->title)
@section('title'){{$article->title}}@endsection
@endif

@if($article->description)
@section('description'){{$article->description}}@endsection
@else
@section('description'){{$article->title}}@endsection
@endif

@section('page_path')
<section class="page_path">
	<a href="{{route('home')}}" class="link-secondary">{{ __('words.home') }}</a>	
	<a href="{{route('subcategory', $article->category_id)}}" class="link-secondary">{{ $article->category->name }}</a>		
	<span class="active text-sm">{{ $article->title }}</span>	
</section>
@endsection

@section('content')
<section class="content">
	<article>
		<h1>{{ $article->title }}</h1>
		<div class="article-owner">
			<span><i class="far fa-user-circle"></i> {{ $article->user->id === auth()->user()->id ? __('words.me') : $article->user->name }} </span>
			<span><i class="far fa-clock"></i> {{ $article->created_at }}</span>
		</div>
		<div class="article-img">
			<img src="{{asset('images')}}/{{$article->image}}" alt="{{$article->image_description}}">
		</div>
		<div class="article-content">{!!$article->content!!}</div>
	</article>
</section>
@endsection


@if($tags->count() != 0)
@section('tags')
<section class="tags">
	<div class="title">{{ __('words.tags') }}</div>
	<div class="section-content">
		@foreach($tags as $tag)
		<a href=" {{route('tag', $tag->id)}} " class="tag"> {{ $tag->name }} </a>
		@endforeach
	</div>
</section>
@endsection
@endif

@section('comments')
<section class="comments">
	<div class="title">{{ __('words.comments') }}</div>
	<div class="section-content">
		
		<div class="comment comment-form">
			<div class="row px-3">
				<div class="col-md-10 col-lg-8 mb-2">
					<input id="name" type="text" class="form-control required" name="name" placeholder="{{__('words.name')}} (*)">
					<small id="err-name" class="text-danger form-text"></small>
				</div>
				<div class="col-md-10 col-lg-8 mb-2">
					<input id="email" type="text" class="form-control" name="email" placeholder="{{__('words.email')}}">
					<small id="err-email" class="text-danger form-text"></small>
				</div>
				<div class="col-md-10 col-lg-8 mb-2">
					<textarea id="comment" class="form-control required" rows="3" name="comment" placeholder="{{__('words.write your comment her')}} (*)"></textarea>
					<small id="err-comment" class="text-danger form-text"></small>
				</div>
				<div class="col-12"></div>
				<div class="col-md-3">
					<button id="comment-submit" class="btn main-btn" style="width: 100%;height: 38px;" disabled>{{ __('words.post a comment') }}</button>
				</div>
			</div>	
		</div>
		
		@foreach($comments as $comment)
		<div class="comment">
			<div class="comment-user">
				<span><i class="far fa-user-circle"></i> {{ $comment->name }}</span>
				<span class="clock"><i class="far fa-clock"></i> {{ $comment->created_at }}</span>
			</div>
			<div class="comment-body">{{$comment->comment}}</div>
		</div>
		@endforeach
	</div>
</section>
@endsection


{{--

@if($related_articles->count() != 0)
@section('related')
<section class="related">
	<div class="title">related articles</div>
	<div class="section-content">
		@include('includes.guest.articles', ['articles' => $related_articles])
	</div>
</section>
@endsection
@endif
--}}


@section('scripts')
	@parent
<script>
	
	let name = 0;
	let comment = 0;
	
	$(document).on('input', '.required', function(){
		
		if( $(this).attr('name') == 'name' ){
			name = $(this).val().length;
		}
		if( $(this).attr('name') == 'comment' ){
			comment = $(this).val().length;
		}
				
		$('#comment-submit').attr('disabled', name != 0 && comment != 0 ? false : true);
	});
	
    $(document).on('click', '#comment-submit', function(){
		
		$(this).html(loader);
        $('small').text('');
        $('#name').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        $('#comment').removeClass('is-invalid');
		$.ajaxSetup({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
		});
        $.ajax({
            type: 'post',
            url: '{{route("comment")}}',
            data: {
				'_token': "{{csrf_token()}}",
				'name': $("input[name='name']").val(),
				'email': $("input[name='email']").val(),
				'comment': $("textarea").val(),
				'article_id': "{{$article->id}}"
			},
            success: function(data){
                $('input').val('');
                $('textarea').val('');
                $('#comment-submit').html("{{ __('words.post a comment') }}").attr('disabled', true);
				if(data.success){
					$('.comment-form').remove();					
				}
            },
            error: function(reject){
				$('#comment-submit').html("{{ __('words.post a comment') }}").attr('disabled', false);
                let jsonResponseErrors = $.parseJSON(reject.responseText).errors;
                $.each(jsonResponseErrors, function(key, val){
                    $('#err-'+key).text(val[0]);
                    $('#'+key).addClass('is-invalid');
                });
            }
        });
    });
        
</script>
@endsection