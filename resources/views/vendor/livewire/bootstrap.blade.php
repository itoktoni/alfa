<div>
    @if ($paginator->hasPages())
    <nav class="toolbox toolbox-pagination">

        <p class="show-info">Showing <span>{{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{$paginator->total()}}</span> Data</p>

        <ul class="pagination">
            {{-- Previous Page Link --}}

            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true"><i class="d-icon-arrow-left"></i> &nbsp;</span>
            </li>
            @else
            <li class="page-item pointer">
                <button type="button" dusk="previousPage" class="page-link" wire:click="previousPage"
                    wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"><i
                        class="d-icon-arrow-left"></i> &nbsp;</button>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active pointer" wire:key="paginator-page-{{ $page }}" aria-current="page"><span
                    class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item pointer" wire:key="paginator-page-{{ $page }}"><button type="button" class="page-link"
                    wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
            @endif
            @endforeach
            @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <li class="page-item pointer">
                <button type="button" dusk="nextPage" class="page-link" wire:click="nextPage"
                    wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">  &nbsp;<i class="d-icon-arrow-right"></i></button>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">  &nbsp;<i class="d-icon-arrow-right"></i></span>
            </li>
            @endif

        </ul>
    </nav>
    @endif
</div>