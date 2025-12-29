@extends('front.layouts.app')

@section('content')

    <div class="container mt-4 topPadd">
        <div class="row">
            {{-- Breadcrumb --}}
            @include('front.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        </div>

        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-3">
                <div class="card cardCategoris">
                    <h5 class="mb-3 cardH5">دسته‌ بندی‌ ها</h5>
                    @include('front.partials.sidebar_categories', [
                        'categories' => $allCategories,
                        'currentCategory' => $category
                    ])
                </div>
            </div>

            {{-- Main content --}}
            <div class="col-md-9 px-0" style="background-color: #fff;">


                {{-- Subcategories --}}
                @if ($subcategories->count())

                    <div class="row mb-4">
                        <h5 class="cardH5">زیر‌ دسته‌ ها</h5>
                        @foreach ($subcategories as $sub)
                            <div class="col-md-3 my-2 px-1">
                                <a href="{{ route('category.show', $sub->slug) }}" class="text-decoration-none">
                                    <div class="card text-center shadow-sm p-1 subCategoryCard" style="font-size: 14px;">
                                        {{ $sub->name }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Products --}}
                <div class="row py-2">
                    @forelse ($products as $product)
                        @include('front.components.product-card', ['product' => $product])
                    @empty
                        <p>محصولی وجود ندارد.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

@endsection
