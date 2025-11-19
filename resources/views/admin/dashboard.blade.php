@extends('admin.layouts.app')
@section('style')

@endsection
@section('content')

    <div class="main" dir="rtl">
        <!--=============================
                Content Container
        =================================-->
        <div class="container px-0 py-3">
            <!--***************
                Dashboard
            ******************-->
            <div id="dashboard-section" class="content-section">
                <div class="container px-0">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-glass icon-yellow">
                                        <i class='bx bxs-calendar-check bx-lg'></i>
                                    </div>
                                    <div class="px-4">
                                        <h5 class="card-title">۱۰۲۰</h5>
                                        <p class="card-text">سفارش جدید</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-glass icon-green">
                                        <i class='bx bxs-group bx-lg'></i>
                                    </div>
                                    <div class="px-4">
                                        <h5 class="card-title">۲۸۳۴</h5>
                                        <p class="card-text">بازدیدکنندگان</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-glass icon-blue">
                                        <i class='bx bxs-dollar-circle bx-lg'></i>
                                    </div>
                                    <div class="px-4">
                                        <h5 class="card-title">۵۰.۰۰۰.۰۰۰.۰۰۰ </h5>
                                        <p class="card-text">کل فروش</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orders Table & Todos -->

                        <!-- Orders Table -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex align-items-center">
                                    <svg class="mx-2" width="18" height="18" fill="#fff" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                        <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z"/>
                                    </svg>
                                    <h5 class="mb-0">آخرین سفارشات</h5>
                                </div>

                                <div class="card-body">
                                    <table class="table table-hover align-middle border-panel">
                                        <thead>
                                        <tr>
                                            <th>شماره سفارش</th>
                                            <th>تاریخ سفارش</th>
                                            <th>وضعیت</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#PK100852</td>
                                            <td>1395/7/5</td>
                                            <td><span class="badge bg-success text-dark">ارسال شده</span></td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">جزئیات</a></td>
                                        </tr>
                                        <tr>
                                            <td>#PK357852</td>
                                            <td>1395/3/4</td>
                                            <td><span class="badge bg-warning text-dark">در حال جمع آوری</span></td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">جزئیات</a></td>
                                        </tr>
                                        <tr>
                                            <td>#PK859852</td>
                                            <td>1390/2/15</td>
                                            <td><span class="badge bg-success text-dark">ارسال شده</span></td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">جزئیات</a></td>
                                        </tr>
                                        <tr>
                                            <td>#PK1500052</td>
                                            <td>1389/7/8</td>
                                            <td><span class="badge bg-danger text-dark">کنسل شده</span></td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">جزئیات</a></td>
                                        </tr>
                                        <tr>
                                            <td>#PK148852</td>
                                            <td>1385/12/15</td>
                                            <td><span class="badge bg-info text-dark">جمع آوری شده</span></td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">جزئیات</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Todos / Reminders -->
                        <div class="col-lg-4" >
                            <div class="card shadow-sm">
                                <div class="card-header d-flex align-items-center">
                                    <svg width="20" height="20" fill="currentColor" class="bi bi-journal-check mx-2" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                    <h5 class="mb-0">یادآوری ها</h5>
                                </div>

                                <div class="card-body">
                                    <ul class="list-group bg-panel border-panel">
                                        <li class="list-group-item d-flex justify-content-between align-items-center bg-panel">
                                            <div>
                                                <strong>بررسی سفارشات جدید</strong><br>
                                                <small class="">۲۰۲۳/۰۴/۰۵</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">امروز</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center bg-panel">
                                            <div>
                                                <strong>بررسی ایمیل ها</strong><br>
                                                <small class="">۲۰۲۳/۰۴/۰۶</small>
                                            </div>
                                            <span class="badge bg-warning rounded-pill">فردا</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center bg-panel">
                                            <div>
                                                <strong>جلسه با تامین کننده</strong><br>
                                                <small class="">۲۰۲۳/۰۴/۰۸</small>
                                            </div>
                                            <span class="badge bg-danger rounded-pill">در 3 روز</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>

            <!--***************
                  managePro
            ******************-->
            <div id="store-section" class="content-section d-none">

                <!-- tabs -->
                <ul class="nav nav-tabs" id="adminTabs" role="tablist" dir="rtl">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active tabBtn" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">
                            <i class="bi bi-bag-check mx-1"></i> افزودن محصول
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tabBtn" id="editPro-tab" data-bs-toggle="tab" data-bs-target="#editPro" type="button" role="tab">
                            <i class="bi bi-box-fill mx-1"></i> ویرایش محصول
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tabBtn" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab">
                            <i class="bi bi-folder2-open mx-1"></i> دسته‌بندی‌ها
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tabBtn" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab">
                            <i class="bi bi-basket3-fill mx-1"></i>مدیریت موجودی
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tabBtn" id="discounts-tab" data-bs-toggle="tab" data-bs-target="#discounts" type="button" role="tab">
                            <i class="bi bi-ticket-perforated mx-1"></i> کدهای تخفیف
                        </button>
                    </li>
                </ul>

                <!-- محتوای تب‌ها -->
                <div class="tab-content" id="adminTabsContent">
                    <!--***** Product definition *****-->
                    <div class="tab-pane fade show active" id="products" role="tabpanel">
                        <div class="rounded-3 shadow-sm p-3 bg-product myStore-content bg-panel" id="Product-definition" dir="rtl">
                            <form id="productForm">

                                <!-- info product -->
                                <div class="seven">
                                    <h1>مشخصات محصول</h1>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <label for="productName" class="form-label ">نام محصول:</label>
                                        <input type="text" class="form-control" id="productName" placeholder="نام محصول را وارد کنید">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="productPrice" class="form-label">قیمت (ریال):</label>
                                        <input type="text" class="form-control text-start placeholder-end number-format" placeholder=" قیمت محصول را وارد کنید">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="datasheetInput" class="form-label">آپلود دیتاشیت:</label>
                                        <div class="input-group mb-3">
                                            <input type="file" id="datasheetInput" class="form-control" accept=".pdf,.doc,.docx" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="productStatus" class="form-label ">وضعیت فروش:</label>
                                        <select class="form-select px-5" id="productStatus">
                                            <option value="available">فعال</option>
                                            <option value="unavailable">غیر فعال</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="productStock" class="form-label ">موجودی در انبار:</label>
                                        <input type="number" class="form-control text-start placeholder-end" id="productStock" placeholder="موجودی در انبار را وارد کنید">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="productCategory" class="form-label">دسته اصلی:</label>
                                        <select id="productCategory" class="form-select px-5" required>
                                            <option value="" disabled selected>یک دسته انتخاب کنید</option>
                                            <option value="electronics">الکترونیک</option>
                                            <option value="mechanical">مکانیک</option>
                                            <option value="automation">اتوماسیون</option>
                                            <option value="tools">ابزار دقیق</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="productSubCategory" class="form-label">زیر دسته:</label>
                                        <select id="productSubCategory" class="form-select px-5" required>
                                            <option value="" disabled selected>ابتدا یک دسته انتخاب کنید</option>
                                        </select>
                                    </div>


                                    <div class="seven my-4">
                                        <h1>ویژگی های محصول</h1>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex flex-row" style="height: 50px;">
                                        <div class="input-group mb-3">
                                            <button class="btn btn-outline-success" type="button" id="addFeatureBtn">➕ افزودن ویژگی</button>
                                            <input type="text" id="featureInput" class="form-control" placeholder="ویژگی محصول را وارد کنید">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6" style="max-height: 150px; overflow-y: auto;">
                                        <ul class="list-group" id="featureList">
                                            <!-- Features are displayed here -->
                                        </ul>
                                    </div>

                                </div>

                                <div class="row g-4">
                                    <!-- upload multi img -->
                                    <div class="col-12 px-2">
                                        <div class="seven my-4">
                                            <h1>آپلود تصاویر محصول</h1>
                                        </div>
                                        <div class="border rounded-3 p-1 bg-light d-flex flex-row align-items-center justify-content-between" style="height: 240px;">
                                            <div class="d-flex flex-column align-items-center" style="max-height: 220px;max-width: 200px;margin-right: 20px;">
                                                <img id="previewImage" src="{{asset('design/image/peopeo.png')}}" class="img-fluid rounded mb-2" style="height: 180px;width: 100%;" alt="تصویر محصول">
                                                <input class="form-control py-1" type="file" id="productImage" accept="image/*" multiple>
                                            </div>
                                            <div id="sortablePreview" class="d-flex flex-wrap align-items-center gap-2 bg-light p-3 rounded" style="min-height: 120px;">
                                                <!-- Images are placed here as cards with Drag & Drop functionality -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-start mt-3">
                                    <button type="submit" class="btn btn-primary px-5">ثبت محصول</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--***** end Product definition *****-->

                    <!-- ******** editPro ******* -->
                    <div class="tab-pane fade" id="editPro" role="tabpanel">
                        <div class="container px-0" dir="rtl">
                            <div class="rounded-3 shadow-sm p-3 bg-product myStore-content bg-panel">
                                <div class="seven">
                                    <h1>لیست محصولات</h1>
                                </div>
                                <!-- Search Bar -->
                                <div class="d-flex justify-content-end mb-3" dir="ltr">
                                    <div class="input-group " style="max-width: 300px;">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                        <input type="text" class="form-control border-start-0 text-end" placeholder="...جستجو">
                                    </div>
                                </div>

                                <div class="table-responsive table-messages-section rounded" style="max-height: 60vh;">
                                    <table class="table table-bordered table-striped align-middle text-center mb-0">
                                        <thead class="table-blue">
                                        <tr>
                                            <th style="width:3%;">ردیف</th>
                                            <th>نام محصول</th>
                                            <th>قیمت (ریال)</th>
                                            <th>دسته‌بندی</th>
                                            <th>موجودی</th>
                                            <th style="width:10%;">وضعیت</th>
                                            <th style="width:10% ;">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="productTableBody">
                                        <tr>
                                            <td>1</td>
                                            <td>کفش ایمنی مردانه</td>
                                            <td>۲,۵۰۰,۰۰۰</td>
                                            <td>پوشاک</td>
                                            <td>15</td>
                                            <td><span class="badge bg-success">فعال</span></td>
                                            <td>
                                                <button class="btn btn-outline-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#editProductModal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm delete-btn">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>سنسور دما</td>
                                            <td>۱,۲۰۰,۰۰۰</td>
                                            <td>اتوماسیون</td>
                                            <td>8</td>
                                            <td><span class="badge bg-secondary">غیرفعال</span></td>
                                            <td>
                                                <button class="btn btn-outline-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm delete-btn">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <!-- 🟦 Modal ویرایش محصول -->
                        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true" dir="rtl">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white d-flex flex-row justify-content-between m-0 p-1">
                                        <h5 class="modal-title" id="editProductModalLabel"><i class="bi bi-pencil-square me-2"></i> ویرایش محصول</h5>
                                        <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body bg-panel">
                                        <form id="editProductForm">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="editProductName" class="form-label">نام محصول</label>
                                                    <input type="text" id="editProductName" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editProductPrice" class="form-label">قیمت (ریال)</label>
                                                    <input type="text" id="editProductPrice" class="form-control text-start number-format">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editProductCategory" class="form-label">دسته‌بندی</label>
                                                    <select id="editProductCategory" class="form-select" style="padding-right: 35px;">
                                                        <option value="electronics">الکترونیک</option>
                                                        <option value="mechanical">مکانیک</option>
                                                        <option value="automation">اتوماسیون</option>
                                                        <option value="tools">ابزار دقیق</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="editProductStock" class="form-label">موجودی</label>
                                                    <input type="number" id="editProductStock" class="form-control text-start">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="editProductStatus" class="form-label">وضعیت</label>
                                                    <select id="editProductStatus" class="form-select" style="padding-right: 35px;">
                                                        <option value="available">فعال</option>
                                                        <option value="unavailable">غیرفعال</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-end mt-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                                                <button type="submit" class="btn btn-primary px-4">
                                                    <i class="bi bi-save me-1"></i> ذخیره تغییرات
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ******** end editPro ******* -->

                    <!--***** Definition of categories and subcategories *****-->
                    <div class="tab-pane fade" id="categories" role="tabpanel">
                        <div class="container rounded-3 shadow-sm p-3  myStore-content bg-panel" id="definition-categories" dir="rtl">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="card shadow border-0 rounded-4">
                                        <div class="card-body bg-warning-subtle text-dark position-relative p-3">
                                            <div class="d-flex align-items-start mb-3">
                                                <svg class="text-warning" width="22" height="22" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                                </svg>
                                                <h5 class="card-title fw-bold mx-2">راهنمای افزودن دسته</h5>
                                            </div>
                                            <p class="mb-0 lh-lg">
                                                در این بخش می‌توانید <strong class="text-danger">حداکثر چهار دسته اصلی</strong> برای سایت تعریف کنید.
                                                برای هر دسته، امکان افزودن <strong class="text-success">تعداد نامحدودی زیر دسته</strong> وجود دارد.
                                                لطفاً در انتخاب نام دسته‌ها دقت فرمایید؛ چرا که نقش مهمی در ساختار منو و تجربه کاربری ایفا می‌کنند.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add category form-->
                                <div class="seven">
                                    <h1>افزودن دسته جدید</h1>
                                </div>
                                <div class="col-md-4 mt-0">
                                    <form id="addCategoryForm" autocomplete="off">
                                        <div class="input-group">
                                            <input type="text" id="categoryNameInput" class="form-control" placeholder="نام دسته جدید" required />
                                            <button class="btn btn-primary" type="submit">افزودن</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Add subcategory form-->
                                <div class="col-md-12">
                                    <div class="seven">
                                        <h1>افزودن زیر دسته به دسته</h1>
                                    </div>
                                    <form class="d-flex flex-row justify-content-between align-items-center" id="addSubCategoryForm" autocomplete="off">
                                        <div class="w-25">
                                            <select id="categorySelect" class="form-select px-5" required>
                                                <option value="" disabled selected>یک دسته انتخاب کنید</option>
                                            </select>
                                        </div>
                                        <div class="input-group w-50">
                                            <input type="text" id="subCategoryNameInput" class="form-control" placeholder="نام زیر دسته" required />
                                            <button class="btn btn-success" type="submit">افزودن</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="my-3" />
                            <!-- Show categories and subcategories as a slider -->
                            <div class="card p-3">
                                <h4 class="mb-3">دسته‌ها و زیر دسته‌ها</h4>
                                <div id="categoryList" class="mb-5"></div>
                            </div>
                        </div>
                    </div>
                    <!--***** end Definition of categories and subcategories *****-->

                    <!--***** inventory *****-->
                    <div class="tab-pane fade" id="inventory" role="tabpanel">
                        <div class="container px-0 py-3" dir="rtl">
                            <div class="table-responsive table-messages-section rounded" style="max-height: 80vh;">
                                <table class="table table-hover align-middle text-center">
                                    <thead class="table-blue">
                                    <tr>
                                        <th style="width: 4%;">#</th>
                                        <th style="width: 20%;">شناسه محصول</th>
                                        <th scope="col">نام محصول</th>
                                        <th style="width:200px;">موجودی</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Example Row -->
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>PRD-001</td>
                                        <td>خازن</td>
                                        <td>
                                            <div class="progress" style="height: 20px; border-radius: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%; background-color:#28a745;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                    100%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>PRD-002</td>
                                        <td>مقاومت</td>
                                        <td>
                                            <div class="progress" style="height: 20px; border-radius: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: 75%; background-color:#0d6efd;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                    75%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>PRD-003</td>
                                        <td>ترانسمیتر</td>
                                        <td>
                                            <div class="progress" style="height: 20px; border-radius: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: 50%; background-color:#fd7e14;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    50%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>PRD-004</td>
                                        <td>ترانزیستور</td>
                                        <td>
                                            <div class="progress" style="height: 20px; border-radius: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: 25%; background-color:#ffc107;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    25%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>PRD-005</td>
                                        <td>IC</td>
                                        <td>
                                            <div class="progress" style="height: 20px; border-radius: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: 15%; background-color:#dc3545;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                                                    15%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--***** end inventory *****-->


                    <!--***** for sale *****-->
                    <div class="tab-pane fade" id="discounts" role="tabpanel">
                        <div class="container rounded-3 shadow-sm p-3 bg-product myStore-content bg-panel myStore-content" id="sale-definition" dir="rtl">

                            <!-- Tabs -->
                            <ul class="nav nav-tabs" id="discountTabs">
                                <li class="nav-item ">
                                    <a class="nav-link active tabBtn p-2" data-target="#tab-discount-codes" href="#">کدهای تخفیف</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tabBtn p-2" data-target="#tab-create-discount" href="#">ایجاد کد تخفیف</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tabBtn p-2" data-target="#tab-stats" href="#"> آمار کدهای تخفیف</a>
                                </li>
                            </ul>

                            <!-- list of Discount code -->
                            <div id="tab-discount-codes" class="tab-content-section">
                                <div class="table-responsive border shadow-sm rounded bg-white" style="max-height: 48vh; width: 60%; margin: 0 auto;" dir="ltr">
                                    <table class="discount-table table table-hover table-striped align-middle m-0" aria-describedby="discounts" dir="rtl">
                                        <thead class="table-blue">
                                        <tr>
                                            <th style="width:30px;">ردیف</th>
                                            <th style="width:100px;">روز باقی‌مانده</th>
                                            <th>برای چه گروهی</th>
                                            <th style="width:100px;text-align: center;">وضعیت</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="text-center" data-days="5">۵</td>
                                            <td class="group-cell">کاربران ویژه</td>
                                            <td class="text-center">
                                            <span class="badge-active green">
                                              <svg width="16" height="16" fill="currentColor" class="bi bi-radioactive mx-1" viewBox="0 0 16 16">
                                                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
                                                <path d="M9.653 5.496A3 3 0 0 0 8 5c-.61 0-1.179.183-1.653.496L4.694 2.992A5.97 5.97 0 0 1 8 2c1.222 0 2.358.365 3.306.992zm1.342 2.324a3 3 0 0 1-.884 2.312 3 3 0 0 1-.769.552l1.342 2.683c.57-.286 1.09-.66 1.538-1.103a6 6 0 0 0 1.767-4.624zm-5.679 5.548 1.342-2.684A3 3 0 0 1 5.005 7.82l-2.994-.18a6 6 0 0 0 3.306 5.728ZM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                                              </svg>
                                              فعال</span></td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td class="days-left text-center" data-days="2">۲</td>
                                            <td class="group-cell">همه کاربران</td>
                                            <td class="text-center">
                                            <span class="badge-active gray">
                                              <svg width="16" height="16" fill="currentColor" class="bi bi-ban mx-1" viewBox="0 0 16 16">
                                                <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                                              </svg>
                                              غیر فعال
                                          </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td class="text-center" data-days="10">۱۰</td>
                                            <td class="group-cell">فروشندگان</td>
                                            <td class="text-center">
                                            <span class="badge-active green">
                                              <svg width="16" height="16" fill="currentColor" class="bi bi-radioactive mx-1" viewBox="0 0 16 16">
                                                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
                                                <path d="M9.653 5.496A3 3 0 0 0 8 5c-.61 0-1.179.183-1.653.496L4.694 2.992A5.97 5.97 0 0 1 8 2c1.222 0 2.358.365 3.306.992zm1.342 2.324a3 3 0 0 1-.884 2.312 3 3 0 0 1-.769.552l1.342 2.683c.57-.286 1.09-.66 1.538-1.103a6 6 0 0 0 1.767-4.624zm-5.679 5.548 1.342-2.684A3 3 0 0 1 5.005 7.82l-2.994-.18a6 6 0 0 0 3.306 5.728ZM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                                              </svg>
                                              فعال</span></td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td class="text-center" data-days="1">۱</td>
                                            <td class="group-cell">مشتریان جدید</td>
                                            <td class="text-center">
                                            <span class="badge-active green">
                                              <svg width="16" height="16" fill="currentColor" class="bi bi-radioactive mx-1" viewBox="0 0 16 16">
                                                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
                                                <path d="M9.653 5.496A3 3 0 0 0 8 5c-.61 0-1.179.183-1.653.496L4.694 2.992A5.97 5.97 0 0 1 8 2c1.222 0 2.358.365 3.306.992zm1.342 2.324a3 3 0 0 1-.884 2.312 3 3 0 0 1-.769.552l1.342 2.683c.57-.286 1.09-.66 1.538-1.103a6 6 0 0 0 1.767-4.624zm-5.679 5.548 1.342-2.684A3 3 0 0 1 5.005 7.82l-2.994-.18a6 6 0 0 0 3.306 5.728ZM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                                              </svg>
                                              فعال</span></td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td class="text-center" data-days="0">۰</td>
                                            <td class="group-cell">کاربران تست</td>
                                            <td class="text-center">
                                            <span class="badge-active gray">
                                              <svg width="16" height="16" fill="currentColor" class="bi bi-ban mx-1" viewBox="0 0 16 16">
                                                <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                                              </svg>
                                            غیرفعال
                                          </span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination" data-pages="15" data-current="5"></div>
                            </div>

                            <!-- create new Discount code -->
                            <div id="tab-create-discount" class="tab-content-section d-none">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <form id="discountForm">
                                            <div class="row g-3">

                                                <div class="col-md-4">
                                                    <label class="form-label">عنوان کد تخفیف:</label>
                                                    <input type="text" class="form-control" placeholder="مثلاً: تخفیف نوروز" required>
                                                </div>

                                                <div class="col-md-4" >
                                                    <label class="form-label">کد تخفیف:</label>
                                                    <div class="input-group" dir="ltr">
                                                        <input type="text" id="couponCode" class="form-control text-right" placeholder="مثلاً: NOWRUZ1404" required>
                                                        <button class="btn btn-secondary" type="button" onclick="generateCode()">تولید خودکار</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">نوع تخفیف:</label>
                                                    <select class="form-select px-5" id="discountType">
                                                        <option value="percent">درصدی</option>
                                                        <option value="fixed">مبلغ ثابت</option>
                                                        <option value="free_shipping">ارسال رایگان</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">مقدار تخفیف:</label>
                                                    <input type="text" class="form-control text-start placeholder-end number-format" placeholder="مثلاً 20 یا 50000" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">سقف تخفیف (برای درصدی):</label>
                                                    <input type="text" class="form-control text-start placeholder-end number-format" placeholder="مثلاً: 100000">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">حداقل مبلغ سفارش:</label>
                                                    <input type="text" class="form-control text-start placeholder-end number-format" placeholder="مثلاً: 200000">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">تعداد دفعات استفاده:</label>
                                                    <input type="number" class="form-control text-start placeholder-end" placeholder="مثلاً: 1 یا 5 یا نامحدود">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">تاریخ شروع:</label>
                                                    <input type="text" id="startDate" class="form-control" placeholder="مثلاً: ۱۴۰۴/۰۴/۲۱">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">تاریخ پایان:</label>
                                                    <input type="text" id="endDate" class="form-control" placeholder="مثلاً: ۱۴۰۴/۰۴/۲۵">
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">توضیحات داخلی (اختیاری):</label>
                                                    <textarea class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="col-12 mt-3 text-start">
                                                    <button type="submit" id="" class="btn btn-success">ثبت کد تخفیف</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Discount code statistics  -->
                            <div id="tab-stats" class="tab-content-section d-none">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="card shadow-sm text-center">
                                            <div class="card-body">
                                                <h6>مجموعه تخفیف ریالی</h6>
                                                <h4 class="fw-bold text-success">2,350,000 تومان</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card shadow-sm text-center">
                                            <div class="card-body">
                                                <h6>مجموعه تخفیف ریالی روزانه</h6>
                                                <h4 class="fw-bold text-primary">150,000 تومان</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card shadow-sm text-center">
                                            <div class="card-body">
                                                <h6>مجموعه تخفیف ریالی هفتگی</h6>
                                                <h4 class="fw-bold text-info">150,000 تومان</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card shadow-sm text-center">
                                            <div class="card-body">
                                                <h6>کد تخفیف فعال</h6>
                                                <h4 class="fw-bold text-success">8</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card shadow-sm text-center">
                                            <div class="card-body">
                                                <h6>کد تخفیف باطل</h6>
                                                <h4 class="fw-bold text-success">8</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <script>
                                document.querySelectorAll('#discountTabs .nav-link').forEach(tab => {
                                    tab.addEventListener('click', function(e) {
                                        e.preventDefault();

                                        document.querySelectorAll('#discountTabs .nav-link').forEach(link => link.classList.remove('active'));
                                        this.classList.add('active');

                                        const target = this.getAttribute('data-target');
                                        document.querySelectorAll('.tab-content-section').forEach(section => section.classList.add('d-none'));
                                        document.querySelector(target).classList.remove('d-none');
                                    });
                                });
                            </script>

                        </div>
                    </div>
                    <!--***** end for sale *****-->

                </div>

            </div>

            <!-- ****************
               themes-section
             ******************** -->
            <div id="themes-section" class="content-section d-none">
                <div class="admin-banner-panel container-fluid px-0">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="bannerTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active tabBtn" id="mainBanner-tab" data-bs-toggle="tab" data-bs-target="#mainBanner" type="button" role="tab">
                                <i class="bi bi-image me-2"></i> بنر اصلی
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabBtn" id="fourBanner-tab" data-bs-toggle="tab" data-bs-target="#fourBanner" type="button" role="tab">
                                <i class="bi bi-grid-3x3-gap me-2"></i> بنر چهارتایی
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabBtn" id="saleLayout-tab" data-bs-toggle="tab" data-bs-target="#saleLayout" type="button" role="tab">
                                <i class="bi bi-tags me-2"></i> چیدمان تخفیف روز
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabBtn" id="newsLayout-tab" data-bs-toggle="tab" data-bs-target="#newsLayout" type="button" role="tab">
                                <i class="bi bi-stars me-2"></i> چیدمان جدیدترین‌ها
                            </button>
                        </li>
                    </ul>


                    <div class="tab-content rounded-3 shadow-sm p-3 bg-product myStore-content bg-panel" id="bannerTabsContent">
                        <!-- ✅ Tab 1: بنر اصلی -->
                        <div class="tab-pane fade show active" id="mainBanner" role="tabpanel">
                            <form id="mainBannerForm" enctype="multipart/form-data" class="row g-4">

                                <!-- 🔹 ردیف بنرها -->
                                <div class="col-12">
                                    <div class="row g-4 justify-content-center">

                                        <!-- 🔸 بنر 1 -->
                                        <div class="col-12 col-md-6 text-center">
                                            <div class="banner-block p-3 border rounded-3 shadow-sm bg-light">
                                                <label for="bannerUpload1" class="btn btn-primary mb-2">تغییر بنر 1</label>
                                                <input type="file" id="bannerUpload1" name="banners[]" accept="image/*" class="d-none">
                                                <img id="bannerPreview1" src="{{asset('design/image/baner-3.jpg')}}" class="banner-img img-fluid rounded-3" alt="Banner 1">
                                            </div>
                                        </div>

                                        <!-- 🔸 بنر 2 -->
                                        <div class="col-12 col-md-6 text-center">
                                            <div class="banner-block p-3 border rounded-3 shadow-sm bg-light">
                                                <label for="bannerUpload2" class="btn btn-primary mb-2">تغییر بنر 2</label>
                                                <input type="file" id="bannerUpload2" name="banners[]" accept="image/*" class="d-none">
                                                <img id="bannerPreview2" src="{{asset('design/image/baner-2.jpg')}}" class="banner-img img-fluid rounded-3" alt="Banner 2">
                                            </div>
                                        </div>

                                        <!-- 🔸 بنر 3 -->
                                        <div class="col-12 col-md-6 text-center">
                                            <div class="banner-block p-3 border rounded-3 shadow-sm bg-light">
                                                <label for="bannerUpload3" class="btn btn-primary mb-2">تغییر بنر 3</label>
                                                <input type="file" id="bannerUpload3" name="banners[]" accept="image/*" class="d-none">
                                                <img id="bannerPreview3" src="{{asset('design/image/baner-1.jpg')}}" class="banner-img img-fluid rounded-3" alt="Banner 3">
                                            </div>
                                        </div>

                                        <!-- 🔸 بنر 4 -->
                                        <div class="col-12 col-md-6 text-center">
                                            <div class="banner-block p-3 border rounded-3 shadow-sm bg-light">
                                                <label for="bannerUpload4" class="btn btn-primary mb-2">تغییر بنر 4</label>
                                                <input type="file" id="bannerUpload4" name="banners[]" accept="image/*" class="d-none">
                                                <img id="bannerPreview4" src="{{asset('design/image/baner-2.jpg')}}" class="banner-img img-fluid rounded-3" alt="Banner 4">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <p class="text-center small mt-3">
                                    ابعاد استاندارد هر بنر: <strong>1248px × 275px</strong>
                                </p>

                                <div class="text-start mt-3">
                                    <button type="submit" id="saveBanner" class="btn btn-success">
                                        ذخیره تغییرات
                                    </button>
                                </div>

                            </form>


                        </div>

                        <!-- ✅ Tab 2: بنر چهارتایی -->
                        <div class="tab-pane fade" id="fourBanner" role="tabpanel" dir="ltr">

                            <!-- بنر شماره 1 -->
                            <form class="row align-items-center justify-content-around border rounded-3 p-2 shadow-sm bg-light mb-2 banner-row-form">
                                <div class="col-12 col-md-3 d-flex flex-column align-items-center mb-3 mb-md-0" style="height: 120px;">
                                    <div class="position-relative d-flex justify-content-center align-items-end baner4-img">
                                        <img id="fourBannerRowImg1" class="img-fluid w-100 mb-2" style=" object-fit: cover; border-radius:5px;" src="{{asset('design/image/blog.jpg')}}" alt="بنر 1">
                                        <div class="text-center fw-bold text-secondary banerTitle">بنر شماره 1</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div>
                                        <label for="bannerSmallUpload1" class="mt-2 changeImg">تغییر تصویر</label>
                                        <input type="file" id="bannerSmallUpload1" accept="image/*" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 d-flex align-items-start justify-content-center gap-2">
                                    <input type="url" id="fourBannerUrl1" class="form-control" placeholder="لینک بنر 1"  value="https://example.com/banner1">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>

                            <!-- بنر شماره 2 -->
                            <form class="row align-items-center justify-content-around border rounded-3 p-2 shadow-sm bg-light mb-2 banner-row-form">
                                <div class="col-12 col-md-3 d-flex flex-column align-items-center mb-3 mb-md-0" style="height: 120px;">
                                    <div class="position-relative d-flex justify-content-center align-items-end baner4-img">
                                        <img id="fourBannerRowImg2" class="img-fluid w-100 mb-2" style="max-height: 120px; object-fit: cover; border-radius:5px;" src="{{asset('design/image/building03.jpg')}}" alt="بنر 2">
                                        <div class="text-center fw-bold text-secondary banerTitle">بنر شماره 2</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div>
                                        <label for="bannerSmallUpload2" class="mt-2 changeImg">تغییر تصویر</label>
                                        <input type="file" id="bannerSmallUpload2" accept="image/*" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 d-flex align-items-start justify-content-center gap-2">
                                    <input type="url" id="fourBannerUrl2" class="form-control" placeholder="لینک بنر 2"  value="https://example.com/banner1">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>

                            <!-- بنر شماره 3 -->
                            <form class="row align-items-center justify-content-around border rounded-3 p-2 shadow-sm bg-light mb-2 banner-row-form">
                                <div class="col-12 col-md-3 d-flex flex-column align-items-center mb-3 mb-md-0" style="height: 120px;">
                                    <div class="position-relative d-flex justify-content-center align-items-end baner4-img">
                                        <img id="fourBannerRowImg3" class="img-fluid w-100 mb-2" style="max-height: 120px; object-fit: cover; border-radius:5px;" src="{{asset('design/image/building01.jpg')}}" alt="بنر 3">
                                        <div class="text-center fw-bold text-secondary banerTitle">بنر شماره 2</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div>
                                        <label for="bannerSmallUpload3" class="mt-2 changeImg">تغییر تصویر</label>
                                        <input type="file" id="bannerSmallUpload3" accept="image/*" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 d-flex align-items-start justify-content-center gap-2">
                                    <input type="url" id="fourBannerUrl3" class="form-control" placeholder="لینک بنر 3"  value="https://example.com/banner1">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>

                            <!-- بنر شماره 4 -->
                            <form class="row align-items-center justify-content-around border rounded-3 p-2 shadow-sm bg-light mb-2 banner-row-form">
                                <div class="col-12 col-md-3 d-flex flex-column align-items-center mb-3 mb-md-0" style="height: 120px;">
                                    <div class="position-relative d-flex justify-content-center align-items-end baner4-img">
                                        <img id="fourBannerRowImg4" class="img-fluid w-100 mb-2" style="max-height: 120px; object-fit: cover; border-radius:5px;" src="{{asset('design/image/building03.jpg')}}" alt="بنر 4">
                                        <span class="text-center fw-bold text-secondary banerTitle">بنر شماره 4</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div>
                                        <label for="bannerSmallUpload4" class="mt-2 changeImg">تغییر تصویر</label>
                                        <input type="file" id="bannerSmallUpload4" accept="image/*" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 d-flex align-items-start justify-content-center gap-2">
                                    <input type="url" id="fourBannerUrl4" class="form-control" placeholder="لینک بنر 1"  value="https://example.com/banner1">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>

                        </div>

                        <!-- ✅ Tab 3: چیدمان اسلایدر -->
                        <!-- Tab 3: saleLayout -->
                        <div class="tab-pane fade" id="saleLayout" role="tabpanel">
                            <div class="container py-2 px-0">
                                <div class="row g-3">

                                    <!-- 🔹 جایگاه 1 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="1">
                                        <div class="slot-number">1</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 2 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="2">
                                        <div class="slot-number">2</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 3 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="3">
                                        <div class="slot-number">3</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 4 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="4">
                                        <div class="slot-number">4</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 5 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="5">
                                        <div class="slot-number">5</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 6 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="6">
                                        <div class="slot-number">6</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 7 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="7">
                                        <div class="slot-number">7</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 8 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="8">
                                        <div class="slot-number">8</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 9 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="9">
                                        <div class="slot-number">9</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 10 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="10">
                                        <div class="slot-number">10</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 11 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="11">
                                        <div class="slot-number">11</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                    <!-- 🔹 جایگاه 12 -->
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="12">
                                        <div class="slot-number">12</div>

                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true"></img>
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- ✅ Tab 4: چیدمان اسلایدر -->
                        <!-- Tab 4: newsLayout -->
                        <div class="tab-pane fade" id="newsLayout" role="tabpanel">
                            <div class="container py-2 px-0">
                                <div class="row g-3">

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="1">
                                        <div class="slot-number">1</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="2">
                                        <div class="slot-number">2</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="3">
                                        <div class="slot-number">3</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="4">
                                        <div class="slot-number">4</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="5">
                                        <div class="slot-number">5</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="6">
                                        <div class="slot-number">6</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="7">
                                        <div class="slot-number">7</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="8">
                                        <div class="slot-number">8</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="9">
                                        <div class="slot-number">9</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="10">
                                        <div class="slot-number">10</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="11">
                                        <div class="slot-number">11</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/avatar.jpg')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="#12e0w78">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 px-1 mt-2" data-position="12">
                                        <div class="slot-number">12</div>
                                        <div class="border p-2 slot" style="min-height: 150px;">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <img src="{{asset('design/image/PM-AD40.png')}}" class="product-img" draggable="true" />
                                            </div>
                                            <input type="text" class="form-control text-center product-code" placeholder="کد محصول">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!--***************
                Analytics
            *******************-->
            <div id="analytics-section" class="content-section d-none">
                <div class="container">
                    <div class="row g-4 mb-4">
                        <!-- Weekly Sales -->
                        <div class="col-md-6 col-lg-4 p-0 position-relative">
                            <div class="card shadow border-0 main-card" style="cursor: pointer;" data-target="salesDetails">
                                <div class="card-body d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle p-3">
                                        <i class="bx bxs-bar-chart-alt-2 bx-sm"></i>
                                    </div>
                                    <div class="w-100 mx-2">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <h5 class="card-title">فروش</h5>
                                            <h2 class="text-primary">۲٬۵۰۰</h2>
                                        </div>
                                        <small class="text-danger">کاهش ۱۵٪ نسبت به ماه قبل</small>
                                    </div>
                                </div>
                            </div>
                            <div class="arrowCard">
                                <svg width="22" height="22" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Total Users -->
                        <div class="col-md-6 col-lg-4 position-relative">
                            <div class="card shadow border-0 main-card" style="cursor: pointer;" data-target="usersDetails">
                                <div class="card-body d-flex align-items-center">
                                    <div class="bg-success text-white rounded-circle p-3">
                                        <i class="bx bxs-user-account bx-sm"></i>
                                    </div>
                                    <div class="w-100 mx-2">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <h5 class="card-titlebg-panel">کل کاربران</h5>
                                            <h2 class="text-success">۸٬۴۳۰</h2>
                                        </div>
                                        <small class="text-success">افزایش ۹٪ نسبت به ماه قبل</small>
                                    </div>
                                </div>
                            </div>
                            <div class="arrowCard">
                                <svg width="22" height="22" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Total Visits -->
                        <div class="col-md-6 col-lg-4 position-relative">
                            <div class="card shadow border-0 main-card" style="cursor: pointer;" data-target="visitsDetails">
                                <div class="card-body d-flex align-items-center">
                                    <div class="bg-warning text-white rounded-circle p-3">
                                        <i class="bx bx-show-alt bx-sm"></i>
                                    </div>
                                    <div class="w-100 mx-2">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <h5 class="card-title bg-panel">تعداد بازدیدها</h5>
                                            <h2 class="text-warning">۱۲٬۳۰۰</h2>
                                        </div>
                                        <small class="text-success">افزایش ۱۸٪ نسبت به ماه قبل</small>
                                    </div>
                                </div>
                            </div>
                            <div class="arrowCard">
                                <svg width="22" height="22" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- subDetails content -->
                        <div id="subDetails" class="mt-3">
                            <div id="salesDetails" class="details-content">
                                <!-- Sales details -->
                                <div class="row g-3">
                                    <!-- Daily sales -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-primary border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class="bg-panel">فروش روزانه</h6>
                                                <h5 class="text-primary">۲۵۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Weekly sales -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-primary border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">فروش هفتگی</h6>
                                                <h5 class="text-success">۱٬۷۰۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Monthly sales -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-primary border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">فروش ماهانه</h6>
                                                <h5 class="text-warning">۲٬۵۰۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="usersDetails" class="details-content">
                                <!-- User details -->
                                <div class="row g-3">
                                    <!-- Daily users -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-success border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">کاربران روزانه</h6>
                                                <h5 class="text-success">۳۰۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Weekly users -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-success border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">کاربران هفتگی</h6>
                                                <h5 class="text-info">۲٬۱۰۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Monthly users -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-success border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">کاربران ماهانه</h6>
                                                <h5 class="text-primary">۸٬۴۳۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="visitsDetails" class="details-content">
                                <!-- Details of visits -->
                                <div class="row g-3">
                                    <!-- Daily visit -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-warning border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">بازدید روزانه</h6>
                                                <h5 class="text-warning">۴۵۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Weekly visit -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-warning border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">بازدید هفتگی</h6>
                                                <h5 class="text-warning">۳٬۱۵۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Monthly visit -->
                                    <div class="col-12 col-md-4">
                                        <div class="card border-start border-warning border-4 shadow-sm">
                                            <div class="card-body text-center">
                                                <h6 class=" bg-panel">بازدید ماهانه</h6>
                                                <h5 class="text-warning">۱۲٬۳۰۰</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Monthly Sales Chart -->
                        <div class="card shadow border-0 d-none d-md-block mt-1">
                            <div class="card-header border-bottom d-flex align-items-center px-0">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-graph-down mx-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 11.887a.5.5 0 0 0 .07-.704l-4.5-5.5a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61 4.15 5.073a.5.5 0 0 0 .704.07"/>
                                </svg>
                                <h5 class="mb-0 bg-panel">نمودار فروش ماهانه</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlySalesChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--***************
                  messages
            *******************-->
            <div id="messages-section" class="content-section d-none">
                <div class="table-responsive table-messages-section rounded" style="max-height: 80vh;" dir="ltr">
                    <table class="table table-bordered table-striped align-middle" dir="rtl">
                        <thead class="table-blue">
                        <tr>
                            <th style="width: 30px;">شماره</th>
                            <th>نام کاربر</th>
                            <th>تاریخ ارسال پیام</th>
                            <th style="width:100px; text-align: center;">مشاهده پیام</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Sample row-->
                        <tr>
                            <td class="text-center">1</td>
                            <td>زهرا محمدی</td>
                            <td>1404/03/01</td>
                            <td class="text-center">
                                <button class="btn btn-sm view-message-btn" data-bs-toggle="modal" data-bs-target="#messageModal" data-message="متن کامل پیام اینجاست">
                                    <svg width="18" height="18" fill="#fff" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>زهرا محمدی</td>
                            <td>1404/03/01</td>
                            <td class="text-center">
                                <button class="btn btn-sm view-message-btn" data-bs-toggle="modal" data-bs-target="#messageModal" data-message="متن کامل پیام اینجاست">
                                    <svg width="18" height="18" fill="#fff" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>زهرا محمدی</td>
                            <td>1404/03/01</td>
                            <td class="text-center">
                                <button class="btn btn-sm view-message-btn" data-bs-toggle="modal" data-bs-target="#messageModal" data-message="متن کامل پیام اینجاست">
                                    <svg width="18" height="18" fill="#fff" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="pagination" data-pages="15" data-current="1"></div>


                <!-- Modal To display the full message-->
                <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen" style="max-width: 800px;margin: auto;">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title" id="messageModalLabel">عنوان پیام</h5>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                            </div>
                            <div class="modal-body" id="fullMessageContent">
                                <!-- The message text is displayed here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--*******************
               Product Information
            ***********************-->
            <div id="ProductInformation-section" class="content-section d-none">
                <!-- Purchase information entry form -->
                <div class="mb-4 p-3 bg-panel">
                    <div class="seven mt-3">
                        <h1>افزودن خرید جدید</h1>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label for="productNameInfo" class="form-label">نام کالا:</label>
                            <input type="text" class="form-control" id="productNameInfo" placeholder="مثلاً ترانسمیتر">
                        </div>
                        <div class="col-md-4">
                            <label for="purchaseDate" class="form-label">تاریخ خرید:</label>
                            <input type="text" class="form-control text-start placeholder-end" id="purchaseDate" placeholder="مثلاً 1404/03/10">
                        </div>
                        <div class="col-md-4">
                            <label for="purchaseCount" class="form-label">تعداد خرید:</label>
                            <input type="number" class="form-control text-start placeholder-end" id="purchaseCount" placeholder="تعداد">
                        </div>
                        <div class="col-md-4">
                            <label for="purchasePrice" class="form-label">قیمت خرید (ریال):</label>
                            <input type="text" class="form-control text-start placeholder-end number-format" id="purchasePrice" placeholder="مثلاً ۵۸۰۰۰۰۰۰">
                        </div>
                        <div class="col-md-4">
                            <label for="shopName" class="form-label">نام فروشگاه:</label>
                            <input type="text" class="form-control" id="shopName" placeholder="مثلاً دیجی‌کالا">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="purchaseLink" class="form-label">لینک خرید:</label>
                            <input type="text" class="form-control text-start placeholder-end" id="purchaseLink" placeholder="مثلاً https://example.com">
                        </div>
                        <div class="col-md-12 mt-2 text-start placeholder-end">
                            <button class="btn btn-primary" id="addPurchaseBtn">ثبت</button>
                        </div>
                    </div>
                </div>
                <!--Shopping display accordion -->
                <div class="bg-panel p-3 bg-panel" style="max-height: 60vh;">
                    <div class="seven mt-3">
                        <h1>لیست همه خریدها</h1>
                    </div>
                    <div class="accordion" id="purchaseList" dir="ltr">
                        <!-- Sample shopping card 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="">1404/02/10 - ترانسمیتر آنالوگ</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#purchaseList">
                                <div class="accordion-body text-end">
                                    <p><strong>تاریخ خرید:</strong> 1404/02/10</p>
                                    <p><strong>تعداد خرید:</strong> ۲ عدد</p>
                                    <p><strong>قیمت خرید:</strong> ۵۸٬۰۰۰٬۰۰۰ ریال</p>
                                    <p><strong>لینک خرید:</strong> <a href="https://example.com/product" target="_blank">https://example.com/product</a></p>
                                    <p><strong>نام فروشگاه:</strong> دیجی‌کالا</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sample shopping card 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="">1404/01/28 - ترانسمیتر</span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#purchaseList">
                                <div class="accordion-body text-end">
                                    <p><strong>تاریخ خرید:</strong> 1404/01/28</p>
                                    <p><strong>تعداد خرید:</strong> ۱ عدد</p>
                                    <p><strong>قیمت خرید:</strong> ۱۲۰٬۰۰۰٬۰۰۰ ریال</p>
                                    <p><strong>لینک خرید:</strong> <a href="https://example.com/product" target="_blank">https://example.com/product</a></p>
                                    <p><strong>نام فروشگاه:</strong> تکنولایف</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--*******************
               ManageSms section
            ***********************-->
            <div id="ManageSms-section" class="content-section d-none">
                <div class="mb-4">
                    <div class="row g-2">
                        <div class="container pt-2 px-0">
                            <div class="row g-2">
                                <div class="col-12 custom-tabs">
                                    <!-- Nav Tabs -->
                                    <ul class="nav nav-tabs" id="smsTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link tabBtn active" id="send-tab" data-bs-toggle="tab" data-bs-target="#send" type="button" role="tab">
                                                <i class="bi bi-send me-2"></i> ارسال SMS
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link tabBtn" id="inbox-tab" data-bs-toggle="tab" data-bs-target="#inbox" type="button" role="tab">
                                                <i class="bi bi-inbox me-2"></i> SMS‌های دریافتی
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link tabBtn" id="group-tab" data-bs-toggle="tab" data-bs-target="#group" type="button" role="tab">
                                                <i class="bi bi-people me-2"></i> گروه‌ها
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content rounded-3 shadow-sm p-3 bg-product myStore-content bg-panel" id="smsTabsContent" style="max-height: 75vh;">
                                        <!-- send -->
                                        <div class="container tab-pane fade show active" id="send" role="tabpanel">

                                            <form class="row sms-form d-flex justify-content-between align-items-center">
                                                <div class="col-12 col-md-2">
                                                    <h5 class="p-2 rounded mb-0">
                                                        <svg width="24" height="24" fill="currentColor" class="bi bi-envelope-arrow-up" viewBox="0 0 16 16">
                                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4.5a.5.5 0 0 1-1 0V5.383l-7 4.2-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h5.5a.5.5 0 0 1 0 1H2a2 2 0 0 1-2-1.99zm1 7.105 4.708-2.897L1 5.383zM1 4v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1"/>
                                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.354 1.25 1.25a.5.5 0 0 1-.708.708L13 12.207V14a.5.5 0 0 1-1 0v-1.717l-.28.305a.5.5 0 0 1-.737-.676l1.149-1.25a.5.5 0 0 1 .722-.016"/>
                                                        </svg>
                                                        نوع ارسال:</h5>
                                                </div>
                                                <!-- sendType -->
                                                <div class="col-12 col-md-3">
                                                    <div class="d-flex flex-row align-items-center justify-content-between mt-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="sendType" id="sendTypeSingle" value="single" checked>
                                                            <label class="form-check-label" for="sendTypeSingle">
                                                                ارسال تکی
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="sendType" id="sendTypeGroup" value="group">
                                                            <label class="form-check-label" for="sendTypeGroup">
                                                                ارسال گروهی
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- groupSelectBox -->
                                                <div class="col-12 col-md-5 d-none d-flex flex-row align-items-center justify-content-between" id="groupSelectBox">
                                                    <label for="smsGroup" class="form-label fw-semibold mb-0" style="width: 150px;">ارسال به گروه:</label>
                                                    <select class="form-select shadow-sm" id="smsGroup">
                                                        <option selected disabled>انتخاب گروه دریافت‌ کننده...</option>
                                                        <option value="all">همه‌ی مشتری‌ها</option>
                                                        <option value="vip">مشتری‌های ویژه</option>
                                                        <option value="gold">مشتری‌های طلایی</option>
                                                        <option value="silver">مشتری‌های نقره‌ای</option>
                                                    </select>
                                                </div>
                                                <!-- singleNumberBox -->
                                                <div class="col-12 col-md-5 d-flex flex-row align-items-center justify-content-between"  id="singleNumberBox">
                                                    <label for="singleNumber" class="form-label mb-0" style="width: 150px;">ارسال به:</label>
                                                    <input type="tel" class="form-control shadow-sm input-ltr" id="singleNumber" pattern="09\d{9}" maxlength="11" title="شماره موبایل باید با 09 شروع شده و 11 رقم باشد"  oninput="this.value = this.value.replace(/[^0-9]/g, '')"   placeholder="مثلاً: 09123456789">
                                                </div>

                                                <!-- Textarea for Message -->
                                                <div class="col-12 my-3">
                                                    <div class="d-flex align-items-center tabBtn  p-2 rounded w-20">
                                                        <svg width="24" height="24" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                                        </svg>
                                                        <label for="smsMessage" class="form-label mb-0 mx-1">متن پیام:</label>
                                                    </div>
                                                    <div class="mb-3 position-relative">
                                                        <textarea class="form-control shadow-sm mt-3" id="smsMessage" rows="6" placeholder="پیام خود را اینجا بنویسید..." maxlength="210"></textarea>
                                                        <div class="d-flex justify-content-between mt-1">
                                                            <div>
                                                                <small class="d-none" id="byteCounter">1KB</small>
                                                            </div>
                                                            <small id="charCount">0 / 70  _  پیام: 0 / 3</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- send btn -->
                                                <div class="text-start">
                                                    <button type="submit" id="sendBtn" class="btn btn-primary fw-bold px-4 py-2 shadow-sm ">ارسال پیام</button>
                                                </div>
                                            </form>
                                            <div id="output"></div>
                                            <script>
                                                document.querySelectorAll('input[name="sendType"]').forEach((radio) => {
                                                    radio.addEventListener('change', function () {
                                                        const singleBox = document.getElementById('singleNumberBox');
                                                        const groupBox = document.getElementById('groupSelectBox');

                                                        if (this.value === 'single') {
                                                            singleBox.classList.remove('d-none');
                                                            groupBox.classList.add('d-none');
                                                        } else if (this.value === 'group') {
                                                            groupBox.classList.remove('d-none');
                                                            singleBox.classList.add('d-none');
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <!-- sms list -->
                                        <div class="tab-pane fade" id="inbox" role="tabpanel">
                                            <div class="container px-0">
                                                <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr">
                                                    <table class="table table-hover table-striped align-middle mb-0" dir="rtl">
                                                        <thead class="table-blue">
                                                        <tr>
                                                            <th style="min-width: 30px;">#</th>
                                                            <th style="min-width: 80px;">شماره موبایل</th>
                                                            <th style="min-width: 400px;">متن پیام</th>
                                                            <th style="min-width: 100px;" class="text-center">اقدامات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>09123456789</td>
                                                            <td>سلام وقت بخیر. درباره سفارش سوال داشتم.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>09391234567</td>
                                                            <td>لطفاً اطلاعات بیشتر ارسال کنید.</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-reply"></i> پاسخ
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-plus-circle-dotted"></i> اضاف به گروه
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="pagination" data-pages="13" data-current="2"></div>

                                            </div>

                                        </div>
                                        <!-- create group -->
                                        <div class="tab-pane fade" id="group" role="tabpanel">
                                            <!--  group list -->
                                            <div id="groupListSection">
                                                <!-- add group-->

                                                <div class="border rounded p-3 shadow-sm mb-4">
                                                    <form id="groupForm" class="d-flex flex-row align-items-center justify-content-between gap-2">

                                                        <div class="col-10 d-flex align-items-center">
                                                            <h5 class="w-20 mb-0">
                                                                <svg width="24" height="24" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
                                                                    <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3m2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1"/>
                                                                </svg>
                                                                ایجاد گروه جدید</h5>
                                                            <input type="text" class="form-control w-50" id="groupName" placeholder="نام گروه را وارد کنید..." required>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="submit" class="btn btn-primary">
                                                                <svg width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                                                </svg>
                                                                افزودن</button>
                                                        </div>

                                                    </form>
                                                </div>

                                                <div class="border-0 shadow-sm">
                                                    <h5 class="mb-3 icon-blue  p-2 rounded w-20">
                                                        <svg width="24" height="24" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
                                                            <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
                                                            <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
                                                        </svg>
                                                        لیست گروه‌ها</h5>
                                                    <div class="table-responsive border shadow-sm rounded bg-white" style="max-height: 56vh; overflow-y: auto;" dir="ltr">
                                                        <table class="table table-hover table-striped align-middle m-0" dir="rtl">
                                                            <thead class="table-blue sticky-top">
                                                            <tr>
                                                                <th style="min-width: 30px;">#</th>
                                                                <th style="min-width: 400px;">نام گروه</th>
                                                                <th style="min-width: 40px;text-align: center;">تعداد زیرمجموعه</th>
                                                                <th style="min-width: 30px;text-align: center;">اقدامات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="groupList">
                                                            <tr>
                                                                <td>1</td>
                                                                <td>مشتریان ویژه</td>
                                                                <td class="text-center">۱۲</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-sm btn-outline-primary edit-btn" data-id="1">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        ویرایش</button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>همکاران تجاری</td>
                                                                <td class="text-center">۷</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-sm btn-outline-primary edit-btn" data-id="2">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        ویرایش</button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>مشتریان جدید</td>
                                                                <td class="text-center">۲۴</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-sm btn-outline-primary edit-btn" data-id="3">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        ویرایش</button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="pagination" data-pages="15" data-current="3"></div>
                                                </div>
                                            </div>

                                            <!-- group Members Section -->
                                            <div id="groupMembersSection" class="d-none">
                                                <h5 class="mb-3 icon-blue p-2 rounded w-50">مدیریت اعضای گروه <span id="currentGroupName" class="text-primary fw-bold"></span></h5>
                                                <div class="border rounded p-3 shadow-sm mb-4">
                                                    <!-- add member Form-->
                                                    <form id="memberForm" class="row g-2 align-items-end">
                                                        <div class="col-md-3">
                                                            <label for="memberName" class="form-label">نام و نام خانوادگی:</label>
                                                            <input type="text" class="form-control" id="memberName" placeholder="مثلاً علی اکبر دهخدا">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="memberPhone" class="form-label">شماره موبایل:</label>
                                                            <input type="text" class="form-control input-ltr" id="memberPhone" pattern="09\d{9}" maxlength="11" title="شماره موبایل باید با 09 شروع شده و 11 رقم باشد"  oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="09xxxxxxxxx">
                                                        </div>
                                                        <div class="col-md-2 me-auto">
                                                            <button type="submit" class="btn btn-success w-100">
                                                                <svg width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                                                </svg>
                                                                افزودن عضو
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- member list -->
                                                <div class="border-0 shadow-sm">
                                                    <h6 class="mb-3 icon-blue  p-2 rounded w-20">اعضای گروه</h6>
                                                    <div class="table-responsive border shadow-sm rounded bg-white" style="max-height: 42vh; overflow-y: auto;" dir="ltr">
                                                        <table class="table table-hover table-striped align-middle m-0" dir="rtl">
                                                            <thead class="table-blue sticky-top">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>نام</th>
                                                                <th>شماره موبایل</th>
                                                                <th style="width:180px; text-align: center;">اقدامات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="memberList">
                                                            <tr>
                                                                <td>1</td>
                                                                <td>خواجه حافظ شیرازی</td>
                                                                <td>09125896548</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        ویرایش</button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="pagination" data-pages="13" data-current="4"></div>
                                                <!-- modal for edit in member list  -->
                                                <!-- Edit Member Modal -->
                                                <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="top: -100px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-panel">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="editMemberForm">
                                                                    <div class="d-flex flex-row justify-content-between">
                                                                        <div class="mb-3">
                                                                            <label for="editMemberName" class="form-label">نام</label>
                                                                            <input type="text" class="form-control" id="editMemberName" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="editMemberPhone" class="form-label">شماره موبایل</label>
                                                                            <input type="text" class="form-control input-ltr" id="editMemberPhone"
                                                                                   pattern="09\d{9}" maxlength="11" title="شماره موبایل باید با 09 شروع شده و 11 رقم باشد"  oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">انصراف</button>
                                                                        <button type="submit" class="btn btn-primary mx-1">ذخیره</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- back to group-->
                                                <div class="text-end mt-3">
                                                    <button id="backToGroups" class="btn btn-outline-secondary">بازگشت به گروه‌ها</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--*******************
                setting-section
            ***********************-->
            <div id="setting-section" class="content-section d-none">
                <div class="admin-banner-panel container-fluid px-0">

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="settingTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active tabBtn" id="megaMenuSec-tab" data-bs-toggle="tab" data-bs-target="#megaMenuSec" type="button" role="tab">مدیریت مگامنو</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabBtn" id="fourBanner-tab" data-bs-toggle="tab" data-bs-target="#fourBanner" type="button" role="tab">...</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabBtn" id="saleLayout-tab" data-bs-toggle="tab" data-bs-target="#saleLayout" type="button" role="tab">...</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabBtn" id="newsLayout-tab" data-bs-toggle="tab" data-bs-target="#newsLayout" type="button" role="tab">...</button>
                        </li>
                    </ul>

                    <div class="tab-content rounded-3 shadow-sm p-3 bg-product myStore-content bg-panel" id="settingTabsContent">
                        <!-- megaMenuSec -->
                        <div class="tab-pane fade show active" id="megaMenuSec" role="tabpanel">
                            <div class="container px-0">
                                <!-- Add Main Menu -->
                                <div class="card mb-4">
                                    <div class="card-body p-0">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" id="mainMenuName" class="form-control" placeholder="عنوان منو (مثلاً قطعات)" />
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="mainMenuIcon" class="form-control" placeholder="آدرس آیکن (اختیاری)" />
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-success w-100" id="addMainMenuBtn">افزودن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu List -->
                                <div id="menuList"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!--*******************
                profile-setting
            ***********************-->
            <div id="Profile-setting" class="content-section d-none">
                <div class="container px-0">
                    <form class="profile-settings-form bg-panel position-relative" id="profile-settings-form">
                        <h5 class="text-center mb-4">تنظیمات پروفایل</h5>

                        <!-- Progress Bar -->
                        <div class="progress">
                            <div class="progress-bar" id="settings-progress" role="progressbar"></div>
                        </div>

                        <!-- Step 1 -->
                        <div class="step active">
                            <div class="d-flex flex-row">
                                <div class="w-75 px-2 d-flex flex-row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label class="form-label">نام:</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="نام">
                                        </div>
                                        <div>
                                            <label class="form-label">شماره موبایل:</label>
                                            <input type="tel" class="form-control" name="mobile" placeholder="0912xxxxxxx">
                                        </div>
                                    </div>

                                    <div class="mx-3">
                                        <div class="mb-3">
                                            <label class="form-label">نام خانوادگی:</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="نام خانوادگی">
                                        </div>
                                        <div>
                                            <label class="form-label">ایمیل:</label>
                                            <input type="email" class="form-control text-start" name="email" placeholder="example@email.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="w-25 px-2 d-flex flex-column align-items-center">
                                    <div class="text-start">
                                        <img id="settings-profile-preview" src="{{asset('design/image/avatar-man.jpg')}}" class="profile-img-preview" alt="Profile">
                                    </div>
                                    <div>
                                        <input type="file" class="form-control mt-2" id="settings-profile-image" name="profile_image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Password -->
                        <div class="step" id="step-password">
                            <div class="row g-3 align-items-start">

                                <!-- Current Password -->
                                <div class="col-12 col-md-4 position-relative">
                                    <label class="form-label fw-bold">رمز فعلی</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control position-relative"  id="current-password" name="current_password" autocomplete="off" placeholder="رمز فعلی">
                                        <!-- Eye Open -->
                                        <svg width="18" height="18" fill="currentColor" class="bi bi-eye toggle-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>

                                        <!-- Eye Slash -->
                                        <svg width="18" height="18" fill="currentColor" class="bi bi-eye-slash d-none toggle-eye" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- New Password -->
                                <div class="col-12 col-md-4 position-relative">
                                    <label class="form-label fw-bold">رمز جدید</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control position-relative"  id="new-password" name="new_password" autocomplete="off" placeholder="رمز جدید">
                                        <!-- Eye Open -->
                                        <svg width="18" height="18" fill="currentColor" class="bi bi-eye toggle-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>

                                        <!-- Eye Slash -->
                                        <svg width="18" height="18" fill="currentColor" class="bi bi-eye-slash d-none toggle-eye" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                                        </svg>
                                    </div>
                                    <div class="password-rules mt-1 small">
                                        <div id="rule-length" class="text-danger">• حداقل 8 کاراکتر</div>
                                        <div id="rule-lower" class="text-danger">•  حرف کوچک</div>
                                        <div id="rule-upper" class="text-danger">•  حرف بزرگ</div>
                                        <div id="rule-number" class="text-danger">•  عدد</div>
                                        <div id="rule-special" class="text-danger">•  کاراکتر خاص</div>
                                    </div>
                                </div>

                                <!-- Repeat Password -->
                                <div class="col-12 col-md-4 position-relative">
                                    <label class="form-label fw-bold">تکرار رمز جدید</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="repeat-password" name="repeat_password" autocomplete="off" placeholder="تکرار رمز جدید">
                                        <!-- Eye Open -->
                                        <svg width="18" height="18" fill="currentColor" class="bi bi-eye toggle-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>

                                        <!-- Eye Slash -->
                                        <svg width="18" height="18" fill="currentColor" class="bi bi-eye-slash d-none toggle-eye" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                                        </svg>
                                    </div>
                                    <div class="small mt-1 text-danger" id="rule-match">• رمزها باید یکسان باشند</div>
                                </div>

                            </div>
                        </div>


                        <!-- Step 3: Notifications -->
                        <div class="step">
                            <div class="form-card">
                                <h3 class="purple-text text-center">موفقیت‌آمیز!</h3> <br>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="step-buttons text-center">
                            <div class="d-flex justify-content-between" style="position: absolute; bottom: 10px;">
                                <button type="button" class="btn btn-secondary" id="settings-prev-btn">برگشت</button>
                                <button type="button" class="btn btn-primary mx-2" id="settings-next-btn">بعدی</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--*******************
                 editor-Section
            ***********************-->
            <div id="editorSection" class="content-section d-none" style="height: 80vh;">
                <form id="articleForm">
                    <input type="text" class="form-control mb-3 w-50" name="title" placeholder="عنوان مقاله">
                    <div id="editor"></div>
                    <div class="text-start mt-3">
                        <button type="submit" class="btn btn-primary fw-bold px-4 py-2 shadow-sm ">ذخیره</button>
                    </div>
                </form>
            </div>

            <!--*******************
                   manageOrder
            ***********************-->
            <div id="manageOrder" class="content-section d-none">
                <div class="container OrderَََArchive" dir="ltr">
                    <div class="row" dir="rtl">
                        <!-- filter-sidebar -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 pe-0">
                            <!-- Mobile version: Accordion -->
                            <div class="d-md-none">
                                <div class="accordion" id="mobileFilterAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="filterHeader-mobile">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse-mobile">
                                                فیلتر سفارش‌ها
                                            </button>
                                        </h2>
                                        <div id="filterCollapse-mobile" class="accordion-collapse collapse" data-bs-parent="#mobileFilterAccordion">
                                            <div class="accordion-body">

                                                <!-- Filter content for mobile -->
                                                <div class="filter-box mb-3">
                                                    <label for="provinceSelect-mobile">استان:</label>
                                                    <select id="provinceSelect-mobile" class="form-select">
                                                        <option value="">انتخاب استان</option>
                                                    </select>

                                                    <label for="citySelect-mobile" class="mt-3">شهر:</label>
                                                    <select id="citySelect-mobile" class="form-select" disabled>
                                                        <option value="">ابتدا استان را انتخاب کنید</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">شماره سفارش</label>
                                                    <input type="text" class="form-control" id="orderNumber-mobile" placeholder="مثال: 123456">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">روش ارسال</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="post-mobile">
                                                        <label class="form-check-label" for="post-mobile">پست</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="tipax-mobile">
                                                        <label class="form-check-label" for="tipax-mobile">تیپاکس</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="courier-mobile">
                                                        <label class="form-check-label" for="courier-mobile">پیک</label>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">مبلغ پرداختی</label>
                                                    <input type="number" class="form-control" id="PaymentAmount-mobile" placeholder="مثال:210000">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">وضعیت سفارش</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="sent-mobile">
                                                        <label class="form-check-label" for="sent-mobile">ارسال شده</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="collecting-mobile">
                                                        <label class="form-check-label" for="collecting-mobile">در حال جمع آوری</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="ready-mobile">
                                                        <label class="form-check-label" for="ready-mobile">آماده برای ارسال</label>
                                                    </div>
                                                </div>

                                                <button class="btn btn-primary w-100" id="applyFilter-mobile">اعمال فیلتر</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Desktop version: Always visible -->
                            <div class="filter-sidebar p-3 border rounded bg-panel d-none d-md-block">
                                <h5 class="mb-3">فیلتر سفارش‌ها</h5>

                                <div class="filter-box mb-3">
                                    <label for="provinceSelect-desktop">استان:</label>
                                    <select id="provinceSelect-desktop" class="form-select">
                                        <option value="">انتخاب استان</option>
                                    </select>

                                    <label for="citySelect-desktop" class="mt-3">شهر:</label>
                                    <select id="citySelect-desktop" class="form-select" disabled>
                                        <option value="">ابتدا استان را انتخاب کنید</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">شماره سفارش</label>
                                    <input type="text" class="form-control" id="orderNumber-desktop" placeholder="مثال: 123456">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">روش ارسال</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="post-desktop">
                                        <label class="form-check-label" for="post-desktop">پست</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tipax-desktop">
                                        <label class="form-check-label" for="tipax-desktop">تیپاکس</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="courier-desktop">
                                        <label class="form-check-label" for="courier-desktop">پیک</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">مبلغ پرداختی</label>
                                    <input type="number" class="form-control" id="PaymentAmount-desktop" placeholder="مثال:210000">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">وضعیت سفارش</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sent-desktop">
                                        <label class="form-check-label" for="sent-desktop">ارسال شده</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="collecting-desktop">
                                        <label class="form-check-label" for="collecting-desktop">در حال جمع آوری</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ready-desktop">
                                        <label class="form-check-label" for="ready-desktop">آماده برای ارسال</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary w-100" id="applyFilter-desktop">اعمال فیلتر</button>
                            </div>

                        </div>
                        <!-- end filter-sidebar -->
                        <!-- list Orders Table-->
                        <div class="col-12 col-md-9 px-0">
                            <div class="table-responsive table-messages-section rounded" style="max-height: 85vh;">
                                <table class="table table-hover align-middle text-center mb-0">
                                    <thead class="table-blue">
                                    <tr>
                                        <th>#</th>
                                        <th>کد سفارش</th>
                                        <th>نام کاربر</th>
                                        <th>شماره تماس</th>
                                        <th>زمان ثبت</th>
                                        <th>پرداخت</th>
                                        <th>ارسال</th>
                                        <th style="width: 17%;">وضعیت</th>
                                        <th>جزئیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="ordersTable"></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end list Orders Table -->
                    </div>
                </div>

                <!--==================
                  modal To see details
                ===================-->
                <div class="modal fade" id="orderModal" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="d-flex justify-content-between align-items-center p-2 bg-dark text-white">
                                <h5 class="modal-title">جزئیات سفارش</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="orderDetails"></div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--==================
                   modal To see details
                 ===================-->
            </div>

            <!--*******************
                  Ad-section
            ***********************-->
            <div class="content-section d-none" id="Ad-section">
                <div class="container px-0" dir="rtl">
                    <div class="rounded-3 shadow-sm p-3 bg-panel myStore-content">
                        <div class="seven mb-3">
                            <h1> تنظیمات ظاهری نوار تبلیغات</h1>
                        </div>

                        <form class="row" id="adSettingsForm">
                            <div class="col-12 col-md-6 mb-2">
                                <label for="adBackgroundColor" class="form-label">🎨رنگ پس‌زمینه نوار</label>
                                <input type="color" id="adBackgroundColor" class="form-control form-control-color w-100" value="#007bff">
                            </div>

                            <div class="col-12 col-md-6 mb-2">
                                <label for="adBackgroundImage" class="form-label">
                                    <svg width="16" height="16" fill="#5e915e" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                                    </svg>
                                    عکس پس‌زمینه نوار (اختیاری)</label>
                                <input type="file" id="adBackgroundImage" class="form-control" accept="image/*">
                                <small class="form-text text-light" style="font-size: 12px;">اگر تصویر انتخاب شود، بر رنگ پس‌زمینه اولویت دارد.</small>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">🔗 لینک تبلیغ</label>
                                <input type="text" id="adLink" class="form-control text-start" placeholder="مثلاً https://example.com/sale">
                            </div>

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">📢 جملات تبلیغاتی</label>
                                <div class="input-group" dir="ltr">
                                    <button type="button" id="addAdMessageBtn" class="btn btn-success"><i class="bi bi-plus-lg"></i> افزودن</button>
                                    <input type="text" id="newAdMessage" class="form-control text-end" placeholder="افزودن جمله جدید">
                                </div>
                            </div>

                            <div class="col-12">
                                <ul id="adMessagesList" class="list-group"></ul>
                            </div>

                            <div class="text-start mt-3">
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>ذخیره</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- *******************
                  manege brands
             *********************** -->
            <section class="content-section d-none" id="admin-brands">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm rounded-4 p-3 border-0">

                            <!-- Section title -->
                            <div class="seven mb-3">
                                <h1>مدیریت برندها</h1>
                            </div>

                            <div class="d-flex flex-row align-items-start justify-content-between flex-wrap bg-panel" style="gap: 1.5rem;">

                                <!-- Brand upload section -->
                                <div class="d-flex flex-column align-items-center" style="max-width: 220px;">
                                    <!-- Preview area -->
                                    <div class="border border-2 border-secondary-subtle rounded-3 overflow-hidden bg-white mb-2 d-flex align-items-center justify-content-center" style="height: 180px; width: 100%;">
                                        <img id="previewImage" src="{{asset('design/image/logo.png')}}" class="img-fluid rounded" alt="Brand preview" style="max-height: 160px; object-fit: contain;">
                                    </div>

                                    <!-- File input -->
                                    <input class="form-control form-control-sm" type="file" id="brandImageInput" accept="image/*">

                                    <!-- Brand name input -->
                                    <input type="text" class="form-control form-control-sm mt-2" id="brandNameInput" placeholder="Brand name">

                                    <!-- Add brand button -->
                                    <button id="addBrandBtn" class="btn btn-primary w-100 mt-2 rounded-pill btn-sm">افزودن برند</button>
                                </div>

                                <!-- Brand gallery section -->
                                <div id="brandGallery" class="d-flex flex-wrap align-items-start gap-2 p-3 rounded-3 border border-2 border-secondary-subtle" style="min-height: 220px; flex: 1;">
                                    <!-- Brands will be dynamically added here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



        </div>
    </div>

@endsection

@section('script')
@endsection
