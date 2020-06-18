@extends('site::theme.kamartamu.layouts.index')
@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
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
	         {{ trans('site::default.booking_history')}} 
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

            <div class="form-group" >
              <label>Photo</label>
              <div style="position: relative; width: 128px;">
                <div class="lds-dual-ring hide"></div>
                <a href="javascript:;" class="upload-now">
                  <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($customer->photo) || empty($customer->photo)) ? url('img/pngwave.png') : url('image/profile/'.$customer->photo) }}" class="card-img-top img-fluid image-preview">
                </a>
                <a href="javascript:;" class="remove-image-single">
                  <i class="fa fa-times"></i>
                </a>
                <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                <input type="hidden" name="photo" value="{{ $customer->photo }}" class="image-path">
              </div>
            </div>  

						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control form-profile" name="email" value="{{ $customer->email }}" readonly="">
							<span class="error helper-profile"></span>
						</div>
						<div class="form-group">
							<label>{{ trans('site::default.fullname')}} </label>
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
							<label>{{ trans('site::default.old_password')}} </label>
							<input type="password" class="form-control" id="old_passsword-profile" name="old_passsword">
							<span class="error helper-profile" id="old_password_error"></span>
						</div>
						<div class="form-group">
							<label>{{ trans('site::default.new_password')}} </label>
							<input type="password" class="form-control" id="password-profile" name="new_password">
							<span class="error helper-profile" id="password_error"></span>
						</div>
						<div class="form-group">
							<label>{{ trans('site::default.new_password_confirmation')}} </label>
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

<style type="text/css">
  .remove-image-single {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    box-shadow: 0 14px 26px -12px rgba(0, 188, 212, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 188, 212, 0.2);
    background-color: #00bcd4;
    color: #fff;
    text-align: center;
    font-size: 12px;
    line-height: 20px;
    opacity: 1;
    background-color: #f44336;
    box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2);
    position: absolute;top: -10px;right: -10px
}
</style>

<script type="text/javascript">
  var uploadPath = "{{ route('public.upload', array('config'=> 'master.customers')).'/'.date('Y/m/d').'/customers/file' }}"
  async function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(input.files[0]);
      var formData = new FormData($('#upload-picture')[0]);
      var real = $(input).prop('files')[0];
      formData.append('file', real);
      var response = new Promise((resolve, errors) => {
        $.ajax({
          url: uploadPath,   
          data : formData,
          beforeSend: function(){
            $(input).parent().find('.lds-dual-ring').removeClass('hide')
          },
          dataType : 'json',
          type : 'post',
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
          success : function(result){
            resolve(result);
          }
        });
      });
      return await response
    }
  }
  $(document).on('change', '.file-upload', function() {
    var response = readURL(this);
    var path = this;
    response.then((result) => {
      $(path).parent().find('.image-preview').attr('src', "{{ url('image/profile/') }}/"+result.path);
      $(path).parent().find('.image-path').val(result.path);
      $(path).parent().find('.lds-dual-ring').addClass('hide')
    })
  });

  $(document).on('click', '.upload-now',function(){
    $(this).parent().find('.file-upload').click();
  });

  $(document).on('click', '.remove-image-single', function(){
    $(this).parent().find('.image-path').val(''); 
    $(this).parent().find('.file-upload').val(''); 
    $(this).parent().find('.image-preview').attr('src', '{{ url('img/pngwave.png') }}')
  });


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
          data: $.extend(false, TOKEN, {'g-recaptcha-response' : token},{photo : $('.image-path').val()}, params),
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