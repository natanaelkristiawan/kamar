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
        <div class="form-group" style="position: relative">
          <i style="position: absolute;top: 30px;left: 18px;" class="fas fa-bed"></i>
          <select class="form-control room" style="border: 2px solid #e6eaf3; color: #707e9c">
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
          <button type="button" disabled="" class="btn btn-theme full-width" id="selectDate">Select Date Booking</button>
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
</style>


<!-- Date Booking Script -->
<script src="{{ asset('themes/landing') }}/assets/js/moment.min.js"></script>
<script src="{{ asset('themes/additionals/') }}/datedropper/datedropper.pro.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script type="text/javascript">

  function changeDateEnd(response) {
    var dateStart = response.outward.y+'-'+response.outward.m+'-'+response.outward.d;
    var dateEnd = response.return.y+'-'+response.return.m+'-'+response.return.d;
    $('#dateStart').val(dateStart);
    $('#dateEnd').val(dateEnd);
  }


  var disabledDate = {!! json_encode(explode(',','2020-06-03,2020-06-04')) !!}


  async function findDateInRange() {

    var dateSelected = $('#showDatePicker').val().split(" - ");
    var response = new Promise((resolve) => {


      var notError = true;
      $.each(disabledDate, function(key, value){
        var dateCompareStart = new Date(dateSelected[0]);
        var dateCompareEnd = new Date(dateSelected[1]);
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


  $(document).on('click', '.pick-submit', function(){
    $('#loader').removeClass('hide');
    findDateInRange().then((response) => {
      if (response) {
        var dateSelected = $('#showDatePicker').val().split(" - ");
        var params = {
          email : $('.email').val(),
          phone : $('.phone').val(),
          fullname : $('.fullname').val(),
          roomTotal : $('.room').val(),
          dateStart: dateSelected[0],
          dateEnd: dateSelected[1],
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


  $(document).on('keyup', '.is-required', function(){
    if ($(this).hasClass('validate') == false) {
      var fillAll = true;
      $.each($('.is-required'), function(key, value) {
        if ($(value).val() == '') {
          fillAll = false;
        }
      })

      if (fillAll) {
        $('#selectDate').removeAttr('disabled');
      } else {
        $('#selectDate').attr('disabled', 'disabled');
      }
    } else {
      resetError();
      validate.async(
        {
          fullname : $('.fullname').val(),
          phone : $('.phone').val(),
          email : $('.email').val()
        }, 
        constraints)
      .then((response) => {
        $('#selectDate').removeAttr('disabled');
      })
      .catch((error) => {
        setErrors(error);
        $('#selectDate').attr('disabled', 'disabled');
      });
    }
  })

  var constraints = {
    fullname : {
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
    $('#selectDate').on('click', function(){
      resetError();
      $('.is-required').addClass('validate');
      validate.async(
        {
          fullname : $('.fullname').val(),
          phone : $('.phone').val(),
          email : $('.email').val()
        }, 
        constraints)
      .then((response) => {
        $('#showDatePicker').dateDropper('show');
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
      roundtrip: true,
      modal: true,
      disabledDays: '2020-06-03,2020-06-04'
    }
    $('#showDatePicker').dateDropper(options);
  })
</script>
@stop