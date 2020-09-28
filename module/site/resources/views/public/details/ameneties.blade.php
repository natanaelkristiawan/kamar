<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">{{ trans('site::default.ameneties') }}</h4>
  </div>
  
  <div class="block-body">
    <ul class="avl-features third">
      @foreach($ameneties as $list)
      <li><img src="{{ url('image/profile/'.$list['icon']) }}" class="img-fluid mr-2 float-left" style="max-width: 32px">{{ $list['content'] }}</li>
      @endforeach
    </ul>
  </div>
  
</div>