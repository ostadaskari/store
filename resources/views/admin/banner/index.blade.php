@extends('admin.layouts.app')

@section('style')
    <style>
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

        .banner-thumb {
            height: 80px;
            width: 150px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .add-btn {
            margin-top: 20px;
        }

        .alt-input {
            width: 100%;
            margin-top: 8px;
        }

        .delete-btn {

            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container" dir="rtl">
        <h2>مدیریت بنرهای اول سایت</h2>

        {{-- ✅ Upload new banners --}}
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="banner-inputs">
                <div class="banner-upload mb-3">
                    <input type="file" name="images[]" class="form-control mb-2 banner-file" accept="image/*" required>
                    <input type="text" name="alts[]" class="form-control alt-input" placeholder="متن جایگزین تصویر (alt)" required>
                    <img src="#" class="banner-thumb mt-2 d-none" alt="preview">
                </div>
            </div>

            <button type="button" id="addMore1" class="btn btn-secondary add-btn">افزودن بنر جدید +</button>
            <button type="submit" class="btn btn-primary mt-3">آپلود</button>
        </form>

        <hr>

        <h4 class="mt-4">بنرهای فعلی (قابل جابجایی)</h4>
        <ul id="sortable" class="list-unstyled">
            @foreach ($banners as $banner)
                <li class="banner-item" data-id="{{ $banner->id }}">
                    <div>
                        <img src="{{ asset($banner->image_path) }}" class="banner-thumb me-3" alt="{{ $banner->alt_text }}">                        <div class="mt-1 text-muted small">Alt: {{ $banner->alt_text ?? '-' }}</div>
                    </div>
                    <form method="POST" action="{{ route('banners.destroy', $banner->id) }}" class="delete-form d-inline">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger delete-btn">حذف</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI for sortable -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ✅ Add new upload input dynamically
            const addMoreBtn = document.getElementById('addMore1');
            addMoreBtn.addEventListener('click', function() {
                const wrapper = document.createElement('div');
                wrapper.classList.add('banner-upload', 'mb-3');
                wrapper.innerHTML = `
                    <input type="file" name="images[]" class="form-control mb-2 banner-file" accept="image/*" required>
                    <input type="text" name="alts[]" class="form-control alt-input" placeholder="متن جایگزین تصویر (alt)" required>
                    <img src="#" class="banner-thumb mt-2 d-none" alt="preview">
                `;
                document.getElementById('banner-inputs').appendChild(wrapper);
            });

            // ✅ Preview selected images
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('banner-file')) {
                    const file = e.target.files[0];
                    const preview = e.target.parentElement.querySelector('.banner-thumb');
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            preview.src = evt.target.result;
                            preview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.classList.add('d-none');
                    }
                }
            });

            // ✅ Drag & drop reordering
            $('#sortable').sortable({
                update: function(event, ui) {
                    let order = $(this).children().map(function() {
                        return $(this).data('id');
                    }).get();

                    $.post('{{ route('banners.updateOrder') }}', {
                        _token: '{{ csrf_token() }}',
                        order: order
                    });
                }
            });

            // ✅ SweetAlert delete confirmation
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: "این بنر حذف خواهد شد!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'بله، حذف شود',
                    cancelButtonText: 'انصراف'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endsection
