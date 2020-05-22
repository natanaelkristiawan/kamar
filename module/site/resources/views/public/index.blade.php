@extends('site::theme.kamartamu.layouts.index')
@section('content')
@include('site::public.partials.banner')

@include('site::public.partials.featured')
<div class="clearfix"></div>
@include('site::public.partials.type')
@include('site::public.partials.ourmission')
@include('site::public.partials.partner')
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop