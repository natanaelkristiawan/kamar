<div class="modal fade" id="modal-filter" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Name</label> 
              <input type="text" placeholder="Search Name" name="search[name]" class="form-control filter-field">
            </div>
          </div> 
          
          <div class="col-lg-6">
            <div class="form-group">
              <label>Owner</label> 
              <select placeholder="Search Name" name="search[owner_id]" class="form-control filter-field select-owner"></select>
            </div>
          </div> 
          
          <div class="col-lg-6">
            <div class="form-group">
              <label>Location</label> 
              <select placeholder="Search Name" name="search[location_id]" class="form-control filter-field select-location"></select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label>Type</label> 
              <select placeholder="Search Name" name="search[type_id]" class="form-control filter-field select-type"></select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label>Status</label> 
              <select class="form-control filter-field" name="search[status]">
                <option value="all">All</option>
                <option value="1">Live</option>
                <option value="0">Draft</option>
              </select>
            </div>
          </div>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger filter-btn">Filter</button>
        <button type="button" class="btn btn-primary filter-clean">Clear</button>
        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@section('script')
@parent

<script type="text/javascript">
  var owners = {!! json_encode($owners) !!}
  var types = {!! json_encode($types) !!}
  var locations = {!! json_encode($locations) !!}
  var ameneties = {!! json_encode($ameneties) !!}
  $(document).ready(function(){
    initSelect2('.select-owner', owners)
    initSelect2('.select-type', types)
    initSelect2('.select-location', locations)
  });
</script>

@stop