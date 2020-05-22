<section>
  <div class="container">
    
    <div class="row mb-4">
    
      <div class="btn-group nav nav-pills btn-group-toggle m-auto" id="pills-tab" role="tablist">
        @foreach($featuredType as $key => $type)
        <label class="btn btn-secondary">
          <a class="nav-link {{ !(bool)$key ? 'active' : '' }}" id="{{ $type->slug }}-tab" data-toggle="pill" href="#{{ $type->slug }}" role="tab" aria-controls="{{ $type->slug }}" aria-selected="true">{{ $type->name }}</a>
        </label>
        @endforeach
      </div>
    
    </div>
    
    <div class="row m-0">
      
      <div class="tab-content" id="pills-tabContent">
        @foreach($featuredType as $key => $type)
        <div class="tab-pane fade {{ !(bool)$key ? 'show active' : '' }}" id="{{ $type->slug }}" role="tabpanel" aria-labelledby="{{ $type->slug }}-tab">
          <div class="row">
            
            @foreach($type->rooms as $room)
            <!-- Single Property -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="single_property_style property_style_2 modern">
              
                <div class="listing_thumb_wrapper">
                  <div class="modern-pro-wrap">
                    <span class="property-type rent">{{ $type->name }}</span>
                  </div>
                  <div class="property_gallery_slide-thumb">
                    <a href="{{ route('public.roomDetail', array('slug'=>$room->slug)) }}"
                      data-href="{{ url('image/blur/'.$room->photo_primary) }}"
                      data-srcset = "{{ url('image/sm/'.$room->photo_primary) }} 300w,
                            {{ url('image/md/'.$room->photo_primary) }} 600w,
                            {{ url('image/lg/'.$room->photo_primary) }} 690w,
                            {{ url('image/original/'.$room->photo_primary) }} 1380w"
                      class="progressive replace img-fluid mx-auto"
                    >
                      <img src="{{ url('image/blur/'.$room->photo_primary) }}" class="preview" alt="{{ $room->name }}" />
                    </a>
                  </div>
                  <div class="property_price_compare">
                    <div class="property_price_reviess">
                      <span style="color: #fff !important"><i class="lni lni-phone mr-2"></i>{{ Site::getDataSite('phone') }}</span>
                      <div class="prt_rates mr-2"><i class="fa fa-star mr-2"></i>4.8 <span>(33 reviews)</span></div>
                    </div>
                    <div class="lpc-right">
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Bookmark Property"><i class="ti-heart"></i></a>
                    </div>
                  </div>
                  
                </div>
                
                <div class="property_caption_wrappers pb-0">
                  <div class="property_short_detail">
                    <h4 class="listing-name"><a href="{{ route('public.roomDetail', array('slug'=>$room->slug)) }}">{{ $room->name }}</a></h4>
                    <span class="property-locations"><i class="ti-location-pin"></i>{{ $room->address }}</span>
                  </div>
                </div>
                
                <div class="modern_property_footer justify-content-center">
                  <h4 class="mdr-price mb-0">Rp {{ number_format($room->price) }} </h4>/<span class=" text-muted">{{ trans('site::default.night') }}</span>
                </div>
              </div>
            </div>

            @endforeach
          </div>
        </div>
        
        @endforeach
      </div>
    </div>
  </div>
</section>