@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Pagination">
        {{-- PREV --}}
        @if ($paginator->onFirstPage())
            <span class="page-link disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">‹</span>
        @else
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">‹</a>
        @endif

        {{-- NUMRAT --}}
        @foreach ($elements as $element)
            {{-- Separator (… ) --}}
            @if (is_string($element))
                <span class="page-link">{{ $element }}</span>
            @endif

            {{-- Links e faqeve --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link active" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- NEXT --}}
        @if ($paginator->hasMorePages())
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">›</a>
        @else
            <span class="page-link disabled" aria-disabled="true" aria-label="@lang('pagination.next')">›</span>
        @endif
    </nav>
@endif
