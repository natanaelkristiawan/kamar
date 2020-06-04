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
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pending</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Success</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="row">
								<div class="col-12">
									<div class="card shadow">
					            <div class="card-body">
					                <div class="row center">
				                	    <div class="col-md-3 mb-3">
				                	      <img class="img-fluid rounded" src="https://via.placeholder.com/360x360">
				                	    </div>
				                	    <div class="col-md-5 mb-3">
				                	        <h4 class="mb-0">Nama Villa</h4>
				                	        <div class="d-block mb-1">
				                	        	Denpasar
				                	        </div>
				                	        <div class="d-inline-block">
				                	        	<i class="fas fa-calendar-check"></i>
				                	        	<span>10 Januari 2020 - </span>
				                	        </div>
				                	        <div class="d-inline-block">
				                	        	<i class="fas fa-calendar-check"></i>
				                	        	<span>15 Januari 2020</span>
				                	        </div>

				                	        <div class="d-block">
				                	        	<i class="fas fa-bed"></i>
				                	        	<span>4room - 8people</span>
				                	        </div>

				                	    </div>
				                	    <div class="col-md-4 text-center">
				                	        <h3>Rp 3.000.000</h3>
				                	        <small>Waiting For Payment*</small>
				                	        <div class="sub-row">
				                	            <button type="button" class="btn btn-theme">How To Pay</button>
				                	        </div>
				                	    </div>
				                	</div>
					            </div>
					        </div>
								</div>
								<div class="col-12">
									<div class="card shadow">
					            <div class="card-body">
					                <div class="row center">
				                	    <div class="col-md-3 mb-3">
				                	      <img class="img-fluid rounded" src="https://via.placeholder.com/360x360">
				                	    </div>
				                	    <div class="col-md-5 mb-3">
				                	        <h4 class="mb-0">Nama Villa</h4>
				                	        <div class="d-block mb-1">
				                	        	Denpasar
				                	        </div>
				                	        <div class="d-inline-block">
				                	        	<i class="fas fa-calendar-check"></i>
				                	        	<span>10 Januari 2020 - </span>
				                	        </div>
				                	        <div class="d-inline-block">
				                	        	<i class="fas fa-calendar-check"></i>
				                	        	<span>15 Januari 2020</span>
				                	        </div>

				                	        <div class="d-block">
				                	        	<i class="fas fa-bed"></i>
				                	        	<span>4room - 8people</span>
				                	        </div>

				                	    </div>
				                	    <div class="col-md-4 text-center">
				                	        <h3>Rp 3.000.000</h3>
				                	        <small>Waiting For Payment*</small>
				                	        <div class="sub-row">
				                	            <button type="button" class="btn btn-theme">How To Pay</button>
				                	        </div>
				                	    </div>
				                	</div>
					            </div>
					        </div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</div>
				</div>
				<nav aria-label="Page navigation example">
			  <ul class="pagination">
			    <li class="page-item">
					  <a class="page-link" href="#" aria-label="Previous">
						<span class="ti-arrow-left"></span>
						<span class="sr-only">Previous</span>
					  </a>
					</li>
			    <li class="page-item"><a class="page-link" href="#">1</a></li>
			    <li class="page-item"><a class="page-link" href="#">2</a></li>
			    <li class="page-item"><a class="page-link" href="#">3</a></li>
  		    <li class="page-item">
					  <a class="page-link" href="#" aria-label="Next">
						<span class="ti-arrow-right"></span>
						<span class="sr-only">Next</span>
					  </a>
					</li>
			  </ul>
			</nav>
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