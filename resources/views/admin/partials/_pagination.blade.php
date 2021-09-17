@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12 col-md-12 d-flex justify-content-end">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="paginate_button page-item previous disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="paginate_button page-item previous">
                        <a href="{{ $paginator->previousPageUrl() }}" class="page-link">Previous</a>
                    </li>
                @endif
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="paginate_button page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="paginate_button page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li class="paginate_button page-item next">
                        <a href="{{ $paginator->nextPageUrl() }}" class="page-link">Next</a>
                    </li>
                @else
                    <li class="paginate_button page-item next disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
