<div class="row">
  @foreach($rooms as $room)
  <!-- Single Property -->
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="single_property_style property_style_2">
      
      <div class="listing_thumb_wrapper">
        <div class="property_gallery_slide">
          <div class="click">
            @foreach($room->gallery as $photo)
            <div>
              <a href="{{ route('public.roomDetail', array('slug'=>$room->slug)) }}"
              data-href="{{ url('image/original/'.$photo->path) }}"
              data-srcset = "{{ url('image/sm/'.$photo->path) }} 300w,
                            {{ url('image/md/'.$photo->path) }} 600w,
                            {{ url('image/lg/'.$photo->path) }} 690w,
                            {{ url('image/original/'.$photo->path) }} 1380w"
              class="img-fluid mx-auto progressive replace">
              <img src="{{ url('image/blur/'.$photo->path) }}"  class="preview" >
              </a>
            </div>
            @endforeach
          </div>
        </div>
        
        <div class="ulisting-listing-category left">
          <span class="rent">{{ $room->type_content }}</span>
          <span class="like-prty"><i class="ti-heart"></i></span>
        </div>
        
        <div class="uilist_bottom_panel">
          <div class="uilist_full_panel">
            <div class="ullist_panel_left">
              <h4 class="uilist_title">{{ $room->name }}</h4>
              <ul>
                <li><i class="lni lni-phone theme-cl"></i>{{ $room->owner_phone }}</li>
              </ul>
            </div>
            <div class="ullist_panel_right">
              <h4 class="uilist_price_title">Rp {{ number_format($room->price) }}</h4>
              <div class="uilist-rating"><i class="ti-star"></i>{{ $room->rating }} Reviews</div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- End Single Property -->     
  @endforeach
</div>