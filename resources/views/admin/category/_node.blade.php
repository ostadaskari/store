<li class="category-node" data-depth="{{ $depth }}">
    <div class="node-label d-flex align-items-center">
        @if ($category->childrenRecursive->count())
            <span class="toggle-icon me-2">▶</span>
        @else
            <span class="empty-icon me-2">•</span>
        @endif

        <span class="node-name">{{ $category->name }}</span>
    </div>

    @if ($category->childrenRecursive->count())
        <ul class="child-list d-none ms-3">
            @foreach ($category->childrenRecursive as $child)
                @include('admin.category._node', ['category' => $child, 'depth' => $depth + 1])
            @endforeach
        </ul>
    @endif
</li>

