@extends('theme.admin.layouts.dashboard')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('dashboard') }}
        </div>
      </div>
    </div>
      <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <!-- Demo purpose only -->
              <div style="min-height: 300px;">
                <p>Your content here</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end page content-->

  </div> <!-- container-fluid -->

</div> <!-- content -->
@stop