@extends('site::theme.kamartamu.layouts.index')
@section('content')

<section class="error-wrap">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-10">
				<div class="text-center">
					<img src="{{ asset('themes/landing') }}/assets/img/404.png" class="img-fluid" alt="">
					<p>{{ \Illuminate\Foundation\Inspiring::quote() }}</p>
					<a class="btn btn-theme" href="{{ route('public.index') }}">Back To Home</a>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop
