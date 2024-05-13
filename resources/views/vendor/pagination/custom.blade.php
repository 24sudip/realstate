@if ($paginator->hasPages())
    <ul class="pagination clearfix">
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a><i class="fas fa-angle-left"></i></a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fas fa-angle-left"></i></a>
            </li>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="current active" aria-current="page">
                            <a href="{{ $url }}" class="current">{{ $page }}</a>
                        </li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fas fa-angle-right"></i></a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a><i class="fas fa-angle-right"></i></a>
            </li>
        @endif
    </ul>
@endif

{{-- <ul class="pagination clearfix">
    <li><a href="property-list.html" class="current">1</a></li>
    <li><a href="property-list.html">2</a></li>
    <li><a href="property-list.html">3</a></li>
    <li><a href="property-list.html"><i class="fas fa-angle-right"></i></a></li>
</ul> --}}
