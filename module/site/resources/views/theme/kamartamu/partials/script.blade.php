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
@if(session()->has('status_notif'))
<script type="text/javascript">
  $(document).ready(function(){
  	Swal.fire('Notification', "{{ session()->get('status_notif') }}", 'success');
  });
</script>
@endif

@section('script')
@show