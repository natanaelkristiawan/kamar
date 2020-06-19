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

          <div class="row">
            <div class="d-block col-lg-12">
              <h4 class="widget_title mb-1">Payment Partners</h4>
            </div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336137510-758f10ec383cb349ffee7bc0fa516c3f.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336144166-e6e7ce40ff72a97e6e0eeeabda7595d7.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336148727-34b7516141fad67cf3b28a682ab0cc93.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336152817-f0ef4ea005ad461b4b2cd0a8fdec6628.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336157462-2cdb1a639427a49e80060bb6e293d50f.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336160378-6e3d05dade33f8b94afb06edad45582e.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336166816-6749d37525bdb6599b47e8f134a094f6.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336170813-a362e7f1758db9360ee23dfb38463ae4.png?tr=q-75&amp;w=51"></div>
            <div class="col-lg-4 mb-2"><img class="img-fluid p-1" style="background-color: white " src="https://ik.imagekit.io/tvlk/image/imageResource/2019/05/20/1558336173985-7a9c617faf21b6770c4b81bfae3df621.png?tr=q-75&amp;w=51"></div>
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
        
        <div class="col-lg-6 col-md-6 text-right">
          <ul class="footer-bottom-social">
            <li><a class="medsos" href="{{ Site::getDataSite('media-facebook')  }}"><i class="ti-facebook"></i></a></li>
            <li><a class="medsos" href="{{ Site::getDataSite('media-twitter')  }}"><i class="ti-twitter"></i></a></li>
            <li><a class="medsos" href="{{ Site::getDataSite('media-instagram')  }}"><i class="ti-instagram"></i></a></li>
            <li><a class="medsos" href="{{ Site::getDataSite('media-linkedin')  }}"><i class="ti-linkedin"></i></a></li>
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</footer>


@section('script')
@parent

<script type="text/javascript">
  $(document).ready(function() {
    $.each($('.medsos'), function(){
      if ($(this).attr('href') == '') {
        $(this).addClass('hide')
      }
    })
  })
</script>

@stop