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
              <label>Email</label> 
              <input type="text" placeholder="Search Email" name="search[email]" class="form-control filter-field">
            </div>
          </div> 

          <div class="col-lg-6">
            <div class="form-group">
              <label>Date Start</label> 
              <input type="text" placeholder="Search Date Start" name="search[created_at][0]" class="form-control filter-field datestart">
            </div>
          </div> 

          <div class="col-lg-6">
            <div class="form-group">
              <label>Date End</label> 
              <input type="text" placeholder="Search Date End" name="search[created_at][1]" class="form-control filter-field dateend">
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
  $(document).ready(function() {
    var dateStart = $('.datestart').datepicker({
      format: 'yyyy-mm-dd',
      autoclose : true,
      clearBtn: true
    }).on('changeDate', function (selected) {
      var that = $('.dateend');
      if (typeof selected.date == 'undefined') {
        that.val('');
        that.datepicker('setStartDate', false);
        that.datepicker('setDate', false);
        return;
      }
      var minDate = new Date(selected.date.valueOf());
      that.datepicker('setStartDate', minDate);
    });

    var dateEndStart = new Date();

    var dateEnd = $('.dateend').datepicker({
      format: 'yyyy-mm-dd',
      autoclose : true,
      startDate: dateEndStart,
    });
  });
</script>

@stop