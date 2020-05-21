<section class="gray">
  <div class="container">
    
    <div class="row">
      <div class="col text-center">
        <div class="sec-heading center">
          <h2>{!! trans('site::default.our_featured_partners') !!}</h2>
          <p>{!! trans('site::default.our_featured_partners_sub') !!}</p>
        </div>
      </div>
    </div>
    
    <div class="row">
      
      @foreach($partner as $list)
      <!-- Single Partner -->
      <div class="col-md-3 col-sm-4 col-lg">
        <div class="partner-grid">
          <img src="{{ url('image/xs/'.$list['logo']) }}" class="img-fluid" alt="" />
        </div>
      </div>
      @endforeach
      
    </div>
    
  </div>
</section>