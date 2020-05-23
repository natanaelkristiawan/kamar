<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <ul class="pagination p-center">

      @if( isset($pagination->links->previous))
      <li class="page-item">
        <a class="page-link" href="{{ $pagination->links->previous }}" aria-label="Previous">
        <span class="ti-arrow-left"></span>
        <span class="sr-only">Previous</span>
        </a>
      </li>
      @endif

      @for ($i = 1; $i <= $pagination->total_pages; $i++)

      @if ($pagination->current_page > 4 && $i === 2)
          <li class="page-item disabled"><a class="page-link">...</a></li>
      @endif


      @if ($i == $pagination->current_page)
          <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
      @elseif ($i === $pagination->current_page + 1 || $i === $pagination->current_page + 2 || $i === $pagination->current_page - 1 || $i === $pagination->current_page - 2 || $i === $pagination->total_pages || $i === 1)
          <li class="page-item"><a class="page-link" href="{{ route('public.rooms', array('page'=>$i)) }}">{{ $i }}</a></li>
      @endif



      @if ($pagination->current_page < $pagination->total_pages - 3 && $i === $pagination->total_pages - 1)
          <li class="page-item disabled"><a class="page-link">...</a></li>
      @endif
      @endfor

      @if(isset($pagination->links->next))
      <li class="page-item">
        <a class="page-link" href="{{ $pagination->links->next }}" aria-label="Next">
        <span class="ti-arrow-right"></span>
        <span class="sr-only">Next</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</div>