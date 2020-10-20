<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : "{{ env('FACEBOOK_APP_ID') }}",
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v7.0'
    });
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/popper.min.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/ion.rangeSlider.min.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/select2.min.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/slick.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/slider-bg.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/lightbox.js"></script> 
<script src="{{ asset('themes/landing') }}/assets/js/imagesloaded.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/daterangepicker.js"></script>
<script src="{{ asset('themes/landing') }}/assets/js/custom.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.css">
<script src="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
<script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js" defer=""></script>
<script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js" defer=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js" defer></script>

<script type="text/javascript">
  if (Cookies.get('dataIP') == undefined) {
    $.getJSON('https://ipinfo.io', function(data){
      Cookies.set('dataIP', JSON.stringify(data), { path: '/',  expires: 1});
    });
  }
</script>

<script>
  function onFingerprintJSLoad(fpAgent) {
    // The FingerprintJS agent is ready. Get a visitor identifier when you'd like to.
    fpAgent.get().then(result => {
      // This is the visitor identifier:
      const visitorId = result.visitorId;
      Cookies.set('fingerprint', visitorId, { path: '/',  expires: 1});
    });
  }
</script>
<script
  async src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"
  onload="FingerprintJS.load().then(onFingerprintJSLoad)"
></script>


@if(session()->has('status_notif'))
<script type="text/javascript">
  $(document).ready(function(){
  	Swal.fire('Notification', "{{ session()->get('status_notif') }}", 'success');
  });
</script>
@endif

@section('script')
@show