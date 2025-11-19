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


{{-- The styles for this page have been moved to file "products page.css",
 You will find it with the comment " style category-tree "--}}

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
