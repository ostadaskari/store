@extends('admin.layouts.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container px-0">
        <div class="seven mt-3">
            <h1>Products (from MegaBag)</h1>
        </div>

          <div class="card p-3">
            <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr">
                <table class="table table-hover table-striped align-middle mb-0 text-center" dir="rtl" role="table">
                <thead class="table-blue">
                    <tr>
                        <th>#</th>
                        <th>P/N</th>
                        <th>Category Path</th>
                        <th>Available Qty</th>
                    </tr>
                    </thead>
                    <tbody style="font-size:16px;">
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
            </div>

            <div class="d-flex justify-content-center mt-4">
                <nav>
                    {{ $products->links() }}
                </nav>
            </div>
          </div> 
    </div>



@endsection

@section('script')

@endsection

