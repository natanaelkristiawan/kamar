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
              <div class="comment-details">
                <div class="comment-meta">
                  <div class="comment-left-meta">
                    <h4 class="author-name">{{ Customers::findByField('id', $review->customer_id)->name }}</h4>
                    <div class="comment-date">{{ date('d F Y H:i:s', strtotime($review->created_at)) }}</div>
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