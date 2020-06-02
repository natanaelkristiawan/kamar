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
          @if(Auth::check())
          <li class="hide-in-mobile"><a href="">Dashboard</a></li>
          @endif
          <li class= "{{ Meta::get('active') == 'home' ? 'active' : ''  }}"><a href="{{ route('public.index') }}">Home</a></li>
          <li class= "{{ Meta::get('active') == 'rooms' ? 'active' : ''  }}"><a href="{{ route('public.rooms') }}">Rooms</a></li>
          <li class= "{{ Meta::get('active') == 'blogs' ? 'active' : ''  }}"><a href="{{ route('public.blogs') }}">Blogs</a></li>
          @if(Auth::check())
          <li class="hide-in-mobile"><a href="{{ route('public.logout') }}">Logout</a></li>
          @endif
        </ul>

        <ul class="nav-menu nav-menu-social align-to-right hidden-sm" >
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

          @if(Auth::check())
          <li class="nav-item dropdown" id="rightmenu">
            <a class="nav-link dropdown-toggle" href="#" id="profileCustomer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{Auth::user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="profileCustomer">
              <a class="dropdown-item" href="#">Dashboard</a>
              <a class="dropdown-item" href="{{ route('public.logout') }}"">Logout</a>
            </div>
          </li>
          @else
          <li>
            <a href="#" class="modalLogin">
              <i class="ti-user mr-1"></i><span class="dn-lg">{{ trans('site::default.login')}}/{{ trans('site::default.signup')}}</span>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </nav>
  </div>
</div>