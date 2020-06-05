@extends('site::theme.kamartamu.layouts.index')
@section('content')
<!-- ============================ Page Title Start================================== -->
<section class="image-cover faq-sec text-center" style="background:url('{{ asset('img/assets/hotel-4416515_1920.jpg') }}') no-repeat;" data-overlay="6">
	<div class="container">
		<div class="row">
		
			<div class="col-lg-12 col-md-12">
				<h1 class="text-light">Frequently Asked Questions</h1>
			</div>
			
		</div>
	</div>
</section>
<!-- ============================ Page Title End ================================== -->

<!-- ================= Our Mission ================= -->
<section>
	<div class="container">
	
		<div class="row">
			
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="contact-box">
					<i class="ti-shopping-cart theme-cl"></i>
					<h4>Contact Sales</h4>
					<p>sales@rikadahelp.co.uk</p>
					<span>+01 215 245 6258</span>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="contact-box">
					<i class="ti-user theme-cl"></i>
					<h4>Contact Sales</h4>
					<p>sales@rikadahelp.co.uk</p>
					<span>+01 215 245 6258</span>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="contact-box">
					<i class="ti-comment-alt theme-cl"></i>
					<h4>Start Live Chat</h4>
					<span>+01 215 245 6258</span>
					<span class="live-chat">Live Chat</span>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			
			<div class="col-lg-10 col-md-12 col-sm-12">
				
				<div class="property_block_wrap_header">
					<ul class="nav nav-tabs customize-tab" id="myTab" role="tablist">
						@foreach($data as $key => $list)
					  <li class="nav-item">
						<a class="nav-link {{ !(bool)$key ? 'active' : '' }}" id="{{$list->slug}}-tab" data-toggle="tab" href="#{{$list->slug}}" role="tab" aria-controls="general" aria-selected="true">General</a>
					  </li>
					  @endforeach		  
					</ul>
				</div>
				
				<div class="tab-content" id="myTabContent">
					
					@foreach($data as $key => $list)
					<!-- general Query -->
					<div class="tab-pane fade show {{ !(bool)$key ? 'active' : '' }}" id="{{$list->slug}}" role="tabpanel" aria-labelledby="{{$list->slug}}">
						<div class="accordion" id="generalac">
							
							@foreach($list->contents as $listKey => $dataContent)

							<div class="card">
								<div class="card-header" id="{{ $listKey }}">
								  <h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{ $dataContent->slug }}" aria-expanded="true" aria-controls="{{$dataContent->slug}}">
									  {!! $dataContent->title[$lang] !!}
									</button>
								  </h2>
								</div>

								<div id="{{$dataContent->slug}}" class="collapse show" aria-labelledby="{{ $listKey }}" data-parent="#{{$list->slug}}">
								  <div class="card-body">
										<p class="ac-para">
											{!! $dataContent->description[$lang] !!}
										</p>
									</div>
								</div>
							</div>
							@endforeach

						</div>
						
					</div>
					@endforeach		
				</div>
				
			</div>
			
		</div>
	</div>
</section>
<!-- ================= Our Mission ================= -->

<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop