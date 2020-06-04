<div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Email</label> 
              <input type="text" placeholder="Search Email" name="search[email]" class="form-control filter-field">
            </div>
          </div> 
          <div class="col-lg-6">
            <div class="form-group">
              <label>Code Booking</label> 
              <input type="text" placeholder="Search Code Booking" name="search[uuid]" class="form-control filter-field">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Room Name</label> 
              <input type="text" placeholder="Search Room Name" name="search[roomName]" class="form-control filter-field">
            </div>
          </div>  
          <div class="col-lg-6">
            <div class="form-group">
              <label>Date Filter</label> 
              <select class="form-control filter-field" name="search[date_filter]">
                <option selected="" value="created_at">Created At</option>
                <option value="checkin">CheckIn</option>
                <option value="checkout">CheckOut</option>
              </select>
            </div>
          </div> 

          <div class="col-lg-6">
            <div class="form-group">
              <label>Date Start</label> 
              <input type="text" placeholder="Search Code Booking" name="search[date_start]" class="form-control filter-field datepicker">
            </div>
          </div>  

          <div class="col-lg-6">
            <div class="form-group">
              <label>Date End</label> 
              <input type="text" placeholder="Search Code Booking" name="search[date_end]" class="form-control filter-field datepicker">
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

<style type="text/css">
  .datepicker {
    border: 1px solid #ced4da !important;
  }
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose : true,
      clearBtn: true
    })
  });
</script>
@stop