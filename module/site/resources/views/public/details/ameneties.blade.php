<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">{{ trans('site::default.ameneties') }}</h4>
  </div>
  
  <div class="block-body">
    <ul class="avl-features third">
      @foreach($ameneties as $list)
      <li>{{ $list->content }}</li>
      @endforeach
    </ul>
  </div>
  
</div>