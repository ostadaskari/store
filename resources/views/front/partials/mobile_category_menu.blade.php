<ul class="list-unstyled mb-0 ps-2">
    @foreach ($categories as $category)
        @php
            $hasChildren = $category->childrenRecursive && $category->childrenRecursive->count() > 0;
            $collapseId = 'mobile-cat-' . $category->id;
        @endphp

        <li class="py-1">
            <div class="d-flex align-items-center justify-content-between py-2 px-1 rounded-3 hover-bg-light">
                <!-- لینک اصلی دسته -->
                <a class="text-decoration-none text-dark fw-medium fs-6 flex-grow-1" href="{{ route('category.show', $category->slug) }}">
                    {{ $category->name }}
                </a>

                <!-- دکمه فلش چرخان UX/UI جدید -->
                @if ($hasChildren)
                    <button class="btn btn-sm p-1 border-0 text-secondary cat-toggle-btn collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#{{ $collapseId }}"
                            aria-expanded="false"
                            aria-controls="{{ $collapseId }}">
                        <div class="icon-box d-flex align-items-center justify-content-center rounded-circle">
                            <svg class="chevron-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9" transform="scale(0.66) translate(-2, -4)"></polyline>
                            </svg>
                        </div>
                    </button>
                @endif
            </div>

            <!-- بخش کشویی زیردسته‌ها به همراه خط راهنمای عمودی -->
            @if ($hasChildren)
                <div class="collapse ms-2 border-start border-2 border-primary-subtle ps-2 my-1" id="{{ $collapseId }}">
                    @include('front.partials.mobile_category_menu', ['categories' => $category->childrenRecursive])
                </div>
            @endif
        </li>
    @endforeach
</ul>
