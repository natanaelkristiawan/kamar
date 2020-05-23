@extends('site::theme.kamartamu.layouts.index')
@section('content')
<section class="gray p-0">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-lg-8 col-md-7 col-sm-12">
        <div class="property3-slide single-advance-property">
      
          <div class="slider-for">
            <a href="{{ url('image/original/'.$room->photo_primary) }}"
              data-href="{{ url('image/original/'.$room->photo_primary) }}"
              data-srcset = "{{ url('image/sm/'.$room->photo_primary) }} 300w,
                            {{ url('image/md/'.$room->photo_primary) }} 600w,
                            {{ url('image/lg/'.$room->photo_primary) }} 690w,
                            {{ url('image/original/'.$room->photo_primary) }} 1380w"
              class="item-slick progressive replace">
              <img src="{{ url('image/blur/'.$room->photo_primary) }}"  class="preview" >
            </a>
            @foreach($room->gallery as $photo)
            <a href="{{ url('image/original/'.$photo->path) }}"
              data-href="{{ url('image/original/'.$photo->path) }}"
              data-srcset = "{{ url('image/sm/'.$photo->path) }} 300w,
                            {{ url('image/md/'.$photo->path) }} 600w,
                            {{ url('image/lg/'.$photo->path) }} 690w,
                            {{ url('image/original/'.$photo->path) }} 1380w"
              class="item-slick progressive replace">
              <img src="{{ url('image/blur/'.$photo->path) }}"  class="preview" >
            </a>
            @endforeach

          </div>
          <div class="slider-nav style-2">
            <div class="item-slick">
              <a href=""
                  data-href=""
                  data-srcset = "{{ url('image/sm/'.$room->photo_primary) }} 300w,
                                {{ url('image/md/'.$room->photo_primary) }} 600w,
                                {{ url('image/lg/'.$room->photo_primary) }} 690w,
                                {{ url('image/original/'.$room->photo_primary) }} 1380w"
                  class="progressive replace">
                <img src="{{ url('image/blur/'.$room->photo_primary) }}" class="preview" alt="Alt">
              </a>
            </div>
            @foreach($room->gallery as $photo)
            <div class="item-slick">
              <a href=""
                  data-href=""
                  data-srcset = "{{ url('image/sm/'.$photo->path) }} 300w,
                                {{ url('image/md/'.$photo->path) }} 600w,
                                {{ url('image/lg/'.$photo->path) }} 690w,
                                {{ url('image/original/'.$photo->path) }} 1380w"
                  class="progressive replace">
                <img src="{{ url('image/blur/'.$photo->path) }}" class="preview" alt="Alt">
              </a>
            </div>
            @endforeach
          </div>
          
        </div>
      </div>
      
      <div class="col-lg-4 col-md-5 col-sm-12">
      
        <div class="pr-all-info text-center mb-3 mt-4">
              
          <div class="pr-single-info">
            <div class="share-opt-wrap">
              <button type="button" class="btn-share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Share this">
                <i class="lni-share"></i>
              </button>
              <div class="dropdown-menu animated flipInX">
                <a href="#" class="cl-facebook"><i class="lni-facebook"></i></a>
                <a href="#" class="cl-twitter"><i class="lni-twitter"></i></a>
                <a href="#" class="cl-gplus"><i class="lni-google-plus"></i></a>
                <a href="#" class="cl-instagram"><i class="lni-instagram"></i></a>
              </div>
            </div>

          </div>
          
          <div class="pr-single-info">
            <a href="JavaScript:Void(0);" data-toggle="tooltip" data-original-title="Get Print"><i class="ti-printer"></i></a>
          </div>
          <div class="pr-single-info">
            <a href="JavaScript:Void(0);" class="like-bitt add-to-favorite" data-toggle="tooltip" data-original-title="Add To Favorites"><i class="lni-heart-filled"></i></a>
          </div>
          
        </div>
            
        <!-- Agent Detail -->
        <div class="agent-_blocks_wrap mb-4">
          <div class="agent-_blocks_title">
          
            <div class="agent-_blocks_thumb"><img src="https://via.placeholder.com/400x400" alt=""></div>
            <div class="agent-_blocks_caption">
              <h4><a href="#">Shivangi Preet</a></h4>
              <span class="approved-agent"><i class="ti-check"></i>approved</span>
            </div>
            <div class="clearfix"></div>
          </div>
          
          <a href="#" class="agent-btn-contact btn btn-theme" data-toggle="modal" data-target="#autho-message"><i class="ti-comment-alt"></i>Contact Us</a>         
          <span id="number" class="style-2" data-last="{{ Site::getDataSite('phone') }}">
            <span><i class="ti-headphone-alt"></i><a class="see">{{ \Illuminate\Support\Str::limit(Site::getDataSite('phone'), 5) }}...Show</a></span>
          </span>
          
        </div>
        
      </div>
      
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      
      <!-- property main detail -->
      <div class="col-lg-8 col-md-12 col-sm-12">
        
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
            <h4 class="property_block_title">Description</h4>
          </div>
          
          <div class="block-body">
            {!! $room->description !!}
          </div>
          
        </div> 

        <div class="property_block_wrap">
          
          <div class="property_block_wrap_header">
            <h4 class="property_block_title">House Rules</h4>
          </div>
          
          <div class="block-body">
            {!! $room->house_rules !!}
          </div>
          
        </div>
        
        <!-- Single Block Wrap -->
        <div class="property_block_wrap">
          
          <div class="property_block_wrap_header">
            <h4 class="property_block_title">Ameneties</h4>
          </div>
          
          <div class="block-body">
            <ul class="avl-features third">
              <li>Air Conditioning</li>
              <li>Swimming Pool</li>
              <li>Central Heating</li>
              <li>Laundry Room</li>
              <li>Gym</li>
              <li>Alarm</li>
              <li>Window Covering</li>
              <li>Internet</li>
              <li>Pets Allow</li>
              <li>Free WiFi</li>
              <li>Car Parking</li>
              <li>Spa & Massage</li>
            </ul>
          </div>
          
        </div>
        
        <!-- Single Block Wrap -->
        <div class="property_block_wrap">
          
          <div class="property_block_wrap_header">
            <h4 class="property_block_title">Property video</h4>
          </div>
          
          <div class="block-body">
            <div class="property_video">
              <div class="thumb">
                <img class="pro_img img-fluid w100" src="https://via.placeholder.com/1300x840" alt="7.jpg">
                <div class="overlay_icon">
                  <div class="bb-video-box">
                    <div class="bb-video-box-inner">
                      <div class="bb-video-box-innerup">
                        <a href="https://www.youtube.com/watch?v=A8EI6JaFbv4" data-toggle="modal" data-target="#popup-video" class="theme-cl"><i class="ti-control-play"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Single Block Wrap -->
        <div class="property_block_wrap">
          
          <div class="property_block_wrap_header">
            <h4 class="property_block_title">Location</h4>
          </div>
          
          <div class="block-body">
            <div class="map-container">
              <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781" data-mapTitle="Our Location"></div>
            </div>

          </div>
          
        </div>
        
        <!-- Single Reviews Block -->
        <div class="property_block_wrap">
          
          <div class="property_block_wrap_header">
            <h4 class="property_block_title">102 Reviews</h4>
          </div>
          
          <div class="block-body">
            <div class="author-review">
              <div class="comment-list">
                <ul>
                  <li class="article_comments_wrap">
                    <article>
                      <div class="article_comments_thumb">
                        <img src="https://via.placeholder.com/400x400" alt="">
                      </div>
                      <div class="comment-details">
                        <div class="comment-meta">
                          <div class="comment-left-meta">
                            <h4 class="author-name">Rosalina Kelian</h4>
                            <div class="comment-date">19th May 2018</div>
                          </div>
                        </div>
                        <div class="comment-text">
                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborumab.
                            perspiciatis unde omnis iste natus error.</p>
                        </div>
                      </div>
                    </article>
                  </li>
                  <li class="article_comments_wrap">
                    <article>
                      <div class="article_comments_thumb">
                        <img src="https://via.placeholder.com/400x400" alt="">
                      </div>
                      <div class="comment-details">
                        <div class="comment-meta">
                          <div class="comment-left-meta">
                            <h4 class="author-name">Rosalina Kelian</h4>
                            <div class="comment-date">19th May 2018</div>
                          </div>
                        </div>
                        <div class="comment-text">
                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborumab.
                            perspiciatis unde omnis iste natus error.</p>
                        </div>
                      </div>
                    </article>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- property Sidebar -->
      <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="property-sidebar">
          
          <div class="agent-_blocks_wrap">
            <div class="side-booking-header">
              <span class="sb-header-left">Book it now</span>
              <h3 class="price">$70<sub>per night</sub></h3>
            </div>
            <div class="side-booking-body">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6">
                  <div class="form-group">
                    <div class="cld-box">
                      <i class="ti-calendar"></i>
                      <input type="text" class="form-control" placeholder="Checkin Start" id="date-input-start" value="" />
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6">
                  <div class="form-group">
                    <div class="cld-box">
                      <i class="ti-calendar"></i>
                      <input type="text" class="form-control" placeholder="Checkin End" id="date-input-end" value="" />
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class="form-group">
                    <div class="guests">
                      <label for="guests">Adults</label>
                      <div class="guests-box">
                        <button class="counter-btn" type="button" id="cnt-down"><i class="ti-minus"></i></button>
                        <input type="text" id="guestNo" name="guests" value="2"/>
                        <button class="counter-btn" type="button" id="cnt-up"><i class="ti-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class="form-group">
                    <div class="guests">
                      <label for="guests">Kids</label>
                      <div class="guests-box">
                        <button class="counter-btn" type="button" id="kcnt-down"><i class="ti-minus"></i></button>
                        <input type="text" id="kidsNo" name="kids" value="0"/>
                        <button class="counter-btn" type="button" id="kcnt-up"><i class="ti-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="side-booking-foot">
                  <span class="sb-header-left">Total</span>
                  <h3 class="price theme-cl">$170</h3>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="stbooking-footer mt-1">
                    <div class="form-group mb-0 pb-0">
                      <a href="#" class="btn full-width btn-theme">Book It Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Find New Property -->
          <div class="sidebar-widgets">
            
            <h4>Find New Property</h4>
            
            <div class="form-group">
              <div class="input-with-icon">
                <input type="text" class="form-control" placeholder="Neighborhood">
                <i class="ti-search"></i>
              </div>
            </div>
            <div class="form-group">
              <div class="input-with-icons">
                <select id="bedrooms" class="form-control">
                  <option value="">&nbsp;</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-with-icons">
                <select id="bathrooms" class="form-control">
                  <option value="">&nbsp;</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-with-icons">
                <select id="cities" class="form-control">
                  <option value="">&nbsp;</option>
                  <option value="1">Los Angeles, CA</option>
                  <option value="2">New York City, NY</option>
                  <option value="3">Chicago, IL</option>
                  <option value="4">Houston, TX</option>
                  <option value="5">Philadelphia, PA</option>
                  <option value="6">San Antonio, TX</option>
                  <option value="7">San Jose, CA</option>
                </select>
              </div>
            </div>
            
            <button class="btn btn-theme full-width">Find New Home</button>
            
          </div>
        
        </div>
      </div>
      
    </div>
  </div>
</section>
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop



@section('script')
@parent
<!-- Date Booking Script -->
<script src="{{ asset('themes/landing') }}/assets/js/moment.min.js"></script>
<script src="{{ asset('themes/additionals/') }}/datedropper/datedropper.pro.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var options = {
     large: true,
      largeOnly: true,
      lock: 'from',
      minYear: new Date().getFullYear(),
      maxYear: new Date().getFullYear() + 5,
      format: 'Y-m-d'
    }
    $('#date-input-start').dateDropper(options);
    $('#date-input-end').dateDropper(options);
  })
</script>



@stop