<div>
    @if ($paginator->hasPages())
        <nav role="navigation" class="my-paginator" aria-label="Pagination Navigation">
            <span>
                {{-- Previous Page Link --}}
                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                        class="prev-page-button {{ $paginator->onFirstPage() ? 'inactive' : null }}">
                    Προηγούμενη
                </button>
            </span>
            @php
                $wasEllipses = FALSE;
            @endphp
            @for ($i =1 ; $i <=  $paginator->lastpage() ; $i++)
                @if(($i <= 2 || $i > $paginator->lastpage() - 2 || abs($i - $paginator->currentPage()) <= 1))
                    <button wire:click="setPage({{$i}})" wire:loading.attr="disabled" rel="prev"
                            class="page-button {{ $i == $paginator->currentPage() ? 'active' : null }}">
                        {{$i}}.
                    </button>
                    @php
                        $wasEllipses = FALSE;
                    @endphp
                @elseif(!$wasEllipses)
                    <span class="ellipses">...</span>
                    @php
                        $wasEllipses = TRUE;
                    @endphp
                @endif
            @endfor
            {{-- Next Page Link --}}
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                    class="next-page-button {{ $paginator->hasMorePages() ? null : 'inactive' }}">
                Επόμενη
            </button>
        </nav>
    @endif
</div>
