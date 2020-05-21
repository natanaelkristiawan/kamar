<section class="pt-0">
  <div class="container">
  
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="sec-heading center">
          <h2>{!! trans('site::default.our_mission') !!}</h2>
          <p>{{ trans('site::default.our_mission_sub') }}</p>
        </div>
      </div>
    </div>
    
    <div class="row align-items-center">
      
      <div class="col-lg-6 col-md-6">
        
        <div class="why-ch">
          <h4>{{ $mission['title'] }}</h4>
          <p>{{ $mission['description'] }}</p>
        </div>
        
        @foreach($missionData as $list)
        <div class="icon-mi-left">
          <i style="color: #FC6E51" class="{{ $list['icon'] }}"></i>
          <div class="icon-mi-left-content">
            <h4>{{ $list[$lang]['title'] }}</h4>
            <p>{{ $list[$lang]['description'] }}</p>
          </div>
        </div>
        @endforeach
        
      </div>
      
      <div class="col-lg-6 col-md-6">
        <div class="position-relative hts-100 vw-lg-50 js--lazyload js--lazyload--loading">
          <img class="img-fluid w-100 rounded rounded-lg-right-0" alt="image description"
               src="{{ url('image/blur/'.$missionBanner) }}"
               data-lazyload="{{ url('image/sm/'.$missionBanner) }} 300w,
                              {{ url('image/md/'.$missionBanner) }} 600w,
                              {{ url('image/lg/'.$missionBanner) }} 690w,
                              {{ url('image/original/'.$missionBanner) }} 1380w">
        </div>
      </div>
      
    </div>
  </div>
</section>