<footer class="dark-footer skin-dark-footer">
  <div>
    <div class="container">
      <div class="row">
        
        <div class="col-lg-3 col-md-3">
          <div class="footer_widget">
            <img src="{{ asset('themes/landing') }}/assets/img/logo-light.png" class="img-footer" alt="" />
            <div class="footer-add">
              <p>{{ Site::getDataSite('address') }}</p>
              <p>{{ Site::getDataSite('phone') }}</p>
              <p>{{ Site::getDataSite('email') }}</p>
            </div>
            
          </div>
        </div>    
        <div class="col-lg-3 col-md-3">
          <div class="footer_widget">
            <h4 class="widget_title">Menu</h4>
            <ul class="footer-menu">
              <li><a href="{{ route('public.faq') }}">{{ trans('site::default.faq')}}</a></li>
              <li><a href="{{ route('public.privacyPolicy') }}">{{ trans('site::default.privacyPolicy')}}</a></li>
              <li><a href="{{ route('public.condition') }}">{{ trans('site::default.termCondition')}}</a></li>
              <li><a href="{{ route('public.aboutUs') }}">{{ trans('site::default.aboutUs')}}</a></li>
              <li><a href="{{ route('public.blogs') }}">Blog</a></li>
            </ul>
          </div>
        </div>
            
        <div class="col-lg-3 col-md-3">
          <div class="footer_widget">
            <h4 class="widget_title">Location</h4>
            <ul class="footer-menu">

              @foreach(Rooms::getLocations(true) as $key => $location)
              @if($key > 4)
              @continue
              @endif
              <li><a href="#">{{ $location->name }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-3">
          <div class="footer_widget">
            <h4 class="widget_title">My Account</h4>
            <ul class="footer-menu">
              @if(Auth::check())
              <li><a href="{{ route('public.dashboard') }}">Dashboard</a></li>
              <li><a href="{{ route('public.bookingHistory') }}">Booking Pending</a></li>
              <li><a href="{{ route('public.bookingHistorySuccess') }}">Booking Success</a></li>
              @else
              <li><a class="modalLogin" href="javascript:;">{{ trans('site::default.login')}}</a></li>
              <li><a class="modalSignup" href="javascript:;">{{ trans('site::default.signup')}}</a></li>
              @endif
            </ul>
          </div>
        </div>       
      </div>
    </div>
  </div>
  
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        
        <div class="col-lg-6 col-md-6">
          <p class="mb-0">© {{date('Y')}} kamartamu.com</p>
        </div>
        
        <div class="col-lg-6 col-md-6 text-right hide">
          <ul class="footer-bottom-social">
            <li><a href="#"><i class="ti-facebook"></i></a></li>
            <li><a href="#"><i class="ti-twitter"></i></a></li>
            <li><a href="#"><i class="ti-instagram"></i></a></li>
            <li><a href="#"><i class="ti-linkedin"></i></a></li>
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</footer>