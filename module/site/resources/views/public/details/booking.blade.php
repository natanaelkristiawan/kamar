<div class="agent-_blocks_wrap">
  <div class="side-booking-header">
    <div class="sb-header-left">{{ trans('site::default.book_it_now') }}</div>
    <h3 class="price">Rp {{number_format($room->price)}}<sub>/{{ trans('site::default.night') }}</sub></h3>
  </div>
  <div class="side-booking-body">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-user"></i>
            <input type="text" class="form-control" placeholder="Full Name"  value="" />
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-email"></i>
            <input type="email" class="form-control" placeholder="Email"  value="" />
          </div>
        </div>
      </div> 
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-tablet"></i>
            <input type="tel" class="form-control" placeholder="Phone"  value="" />
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-calendar"></i>
            <input type="text" class="form-control" placeholder="Checkin Start" id="date-input-start" value="" />
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-calendar"></i>
            <input type="text" class="form-control" placeholder="Checkin End" id="date-input-end" value="" />
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="stbooking-footer mt-1">
          <div class="form-group mb-0 pb-0">
            <button type="button" disabled="" class="btn full-width btn-theme">{{ trans('site::default.check_availability') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('script')
@parent
<!-- Date Booking Script -->
<script src="{{ asset('themes/landing') }}/assets/js/moment.min.js"></script>
<script src="{{ asset('themes/additionals/') }}/datedropper/datedropper.pro.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var options = {
     large: true,
      largeOnly: true,
      lock: 'from',
      minYear: new Date().getFullYear(),
      maxYear: new Date().getFullYear() + 5,
      format: 'Y-m-d'
    }
    $('#date-input-start').dateDropper(options);
    $('#date-input-end').dateDropper(options);
  })
</script>
@stop