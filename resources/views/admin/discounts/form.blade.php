@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($discount) ? 'Edit Discount' : 'Create Discount' }}</h2>

        <form method="POST" action="{{ isset($discount) && $discount->id ? route('admin.discounts.update', $discount->id) : route('admin.discounts.store') }}">
            @csrf
            @if(isset($discount) && $discount->id)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $discount->name ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" class="form-control" value="{{ $discount->code ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-control" required>
                    <option value="percent" {{ isset($discount) && $discount->type == 'percent' ? 'selected' : '' }}>Percent</option>
                    <option value="amount" {{ isset($discount) && $discount->type == 'amount' ? 'selected' : '' }}>Amount</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Percent / Amount</label>
                <input type="number" name="value" class="form-control" step="0.01"
                       value="{{ $discount->value ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Expire Date</label>
                <input type="date" name="expire_at" class="form-control"
                       value="{{ old('expire_at', $discount->expire_at?->format('Y-m-d') ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ isset($discount) && $discount->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ isset($discount) && !$discount->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </div>
@endsection

