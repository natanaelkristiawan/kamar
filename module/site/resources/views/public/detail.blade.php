@extends('site::theme.kamartamu.layouts.index')
@section('content')
@include('site::public.details.gallery')
<section class="pt-5">
  <div class="container">
    <div class="row">
      <!-- property main detail -->
      <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
        @include('site::public.details.info')
        <!-- Single Block Wrap -->
        @include('site::public.details.ameneties')
        <!-- Single Block Wrap -->
        @if( !(bool)is_null($room->youtube) || !(bool)empty($room->youtube) )
        @include('site::public.details.video')
        @endif
        <!-- Single Block Wrap -->
        @include('site::public.details.location')
        <!-- Single Reviews Block -->
        @include('site::public.details.review')
      </div>
      <!-- property Sidebar -->
      <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="property-sidebar">

          @if(is_null($packageOwner))

          @include('site::public.details.booking')
          
          @endif
          <!-- Find New Property -->
          @include('site::public.details.filter')
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop