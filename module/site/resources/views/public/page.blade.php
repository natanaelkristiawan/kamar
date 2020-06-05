@extends('site::theme.kamartamu.layouts.index')
@section('content')
<!-- ============================ Page Title Start================================== -->
<section class="image-cover faq-sec text-center" style="background:#f4f4f4 url('{{ (is_null($banner) || empty($banner)) ? asset('img/assets/hotel-4416515_1920.jpg') : url('image/original/'.$banner)  }}');" data-overlay="6">
  <div class="container">
    <div class="row">
    
      <div class="col-lg-12 col-md-12">
        <h1 class="text-light">{{ $data['title'] }}</h1>
      </div>
      
    </div>
  </div>
</section>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section class="gray">
  <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          {!! $data['description'] !!}
        </div>
      </div>
  </div>
</section>
<!-- ============================ Agency List End ================================== -->
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop