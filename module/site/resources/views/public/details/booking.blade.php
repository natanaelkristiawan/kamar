<div class="agent-_blocks_wrap">
  <div class="side-booking-header">
    <div class="sb-header-left">{{ trans('site::default.book_it_now') }}</div>
    <h3 class="price">Rp {{number_format($room->price)}}<sub>/{{ trans('site::default.night') }}</sub></h3>
  </div>
  <div class="side-booking-body">

    <div class="row mb-3 hide" id="checkout-message">
      <div class="col-12">
        <div class="px-4 py-3 mx-1 rounded" style="background-color: #e6eaf3">
          <p class="text-center mb-0">{{ trans('site::default.welcome') }} <span class="fullname-display" style="font-weight: bold;"></span></p>
          <p class="text-center" id="message-resend"> {{ trans('site::default.your_email') }} <a href="javascript:;" style="color: #fc6e51" id="resendActivate">Resend</a></p>
          @if(!(bool)Auth::check())
          <button data-toggle="collapse" href="#main-data" role="button" aria-expanded="false" aria-controls="main-data" class="btn btn-theme full-width">Change Data</button>
          @endif
        </div>
      </div>
    </div>


    <div class="row">
      <div id="main-data" class="collapse show"  style="width:100%;">
        <div class="col-lg-12 col-md-12 col-sm-6">
          <div class="form-group">
            <div class="cld-box">
              <i class="ti-user"></i>
              <input type="text" class="form-control fullname is-required" placeholder="{{  trans('site::default.fullname')  }}"  value="" />
            </div>
            <span class="helper error"></span>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-6">
          <div class="form-group">
            <div class="cld-box">
              <i class="ti-email"></i>
              <input type="email" class="form-control email is-required" placeholder="Email"  value="" />
            </div>
            <span class="helper error"></span>
          </div>
        </div> 
        <div class="col-lg-12 col-md-12 col-sm-6">
          <div class="form-group">
            <div class="cld-box">
              <i class="ti-tablet"></i>
              <input type="tel" class="form-control phone is-required" placeholder="Phone"  value="" />
            </div>
            <span class="helper error"></span>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-agenda"></i>
            <input type="text" class="form-control datecheckin is-required dateSelected" placeholder="{{  trans('site::default.date_checkin')  }}"  value="" />
          </div>
          <span class="helper error"></span>
        </div>
      </div> 
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-agenda"></i>
            <input type="text" class="form-control datecheckout is-required dateSelected" placeholder="{{  trans('site::default.date_checkout')  }}"  value="" />
          </div>
          <span class="helper error"></span>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group room-wrap">
          <select class="form-control rooms">
            <option value="1">1 {{ trans('site::default.room') }} - 2 {{ trans('site::default.persons') }}</option>
            <option value="2">2 {{ trans('site::default.room') }} - 4 {{ trans('site::default.persons') }}</option>
            <option value="3">3 {{ trans('site::default.room') }} - 6 {{ trans('site::default.persons') }}</option>
            <option value="4">4 {{ trans('site::default.room') }} - 8 {{ trans('site::default.persons') }}</option>
          </select>
          <span class="helper error"></span>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <button type="button" class="btn btn-theme full-width" id="btnCheckRoom">{{ trans('site::default.check_availability') }}</button>
        </div>
      </div>

      <div class="col-lg-12 px-4 py-3 hide" id="checkout-detail">
        <div class="detail-wrap d-flex">
          <span class="tag">Total :</span>
          <span class="detail ml-auto">Rp. <span id="total"></span></span>
        </div>
        <div class="detail-wrap d-flex">
          <span data-toggle="tooltip" data-original-title="{{ trans('site::default.notif_fee')  }}"  class="tag">Service Fee:</span>
          <span class="detail ml-auto">Rp. <span id="service"></span></span>
        </div>
        <div class="defer pb-1 mb-1 d-block" style="border-bottom: 1px dashed #e6eaf3 "></div>
        <div class="detail-wrap  d-flex font-weight-bold">
          <span class="tag">Total:</span>
          <span class="detail ml-auto">Rp. <span id="grandTotal"></span></span>
        </div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-6 hide" id="checkout-button">
        <div class="form-group">
          <input id="confirmation" class="checkbox-custom" name="confirmation" type="checkbox">
          <label for="confirmation" class="checkbox-custom-label"> <a target="_blank" class="checkbox-custom-label" href="{{ route('public.condition') }}">{{ trans('site::default.termCondition')}}</a></label>
         
        </div>
        <div class="form-group">
          @if(Auth::check() && !(bool)is_null(Auth::user()->verified_at))
          <button type="button" disabled="" class="btn btn-theme full-width" id="bookingNow">{{ trans('site::default.book_it_now')  }}</button>
          <span class="text-mute">{{ trans('site::default.notif_booking') }}</span>
          @else
          <button type="button" disabled="" data-toggle="tooltip" data-original-title="{{ trans('site::default.notif_email')  }}" class="btn btn-theme full-width">{{ trans('site::default.book_it_now')  }}</button>
          <span class="text-mute">{{ trans('site::default.notif_email')  }}</span> 
          @endif
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
<script src="{{ asset('themes/additionals/') }}/number/jquery.number.min.js" defer></script>
<script type="text/javascript">
  $(document).on('click', '#confirmation', function(){
    if ($(this).is(':checked')) {
      $('#bookingNow').removeAttr('disabled')
    } else {
      $('#bookingNow').attr('disabled', 'disabled')
    }
  });

  var disabledDate = {!! json_encode($dateDisable) !!}
  var uuid = "{{ $uuid }}"
  async function findDateInRange() {
    var response = new Promise((resolve) => {
      var notError = true;
      $.each(disabledDate, function(key, value){
        var dateCompareStart = new Date($('.datecheckin').val());
        var dateCompareEnd = new Date($('.datecheckout').val());
        if (+dateCompareStart == +dateCompareEnd) {
          notError = false;
        }
        var dateCompare = new Date(value);
        if (dateCompare >= dateCompareStart && dateCompare <= dateCompareEnd) {
          notError = false
        }
      });
      resolve(notError)
    });
    return await response;
  }
  async function checkAvailability(params)
  {
    var response = new Promise((resolve, error) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.findCustomer') }}",
          type : 'POST',
          dataType : 'json',
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token}, params),
          success: function(result){
            resolve(result)
          }
        });
      });
    });
    return await response;
  }
  async function resendActivateEmail(params) {
    var response = new Promise((resolve, error) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.resendActivate') }}",
          type : 'POST',
          dataType : 'json',
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token}, params),
          success: function(result){
            resolve(result)
          }
        });
      })
    });
    return await response;
  }
  function setErrorCommand(path) {
    if ($(path).hasClass('validate') !== false) {
      resetError();
      validate.async(
        {
          fullname : $('.fullname').val(),
          phone : $('.phone').val(),
          email : $('.email').val(),
          datecheckin : $('.datecheckin').val(),
          datecheckout : $('.datecheckout').val(),
        }, 
        constraints)
      .then((response) => {
        $('#btnCheckRoom').removeAttr('disabled');
      })
      .catch((error) => {
        setErrors(error);
        $('#btnCheckRoom').attr('disabled', 'disabled');
      });
    }
  }
  $(document).on('keyup', '.is-required', function(){
    setErrorCommand(this)
  });

  $(document).on('change', '.dateSelected', function(){
    setTimeout(function() {
      setErrorCommand(this)
    }, 100);
  })
  var constraints = {
    fullname : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      }
    }, 
    datecheckin : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      }
    }, 
    datecheckout : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      }
    },
    @if(!(bool)Auth::check())
    phone : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      }
    },
    @endif
    email : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      },
      email: {
        message: "^Email is not valid"
      },
      format: {
        pattern: /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/,
        flags: "g",
        message: "format wrong"
      },
    }
  };
  function setErrors(params) {
    $.each(params, function(key, value){
      var path = $('.'+key).parents()[1]
      $(path).find('span').html(value[0])
    })
  }
  function resetError() {
    $('.helper').html('')
  }
  $(document).on('keyup', '.fullname', function(){
    var text = $(this).val();
    $('.fullname-display').html(text);
  })
  $(document).ready(function() {
    $('.rooms').select2()
    $('#btnCheckRoom').on('click', function(){
      resetError();
      $('.is-required').addClass('validate');
      validate.async(
        {
          fullname : $('.fullname').val(),
          phone : $('.phone').val(),
          email : $('.email').val(),
          datecheckin : $('.datecheckin').val(),
          datecheckout : $('.datecheckout').val()
        }, 
        constraints)
      .then((response) => {
        $('#loader').removeClass('hide');
        findDateInRange().then((response) => {
          if (response) {
            var params = {
              email : $('.email').val(),
              phone : $('.phone').val(),
              fullname : $('.fullname').val(),
              roomTotal : $('.rooms').val(),
              dateStart: $('.datecheckin').val(),
              dateEnd: $('.datecheckout').val(),
              roomID : "{{ $room->id }}",
              callback: "{{ $room->slug }}"
            }
            checkAvailability(params).then((response) => {
              if (response.status) {
                // setcookies di sini supaya datanya gak ilang, set aja sehari
                if (response.step == 'activate_account') {
                  Cookies.set('booking-pending', JSON.stringify($.extend(false,params,{userExist:false})), { path: '/',  expires: 1});
                  Swal.fire('{{ trans('site::default.notif') }}', response.message, 'success');
                  setDefaultBooking();
                }
                if (response.step == 'account_exist_not_active') {
                  Cookies.set('booking-pending', JSON.stringify($.extend(false,params,{userExist:false})), { path: '/',  expires: 1});
                  setDefaultBooking();
                  Swal.fire({
                    title: '{{ trans('site::default.notif') }}',
                    icon: 'info',
                    html: response.message,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: '{{ trans('site::default.resend_code') }}',
                    cancelButtonText: 'Close'
                  }).then((result) => {
                    if (result.value) {
                      $('#loader').removeClass('hide');
                      resendActivateEmail(params).then((response)=>{
                        if (response.status) {
                          if (response.step == 'activate_account') {
                            Swal.fire('{{ trans('site::default.notif') }}', response.message, 'success')
                          }
                        }
                      }).then(()=>{
                        $('#loader').addClass('hide')
                      })
                    }
                  })
                }
                if (response.step == 'account_need_login') {
                  Cookies.set('booking-pending', JSON.stringify($.extend(false,params,{userExist:true})), { path: '/',  expires: 1});
                  $('#message-resend').addClass('hide');
                  setDefaultBooking();
                  $('.modalLogin').click();
                  $('#notif_login').removeClass('hide');
                }
                if (response.step == 'calculate_booking') {
                  Cookies.set('booking-pending', JSON.stringify($.extend(false,params,{userExist:true})), { path: '/',  expires: 1});
                  $('#message-resend').addClass('hide');
                  setDefaultBooking();
                }
              }
            }).then(()=>{
              $('#loader').addClass('hide')
            })
          } else {
            Swal.fire('{{ trans('site::default.notif') }}', '{{ trans('site::default.date_error') }}', 'error');
            $('#loader').addClass('hide')
          }
        }) 
      })
      .catch((error) => {
        console.log(error);
        setErrors(error)
      });
    });
    
    var disabledDays = "{!! implode(',' , $dateDisable) !!}"
    var options = {
      large: true,
      largeOnly: true,
      lock: 'from',
      minYear: new Date().getFullYear(),
      maxYear: new Date().getFullYear() + 5,
      format: 'Y-m-d',
      modal: true,
      disabledDays: disabledDays,
      autofill: false
    }
    $('.datecheckin').dateDropper( $.extend(false,options,{
      onChange: function(res) {
        var dateSelected = new Date(res.date.formatted);

        if ($('.datecheckout').val() == '') {
          resetDateOut(dateSelected).then((response) => {
            $('.datecheckout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
          })
        }else {
          var compareDate = compare_dates($('.datecheckin').val(), $('.datecheckout').val());
          if (compareDate == 'more' || compareDate == 'same') {
            resetDateOut(dateSelected).then((response)=>{
              $('.datecheckout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
            })
          }
        }
      }
    }))
    $('.datecheckout').dateDropper($.extend(false,options,{
      onChange: function(res) {
        var dateSelected = new Date(res.date.formatted);
        if ($('.datecheckin').val() == '') {
          resetDateIn(dateSelected).then((response)=>{
            resetDateOut(dateSelected).then((response)=>{
              $('.datecheckout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
            })
            $('.datecheckin').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
          })
        }else {
          var compareDate = compare_dates($('.datecheckin').val(), $('.datecheckout').val());
          if (compareDate == 'more' || compareDate == 'same') {
            resetDateIn(dateSelected).then((response)=>{
              resetDateOut(dateSelected).then((response)=>{
                $('.datecheckout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
              })
              $('.datecheckin').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
            })
          }
        }

      }
    }));
  })
  function str_pad(n) {
    return String("00" + n).slice(-2);
  }
  var compare_dates = function(date1, date2){
    var first = new Date(date1);
    var second = new Date(date2);
    if (first>second) return ("more");
    else if (first<second) return ("less");
    else return ("same"); 
  }
  async function resetDateIn(dateSelected) {
    var response =  new Promise((resolve) => {
      var dd = str_pad(dateSelected.getDate());
      var mm = str_pad(dateSelected.getMonth()+1); 
      var yyyy = dateSelected.getFullYear();
      $('.datecheckin').val(yyyy+'-'+mm+'-'+dd); 
      resolve ({
        d : dd,
        m : mm,
        y : yyyy
      })
    })
    return await response;
  }
  async function resetDateOut(dateSelected) {
    return await new Promise((resolve) => {
      dateSelected.setDate(dateSelected.getDate() + 1);
      var dd = str_pad(dateSelected.getDate());
      var mm = str_pad(dateSelected.getMonth()+1); 
      var yyyy = dateSelected.getFullYear();
      $('.datecheckout').val(yyyy+'-'+mm+'-'+dd);
      resolve ({
        d : dd,
        m : mm,
        y : yyyy
      })
    })
  }
  function setDefaultBooking(){
    if (typeof Cookies.get('booking-pending') != 'undefined') {
      var bookingPending = JSON.parse(Cookies.get('booking-pending'));
      if (bookingPending.roomID == {{ $room->id }}) {
        $('#checkout-message').removeClass('hide');
        @if(Auth::check())
        $('.email').val("{{Auth::user()->email}}")
        $('.fullname').val("{{Auth::user()->name}}")
        @else
        $('.email').val(bookingPending.email)
        $('.fullname').val(bookingPending.fullname)
        @endif
        $('.phone').val(bookingPending.phone)
        $('.datecheckin').val(bookingPending.dateStart)
        $('.datecheckout').val(bookingPending.dateEnd)
        $('.rooms').val(bookingPending.roomTotal).trigger('change');
        @if(!(bool)Auth::check())
        $('.fullname-display').html(bookingPending.fullname);
        @endif
        var dateIn = bookingPending.dateStart.split("-");
        var dateOut = bookingPending.dateEnd.split("-");
        $('.datecheckin').dateDropper('setDate',{d: dateIn[2], m:dateIn[1], y:dateIn[0]});
        $('.datecheckout').dateDropper('setDate',{d: dateOut[2], m:dateOut[1], y:dateOut[0]});
        $('#main-data').removeClass('show');
        $('#btnCheckRoom').removeAttr('disabled');
        $('#checkout-detail').removeClass('hide');
        $('#checkout-button').removeClass('hide');

        @if(Auth::check() && (bool)Auth::user()->status)
          bookingPending.userExist = true;
        @endif

        if(bookingPending.userExist) {
          $('#message-resend').addClass('hide')
        } else {
          $('#message-resend').removeClass('hide')
        }

        calculateBooking(bookingPending).then((response)=>{
          $('#total').html($.number(response.total,0,',', '.' ))
          $('#service').html($.number(response.service,0,',', '.' ))
          $('#grandTotal').html($.number(response.grandTotal,0,',', '.' ))
        })
      }
    }
  }
  async function calculateBooking(params) {
    var pricePerNight = parseInt("{{ $room->price }}");
    var rooms = parseInt(params.roomTotal);
    var nights = parseInt(daysBetween(new Date(params.dateStart), new Date(params.dateEnd)));

    var response = new Promise((resolve) => {
      var total = pricePerNight * rooms * nights;
      var service = (total * 10) / 100;
      var grandTotal = total + service;
      resolve({
        total : total,
        service : service,
        grandTotal : grandTotal
      })
    });
    return await response;
  }
  function daysBetween(StartDate, EndDate) {
    // The number of milliseconds in all UTC days (no DST)
    const oneDay = 1000 * 60 * 60 * 24;
    // A day in UTC always lasts 24 hours (unlike in other time formats)
    const start = Date.UTC(EndDate.getFullYear(), EndDate.getMonth(), EndDate.getDate());
    const end = Date.UTC(StartDate.getFullYear(), StartDate.getMonth(), StartDate.getDate());
    // so it's safe to divide by 24 hours
    return (start - end) / oneDay;
  }
  /*for cookies*/
  $(document).ready(function(){

    /*set default if login*/ 
    @if(Auth::check())
    $('.email').val("{{Auth::user()->email}}")
    $('.fullname').val("{{Auth::user()->name}}")
    $('.phone').val("{{Auth::user()->phone}}")
    $('#main-data').removeClass('show');
    $('#checkout-message').removeClass('hide');
    $('.fullname-display').html("{{Auth::user()->name}}");
    @if((bool)Auth::user()->status)
    $('#message-resend').addClass('hide')
    @endif
    @endif


    setDefaultBooking();
    $('#resendActivate').on('click', function(){
      if (typeof Cookies.get('booking-pending') != 'undefined') {
        var bookingPending = JSON.parse(Cookies.get('booking-pending'));
        $('#loader').removeClass('hide');
        resendActivateEmail(bookingPending).then((response)=>{
          if (response.status) {
            if (response.step == 'activate_account') {
              Swal.fire('{{ trans('site::default.notif') }}', response.message, 'success')
            }
          }
        }).then(()=>{
          $('#loader').addClass('hide')
        })
      }
    })
  }); 
</script>

<!-- for booking -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}" defer></script>
<script type="text/javascript">

  async function getSnapToken(params) {
    var response = new Promise((resolve, reject) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.getSnapToken') }}",
          type : 'POST',
          dataType : 'json',
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token}, {uuid : uuid}, params),
          success: function(result){
            resolve(result)
          },
          error: function (request, status, error) {
            reject(request)
          },

        });
      })
    });

    return await response;
  }


  async function saveResponseMidtrans(params) {
    var response = new Promise((resolve, reject) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.saveResponseMidtrans') }}",
          type : 'POST',
          dataType : 'json',
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token}, params),
          success: function(result){
            resolve(result)
          },
          error: function (request, status, error) {
            reject(request)
          },

        });
      })
    });

    return await response;
  }
  
  async function callMidtrans(token) {
    var response = new Promise((resolve, reject) => {
      snap.pay(token, {
        // Optional
        onSuccess: function(result){
          resolve(result);
        },
        // Optional
        onPending: function(result){
          resolve(result)
        },
        // Optional
        onError: function(result){
          reject({
            status : false,
            message : 'midtrans_error'
          })
        },
        onClose: function(){
          reject({
            status : false,
            message : 'close_midtrans'
          })
        }
      });
    });

    return await response;
  }


  function callPayment(){
    $('#loader').removeClass('hide');
    findDateInRange().then((response)=>{
      if (response) {
        var params = {
          email : $('.email').val(),
          phone : $('.phone').val(),
          fullname : $('.fullname').val(),
          roomTotal : $('.rooms').val(),
          dateStart: $('.datecheckin').val(),
          dateEnd: $('.datecheckout').val(),
          roomID : "{{ $room->id }}",
          callback: "{{ $room->slug }}",
          nights: parseInt(daysBetween(new Date($('.datecheckin').val()), new Date($('.datecheckout').val())))
        }
        Cookies.set('booking-pending', JSON.stringify($.extend(false,params,{userExist:true})), { path: '/',  expires: 1});
        calculateBooking(params).then((response) => {
          $('#total').html($.number(response.total,0,',', '.' ))
          $('#service').html($.number(response.service,0,',', '.' ))
          $('#grandTotal').html($.number(response.grandTotal,0,',', '.' ))
          getSnapToken(params).then((response)=>{
            if (response.status) {
              $('#loader').addClass('hide');

              var snapToken = response.snapToken;

              callMidtrans(snapToken).then((response)=>{
                Cookies.remove('booking-pending', { path: '/' })
                saveResponseMidtrans(response).then((response)=>{
                  if (response.status) {
                    window.location.href = response.redirect;
                  }
                });
              }).catch((error) => {
                
              })
            }
          })
        })
      }
    })
  }


  $(document).ready(function(){
    $('#bookingNow').on('click', function(){
      callPayment()
    })
  })
</script>
@stop