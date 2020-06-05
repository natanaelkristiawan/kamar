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
                      <select type="text" class="form-control b-0 location-list" name="location" placeholder="{{ trans('site::default.location')}} "></select>
                      <i class="ti-target"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 small-padd">
                  <div class="form-group">
                    <a href="{{ route('public.rooms') }}" class="btn search-btn" id="search-room">{{trans('site::default.search')}} </a>
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
  .select2-selection.select2-selection--single, .select2-selection__arrow{
    margin-top: 13px;
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

    $('.location-list').on('select2:select', function (e) {
      var urlRoom = "{{ route('public.rooms') }}"

      var withLocation = e.params.data.id;

      var newLink = urlRoom+'?location='+withLocation;

      $('#search-room').attr('href', newLink);
    }); 

    $('.location-list').on('select2:clearing', function (e) {
      var urlRoom = "{{ route('public.rooms') }}"
      $('#search-room').attr('href', urlRoom);
    });
  });
</script>

@stop