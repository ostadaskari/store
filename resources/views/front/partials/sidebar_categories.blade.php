<ul class="category-tree list-unstyled ms-2">
    @foreach ($categories as $cat)
        <li class="category-node" data-id="{{ $cat->id }}">
            <div class="d-flex align-items-center">
                @if ($cat->childrenRecursive->count())
                    <span class="toggle me-1" style="cursor: pointer;">+</span>
                @else
                    <span class="me-3"></span>
                @endif

                <a href="{{ route('category.show', $cat->slug) }}"
                   class="{{ isset($currentCategory) && $cat->id === $currentCategory->id ? 'text-danger fw-bold' : '' }}">
                    {{ $cat->name }}
                </a>
            </div>

            @if ($cat->childrenRecursive->count())
                <div class="child-list ms-3 d-none">
                    @include('front.partials.sidebar_categories', [
                        'categories' => $cat->childrenRecursive,
                        'currentCategory' => $currentCategory ?? null
                    ])
                </div>
            @endif
        </li>
    @endforeach
</ul>

<style>
    .category-tree .child-list {
        border-left: 1px dashed #ccc;
        padding-left: 10px;
        margin-top: 4px;
    }
    .category-node a {
        text-decoration: none;
        color: #333;
    }
    .category-node a:hover {
        color: #0d6efd;
    }
    .text-danger.fw-bold {
        color: #dc3545 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.category-node .toggle').forEach(toggle => {
            toggle.addEventListener('click', e => {
                e.stopPropagation();
                const childList = e.target.closest('.category-node').querySelector('.child-list');
                if (childList) {
                    const isOpen = !childList.classList.contains('d-none');
                    childList.classList.toggle('d-none');
                    e.target.textContent = isOpen ? '+' : '−';
                }
            });
        });

        // Auto-open active branch
        const activeLink = document.querySelector('.category-node a.text-danger');
        if (activeLink) {
            let parent = activeLink.closest('.child-list');
            while (parent) {
                parent.classList.remove('d-none');
                const toggle = parent.previousElementSibling?.querySelector('.toggle');
                if (toggle) toggle.textContent = '−';
                parent = parent.closest('.child-list')?.parentElement?.closest('.child-list');
            }
        }
    });
</script>
