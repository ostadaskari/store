@extends('admin.layouts.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container">
        <h2>Products (from MegaBag)</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>P/N</th>
                <th>Category Path</th>
                <th>Available Qty</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $i => $product)
                <tr>
                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                    <td>{{ $product->part_number }}</td>
                    <td>{{ $product->category ? $product->category->full_path_slug : '-' }}</td>
                    <td>{{ $product->available_qty }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            <nav>
                {{ $products->links() }}
            </nav>
        </div>
    </div>



@endsection

@section('script')

@endsection

