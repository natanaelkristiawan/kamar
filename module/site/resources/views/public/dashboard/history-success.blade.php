@extends('site::theme.kamartamu.layouts.index')
@section('content')
<section class="pt-5" style="min-height: 100vh">
  <div class="container">
    <div class="row">
			<div class="col-md-3 col-sm-12 mb-3">
				<h4>Dashboard</h4>
		    <div class="list-group">
	        <a href="{{ route('public.dashboard') }}" class="list-group-item">
	          Profile
	        </a>
	        <a href="{{ route('public.bookingHistory') }}" class="list-group-item is-active">
	          Booking History
	        </a>
		    </div>        
			</div>
			<div class="col-md-9 col-sm-12">
				<h4>History</h4>
				<div class="custom-tab style-1">
					<ul class="nav nav-tabs pb-2 b-0" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link" id="home-tab" href="{{ route('public.bookingHistory') }}" role="tab" aria-controls="home" aria-selected="true">Pending</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" id="profile-tab"  href="{{ route('public.bookingHistorySuccess') }}" role="tab" aria-controls="profile" aria-selected="false">Success</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="row">
								@foreach($books as $book)
								<div class="col-12">
									<div class="card shadow">
											<div class="card-header">
												<div class="row center">
													<div class="col-lg-6">
														{{ $book->created_at }}
													</div>
													@if(is_null($book->review_id))
													<div class="col-lg-6 text-right center">
														<button data-id="{{ $book->id }}" class="btn btn-outline-theme py-1 btn-review">Write Review</button>
													</div>
													@endif
												</div>
											</div>
					            <div class="card-body">
					                <div class="row center">
				                	    <div class="col-md-3 mb-3">
				                	       <a href="{{ url('image/original/'.$book->room_image) }}"
										              data-href="{{ url('image/original/'.$book->room_image) }}"
										              data-srcset = "{{ url('image/sm/'.$book->room_image) }} 300w,
										                            {{ url('image/md/'.$book->room_image) }} 600w,
										                            {{ url('image/lg/'.$book->room_image) }} 690w,
										                            {{ url('image/original/'.$book->room_image) }} 1380w"
										              class="progressive replace img-fluid rounded">
										              <img src="{{ url('image/blur/'.$book->room_image) }}"  class="preview" >
										            </a>
				                	    </div>
				                	    <div class="col-md-5 mb-3">
				                	        <a class="link" href="{{ route('public.roomDetail', array('slug'=>$book->room_slug)) }}"><h4 class="mb-0">{{ $book->room }}</h4></a>
				                	        <div class="d-block mb-1">
				                	        	{{ $book->room_location }}
				                	        </div>
				                	        <div class="d-inline-block">
				                	        	<i class="fas fa-calendar-check"></i>
				                	        	<span>{{ $book->date_checkin }} - </span>
				                	        </div> 
				                	        <div class="d-inline-block">
				                	        	<i class="fas fa-calendar-check"></i>
				                	        	<span>{{ $book->date_checkout }}</span>
				                	        </div>

				                	        <div class="d-block">
				                	        	<i class="fas fa-bed"></i>
				                	        	<span>{{ $book->rooms }}room - {{ $book->guests }}people</span>
				                	        </div>

				                	    </div>
				                	    <div class="col-md-4 text-center">
				                	        <h3>Rp {{ number_format($book->grand_total, 0, ',', '.') }}</h3>
				                	        <small>Thank You For Payment*</small>
				                	        <div class="sub-row">
				                	        	<a target="_blank" href="{{ route('public.bookingReceipt', array('uuid' => $book->uuid)) }}" type="button" class="btn btn-theme">Receipt</a>
				                	        </div>
				                	    </div>
				                	</div>
					            </div>
					        </div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>

				@include('site::public.general.pagination')     
			</div>
  	</div>
  </div>
</section>


<style type="text/css">
	.is-active {
		color: #fc6e51
	}

	@media screen and (max-width:480px) {
		.center {
			text-align: center !important;
		}
	}
</style>
@stop

@section('modal')
@parent
<!-- Sign Up Modal -->
<div data-keyboard="false" data-backdrop="static" class="modal fade" id="modal-review" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
    <div class="modal-content" id="sign-up">
      <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
      <div class="modal-body">
        <h4 class="modal-header-title">Review</h4>
        <div class="login-form">
        <div id="review-field">
        	
        </div>
       	</div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-theme" id="submit-preview">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

@stop

@section('script')
@parent

<script type="x-tmpl-mustache" id="form-review">
	<div class="form-group">
		<label>Leave Review</label>
		<textarea class="form-control" id="review-text" data-id="@{{id}}" name="review"></textarea>
		<span class="helper error" id="error-review"></span>
	</div>
</script>



<script type="text/javascript">
	var reviewValidate = {
    review : {
      presence: {
        allowEmpty: false
      }
    }
  };

  async function sendReview(params) {
    var response = new Promise((resolve, reject) => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'contactForm' }).then((token) => {
        $.ajax({
          url : "{{ route('public.sendReview') }}",
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

  $(document).on('keyup', '.validate', function(){

		validate.async(
    {
      review : $('#review-text').val(),
    }, 
    reviewValidate)
    .then((response) => {
  		$('#error-review').html('');
    }).catch((error) => {
    	$('#error-review').html('The field is mandatory')
    });
  })

	$(document).ready(function() {
		$('#submit-preview').on('click', function(){

			$('#review-text').addClass('validate');

			validate.async(
	    {
	      review : $('#review-text').val(),
	    }, 
	    reviewValidate)
	    .then((response) => {
	    	var dataSend = $.extend(false, response, {book_id : $('#review-text').data('id')})
	    	sendReview(dataSend).then((response)=> {
	    		if (response.status) {
	    			$('#modal-review').modal('hide');
	    			Swal.fire('Success',  'Thank you for submit your review', 'success');
	    			deleteReviewButton( $('#review-text').data('id'));
	    			return;
	    		} else {
	    			$('#error-review').html('The field is mandatory')
	    		}
	    	})
	    }).catch((error) => {
	    	$('#error-review').html('The field is mandatory')
	    });
		});
	
		$('.btn-review').on('click', function(){
			var id = $(this).data('id');
			var template = $('#form-review').html();
	    htmlBody = Mustache.render(template, {id: id});
	    $('#review-field').html(htmlBody);
			$('#modal-review').modal('show');
		})
	});


	function deleteReviewButton(id){
		$.each($('.btn-review'), function(key, value){
			if($(value).data('id') == id){
				$(value).remove();
			}
		})
	}
</script>
@stop