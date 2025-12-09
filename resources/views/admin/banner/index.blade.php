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

        <div class="card p-3">
            {{-- ✅ Upload new banners --}}
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" dir="rtl">
                @csrf
                <div id="banner-inputs">
                    {{-- Single Banner Input Block --}}
                    <div class="banner-upload mb-3">

                        {{-- ➡️ Right Side (Image Upload & Preview) --}}
                        <div class="right-side">
                            {{-- Preview Image (Above the File Input) --}}
                            <label class="form-label">تصویر بنر (Choose File):</label>
                            <img src="#" class="banner-thumb mt-2 d-none" alt="پیش‌نمایش تصویر">

                            {{-- File Input --}}
                            <input type="file" name="images[]" class="form-control form-control-modern banner-file" accept="image/*" required>
                        </div>

                        {{-- ⬅️ Left Side (Alt Text Input) --}}
                        <div class="left-side">
                            {{-- Alt Text Input --}}
                            <label class="form-label">متن جایگزین (Alt):</label>
                            <input type="text" name="alts[]" class="form-control form-control-modern alt-input" placeholder="متن جایگزین تصویر برای سئو" required>
                        </div>

                        <button type="button" class="btn btn-danger btn-sm remove-banner-btn d-none" style="position: absolute; top: 5px; left: 5px;">
                            ❌
                        </button>
                    </div>
                    {{-- End of Single Banner Input Block --}}
                </div>

                <div class="row mt-4 d-flex justify-content-end px-3">
                    {{-- Add Button (Left Aligned for RTL context) --}}
                    <div class="col-auto px-0 mx-1">
                        <button type="button" id="addMore1" class="btn btn-secondary add-btn">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                             <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                            </svg>
                            افزودن بنر جدید</button>
                    </div>

                    {{-- Submit Button (Right Aligned or standard float) --}}
                    <div class="col-auto px-0">
                        <button type="submit" class="btn btn-primary">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"/>
                                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                            </svg>
                            آپلود نهایی</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="seven mt-3">
            <h1>بنرهای فعلی (قابل جابجایی)</h1>
        </div>
        <div class="card p-3">
            <ul id="sortable" class="list-unstyled">
                @foreach ($banners as $banner)
                    <li class="banner-item" data-id="{{ $banner->id }}">
                        <div>
                            <img src="{{ asset($banner->image_path) }}" class="banner-thumb me-3" alt="{{ $banner->alt_text }}">
                            <div class="mt-1 text-muted small">Alt: {{ $banner->alt_text ?? '-' }}</div>
                        </div>
                        <form method="POST" action="{{ route('banners.destroy', $banner->id) }}" class="delete-form d-inline">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger delete-btn">حذف</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
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
