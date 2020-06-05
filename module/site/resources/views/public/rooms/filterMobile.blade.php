<div class="row">
  <div class="col-md-12 col-lg-12">
    <div id="filter-sidebar" class="filter-sidebar">
      <div class="filt-head">
        <h4 class="filt-first">Advance Options</h4>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">Close <i class="ti-close"></i></a>
      </div>
      <div class="show-hide-sidebar">
        
        <!-- Find New Property -->
        <div class="sidebar-widgets">
          
          <div class="form-group">
            <div class="input-with-icon">
              <select type="text" class="form-control b-0 location-list" placeholder="{{ trans('site::default.location')}} "></select>
              <i class="ti-search"></i>
            </div>
          </div>
          

          <div class="ameneties-features">
          
             <a href="{{ route('public.rooms') }}" class="btn search-btn search-room">{{trans('site::default.search')}} </a>
          
          </div>
        
        </div>
        
      </div>
    </div>
  </div>
</div>