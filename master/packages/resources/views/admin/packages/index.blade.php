@extends('theme.admin.layouts.blank')

@section('content')



<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('packages') }}
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
                  <a href="{{ route('admin.packages.create') }}" class="btn btn-sm btn-primary">New</a>
                  <button type="button" data-toggle="modal" data-target="#modal-filter" class="btn btn-sm btn-neutral">Filter</button>
                </div>
              </div>

              @include('packages::admin.packages.partials.table')

              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end page content-->

  </div> <!-- container-fluid -->

</div> <!-- content -->


@stop


@section('modal')
@parent

@include('packages::admin.packages.partials.filter')
@stop


@section('script')
@parent

<!-- <script type="text/javascript">
var oTable;
var page = 1;
$(document).ready(function() {
  oTable = $('#datatable').dataTable({
    pageLength: 10,
    responsive: false,
    scrollX: true,
    dom: 'lrtip',
    order: [[ 0, "asc" ]],
    columnDefs: [
      { orderable: false, targets: 3 },
    ],
    processing: true,
    serverSide: true,
    language: { 
      paginate: {
        previous: "<i class='fas fa-angle-left'>",
        next: "<i class='fas fa-angle-right'>"
      }
    },
    ajax: {
      url: "{{ route('admin.packages') }}",
      dataType: "json",
      type: "GET",
      data: function ( d ) {
        oSearch = {};
        $('.filter-field').each( function () {
          key = $(this).attr('name');
          val = $(this).val();
          oSearch[key] = val;
        });
        return $.extend(false, TOKEN, {page : page}, oSearch, d);
      }
    },
    preDrawCallback: function( settings ) {
      var api = this.api();
      page = parseInt(api.rows().page()) + 1;
    },
    columns: [
      {data : 'name'},
      {data : 'abstract'},
      {data : 'status'},
      {data : 'action'},
    ],
  });

  $('.filter-btn').on('click', function(){
    oTable.api().draw();
  }); 

  $('.filter-clean').on('click', function(){
    $('.filter-field').val('');
    oTable.api().draw();
  });
});

</script> -->

@stop