@extends('front.layouts.app')

@section('content')
    <div class="container topPadd">
        <h4 class="mt-3 mb-2">❤️ علاقه‌مندی‌های من</h4>

        @if($products->isEmpty())
            <p class="text-muted">لیست علاقه‌مندی خالی است.</p>
        @else
            {{-- Reuse SAME layout as categories --}}
            <div class="row py-2">
                @foreach ($products as $product)
                    @include('front.components.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </div>
@endsection
