<!-- ============================ Hero Banner  Start================================== -->
<div class="image-cover hero_banner bgimg  progressive replace d-flex" data-overlay="4">
  <div class="container">
    
    <h1 class="big-header-capt mb-4">{{ trans('site::default.quote')}} </h1>

      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">
        
          <div class="full_search_box nexio_search lightanic_search hero_search-radius style-2">
            <div class="search_hero_wrapping">
            <div class="row">
              
              <div class="col-lg-9 col-md-9 col-sm-12 small-padd">
                <div class="form-group">
                  <div class="input-with-icon">
                    <input type="text" class="form-control b-0" placeholder="{{ trans('site::default.location')}} ">
                    <i class="ti-target"></i>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-3 col-md-3 col-sm-12 small-padd">
                <div class="form-group">
                  <a href="#" class="btn search-btn">{{trans('site::default.search')}} </a>
                </div>
              </div>
          
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- ============================ Hero Banner End ================================== -->

@section('style')
@parent

<style type="text/css">
  .bgimg {
    background:url({{ url('image/original/'.$mainBanner) }}) no-repeat;
    background-size: cover;
  }

  .bgimg.replace {
    background: url({{ url('image/blur/'.$mainBanner) }}) no-repeat;
    background-size: cover;
  }
</style>
@stop