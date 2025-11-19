@extends('admin.layouts.app')

@section('style')
    <style>
        .table-input { width:100%;}
        .save-btn { min-width:90px; }
        .edit-icon { cursor:pointer; width:18px; height:18px; vertical-align:middle; }
    </style>
@endsection

@section('content')
    <div class="container px-0" dir="rtl">
        <div class="seven mt-3">
            <h1>مدیریت SEO محصولات</h1>
        </div>
        
        <div class="card p-3">
            <div class="search-box mb-3">
               <input type="text" id="search-input" class="form-control" placeholder="جستجو بر اساس پارت نامبر...">
            </div>

                
            <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr" id="seo-table">
                @include('admin.product_seo._table_rows', ['products' => $products])
            </div>

            <div class="mt-3">
                {{ $products->appends(['q' => $q])->links() }}
            </div>
        </div>    
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- helper: debounce ---
            function debounce(fn, delay){
                let t;
                return function(...args){
                    clearTimeout(t);
                    t = setTimeout(()=> fn.apply(this, args), delay);
                };
            }

            const searchInput = document.getElementById('search-input');
            const seoTable = document.getElementById('seo-table');
            if (!searchInput || !seoTable) return; // nothing to do

            // --- load a page (partial) and replace #seo-table content ---
            async function loadTableFromUrl(url) {
                try {
                    const res = await fetch(url, { credentials: 'same-origin' });
                    const html = await res.text();
                    const tmp = document.createElement('div');
                    tmp.innerHTML = html;
                    const newTable = tmp.querySelector('#seo-table');
                    if (newTable) {
                        seoTable.innerHTML = newTable.innerHTML;
                        // optional: push URL to history (so back button works)
                        // history.pushState(null, '', url);
                    } else {
                        console.warn('No #seo-table found in response');
                    }
                } catch (err) {
                    console.error('Fetch error:', err);
                }
            }

            // --- debounced search handler (wait 500ms) ---
            const handleSearch = debounce(function () {
                const q = searchInput.value.trim();
                if (q.length >= 2) {
                    const url = new URL("{{ route('product_seo.index') }}", window.location.origin);
                    url.searchParams.set('q', q);
                    loadTableFromUrl(url.toString());
                } else if (q.length === 0) {
                    // reset to base listing
                    loadTableFromUrl("{{ route('product_seo.index') }}");
                }
            }, 500);

            searchInput.addEventListener('input', handleSearch);

            // --- pagination: delegate clicks inside #seo-table ---
            document.addEventListener('click', function (e) {
                const link = e.target.closest('a');
                if (!link) return;

                // make sure link is inside the #seo-table pagination
                const pag = link.closest('#seo-table .pagination, #seo-table .pagination');
                if (!pag) return;

                // Only intercept actual paginator links (they usually have href)
                const href = link.getAttribute('href');
                if (!href || href.trim() === '#') return;

                e.preventDefault();
                // load that page via AJAX and replace table
                loadTableFromUrl(href);
            });

            // --- AJAX save handler (delegated) ---
            document.addEventListener('click', async function (e) {
                // match by class; works even if the clicked element is an icon inside the button
                const btn = e.target.closest('.save-seo');
                if (!btn) return;

                e.preventDefault();
                const row = btn.closest('tr');
                if (!row) return;

                const part = row.dataset.part ?? row.dataset.partNumber ?? row.getAttribute('data-part') ?? row.getAttribute('data-part-number');
                if (!part) {
                    console.error('part number not found on row');
                    return;
                }

                // find inputs safely
                const titleEl = row.querySelector('[name="meta_title"]');
                const descEl  = row.querySelector('[name="meta_description"]');
                const keysEl  = row.querySelector('[name="meta_keywords"]');

                const payload = {
                    product_part_number: part,
                    meta_title: titleEl ? titleEl.value.trim() : null,
                    meta_description: descEl ? descEl.value.trim() : null,
                    meta_keywords: keysEl ? keysEl.value.trim() : null
                };

                btn.disabled = true;
                try {
                    const res = await fetch("{{ route('product_seo.save') }}", {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await res.json();
                    btn.disabled = false;

                    if (data && data.status === 'ok') {
                        // success toast (requires SweetAlert loaded in page)
                        if (window.Swal) {
                            Swal.fire({ icon: 'success', title: 'ذخیره شد', text: data.message, timer: 1400, showConfirmButton: false });
                        }
                        // After save we want to re-load the current table page so sorting is reapplied.
                        // Determine current URL for table: if q present in input include it
                        const currentQ = searchInput.value.trim();
                        const url = new URL("{{ route('product_seo.index') }}", window.location.origin);
                        if (currentQ.length >= 2) url.searchParams.set('q', currentQ);

                        // keep current page number if paginator exists
                        const activePageLink = seoTable.querySelector('.pagination .active a');
                        if (activePageLink) {
                            const pageHref = activePageLink.getAttribute('href');
                            if (pageHref) {
                                const pUrl = new URL(pageHref, window.location.origin);
                                if (pUrl.searchParams.has('page')) {
                                    url.searchParams.set('page', pUrl.searchParams.get('page'));
                                }
                            }
                        }

                        // reload the table partial so the sorted order updates
                        loadTableFromUrl(url.toString());
                    } else {
                        if (window.Swal) {
                            Swal.fire({ icon: 'error', title: 'خطا', text: data?.message ?? 'خطا در ذخیره' });
                        } else {
                            alert(data?.message ?? 'خطا');
                        }
                    }
                } catch (err) {
                    btn.disabled = false;
                    console.error(err);
                    if (window.Swal) {
                        Swal.fire({ icon: 'error', title: 'خطا', text: 'خطای شبکه' });
                    } else {
                        alert('Network error');
                    }
                }
            });

            // Optional: allow edit icon to focus first field (delegated)
            document.addEventListener('click', function (e) {
                const edit = e.target.closest('.edit-icon');
                if (!edit) return;
                const row = edit.closest('tr');
                if (!row) return;
                const first = row.querySelector('input, textarea');
                if (first) first.focus();
            });
        });
    </script>
@endsection

