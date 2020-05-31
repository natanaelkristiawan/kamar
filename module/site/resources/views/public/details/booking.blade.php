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
            <input type="text" class="form-control fullname is-required" placeholder="Full Name"  value="" />
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
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-agenda"></i>
            <input type="text" class="form-control date-checkin is-required dateSelected" placeholder="Date Checkin"  value="" />
          </div>
          <span class="helper error"></span>
        </div>
      </div> 
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <div class="cld-box">
            <i class="ti-agenda"></i>
            <input type="text" class="form-control date-checkout is-required dateSelected" placeholder="Date Checkout"  value="" />
          </div>
          <span class="helper error"></span>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group room-wrap">
          <select class="form-control rooms">
            <option value="1">1room - 2people</option>
            <option value="2">2room - 4people</option>
            <option value="3">3room - 6people</option>
            <option value="4">4room - 8people</option>
          </select>
          <span class="helper error"></span>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-6">
        <div class="form-group">
          <button id="showDatePicker" style="display: none"></button>
          <button type="button" disabled="" class="btn btn-theme full-width" id="btnCheckRoom">Check Avaibility</button>
        </div>
      </div>
    </div>


  </div>
</div>

@section('script')
@parent
<style type="text/css">
  .error {
    color: #e74c3c
  }

  .room-wrap .select2-selection.select2-selection--single {
    margin: 10px 0px;
  }
  .room-wrap .select2-selection__arrow{
    margin-top: 10px;
  }

  .room-wrap .select2.select2-container.select2-container--default{
    border:2px solid #e6eaf3;
    color: #707e9c,
    background-color:rgb(230, 234, 243);
    border-radius: 3px;
  } 
</style>


<!-- Date Booking Script -->
<script src="{{ asset('themes/landing') }}/assets/js/moment.min.js"></script>
<script src="{{ asset('themes/additionals/') }}/datedropper/datedropper.pro.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script type="text/javascript">
  var disabledDate = {!! json_encode(explode(',','2020-06-03,2020-06-04')) !!}
  async function findDateInRange() {
    var response = new Promise((resolve) => {
      var notError = true;
      $.each(disabledDate, function(key, value){
        var dateCompareStart = new Date($('.date-checkin').val());
        var dateCompareEnd = new Date($('.date-checkout').val());
        if (+dateCompareStart == +dateCompareEnd) {
          notError = false;
        }
        var dateCompare = new Date(value);
        if (dateCompare > dateCompareStart && dateCompare < dateCompareEnd) {
          notError = false
        }
      });
      resolve(notError)
    });

    return await response;
  }


  async function createBooking(params)
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
    if ($(path).hasClass('validate') == false) {
      var fillAll = true;
      $.each($('.is-required'), function(key, value) {
        if ($(value).val() == '') {
          fillAll = false;
        }
      })

      if (fillAll) {
        $('#btnCheckRoom').removeAttr('disabled');
      } else {
        $('#btnCheckRoom').attr('disabled', 'disabled');
      }
    } else {
      resetError();
      validate.async(
        {
          fullname : $('.fullname').val(),
          phone : $('.phone').val(),
          email : $('.email').val(),
          datecheckin : $('.date-checkin').val(),
          datecheckout : $('.date-checkout').val(),
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
        allowEmpty: false
      }
    }, 
    datecheckin : {
      presence: {
        allowEmpty: false
      }
    }, 
    datecheckout : {
      presence: {
        allowEmpty: false
      }
    },
    phone : {
      format: {
        pattern: /^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/,
        flags: "g",
        message: "format wrong, insert 0 or +62"
      },
      presence: {
        allowEmpty: false
      }
    },
    email : {
      presence: {
        allowEmpty: false
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
          datecheckin : $('.date-checkin').val(),
          datecheckout : $('.date-checkout').val()
        }, 
        constraints)
      .then((response) => {
        $('#loader').removeClass('hide');
        findDateInRange().then((response) => {
          if (response) {
            var dateSelected = $('#showDatePicker').val().split(" - ");
            var params = {
              email : $('.email').val(),
              phone : $('.phone').val(),
              fullname : $('.fullname').val(),
              roomTotal : $('.rooms').val(),
              dateStart: $('.date-checkin').val(),
              dateEnd: $('.date-checkout').val(),
              roomID : "{{ $room->id }}"
            }
            createBooking(params).then((response) => {
              if (response.status) {
                if (response.step == 'activate_account') {
                  Swal.fire('Notification', response.message, 'success')
                }

                if (response.step == 'account_exist_not_active') {
                  Swal.fire({
                    title: 'Notification',
                    icon: 'info',
                    html: response.message,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'Resend Code',
                    cancelButtonText: 'Close'
                  }).then((result) => {
                    if (result.value) {
                      $('#loader').removeClass('hide');
                      resendActivateEmail(params).then((response)=>{
                        if (response.status) {
                          if (response.step == 'activate_account') {
                            Swal.fire('Notification', response.message, 'success')
                          }
                        }
                      }).then(()=>{
                        $('#loader').addClass('hide')
                      })
                    }
                  })
                }
              }
            }).then(()=>{
              $('#loader').addClass('hide')
            })
          } else {
            Swal.fire('Notification', 'Your date selected is not available. Please change it', 'error');
            $('#loader').addClass('hide')
          }
        }) 
      })
      .catch((error) => {
        setErrors(error)
      });
    });
    
    var options = {
     large: true,
      largeOnly: true,
      lock: 'from',
      minYear: new Date().getFullYear(),
      maxYear: new Date().getFullYear() + 5,
      format: 'Y-m-d',
      modal: true,
      disabledDays: '2020-06-03,2020-06-04',
      autofill: false,
      eventSelector: 'click'
    }
    $('.date-checkin').dateDropper( $.extend(false,options,{
      onChange: function(res) {
        var dateSelected = new Date(res.date.formatted);

        if ($('.date-checkout').val() == '') {
          resetDateOut(dateSelected).then((response) => {
            $('.date-checkout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
          })
        }else {
          var compareDate = compare_dates($('.date-checkin').val(), $('.date-checkout').val());
          if (compareDate == 'more' || compareDate == 'same') {
            resetDateOut(dateSelected).then((response)=>{
              $('.date-checkout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
            })

          }
        }
      }
    }))


    $('.date-checkout').dateDropper($.extend(false,options,{
      onChange: function(res) {
        var dateSelected = new Date(res.date.formatted);
        if ($('.date-checkin').val() == '') {
          resetDateIn(dateSelected).then((response)=>{
            resetDateOut(dateSelected).then((response)=>{
              $('.date-checkout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
            })
            $('.date-checkin').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
          })
        }else {
          var compareDate = compare_dates($('.date-checkin').val(), $('.date-checkout').val());
          if (compareDate == 'more' || compareDate == 'same') {
            resetDateIn(dateSelected).then((response)=>{
              resetDateOut(dateSelected).then((response)=>{
                $('.date-checkout').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
              })
              $('.date-checkin').dateDropper('setDate',{d: response.d, m:response.m, y:response.y})
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
      $('.date-checkin').val(yyyy+'-'+mm+'-'+dd); 
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
      $('.date-checkout').val(yyyy+'-'+mm+'-'+dd);
      resolve ({
        d : dd,
        m : mm,
        y : yyyy
      })
    })
  }

</script>
@stop