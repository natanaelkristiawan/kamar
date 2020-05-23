<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">Location</h4>
  </div>
  
  <div class="block-body">
    <div class="map-container">
      <div id="map" style="height: 400px" data-latitude="{{ $room->latitude }}" data-longitude="{{ $room->longitude }}" data-mapTitle="Our Location">
        
      </div>
    </div>

  </div>
  
</div>


@section('script')
@parent
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6hoGyKmhX5TUFJB9ucNsNvb-wm8wZxfI&libraries=places"></script>
<script src="{{ asset('themes/additionals/gmaps') }}/gmaps.js" type="text/javascript"></script>
<script type="text/javascript">
  function initMap(zoom, data) {
    if ($('#map').length == 1) {
      if (typeof zoom == 'undefined') {
        zoom = 15;
      }

      latest_lat = $('#map').data('latitude');
      latest_lng = $('#map').data('longitude');

      map = new GMaps({
        div: '#map',
        lat: latest_lat,
        lng: latest_lng,
        zoom: 14,
        textSearch: true
      });

      map.addMarker({
        lat: latest_lat,
        lng: latest_lng,
        draggable: false
      });
    }
  }

  $(document).ready(function(){
    initMap();
  })
</script>
@stop