@extends('site::theme.kamartamu.layouts.index')
@section('content')
<section class="pt-5" style="min-height: 100vh">
  <div class="container">
    <div class="row">
			<div class="col-md-3 mb-3">
				<h4>Dashboard</h4>
		    <div class="list-group">
	        <a href="{{ route('public.dashboard') }}" class="list-group-item is-active">
	          Profile
	        </a>
	        <a href="{{ route('public.bookingHistory') }}" class="list-group-item">
	          Booking History
	        </a>
          <a href="{{ route('public.bookmarkList') }}" class="list-group-item">
            Bookmark
          </a>
		    </div>        
			</div>

			<div class="col-md-9">
				
				<div class="row">
					<div class="col-lg-12">
						<h4>Data Profile</h4>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control form-profile" name="email" value="{{ $customer->email }}" readonly="">
							<span class="error helper-profile"></span>
						</div>
						<div class="form-group">
							<label>Fullname</label>
							<input type="text" class="form-control form-profile is-validate" id="name-profile"  value="{{ $customer->name }}">
							<span class="error helper-profile"></span>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="tel" class="form-control form-profile is-validate" id="phone-profile" value="{{ $customer->phone }}">
							<span class="error helper-profile"></span>
						</div>
					</div>
					<div class="col-lg-12 mt-3">
						<h4>Data Password</h4>
						<div class="form-group">
							<label>Old Password</label>
							<input type="password" class="form-control" id="old_passsword-profile" name="old_passsword">
							<span class="error helper-profile" id="old_password_error"></span>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" class="form-control" id="password-profile" name="new_password">
							<span class="error helper-profile" id="password_error"></span>
						</div>
						<div class="form-group">
							<label>New Password Confirmation</label>
							<input type="password" class="form-control" id="password_confirmation-profile" name="new_password_confirmation">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id="doUpdate">Save</button>
						</div>
					</div>
				</div>
			
			</div>
  	</div>
  </div>
</section>
<style type="text/css">
	.is-active {
		color: #fc6e51
	}
</style>
@stop


@section('script')
@parent

<script type="text/javascript">
  var updateProfileValidate = {
    name : {
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
    }
  };

  $(document).on('keyup', '.form-profile', function(){
    if ($(this).hasClass('validateProfile') == true) {
      $('.helper-profile').html('')
      validate.async({
        name : $('#name-profile').val(),
        phone : $('#phone-profile').val(),
        password : $('#password-profile').val(),
        password_confirmation : $('#password_confirmation-profile').val(),
      }, 
      registerValidate)
      .then((response) => {

      })
      .catch((error) => {
        $.each(error, function(key, value){
          var path = $('#'+key+'-profile').parents()[0];
          $(path).find('span').html(value[0])
        })
      });
    }
  });

  async function doUpdate(params) {
    var response = new Promise((resolve, reject) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.updateProfile') }}",
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


  $(document).on('click', '#doUpdate', function(){
    $('.helper-profile').html('')
    $('.is-validate').addClass('validateProfile');
    validate.async(
    {
      name : $('#name-profile').val(),
      phone : $('#phone-profile').val(),
      old_password : $('#old_passsword-profile').val(),
      password : $('#password-profile').val(),
      password_confirmation : $('#password_confirmation-profile').val(),
    }, 
    updateProfileValidate)
    .then((response) => {
      $('#loader').removeClass('hide');

      var params = $.extend(false, response, {
	      old_password : $('#old_passsword-profile').val(),
	      password : $('#password-profile').val(),
	      password_confirmation : $('#password_confirmation-profile').val(),
      });
      setTimeout(function() {
	      doUpdate(params).then((response) => {
	        if (response.status == true) {
	          location.reload();
	        }
	      }).catch((error) => {
	        $('#loader').addClass('hide');
	        // console.log(error);
	        // $('#callbackmessageRegister').html(error.responseJSON.message);

	        $.each(error.responseJSON.error, function(key, value){
	        	console.log(key, value)
	        	$('#'+key+'_error').html(value[0])
	        })
	      })
      }, 100);
    }).catch((error) => {
    	console.log(error);
      $.each(error, function(key, value){
        var path = $('#'+key+'-profile').parents()[0];
        $(path).find('span').html(value[0])
      })
    });
  })

</script>


@stop