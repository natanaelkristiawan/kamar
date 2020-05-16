@extends('theme.admin.layouts.blank')

@section('content')



<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('rooms') }}
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
                  <a href="{{ route('admin.rooms.create') }}" class="btn btn-sm btn-primary">New</a>
                  <button type="button" data-toggle="modal" data-target="#modal-filter" class="btn btn-sm btn-neutral">Filter</button>
                </div>
              </div>

              @include('rooms::admin.rooms.partials.table')

              
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
@include('rooms::admin.rooms.partials.filter')
@stop

@section('script')
@parent
<link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript"> 
var oTable;
var page = 1;
$(document).ready(function() {
  oTable = $('#datatable').dataTable({
    pageLength: 10,
    responsive: false,
    scrollX: true,
    dom: 'lrtip',
    order: [[ 1, "asc" ]],
    columnDefs: [
      { orderable: false, targets: 0 },
      { orderable: false, targets: 2 },
      { orderable: false, targets: 3 },
      { orderable: false, targets: 4 },
      { orderable: false, targets: 6 },
      { orderable: false, targets: 7 },
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
      url: "{{ route('admin.rooms') }}",
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
      {data : 'photo'},
      {data : 'name'},
      {data : 'owner'},
      {data : 'type'},
      {data : 'location'},
      {data : 'address'},
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

</script>

@stop