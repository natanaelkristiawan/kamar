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
@if(session()->has('status_notif'))
<script type="text/javascript">
  $(document).ready(function(){
  	Swal.fire('Notification', "{{ session()->get('status_notif') }}", 'success');
  });
</script>
@endif

@section('script')
@show