<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">Property video</h4>
  </div>
  <div class="block-body">
    <iframe style="width: 100%"s src="https://www.youtube.com/embed/{{ $room->youtube }}?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>


@section('style')
@parent

<style type="text/css">
	iframe {
		height: 500px
	}

	@media only screen and (max-width: 600px) {
		iframe {
			height: 250px;
		}
	}
</style>

@stop