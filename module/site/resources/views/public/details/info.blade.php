<div class="property_lexible-1 mb-4">
  <div class="pr-price-into flex-1" style="margin-right: 29px;word-break: break-all;">
    <h2>{{ $room->name }}</h2>
    <span ><i class="lni-map-marker"></i> {{ $room->address }} <br/> {{ $room->address_detail }}</span>
  </div>
  <div class="price_into_last">
    <h2>Rp {{ number_format($room->price) }}<span>/{{ trans('site::default.night') }}</span></h2>
  </div>
</div>
<!-- Single Block Wrap -->
<div class="property_block_wrap">
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">{{ trans('site::default.description') }}</h4>
  </div>
  
  <div class="block-body">
    {!! $room->description !!}
  </div>
</div> 

<div class="property_block_wrap">
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">{{ trans('site::default.house_rules') }}</h4>
  </div>
  <div class="block-body">
    {!! $room->house_rules !!}
  </div>
</div>