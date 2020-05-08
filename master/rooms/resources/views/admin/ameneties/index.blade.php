@extends('theme.admin.layouts.blank')

@section('content')



<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('ameneties') }}
        </div>
      </div>
    </div>
      <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h4 class="mt-0 header-title">Data</h4>
                </div>
                <div class="col-lg-6 text-right">
                  <a href="{{ route('admin.ameneties.create') }}" class="btn btn-sm btn-primary">New</a>
                  <button type="button" data-toggle="modal" data-target="#modal-filter" class="btn btn-sm btn-neutral">Filter</button>
                </div>
              </div>

              @include('rooms::admin.ameneties.partials.table')

              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end page content-->

  </div> <!-- container-fluid -->

</div> <!-- content -->


@stop