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
							<a class="nav-link active" id="home-tab" href="{{ route('public.bookingHistory') }}" role="tab" aria-controls="home" aria-selected="true">Pending</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab"  href="{{ route('public.bookingHistorySuccess') }}" role="tab" aria-controls="profile" aria-selected="false">Success</a>
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
													<div class="col-lg-6 text-right center">
														
													</div>
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
				                	        <small>Waiting For Payment*</small>
				                	        <div class="sub-row">
				                	            <a target="_blank" href="{{ $book->notes->pdf_url }}" type="button" class="btn btn-theme">How To Pay</a>
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