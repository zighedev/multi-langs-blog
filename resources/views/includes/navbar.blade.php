<nav class="navbar navbar-expand-xlg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" id="brand" href="{{ route('home') }}">
		{{ $settings->translate(app()->getLocale())->site_name ?? $_ENV['APP_NAME'] }}
	</a>
	
	@guest
	<div class="admin-nav-icons">
		<li class="dropdown">
			<a href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fas fa-user-circle text-secondary" style="font-size: 2em;"></i>
			</a>
			<ul class="dropdown-menu" aria-labelledby="userDropdown">		  
				<li>
					<a class="dropdown-item" href="{{ route('login') }}">
						{{ __('words.login') }}
					</a>
				</li>
				<li>
					<a class="dropdown-item" href="{{ route('register') }}">
						{{ __('words.register') }}
					</a>
				</li>				
			</ul>
		</li>
	</div>
	@endguest
	
	@auth
	<div class="d-flex admin-nav-icons">
	
		<li>
		@if(Auth::user()->role == 'admin')
			<a href="#" class="adminMenuControl">
		@else
			<a href="{{ route('admin.dashboard')}}">
		@endif
				<i class="fas fa-tachometer-alt text-secondary" style="font-size: 2em;"></i>
			</a>
        </li>
		<li class="dropdown">
			<a href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fas fa-user-circle text-secondary" style="font-size: 2em;"></i>
			</a>
			<ul class="dropdown-menu" aria-labelledby="userDropdown">		  
				<li>
					<a class="dropdown-item direction" href="{{ route('admin.profile') }}">
						<i class="fa fa-user"></i>
						{{ __('words.profile') }}
					</a>
				</li>
				@if(Auth::user()->role == 'admin')
				<li>
					<a class="dropdown-item direction" href="{{ route('admin.settings') }}">
						<i class="fa fa-cog"></i>
						{{ __('words.settings') }}
					</a>
				</li>
				@endif
				<div class="dropdown-divider"></div>
				<li>
					<a class="dropdown-item direction" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="fa fa-power-off"></i>
						{{ __('buttons.logout') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</li>
			</ul>
		</li>
		@if(Auth::user()->role == 'writer')
		<li>
			<a href="#"><i class="fa fa-bell text-secondary" style="font-size: 2em;"></i></a>
		</li>
		@endif
	
	</div>
	@endauth
	
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-grow: 0.5;">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto direction"> 
		
		<a href="#" class="nav-link dropdown-toggle navbarToggle" data-bs-toggle="collapse" data-bs-target="#navbarToggleCategories" aria-controls="navbarToggleCategories" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-folder text-secondary"></i>
			{{ __('words.categories') }}
		</a>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-globe-americas text-secondary"></i>
			@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				@if(app()->getLocale() == $localeCode){{ __('words.language') }}@endif
			@endforeach
          </a>
          <ul class="dropdown-menu" aria-labelledby="languageDropdown" id="langs">		  
			@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
			<li>
				<a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
					{{ $properties['native'] }}
				</a>
			</li>
			@endforeach
          </ul>
        </li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('about') }}"><i class="fas fa-info-circle text-secondary"></i> {{ __('words.about') }}</a>
        </li>
        <li class="nav-item">
			<a class="nav-link" href="{{ route('contact') }}"><i class="fas fa-envelope text-secondary"></i> {{ __('words.contact') }}</a>
        </li>
		
      </ul>
	  
      <form class="d-flex direction">
        <input class="form-control me-2" type="search" placeholder="{{ __('words.search') }}" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">{{ __('words.search') }}</button>
      </form>
    </div>
  </div>
</nav>

<div class="collapse " id="navbarToggleCategories">
  <div class="bg-dark p-2 mt-1 d-flex justify-content-center direction"></div>
</div>


<div class="collapse " id="navbarToggleSubCategories">
  <div class="bg-dark p-2 mt-1 d-flex justify-content-center direction"></div>
</div>
</div>