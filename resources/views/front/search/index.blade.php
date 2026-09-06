@extends('front.layouts.app')

@section('content')

    <div class="container py-5">

        {{-- =========================================================
             Search Header
        ========================================================== --}}
        <div class="mb-5">

            <h1 class="fw-bold mb-2">
                جستجو
            </h1>

            @if($q)
                <p class="text-muted mb-0">
                    نتایج جستجو برای:
                    <strong>{{ $q }}</strong>
                </p>
            @endif

        </div>


        {{-- =========================================================
             Empty Search
        ========================================================== --}}
        @if(!$q)

            <div class="text-center py-5">

                <div class="mb-3">
                    <i class="bi bi-search"
                       style="font-size: 48px; opacity: .35;"></i>
                </div>

                <h5 class="fw-bold">
                    عبارت مورد نظر خود را جستجو کنید
                </h5>

                <p class="text-muted mb-0">
                    نام دسته‌بندی، شماره فنی کالا یا عنوان اطلاعات محصول را وارد کنید.
                </p>

            </div>


        @else


            {{-- =====================================================
                 Categories
            ====================================================== --}}
            @if($categories->count())

                <section class="mb-5">

                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <h4 class="fw-bold mb-0">
                            دسته‌بندی‌ها
                        </h4>

                        <span class="text-muted small">
                            {{ $categories->count() }} نتیجه
                        </span>

                    </div>


                    <div class="row g-3">

                        @foreach($categories as $category)

                            <div class="col-12 col-md-6 col-lg-4">

                                <a
                                    href="{{ route('category.show', ['slug' => $category->slug]) }}"
                                    class="text-decoration-none"
                                >

                                    <div class="border rounded-3 p-3 h-100
                                                bg-white
                                                transition
                                                category-search-item">

                                        <div class="d-flex align-items-center gap-3">

                                            <div
                                                class="d-flex align-items-center justify-content-center
                                                       rounded-circle bg-light flex-shrink-0"
                                                style="width: 44px; height: 44px;"
                                            >
                                                <i class="bi bi-folder2-open text-success"></i>
                                            </div>


                                            <div class="min-width-0">

                                                <div class="fw-bold text-dark">
                                                    {{ $category->name }}
                                                </div>

                                                <small class="text-muted">
                                                    مشاهده دسته‌بندی
                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        @endforeach

                    </div>

                </section>

            @endif



            {{-- =====================================================
                 Products
            ====================================================== --}}
            <section>

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>

                        <h4 class="fw-bold mb-1">
                            کالاها
                        </h4>

                        @if($products->total() > 0)

                            <small class="text-muted">
                                {{ number_format($products->total()) }}
                                کالا پیدا شد
                            </small>

                        @endif

                    </div>

                </div>


                @if($products->count())

                    {{-- IMPORTANT:
                         Use the exact same product-card component
                         used on the rest of the website.
                    --}}
                    <div class="row g-0">

                        @foreach($products as $product)

                            @include('front.components.product-card', [
                                'product' => $product
                            ])

                        @endforeach

                    </div>


                    {{-- =================================================
                         Pagination
                    ================================================== --}}
                    @if($products->hasPages())

                        <div class="mt-5 d-flex justify-content-center">

                            {{ $products->links() }}

                        </div>

                    @endif


                @else

                    {{-- =================================================
                         No Products
                    ================================================== --}}
                    <div class="border rounded-4 p-5 text-center">

                        <div class="mb-3">

                            <i
                                class="bi bi-box-seam"
                                style="font-size: 52px; opacity: .35;"
                            ></i>

                        </div>


                        <h5 class="fw-bold mb-2">
                            محصولی پیدا نشد
                        </h5>


                        <p class="text-muted mb-0">

                            برای عبارت

                            <strong>
                                {{ $q }}
                            </strong>

                            محصولی پیدا نشد.

                        </p>

                    </div>

                @endif

            </section>


        @endif

    </div>

@endsection
