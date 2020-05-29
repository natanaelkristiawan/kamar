<section class="gray-bg">
  <div class="container">
    
    <div class="row">
      <div class="col text-center">
        <div class="sec-heading center">
          <h2>{!! trans('site::default.featured_property') !!}</h2>
          <p>{!! trans('site::default.featured_property_sub') !!}</p>
        </div>
      </div>
    </div>
    
    <div class="row">
      
      @foreach($featuredRooms as $room)
      <!-- Single Property -->
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="list-slide-box">
          <div class="modern-list">
            <div class="list-badge now-close">{!! trans('site::default.featured') !!}</div>
            <div class="grid-category-thumb">
          
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
      
              <div class="property_meta simple">
                <a href="{{ route('public.roomDetail', array('slug'=>$room->slug)) }}" class="cate-trix theme-cl">{{ $room->type_content }}</a>
              </div>
            </div>
            <div class="modern-list-content">
              <div class="listing-content-wrap smalls">
                <h4 class="lst-title"><a href="single-property-3.html">{{ $room->name }}</a></h4> 
                <p>{{ $room->location }}</p>
              </div>
              <div class="listing-footer-wrap property-lists mt-2 text-center justify-content-center">
                <h4 class="mdr-price">Rp {{ number_format($room->price) }} </h4>/<span class=" text-muted">{{ trans('site::default.night') }}</span>
              </div>
            </div>
          </div>  
        </div>
      </div>
      @endforeach
    </div>
    
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        <a href="{{ route('public.rooms') }}" class="btn btn-theme arrow-btn">{{ trans('site::default.browse_all_property') }}<span><i class="ti-arrow-right"></i></span></a>
      </div>
    </div>
    
  </div>
</section>