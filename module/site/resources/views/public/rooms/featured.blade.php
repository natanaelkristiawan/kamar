<div class="page-sidebar">
  <div class="sidebar-widgets">
    <h4>Featured Property</h4>
    
    <div class="sidebar-property-slide">
      <!-- single item -->
      @foreach($featuredRooms as $room)
      <div class="single-items">
        <div class="uilist-wrap">
          <div class="uilist_thumb">


            <a href="{{ route('public.roomDetail', array('slug'=>$room->slug)) }}"
                data-href="{{ url('image/blur/'.$room->photo_primary) }}"
                class="overlay-cate img-responsive progressive replace"
                data-srcset = "{{ url('image/sm/'.$room->photo_primary) }} 300w,
                            {{ url('image/md/'.$room->photo_primary) }} 600w,
                            {{ url('image/lg/'.$room->photo_primary) }} 690w,
                            {{ url('image/original/'.$room->photo_primary) }} 1380w"
              >
                <img src="{{ url('image/blur/'.$room->photo_primary) }}" class="preview" alt="{{ $room->title }}">
              </a>
            
            <div class="ulisting-listing-category">
              <span class="rent">{{ $room->type_content }}</span>
            </div>
            <div class="uilist_view_thumb">
              <a href="#" class="uilist-btn"><i class="ti-eye"></i></a>
              <a href="#" class="uilist-btn"><i class="ti-share"></i></a>
            </div>
            
            <div class="uilist_bottom_panel">
              <div class="uilist_full_panel">
                <div class="ullist_panel_left">
                  <h4 class="uilist_title">{{ $room->name }}</h4>
                  <ul>
                    <li><i class="ti-home"></i>{{ $room->owner_name }}</li>
                    <li><i class="ti-phone"></i>{{ $room->owner_phone }}</li>
                  </ul>
                </div>
              
              </div>
            </div>
            
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>