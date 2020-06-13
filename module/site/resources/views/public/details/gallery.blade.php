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
            <a href="javascript:;" onclick="shareFB()" data-toggle="tooltip" data-original-title="Share Facebook"><i class="fab fa-facebook-f"></i></a>
          </div>
          <div class="pr-single-info">
            <a href="javascript:;" onclick="window.print()" data-toggle="tooltip" data-original-title="Get Print"><i class="fas fa-print"></i></a>
          </div>
          <div class="pr-single-info">
            <a href="javascript:;" class="like-bitt add-to-favorite {{ $isBookmark ? 'active' : '' }}" data-toggle="tooltip" data-original-title="Add To Favorites"><i class="lni-heart-filled"></i></a>
          </div>
          
        </div>
            
        <!-- Agent Detail -->
        <div class="agent-_blocks_wrap mb-4">
          <div class="agent-_blocks_title">
          
            <div class="agent-_blocks_thumb"><img src="{{ (is_null($room->owner_photo) || empty($room->owner_photo)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$room->owner_photo) }}" alt=""></div>
            <div class="agent-_blocks_caption">
              <h4><a href="#">{{ $room->owner_name }}</a></h4>
              <span class="approved-agent"><i class="ti-check"></i>approved</span>
            </div>
            <div class="clearfix"></div>
          </div>
          
          <a href="#" class="agent-btn-contact btn btn-theme" data-toggle="modal" data-target="#autho-message"><i class="ti-comment-alt"></i>Contact Us</a>         
          <span id="number" class="style-2" data-last="{{ $room->owner_phone }}">
            <span><i class="ti-headphone-alt"></i><a class="see">{{ \Illuminate\Support\Str::limit($room->owner_phone, 5) }}...Show</a></span>
          </span>
          
        </div>
        
      </div>
      
    </div>
  </div>
</section>


@section('script')
@parent

<style>
  .add-to-favorite.active i{
    color: #eb3b5a
  }
</style>

<script type="text/javascript">

  async function bookmark(status) {
    var response = new Promise((resolve, reject) => {
      $.ajax({
        url : "{{ route('public.bookmark') }}",
        data: $.extend(false, TOKEN, {room_id:"{{ $room->id }}", status:status}),
        type: 'post',
        dataType : 'json',
        success : function(result) {
          resolve(result)
        },
        error : function(error) {
          reject(error)
        }
      });
    })

    return await response;
  }

  $(document).on('click', '.add-to-favorite', function(){
    if ($(this).hasClass('active')) {
      bookmark(0).then(response => {
        Swal.fire('Success', 'Remove Bookmark', 'success');
        $(this).removeClass('active')
      }).catch(error => {
        $('.modalLogin').click();
      })
    } else {
  
      bookmark(1).then(response => {
        Swal.fire('Success', 'Add Bookmark', 'success');
        $(this).addClass('active')
      }).catch(error => {
        $('.modalLogin').click();
      })
    }
  })


  function shareFB() {
    FB.ui(
      {
        method: 'share',
        href: '{{ url()->current() }}',
      },
      function(response) {
      }
    );
  }



</script>

@stop