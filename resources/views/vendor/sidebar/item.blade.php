<li>
    <a class="waves-effect" href="@if($item->hasItems())javascript:void(0)@else{{ $item->getUrl() }}@endif">
        
        @if($item->getIcon() == 'fa fa-angle-double-right')
        @else
        <i class="{{ $item->getIcon() }}"></i>
        @endif
        <span> {{ $item->getName() }} @if($item->hasItems())<span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span>@endif </span>

        @foreach($badges as $badge)
            {!! $badge !!}
        @endforeach
    </a>

    @foreach($appends as $append)
        {!! $append !!}
    @endforeach

    @if(count($items) > 0)
        <ul class="submenu">
            @foreach($items as $item)
                {!! $item !!}
            @endforeach
        </ul>
    @endif
</li>