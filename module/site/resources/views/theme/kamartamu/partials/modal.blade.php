@if(!(bool)Auth::check())
<!-- Log In Modal -->
<div data-keyboard="false" data-backdrop="static" class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
    <div class="modal-content" id="registermodal">
      <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
      <div class="modal-body">
        <h4 class="modal-header-title mb-2">{{ trans('site::default.login')}}</h4>
        <span class="text-center mb-3 d-block hide" id="notif_login"> {{ trans('site::default.notif_login')}}</span>
        <div class="login-form">
          <div id="login-field"></div>
        </div>
        <div class="modal-divider"><span>{{ trans('site::default.notif_social_login')}}</span></div>
        <div class="social-login mb-3">
          <ul>
            <li><a href="{{ route('public.fbLogin') }}" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
            <li><a href="{{ route('public.googleLogin') }}" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
          </ul>
        </div>
        <div class="text-center">
          <p class="mt-2">{{ trans('site::default.notif_any_account')}} <a href="javascript:;" class="link modalSignup">{{ trans('site::default.click_here')}}</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- Sign Up Modal -->
<div data-keyboard="false" data-backdrop="static" class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
    <div class="modal-content" id="sign-up">
      <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
      <div class="modal-body">
        <h4 class="modal-header-title">{{ trans('site::default.signup')}}</h4>
        <div class="login-form">
          <div id="signup-field"></div>
        </div>
        <div class="modal-divider"><span>{{ trans('site::default.notif_social_login')}}</span></div>
        <div class="social-login mb-3">
          <ul>
            <li><a href="{{ route('public.fbLogin') }}" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
            <li><a href="{{ route('public.googleLogin') }}" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
          </ul>
        </div>
        <div class="text-center">
          <p class="mt-3"><i class="ti-user mr-1"></i>{{ trans('site::default.notif_already_account')}}<a href="#" class="link modalLogin">{{ trans('site::default.click_here')}}</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


@section('script')
@parent

<style type="text/css">
  .hide {
    display: none !important;
  }
</style>
<script type="x-tmpl-mustache" id="form-login">

  <div class="form-group">
    <label>Email</label>
    <div class="input-with-icon">
      <input type="text" class="form-control form-login is-validate" id="email-login" value="@{{email}}" placeholder="Email">
      <i class="ti-user"></i>
    </div>
    <span class="helper-login error" id="callbackmessageLogin"></span>
  </div>
  <div class="form-group">
    <label>Password</label>
    <div class="input-with-icon">
      <input type="password" class="form-control form-login is-validate" id="password-login"  placeholder="Password">
      <i class="ti-unlock"></i>
    </div>
    <span class="helper-login error"></span>
  </div>
  <div class="form-group">
    <button type="button" id="doLogin" class="btn btn-md full-width pop-login">Login</button>
  </div>

</script>

<script type="x-tmpl-mustache" id="form-signup">
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="email" class="form-control form-register is-validate" id="email-register" placeholder="Email">
        <i class="ti-email"></i>
      </div>
      <span class="helper-register error" id="callbackmessageRegister"></span>
    </div>
  </div>

  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="text" class="form-control form-register is-validate" id="fullname-register" placeholder="Full Name">
        <i class="ti-user"></i>
      </div>
      <span class="helper-register error"></span>
    </div>
  </div>
  
  
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="tel" class="form-control form-register is-validate" id="phone-register"  placeholder="Phone">
        <i class="ti-tablet"></i>
      </div>
      <span class="helper-register error"></span>
    </div>
  </div>
  
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="password" class="form-control form-register is-validate" id="password-register" placeholder="Password">
        <i class="ti-unlock"></i>
      </div>
      <span class="helper-register error"></span>
    </div>
  </div> 
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="password" class="form-control form-register is-validate" id="password_confirmation-register" placeholder="Password Confirmation">
        <i class="ti-unlock"></i>
      </div>
      <span class="helper-register error"></span>
    </div>
  </div> 
</div>
<div class="form-group">
  <button type="button" id="doRegister" class="btn btn-md full-width pop-login">Sign Up</button>
</div>
</script>

<script type="text/javascript">
  $(document).on('click', '.connect-fb', function(){
    $('#loader').removeClass('hide');
     $('.modal').modal('hide')
  }) 
  $(document).on('click', '.connect-google', function(){
    $('#loader').removeClass('hide');
     $('.modal').modal('hide')
  })
  $(document).on('click', '.modalLogin', function() {
    $('.modal').modal('hide')
    $('#login').modal('show');
    var template = $('#form-login').html();
    var email = '';
    // find cookies for grab email
    if (typeof Cookies.get('booking-pending') != 'undefined') {
      var bookingPending = JSON.parse(Cookies.get('booking-pending'));
      email = bookingPending.email;
    }
    var data = {
      email : email
    }
    htmlBody = Mustache.render(template, data);
    $('#login-field').html(htmlBody);
  });

  $(document).on('click', '.modalSignup', function() {
    $('.modal').modal('hide')
    $('#signup').modal('show');

    var template = $('#form-signup').html();
    htmlBody = Mustache.render(template, {});
    $('#signup-field').html(htmlBody);
  });
  var loginValidate = {
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
    },
    password : {
      presence: {
        allowEmpty: false
      }
    }
  };

  async function doLogin(params) {
    var response = new Promise((resolve, reject) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.login') }}",
          type: 'POST',
          dataType : 'json',
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token}, params),
          success : function(result) {
            resolve(result)
          },
          error: function (request, status, error) {
            reject(request)
          }
        });
      });
    });

    return await response;
  }

  $(document).on('keyup', '.form-login', function(){
    if ($(this).hasClass('validateLogin') == true) {
      $('.helper-login').html('')
      validate.async({
        email : $('#email-login').val(),
        password : $('#password-login').val(),
      }, 
      loginValidate)
      .then((response) => {

      })
      .catch((error) => {
        $.each(error, function(key, value){
          var path = $('#'+key+'-login').parents()[1];
          $(path).find('span').html(value[0])
        })
      });
    }
  });
  $(document).on('click', '#doLogin', function(){
    $('.helper-login').html('')
    $('.is-validate').addClass('validateLogin');
    validate.async(
    {
      email : $('#email-login').val(),
      password : $('#password-login').val(),
    }, 
    loginValidate)
    .then((response) => {
      $('#loader').removeClass('hide');
      doLogin(response).then((response) => {
        if (response.status == true) {
          location.reload();
        }
      }).catch((error) => {
        $('#loader').addClass('hide');
        $('#callbackmessageLogin').html(error.responseJSON.message);
      })
    }).catch((error) => {
      $.each(error, function(key, value){
        var path = $('#'+key+'-login').parents()[1];
        $(path).find('span').html(value[0])
      })
    });
  })
</script>


<!-- script register -->
<script type="text/javascript">
  var registerValidate = {
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
    },
    fullname : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      }
    },
    phone : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      }
    },
    password : {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      },
      length: {
        minimum: 6,
        message: "must be at least 6 characters"
      }
    },
    password_confirmation: {
      presence: {
        allowEmpty: false,
        message: '^{{ trans('site::default.notif_mandatory') }}'
      },
      equality: "password"
    }
  };

  $(document).on('keyup', '.form-register', function(){
    if ($(this).hasClass('validateRegister') == true) {
      $('.helper-register').html('')
      validate.async({
        email : $('#email-register').val(),
        fullname : $('#fullname-register').val(),
        phone : $('#phone-register').val(),
        password : $('#password-register').val(),
        password_confirmation : $('#password_confirmation-register').val(),
      }, 
      registerValidate)
      .then((response) => {

      })
      .catch((error) => {
        $.each(error, function(key, value){
          var path = $('#'+key+'-register').parents()[1];
          $(path).find('span').html(value[0])
        })
      });
    }
  });

  async function doRegister(params) {
    var response = new Promise((resolve, reject) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.register') }}",
          type: 'POST',
          dataType : 'json',
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token}, params),
          success : function(result) {
            resolve(result)
          },
          error: function (request, status, error) {
            reject(request)
          }
        });
      });
    });

    return await response;
  }


  $(document).on('click', '#doRegister', function(){
    $('.helper-login').html('')
    $('.is-validate').addClass('validateRegister');
    validate.async(
    {
      email : $('#email-register').val(),
      fullname : $('#fullname-register').val(),
      phone : $('#phone-register').val(),
      password : $('#password-register').val(),
      password_confirmation : $('#password_confirmation-register').val(),
    }, 
    registerValidate)
    .then((response) => {
      $('#loader').removeClass('hide');
      doRegister(response).then((response) => {
        if (response.status == true) {
          location.reload();
        }
      }).catch((error) => {
        $('#loader').addClass('hide');
        $('#callbackmessageRegister').html(error.responseJSON.message);
      })
    }).catch((error) => {
      $.each(error, function(key, value){
        var path = $('#'+key+'-register').parents()[1];
        $(path).find('span').html(value[0])
      })
    });
  })

</script>
@stop

@endif


@section('modal')
@show