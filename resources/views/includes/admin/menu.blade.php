<div id="adminMenu" class="d-none">
	<div class="row">
		<div class="col-1 col-md-2 col-lg-3"></div>
		<div class="menu col-10 col-md-8 col-lg-6">
			<div class="d-flex flex-row-reverse direction">
				<a href="#" class="adminMenuControl btn btn-outline-light py-1 mb-4"><i class="fa fa-times"></i></a>
			</div>
			<a href="{{ route('admin.dashboard') }}" class="menu-item">
				<i class="fa fa-tachometer-alt"></i>
				{{ __('words.dashboard') }}
			</a>
			<a href="{{ route('admin.articles.index') }}" class="menu-item sub-menu">
				<i class="fa fa-file mx-2"></i>
				{{ __('words.articles') }}
			</a>
			<a href="{{ route('admin.categories.index') }}" class="menu-item sub-menu">
				<i class="fa fa-folder ms-2 me-1"></i>
				{{ __('words.categories') }}
			</a>
			<a href="{{ route('admin.members.index') }}" class="menu-item sub-menu">
				<i class="fa fa-users mx-1"></i>
				{{ __('words.members') }}
			</a>
			<a href="{{ route('admin.comments.index') }}" class="menu-item sub-menu">
				<i class="fa fa-comments mx-1"></i>
				{{ __('words.comments') }}
			</a>     
			<a href="{{ route('admin.tags.index') }}" class="menu-item sub-menu">
				<i class="fa fa-tags mx-1"></i>
				{{ __('words.tags') }}
			</a>
		</div>
		<div class="col-1 col-md-2 col-lg-3"></div>
	</div>
</div>