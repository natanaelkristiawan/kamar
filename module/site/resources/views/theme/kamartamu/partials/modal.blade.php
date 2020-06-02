<!-- Log In Modal -->
<div data-keyboard="false" data-backdrop="static" class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
    <div class="modal-content" id="registermodal">
      <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
      <div class="modal-body">
        <h4 class="modal-header-title">{{ trans('site::default.login')}}</h4>
        <div class="login-form">
          <div id="login-field"></div>
        </div>
        <div class="modal-divider"><span>Or login via</span></div>
        <div class="social-login mb-3">
          <ul>
            <li><a href="{{ route('public.fbLogin') }}" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
            <li><a href="{{ route('public.googleLogin') }}" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
          </ul>
        </div>
        
        <div class="social-login mb-3">
          <ul>
            <li>
              <input id="reg" class="checkbox-custom" name="reg" type="checkbox">
              <label for="reg" class="checkbox-custom-label">Save Password</label>
            </li>
            <li><a href="#" class="theme-cl">Forget Password?</a></li>
          </ul>
        </div>
        
        <div class="text-center">
          <p class="mt-2">Haven't Any Account? <a href="javascript:;" class="link modalSignup">Click here</a></p>
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
        <div class="modal-divider"><span>Or Signup via</span></div>
        <div class="social-login mb-3">
          <ul>
            <li><a href="{{ route('public.fbLogin') }}" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
            <li><a href="{{ route('public.googleLogin') }}" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
          </ul>
        </div>
        <div class="text-center">
          <p class="mt-3"><i class="ti-user mr-1"></i>Already Have An Account? <a href="#" class="link modalLogin">Login</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


@section('script')
@parent
<script type="x-tmpl-mustache" id="form-login">
<div class="form-group">
  <label>Email</label>
  <div class="input-with-icon">
    <input type="text" class="form-control form-login is-validate" id="email-login" value="@{{email}}" placeholder="Email">
    <i class="ti-user"></i>
  </div>
  <span class="helper-login error" id="callbackmessage"></span>
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
  <button type="button" disabled id="doLogin" class="btn btn-md full-width pop-login">Login</button>
</div>
</script>

<script type="x-tmpl-mustache" id="form-signup">
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="text" class="form-control" placeholder="Full Name">
        <i class="ti-user"></i>
      </div>
    </div>
  </div>
  
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="email" class="form-control" placeholder="Email">
        <i class="ti-email"></i>
      </div>
    </div>
  </div>
  
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="tel" class="form-control" placeholder="Phone">
        <i class="ti-user"></i>
      </div>
    </div>
  </div>
  
  <div class="col-lg-12 col-md-12">
    <div class="form-group">
      <div class="input-with-icon">
        <input type="password" class="form-control" placeholder="Password">
        <i class="ti-unlock"></i>
      </div>
    </div>
  </div> 
</div>
<div class="form-group">
  <button type="submit" class="btn btn-md full-width pop-login">Sign Up</button>
</div>
</script>



<script type="text/javascript">
  $(document).on('click', '.connect-fb', function(){
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
    if ($(this).hasClass('validateLogin') == false) {
      var fillAll = true;
      $.each($('.is-validate'), function(key, value) {
        if ($(value).val() == '') {
          fillAll = false;
        }
      })
      if (fillAll) {
        $('#doLogin').removeAttr('disabled');
      } else {
        $('#doLogin').attr('disabled', 'disabled');
      }
    } else {
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
        $('#doLogin').attr('disabled', 'disabled');
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
      doLogin(response).then((response) => {
        if (response.status == true) {
          location.reload();
        }
      }).catch((error) => {
        $('#callbackmessage').html(error.responseJSON.message);
      })
    }).catch((error) => {
      $.each(error, function(key, value){
        var path = $('#'+key+'-login').parents()[1];
        $(path).find('span').html(value[0])
      })
    });
  })
</script>

@stop