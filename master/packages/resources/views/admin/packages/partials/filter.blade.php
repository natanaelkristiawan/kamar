<div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Owner</label> 
              <select class="form-control select-owner filter-field" name="search[owner_id]" required="" data-error="Please select owner"></select>
              <div class="help-block with-errors error"></div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label>Status</label> 
              <select class="form-control filter-field" name="search[status]">
                <option value="all">All</option>
                <option value="1">Live</option>
                <option value="0">Draft</option>
                <option value="2">Exhausted Limit</option>
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
   $(document).ready(function(){
    var owners = {!! json_encode($owners) !!}


    initSelect2('.select-owner', owners).then((result) => {
      
    });

  })
</script>

@stop