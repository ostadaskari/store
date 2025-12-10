@extends('admin.layouts.app')

@section('content')
    <div class="container" dir="rtl">
        <div class="seven mt-3">
            <h1>{{ isset($discount) ? 'Edit Discount' : 'Create Discount' }}</h1>
        </div>
        <div class="card card-primary card-outline p-3">
            <a href="" class="btnBack m-0" title="بازگشت">
                <svg width="24" height="24" fill="currentColor" class="bi bi-arrow-right-circle icon-transition" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"></path>
                </svg>
            </a>
            <form method="POST"
                action="{{ isset($discount) && $discount->id 
                            ? route('admin.discounts.update', $discount->id) 
                            : route('admin.discounts.store') }}" class="mt-4 px-2">

                @csrf
                @if(isset($discount) && $discount->id)
                    @method('PUT')
                @endif

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">عنوان تخفیف:</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ $discount->name ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">کد تخفیف:</label>
                        <input type="text" name="code" class="form-control"
                            value="{{ $discount->code ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">نوع تخفیف:</label>
                        <select name="type" class="form-control" required>
                            <option value="percent"
                                {{ isset($discount) && $discount->type == 'percent' ? 'selected' : '' }}>
                                درصدی
                            </option>
                            <option value="amount"
                                {{ isset($discount) && $discount->type == 'amount' ? 'selected' : '' }}>
                                مبلغی
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">مقدار تخفیف:</label>
                        <input type="number" name="value" class="form-control" step="0.01"
                            value="{{ $discount->value ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">تاریخ انقضا:</label>
                        <input type="date" name="expire_at"
                            class="form-control text-start"
                            value="{{ old('expire_at', $discount->expire_at?->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">وضعیت:</label>
                        <select name="status" class="form-control">
                            <option value="1"
                                {{ isset($discount) && $discount->status ? 'selected' : '' }}>
                                فعال
                            </option>
                            <option value="0"
                                {{ isset($discount) && !$discount->status ? 'selected' : '' }}>
                                غیرفعال
                            </option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            ذخیره اطلاعات
                        </button>
                    </div>

                </div>
            </form>

        </div>
        
    </div>
@endsection

