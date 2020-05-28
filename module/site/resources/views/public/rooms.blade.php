@extends('site::theme.kamartamu.layouts.index')
@section('content')
<section class="gray">
  <div class="container">
    <!-- Onclick Sidebar -->
    @include('site::public.rooms.filterMobile')
    <!-- Breadcrumbs -->
    @include('site::public.rooms.breadcrumb')
    <div class="row">
      <!-- property Sidebar -->
      <div class="col-lg-4 col-md-12 col-sm-12">
        @include('site::public.rooms.filter')
        @include('site::public.rooms.featured')
      </div>
      <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="shorting-wrap">
              <h5 class="shorting-title">{{ $pagination->total }} Results</h5>
              <div class="shorting-right">
                <label>Short By:</label>
                <div class="dropdown show">
                  <a class="btn btn-filter dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="selection">Most Rated</span>
                  </a>
                  <div class="drp-select dropdown-menu">
                    <a class="dropdown-item" href="JavaScript:Void(0);">Most Rated</a>
                    <a class="dropdown-item" href="JavaScript:Void(0);">Most View</a>
                    <a class="dropdown-item" href="JavaScript:Void(0);">News Listings</a>
                    <a class="dropdown-item" href="JavaScript:Void(0);">High Rated</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('site::public.rooms.list')
        <!-- Pagination -->
        @include('site::public.general.pagination')
      </div>
    </div>
  </div>  
</section>
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop


@section('script')
@parent
<script>
  function openNav() {
    document.getElementById("filter-sidebar").style.width = "320px";
  }
  function closeNav() {
    document.getElementById("filter-sidebar").style.width = "0";
  }
</script>

@stop