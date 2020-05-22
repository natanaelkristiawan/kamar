@extends('site::theme.kamartamu.layouts.index')
@section('content')
@include('site::public.partials.banner')
<!-- ============================ Featured Property Start ================================== -->
@include('site::public.partials.featured')
<div class="clearfix"></div>
<!-- ============================ Featured Property End ================================== -->

<!-- ============================ Property Start ================================== -->
@include('site::public.partials.type')
<!-- ============================ Property End ================================== -->

<!-- ================= Our Mission ================= -->
@include('site::public.partials.ourmission')
<!-- ================= Our Mission ================= -->

<!-- ============================ partner Start ================================== -->
@include('site::public.partials.partner')
<div class="clearfix"></div>
<!-- ============================ partner End ================================== -->

<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call_action_wrap-wrap">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        
        <div class="call_action_wrap">
          <div class="call_action_wrap-head">
            <h3>{{ trans('site::default.signup_quote')  }}</h3>
            <span>{{ trans('site::default.signup_quote_sub')  }}</span>
          </div>
          <a href="#" data-toggle="modal" data-target="#signup" class="btn btn-call_action_wrap">{{ trans('site::default.signup_today')  }}</a>
        </div>
        
      </div>
    </div>
  </div>
</section>
@stop