	<div class="row justify-content-center">
		
		<div class="col-md-6 col-lg-4 p-2">
			<div class="dash-card bg-dark">
				<div class="title">{{ __('words.articles') }}</div>
				<a href="{{route('admin.articles.index')}}" class="link total">
					<div class="mx-1">{{ __('words.total') }}</div>
					<div> {{ $articles['total'] }}</div>
				</a>
				<div class="others">
					<a href="{{route('admin.articles.index')}}?approved" class="link">
						<div class="mx-1">{{ __('words.approved') }}</div>
						<div> {{ $articles['approved'] }}</div>
					</a>
					<a href="{{route('admin.articles.index')}}?notapproved" class="link">
						<div class="mx-1">{{ __('words.not approved') }}</div>
						<div> {{ $articles['notApproved'] }}</div>
					</a>
					<a href="{{route('admin.articles.index')}}?watched" class="link">
						<div class="mx-1">{{ __('words.watched') }}</div>
						<div> {{ $articles['watched'] }}</div>
					</a>
					<a href="{{route('admin.articles.index')}}?notbeenwatched" class="link">
						<div class="mx-1">{{ __('words.not been watched') }}</div>
						<div> {{ $articles['notBeenWatched'] }}</div>
					</a>
				</div>
				<div class="buttons">				
					<a class="btn btn-outline-success mx-1" href="{{ route('admin.articles.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>		
		</div>
		
		@if(Auth::user()->role == 'admin')
		
		<div class="col-md-6 col-lg-4 p-2">
			<div class="dash-card bg-dark">
				<div class="title">{{ __('words.categories') }}</div>
				<a href="{{route('admin.categories.index')}}" class="link total">
					<div class="mx-1">{{ __('words.total') }}</div>
					<div> {{ $categories['total'] }}</div>
				</a>
				<div class="others">
					<a href="{{route('admin.categories.index')}}?visible" class="link">
						<div class="mx-1">{{ __('words.visible') }}</div>
						<div> {{ $categories['visible'] }}</div>
					</a>
					<a href="{{route('admin.categories.index')}}?invisible" class="link">
						<div class="mx-1">{{ __('words.invisible') }}</div>
						<div> {{ $categories['invisible'] }}</div>
					</a>				
					<a href="{{route('admin.categories.index')}}?ads" class="link">
						<div class="mx-1">{{ __('words.ads allowed') }}</div>
						<div> {{ $categories['adsAllowed'] }}</div>
					</a>
					<a href="{{route('admin.categories.index')}}?noads" class="link">
						<div class="mx-1">{{ __('words.ads not allowed') }}</div>
						<div> {{ $categories['adsNotAllowed'] }}</div>
					</a>
				</div>
				<div class="buttons">				
					<a class="btn btn-outline-success mx-1" href="{{ route('admin.categories.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>		
		</div>
		
		<div class="col-md-6 col-lg-4 p-2">
			<div class="dash-card bg-dark">
				<div class="title">{{ __('words.members') }}</div>
				<a href="{{route('admin.members.index')}}" class="link total">
					<div class="mx-1">{{ __('words.total') }}</div>
					<div> {{ $users['total'] }}</div>
				</a>
				<div class="buttons">				
					<a class="btn btn-outline-success mx-1" href="{{ route('admin.members.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>		
		</div>
		
		<div class="col-md-6 col-lg-4 p-2">
			<div class="dash-card bg-dark">
				<div class="title">{{ __('words.comments') }}</div>
				<a href="{{route('admin.comments.index')}}" class="link total">
					<div class="mx-1">{{ __('words.total') }}</div>
					<div> {{ $comments['total'] }}</div>
				</a>
				<div class="others">
					<a href="{{route('admin.comments.index')}}?hasemail" class="link">
						<div class="mx-1">{{ __('words.has email') }}</div>
						<div> {{ $comments['hasEmail'] }}</div>
					</a>
					<a href="{{route('admin.comments.index')}}?doesnthaveemail" class="link">
						<div class="mx-1">{{ __('words.doesnt have email') }}</div>
						<div> {{ $comments['doesntHaveEmail'] }}</div>
					</a>				
				</div>
			</div>		
		</div>
		<div class="col-md-6 col-lg-4 p-2">
			<div class="dash-card bg-dark">
				<div class="title">{{ __('words.tags') }}</div>
				<a href="{{route('admin.tags.index')}}" class="link total">
					<div class="mx-1">{{ __('words.total') }}</div>
					<div> {{ $tags['total'] }}</div>
				</a>
				<div class="buttons">				
					<a class="btn btn-outline-success mx-1" href="{{ route('admin.tags.create') }}">
						{{ __('buttons.add') }} <i class="fas fa-plus"></i>
					</a>
				</div>
			</div>		
		</div>
		
		@endif
		
	</div>