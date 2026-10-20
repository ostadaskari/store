@extends('front.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-3" style="margin-top: 150px;">
        <div class="row">
            {{-- Sidebar Filter Controls --}}
            <aside class="col-12 col-md-3 mb-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fs-6 fw-bold">
                            <i class="bi bi-funnel me-2"></i> فیلتر پیشرفته
                        </h5>
                    </div>
                    <div class="card-body">
                        {{-- Category Selector (Tree View) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold mb-2">انتخاب دسته‌بندی</label>

                            {{-- فیلد مخفی برای نگهداری آی‌دی دسته‌بندی انتخاب شده جهت ارسال به اژاکس --}}
                            <input type="hidden" id="category-select" value="">

                            {{-- کانتینر نمایش درخت دسته‌بندی‌ها --}}
                            <div class="category-tree-container border rounded p-2" style="max-height: 250px; overflow-y: auto; background: #fdfdfd;">
                                @include('front.partials.sidebar_categories', [
                                    'categories' => $allCategories,
                                    'currentCategory' => null
                                ])
                            </div>
                        </div>

                        {{-- Dynamic Filters Container --}}
                        <div id="dynamic-filters"></div>

                        <button id="search-btn" class="btn btn-primary w-100 mt-3 fw-bold">
                            <i class="bi bi-search me-1"></i> اعمال فیلتر
                        </button>
                    </div>
                </div>
            </aside>

            {{-- Main Results Area --}}
            <main class="col-12 col-md-9">
                <div class="card shadow-sm border-0 rounded-3 mb-3">
                    <div class="card-body py-2 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fs-6 fw-bold text-secondary">
                            <i class="bi bi-list-stars me-2"></i> نتایج جستجو
                        </h5>
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="listViewBtn" class="btn btn-primary">
                                <i class="bi bi-grid-fill me-1"></i> نمای کارت
                            </button>
                            <button id="tableViewBtn" class="btn btn-outline-primary">
                                <i class="bi bi-table me-1"></i> نمای جدول
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Loader Spinner --}}
                <div id="loader" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">در حال بارگذاری...</span>
                    </div>
                </div>

                {{-- Products Display Area (Cards) --}}
                <div id="product-list" class="row g-2"></div>

                {{-- Table View Container --}}
                <div id="product-table-container" class="table-responsive bg-white rounded shadow-sm p-2" style="display: none; max-height: 70vh; overflow-y: auto;"></div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryInput = document.getElementById("category-select");
            const filtersEl = document.getElementById("dynamic-filters");
            const searchBtn = document.getElementById("search-btn");
            const loaderEl = document.getElementById("loader");
            const productListEl = document.getElementById("product-list");
            const productTableContainerEl = document.getElementById("product-table-container");
            const listViewBtn = document.getElementById("listViewBtn");
            const tableViewBtn = document.getElementById("tableViewBtn");

            let currentView = 'list';
            let rawProductsData = [];

            // مدیریت کلیک روی لینک‌های دسته‌بندی درخت برای انتخاب و بارگذاری ویژگی‌ها
            document.querySelectorAll('.category-node a').forEach(catLink => {
                catLink.addEventListener('click', function(e) {
                    e.preventDefault();

                    // حذف کلاس اکتیو از بقیه و افزودن به این مورد
                    document.querySelectorAll('.category-node a').forEach(l => l.classList.remove('text-danger', 'fw-bold'));
                    this.classList.add('text-danger', 'fw-bold');

                    // خواندن آی‌دی مستقیماً از data-id در تگ li والد (category-node)
                    const categoryNode = this.closest('.category-node');
                    if (categoryNode) {
                        const catId = categoryNode.getAttribute('data-id');
                        if (catId) {
                            categoryInput.value = catId;
                            fetchFeaturesForCategory(catId);
                        }
                    }
                });
            });

            // تابع باز و بسته کردن درخت
            document.querySelectorAll('.category-node .toggle').forEach(function (toggle) {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const categoryNode = this.closest('.category-node');
                    const childList = categoryNode.querySelector(':scope > .child-list');
                    if (!childList) return;
                    const isOpen = !childList.classList.contains('d-none');
                    childList.classList.toggle('d-none', isOpen);
                    this.textContent = isOpen ? '+' : '−';
                });
            });

            function getMultiplierJS(unit) {
                if (!unit) return 1.0;
                unit = unit.trim();
                if (unit.startsWith('M')) return 1000000.0;
                if (unit.startsWith('m')) return 0.001;
                if (/^p/i.test(unit)) return 0.000000000001;
                if (/^n/i.test(unit)) return 0.000000001;
                if (/^(u|μ)/i.test(unit)) return 0.000001;
                if (/^k/i.test(unit)) return 1000.0;
                if (/^G/i.test(unit)) return 1000000000.0;
                return 1.0;
            }

            function formatNumber(num) {
                if (num === null || num === undefined || isNaN(num)) return '';
                if (num === 0) return '0';
                if (Math.abs(num) < 0.0001 || Math.abs(num) >= 1000000) {
                    return num.toExponential(2);
                }
                return parseFloat(num.toFixed(4)).toString();
            }

            function showLoader(isVisible) {
                loaderEl.style.display = isVisible ? 'block' : 'none';
                if (isVisible) {
                    productListEl.style.display = 'none';
                    productTableContainerEl.style.display = 'none';
                } else {
                    if (currentView === 'list') {
                        productListEl.style.display = 'flex';
                        productTableContainerEl.style.display = 'none';
                    } else {
                        productListEl.style.display = 'none';
                        productTableContainerEl.style.display = 'block';
                    }
                }
            }

            // تابع بارگذاری فیلترها بر اساس دسته‌بندی انتخابی
            function fetchFeaturesForCategory(catId) {
                filtersEl.innerHTML = "";
                productListEl.innerHTML = "";
                productTableContainerEl.innerHTML = "";
                rawProductsData = [];
                if (!catId) return;

                showLoader(true);
                fetch(`/filter-search/features/${catId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.features) return;
                        data.features.forEach(f => {
                            const filterBox = document.createElement("div");
                            filterBox.className = "mb-3 border-bottom pb-2";

                            let inputHtml = "";
                            const minName  = `feature_${f.id}_min`;
                            const maxName  = `feature_${f.id}_max`;
                            const unitName = `feature_${f.id}_unit`;

                            if (f.data_type === "decimal(15,7)" || f.data_type === "range") {
                                let unitSelector = '';
                                let defaultUnit = '';

                                if (f.unit) {
                                    const unitsList = f.unit.split(',').map(u => u.trim()).filter(Boolean);
                                    if (unitsList.length > 0) {
                                        defaultUnit = unitsList[0];
                                        const options = unitsList.map(u => `<option value="${u}">${u}</option>`).join('');
                                        unitSelector = `<select name="${unitName}" class="form-select form-select-sm bg-light text-secondary unit-select" data-feature-id="${f.id}" style="max-width: 80px;">${options}</select>`;
                                    }
                                }

                                const minBase = f.min_value !== undefined ? f.min_value : 0;
                                const maxBase = f.max_value !== undefined ? f.max_value : 0;
                                const initialMultiplier = getMultiplierJS(defaultUnit);

                                inputHtml = `
                                <div class="row g-1 align-items-center">
                                    <div class="col">
                                        <input type="number" step="any" id="min_input_${f.id}" name="${minName}"
                                               data-min-base="${minBase}"
                                               class="form-control form-control-sm"
                                               placeholder="از: ${formatNumber(minBase / initialMultiplier)}">
                                    </div>
                                    <div class="col">
                                        <input type="number" step="any" id="max_input_${f.id}" name="${maxName}"
                                               data-max-base="${maxBase}"
                                               class="form-control form-control-sm"
                                               placeholder="تا: ${formatNumber(maxBase / initialMultiplier)}">
                                    </div>
                                    ${unitSelector ? `<div class="col-auto">${unitSelector}</div>` : ''}
                                </div>`;
                            } else if (f.data_type === "varchar(50)" || f.data_type === "TEXT") {
                                inputHtml = `<input type="text" name="feature_${f.id}" class="form-control form-control-sm" placeholder="متن...">`;
                            } else if (f.data_type === "boolean") {
                                inputHtml = `<select name="feature_${f.id}" class="form-select form-select-sm">
                                    <option value="">-- همه --</option>
                                    <option value="true">بله</option>
                                    <option value="false">خیر</option>
                                </select>`;
                            } else if (f.data_type === "multiselect") {
                                try {
                                    const meta = typeof f.metadata === 'string' ? JSON.parse(f.metadata) : (f.metadata || {});
                                    if (meta.options) {
                                        inputHtml = `<select name="feature_${f.id}" class="form-select form-select-sm">
                                            <option value="">-- همه --</option>
                                            ${meta.options.map(opt => `<option value="${opt}">${opt}</option>`).join('')}
                                        </select>`;
                                    }
                                } catch (e) { console.error(e); }
                            }

                            filterBox.innerHTML = `<label class="form-label small fw-bold mb-1 d-block text-dark">${f.name}</label>${inputHtml}`;
                            if (inputHtml.trim() !== "") {
                                filtersEl.appendChild(filterBox);
                            }
                        });

                        document.querySelectorAll('.unit-select').forEach(selectEl => {
                            selectEl.addEventListener('change', function () {
                                const featureId = this.getAttribute('data-feature-id');
                                const selectedUnit = this.value;
                                const mult = getMultiplierJS(selectedUnit);

                                const minInput = document.getElementById(`min_input_${featureId}`);
                                const maxInput = document.getElementById(`max_input_${featureId}`);

                                if (minInput) {
                                    const baseMin = parseFloat(minInput.getAttribute('data-min-base'));
                                    minInput.placeholder = `از: ${formatNumber(baseMin / mult)}`;
                                }
                                if (maxInput) {
                                    const baseMax = parseFloat(maxInput.getAttribute('data-max-base'));
                                    maxInput.placeholder = `تا: ${formatNumber(baseMax / mult)}`;
                                }
                            });
                        });

                        showLoader(false);
                    })
                    .catch(err => {
                        console.error("خطا:", err);
                        showLoader(false);
                    });
            }

            // دکمه اعمال فیلتر
            searchBtn.addEventListener("click", function () {
                const catId = categoryInput.value;
                if (!catId) {
                    alert('لطفاً یک دسته‌بندی را از منوی درختی انتخاب کنید.');
                    return;
                }

                const params = new URLSearchParams();
                params.set('category_id', catId);

                document.querySelectorAll("#dynamic-filters input, #dynamic-filters select").forEach(el => {
                    if (el.value.trim() !== "") {
                        params.set(el.name, el.value.trim());
                    }
                });

                showLoader(true);
                fetch(`/filter-search/results?${params.toString()}`)
                    .then(res => res.json())
                    .then(data => {
                        productListEl.innerHTML = data.html || '';
                        rawProductsData = data.products || [];

                        if (currentView === 'table') {
                            renderTableView(rawProductsData);
                        }
                        showLoader(false);
                    })
                    .catch(err => {
                        console.error(err);
                        showLoader(false);
                    });
            });

            function renderTableView(products) {
                if (products.length === 0) {
                    productTableContainerEl.innerHTML = "<p class='text-center text-muted my-4'>هیچ محصولی پیدا نشد.</p>";
                    return;
                }
                let tableHtml = `<table class="table table-bordered table-hover align-middle mb-0 text-center small"><thead class="table-primary"><tr><th>#</th><th>شماره فنی</th><th>سازنده</th><th>موجودی</th></tr></thead><tbody>`;
                products.forEach((p, i) => {
                    tableHtml += `<tr><td>${i + 1}</td><td class="fw-bold">${p.part_number}</td><td>${p.mfg || 'N/A'}</td><td>${p.available_qty || 0}</td></tr>`;
                });
                tableHtml += `</tbody></table>`;
                productTableContainerEl.innerHTML = tableHtml;
            }

            listViewBtn.addEventListener('click', function () {
                currentView = 'list';
                listViewBtn.className = 'btn btn-primary';
                tableViewBtn.className = 'btn btn-outline-primary';
                productListEl.style.display = 'flex';
                productTableContainerEl.style.display = 'none';
            });

            tableViewBtn.addEventListener('click', function () {
                currentView = 'table';
                renderTableView(rawProductsData);
                tableViewBtn.className = 'btn btn-primary';
                listViewBtn.className = 'btn btn-outline-primary';
                productListEl.style.display = 'none';
                productTableContainerEl.style.display = 'block';
            });
        });
    </script>
@endsection
