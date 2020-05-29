<div class="sidebar-widgets">     
  <h4>Find New Property</h4>
  <div class="form-group">
    <div class="input-with-icon">
      <select type="text" class="form-control location-list" placeholder="{{ trans('site::default.location')}} "></select>
      <i class="ti-search"></i>
    </div>
  </div>
  <button class="btn btn-theme full-width">Search</button>
</div>


@section('style')
@parent

<style type="text/css">
  .select2-selection.select2-selection--single, .select2-selection__arrow{
    margin-top: 13px;
    border: 0px !important;
  }

  .select2.select2-container.select2-container--default{
    box-shadow: none;
    border: 1px solid #e6eaf3;
  }

  .select2-dropdown.select2-dropdown--below{
    top: 0px !important;
  }



  @media (min-width: 768px)
  {
    .select2-dropdown.select2-dropdown--below {
      top: 10px;
    }
  }
</style>
@stop

@section('script')
@parent

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.location-list').select2({
      placeholder : "Select Your Location",
      data : {!! json_encode($locations) !!},
      allowClear: true
    });
  });
</script>
@stop