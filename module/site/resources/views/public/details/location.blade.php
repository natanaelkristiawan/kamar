<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">{{ trans('site::default.location') }}</h4>
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

 function initMap() {
    latest_lat = $('#map').data('latitude');
    latest_lng = $('#map').data('longitude');
    // Create the map.
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {lat: latest_lat, lng: latest_lng},
      mapTypeId: 'terrain'
    });

    // Construct the circle for each value in citymap.
    // Note: We scale the area of the circle based on the population.
  
    // Add the circle for this city to the map.
    new google.maps.Circle({
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map,
      center: {
        lat : latest_lat,
        lng : latest_lng
      },
      radius:  100
    });
 
  }

  // function initMap(zoom, data) {
  //   if ($('#map').length == 1) {
  //     if (typeof zoom == 'undefined') {
  //       zoom = 15;
  //     }

  //     latest_lat = $('#map').data('latitude');
  //     latest_lng = $('#map').data('longitude');

  //     map = new GMaps({
  //       div: '#map',
  //       lat: latest_lat,
  //       lng: latest_lng,
  //       zoom: 14,
  //       textSearch: true
  //     });




  //     map.addMarker({
  //       lat: latest_lat,
  //       lng: latest_lng,
  //       draggable: false
  //     });
  //   }
  // }

  $(document).ready(function(){
    initMap();
  })
</script>
@stop