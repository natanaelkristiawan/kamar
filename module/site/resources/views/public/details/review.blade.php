<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">{{ count($room->reviews) }} Reviews</h4>
  </div>
  
  <div class="block-body">
    <div class="author-review">
      <div class="comment-list">
        <ul>
          @foreach($room->reviews as $review)
          <li class="article_comments_wrap">
            <article>
              <div class="article_comments_thumb">
                <img  src="{{ (is_null( Customers::findByField('id', $review->customer_id)->photo) || empty( Customers::findByField('id', $review->customer_id)->photo)) ? asset('img/pngwave.png') : url('image/profile/'. Customers::findByField('id', $review->customer_id)->photo) }}" alt="">
              </div>
              <div class="comment-details">
                <div class="comment-meta">
                  <div class="comment-left-meta">
                    <h4 class="author-name">{{ Customers::findByField('id', $review->customer_id)->name }}</h4>
                    <div class="comment-date">{{ date('d F Y H:i:s', strtotime($review->created_at)) }}</div>
                  </div>
                  <div>
                    
                  @for($i=0;$i<5;$i++)
                  <span class="fa fa-star {{ $i < $review->rating ? 'checked' : '' }}"></span>
                  @endfor
                  </div>
                </div>
                <div class="comment-text">
                  <p>{!! $review->review !!}</p>
                </div>
              </div>
            </article>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="property_block_wrap">
  
  <div class="property_block_wrap_header">
    <h4 class="property_block_title">Other Reviews</h4>
  </div>

  <div class="block-body">
    <div class="author-review">
      <div class="comment-list">
        {!! $room->other_review !!}
      </div>
    </div>
  </div>
</div>


@section('script')
@parent
<style type="text/css">
  .checked {
  color: orange;
}
</style>

@stop