<div class="header header-light">
  <div class="container-fluid">
    <nav id="navigation" class="navigation navigation-landscape">
      <div class="nav-header">
        <a class="nav-brand" href="{{ route('public.index') }}">
          <img src="{{ asset('themes/landing') }}/assets/img/logo.png" class="logo" alt="" />
        </a>
        <div class="nav-toggle"></div>
      </div>
      <div class="nav-menus-wrapper" style="transition-property: none;">
        <ul class="nav-menu">
        
          <li class= "{{ Meta::get('active') == 'home' ? 'active' : ''  }}"><a href="{{ route('public.index') }}">Home</a></li>
          <li class= "{{ Meta::get('active') == 'rooms' ? 'active' : ''  }}"><a href="{{ route('public.rooms') }}">Rooms</a></li>
          
        </ul>
        
        <ul class="nav-menu nav-menu-social align-to-right">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              @if(App::getLocale() == $localeCode)
              @continue
              @endif
          <li>
            <a class="second-nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [] , false) }}">
              {{ $properties['name'] }}
            </a>
          </li>  
          @endforeach
          <li>
            <a href="#" data-toggle="modal" data-target="#login">
              <i class="ti-user mr-1"></i><span class="dn-lg">{{ trans('site::default.login')}}/{{ trans('site::default.signup')}}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>