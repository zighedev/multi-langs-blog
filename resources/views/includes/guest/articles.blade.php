<div class="row justify-content-center">
@foreach($articles as $article)
	<div class="col-sm-6 col-md-4 col-lg-3 p-2">
		<a href="{{route('article',$article->id)}}">
			<div class="article_card">
				<div class="article_image">
					@forelse($article->images as $image)
					<img src="{{asset('images')}}/{{$image->name}}.{{$image->extension}}" alt="{{$image->alt}}">
					@empty
					<img src="" alt="{{__('words.image unavialable')}}">
					@endforelse
				</div>
				<div class="article_title direction">{{$article->title}}</div>
			</div>
		</a>
	</div>
@endforeach
</div>