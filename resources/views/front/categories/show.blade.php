@extends('front.layouts.app')

@section('content')
    <div class="container " style="margin-top:180px;">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-3">
                <div class="card p-3">
                    <h5 class="mb-3">دسته‌بندی‌ها</h5>
                    @include('front.partials.sidebar_categories', [
                        'categories' => $allCategories,
                        'currentCategory' => $category
                    ])
                </div>
            </div>

            {{-- Main content --}}
            <div class="col-md-9">

                {{-- Breadcrumb --}}
                @include('front.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

                {{-- Subcategories --}}
                @if ($subcategories->count())
                    <h4 class="mb-3">زیر‌دسته‌ها</h4>
                    <div class="row mb-4">
                        @foreach ($subcategories as $sub)
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('category.show', $sub->slug) }}" class="text-decoration-none">
                                    <div class="card text-center p-3 shadow-sm">
                                        {{ $sub->name }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Products --}}
                <h4 class="mb-3">محصولات</h4>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-4 mb-4">

                            <a href="{{ route('front.product.show', [
                                'category' => $product->category->slug,
                                'product'  => $product->slug
                            ]) }}">
                                <div class="card h-100">
                                    @php
                                        $image = $product->coverImage ? $product->coverImage->url : asset('images/300x300.webp');
                                    @endphp
                                    <img src="{{ $image }}" class="card-img-top" alt="{{ $product->name }}">

                                    <div class="card-body">
                                        <h6 class="card-title">{{ $product->part_number }} :P/N</h6>
                                        <p class="card-text text-muted" dir="ltr">{{ $product->company_cmt }}</p>
                                        <p class="card-text text-muted">
                                            {{ $product->available_qty ? 'موجودی: '.$product->available_qty.' عدد' : 'ناموجود' }}
                                        </p>
                                        @php $display = $product->display_price_toman; @endphp

                                        <p class="card-text text-muted">
                                            @if($display)
                                                {{ number_format($display) }} تومان
                                            @else
                                                <span class="text-muted">قیمت ثبت نشده</span>
                                            @endif
                                        </p>                                    </div>
                                </div>
                            </a>

                        </div>
                    @empty
                        <p>محصولی در این دسته وجود ندارد.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
