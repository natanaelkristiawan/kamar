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
      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="form-group">
          <div class="guests">
            <label for="guests">Adults</label>
            <div class="guests-box">
              <button class="counter-btn" type="button" id="cnt-down"><i class="ti-minus"></i></button>
              <input type="text" id="guestNo" name="guests" value="2"/>
              <button class="counter-btn" type="button" id="cnt-up"><i class="ti-plus"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="form-group">
          <div class="guests">
            <label for="guests">Kids</label>
            <div class="guests-box">
              <button class="counter-btn" type="button" id="kcnt-down"><i class="ti-minus"></i></button>
              <input type="text" id="kidsNo" name="kids" value="0"/>
              <button class="counter-btn" type="button" id="kcnt-up"><i class="ti-plus"></i></button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="side-booking-foot">
        <span class="sb-header-left">Total</span>
        <h3 class="price theme-cl">$170</h3>
      </div>
      
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="stbooking-footer mt-1">
          <div class="form-group mb-0 pb-0">
            <a href="#" class="btn full-width btn-theme">{{ trans('site::default.book_it_now') }}</a>
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