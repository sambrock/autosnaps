@if ($paginator->hasPages())
<div class="pagination flex justify-center items-center sm:justify-between">
  <div class="text-grey font-medium hidden sm:block">
    <span>Showing {{$paginator->firstItem()}} - {{$paginator->lastItem()}} of {{$paginator->total()}}</span>
  </div>
  <nav class="flex items-center">
    <a href="{{ $paginator->previousPageUrl() }}" class="mt-1 @if ($paginator->onFirstPage()) hidden @endif" rel="prev"><i class="material-icons icon-btn">keyboard_arrow_left</i></a>
    @foreach ($elements as $element)
    @if (is_string($element))
    <span class="disabled">─</span>
    @endif
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="active">{{ $page }}</span>
    @else
    <a href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach
    <a href="{{ $paginator->nextPageUrl() }}" class="mt-1 @if (!$paginator->hasMorePages()) hidden @endif" rel="next"><i class="material-icons icon-btn">keyboard_arrow_right</i></a>
  </nav>
</div>
@endif