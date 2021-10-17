<?php
    $pagin = $items->appends(request()->query())->links()->paginator;
?>

<div class="pagination @if (!$pagin->hasPages()) pagination_hidden @endif">
    <a class="pagination__link pagination__link-prev" href= "@if ($pagin->currentPage() > 1) {{ $pagin->previousPageUrl() }} @else #  @endif">
        <div class="pagination__arrow arrow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
    </a>
    <div class="pagination__pages">
        <span class="pagination__current">{{ $pagin->currentPage() }}</span> / <span class="pagination__last-page">{{$pagin->lastPage()}}</span>
    </div>
    <a class="pagination__link pagination__link-next" href= "@if ($pagin->currentPage() < $pagin->lastPage()) {{ $pagin->nextPageUrl() }} @else #  @endif">
        <div class="pagination__arrow arrow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</div>
