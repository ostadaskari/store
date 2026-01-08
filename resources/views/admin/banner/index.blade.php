@extends('admin.layouts.app')

@section('style')
    <style>
        /* Style for current sortable banners */
        .banner-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: grab;
            transition: all 0.2s ease-in-out;
        }

        .banner-item:hover {
            background-color: #eef2f7;
        }

        /* Thumb for currently saved banners (smaller size) */
        .banner-item .banner-thumb {
            height: 80px;
            width: 150px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        /* Layout for new banner upload section */
        .banner-upload {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            border: 1px solid #e9ecef;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px !important;
        }

        .left-side, .right-side {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        @media (max-width: 768px) {
            .banner-upload{
                flex-direction:column;
            }
            .left-side, .right-side {
                width: 100%;
            }
        }
        .right-side {
            order: 1; /* Image/File on the right in RTL */
        }

        .left-side {
            order: 2; /* Alt text on the left in RTL */
        }

        /* Thumb for new upload preview (larger size) */
        .banner-upload .banner-thumb {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
            padding: 5px;
            margin-bottom: 15px !important; /* Spacing below the preview */
        }

        /* Modern input style */
        .form-control-modern {
            height: 48px;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #d1d9e6;
        }
    </style>
@endsection

@section('content')
    <div class="container px-0" dir="rtl">
        <div class="seven mt-3">
            <h1>مدیریت بنرهای اول سایت</h1>
        </div>

        <div class="card p-3 shadow-sm">
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="banner-inputs">
                    <div class="banner-upload mb-4 p-3 border rounded position-relative">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">تصویر بنر:</label>
                                <input type="file" name="images[]" class="form-control banner-file" accept="image/*" required>
                                <img src="#" class="banner-thumb mt-2 d-none img-thumbnail" style="max-height: 100px;">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">متن جایگزین (Alt):</label>
                                <input type="text" name="alts[]" class="form-control" placeholder="برای سئو..." required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">لینک بنر (Link):</label>
                                <input type="url" name="links[]" class="form-control" placeholder="https://example.com">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" id="addMore1" class="btn btn-outline-secondary">
                        <i class="bi bi-plus-circle"></i> افزودن بنر جدید
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cloud-arrow-up"></i> آپلود نهایی
                    </button>
                </div>
            </form>
        </div>

        <div class="seven mt-4">
            <h1>بنرهای فعلی (قابل جابجایی)</h1>
        </div>

        <div class="card p-3 shadow-sm">
            <ul id="sortable" class="list-unstyled">
                @foreach ($banners as $banner)
                    <li class="banner-item border p-3 mb-2 rounded bg-white d-flex align-items-center justify-content-between" data-id="{{ $banner->id }}">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-grip-vertical fs-4 text-muted me-2"></i>
                            <img src="{{ asset($banner->image_path) }}" class="rounded me-3" style="width: 120px; height: 60px; object-fit: cover;">
                        </div>
                        <div class="d-flex d-flex align-items-center justify-content-between modalTextColor">
                                <div class="fw-bold mx-2">Alt: <span class="text-muted fw-normal">{{ $banner->alt_text ?? '-' }}</span></div>
                                <div class="fw-bold mx-2">Link: <a href="{{ $banner->link }}" target="_blank" class="text-primary fw-normal small">{{ $banner->link ?? 'بدون لینک' }}</a></div>
                            </div>
                        <form method="POST" action="{{ route('banners.destroy', $banner->id) }}" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // افزودن ورودی جدید
            const addMoreBtn = document.getElementById('addMore1');
            addMoreBtn.addEventListener('click', function() {
                const wrapper = document.createElement('div');
                wrapper.classList.add('banner-upload', 'mb-4', 'p-3', 'border', 'rounded', 'bg-light', 'position-relative');
                wrapper.innerHTML = `
                    <button type="button" class="btn-close position-absolute top-0 start-0 m-2 remove-entry"></button>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">تصویر بنر:</label>
                            <input type="file" name="images[]" class="form-control banner-file" accept="image/*" required>
                            <img src="#" class="banner-thumb mt-2 d-none img-thumbnail" style="max-height: 100px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">متن جایگزین (Alt):</label>
                            <input type="text" name="alts[]" class="form-control" placeholder="برای سئو..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">لینک بنر (Link):</label>
                            <input type="url" name="links[]" class="form-control">
                        </div>
                    </div>
                `;
                document.getElementById('banner-inputs').appendChild(wrapper);
            });

            // حذف ورودی جدید قبل از آپلود
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-entry')) {
                    e.target.closest('.banner-upload').remove();
                }
            });

            // پیش‌نمایش تصویر
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('banner-file')) {
                    const file = e.target.files[0];
                    const preview = e.target.closest('.col-md-4').querySelector('.banner-thumb');
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            preview.src = evt.target.result;
                            preview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            // جابجایی (Sortable)
            $('#sortable').sortable({
                handle: '.bi-grip-vertical',
                update: function() {
                    let order = $(this).children().map(function() { return $(this).data('id'); }).get();
                    $.post('{{ route('banners.updateOrder') }}', { _token: '{{ csrf_token() }}', order: order });
                }
            });

            // تایید حذف
            $(document).on('click', '.delete-btn', function() {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: "این بنر برای همیشه حذف می‌شود.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله، حذف شود',
                    cancelButtonText: 'انصراف',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endsection
