<div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Title</label> 
              <input type="text" placeholder="Search Title Category" name="search[title]" class="form-control filter-field">
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