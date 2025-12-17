@extends('user.layouts.app')

@section('style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap');
        body { font-family: 'Vazirmatn', sans-serif; background-color: #f8f9fa; }
        .card-summary { transition: transform 0.2s; }
        .card-summary:hover { transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            flex-wrap: wrap;
        }
        .order-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }
        .accordion-button:not(.collapsed) { background-color: #e9ecef; }
        .accordion-header button { text-align: right; justify-content: flex-end; }
        .accordion-header button .meta-item:first-child { margin-right: auto; }

        /* Progress Bar Styling */
        .order-progress {
            display: flex;
            align-items: center;
            padding: 0 20px;
            height: 80px !important;
        }
        .order-progress .progress {
            flex-grow: 1;
            margin: 0 10px;
            height: 5px !important;
        }
        .order-progress svg {
            color: #3b82f6;
            z-index: 10;
            background-color: white;
            border-radius: 50%;
            padding: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .bi-shop-icon { color: #f97316; } /* Orange */
        .house-icon { color: #dc2626; } /* Red */

        /* Media Queries for Progress Icons positioning (simulating status-based styling) */
        /* Note: Actual dynamic positioning logic requires status data and JavaScript */
        .order-progress .bi-shop-icon { margin-right: -45px; }
        .order-progress .house-icon { margin-left: -45px; }
        .order-progress .car { margin-right: -20px; }


    </style>


@endsection

@section('content')
    <div class="col-md-9" id="invoice-dashboard">

        <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2"> فاکتورها</h1>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs mb-4" id="invoiceTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="current-tab" data-bs-toggle="tab" data-bs-target="#current-invoices" type="button" role="tab" aria-controls="current-invoices" aria-selected="true" data-status="current">
                    <span class="badge bg-primary me-2 current-count">{{ $invoices_count ?? 0 }}</span>
                    فاکتورهای در حال پیگیری
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-invoices" type="button" role="tab" aria-controls="completed-invoices" aria-selected="false" data-status="completed">
                    <span class="badge bg-success me-2 completed-count">{{ $user_invoices_complete_count ?? 0 }}</span>
                    فاکتورهای تکمیل شده
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceled-invoices" type="button" role="tab" aria-controls="canceled-invoices" aria-selected="false" data-status="canceled">
                    <span class="badge bg-danger me-2 canceled-count">{{ $user_invoices_canceled_count ?? 0 }}</span>
                    فاکتورهای لغو شده
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="invoiceTabsContent">

            <!-- 1. Current Invoices Tab (Initial content loaded from controller) -->
            <div class="tab-pane fade show active" id="current-invoices" role="tabpanel" aria-labelledby="current-tab">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <input type="text" id="search-current" class="form-control w-1/3" placeholder="جستجوی شماره فاکتور یا مبلغ...">
                        <span id="loading-current" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true" style="display: none;"></span>
                    </div>
                    <!-- Invoice List (Initially populated by Blade include) -->
                    <div id="current-invoice-list">
                        {{-- The initial current invoices loaded by the controller are included here --}}
                        @include('user.invoices.partials.current_invoice_items', ['user_invoices' => $invoices])
                    </div>
                    <!-- Pagination links for current invoices -->
                    <div id="pagination-current" class="mt-4 flex justify-center">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>

            <!-- 2. Completed Invoices Tab (Content loaded via AJAX) -->
            <div class="tab-pane fade" id="completed-invoices" role="tabpanel" aria-labelledby="completed-tab">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <input type="text" id="search-completed" class="form-control w-1/3" placeholder="جستجوی شماره فاکتور یا مبلغ...">
                        <span id="loading-completed" class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true" style="display: none;"></span>
                    </div>
                    <!-- Invoice List Container -->
                    <div id="completed-invoice-list">
                        <div class="alert alert-info text-center">فاکتورهای تکمیل شده در حال بارگذاری هستند...</div>
                    </div>
                    <!-- Pagination links container -->
                    <div id="pagination-completed" class="mt-4 flex justify-center"></div>
                </div>
            </div>

            <!-- 3. Canceled Invoices Tab (Content loaded via AJAX) -->
            <div class="tab-pane fade" id="canceled-invoices" role="tabpanel" aria-labelledby="canceled-tab">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <input type="text" id="search-canceled" class="form-control w-1/3" placeholder="جستجوی شماره فاکتور یا مبلغ...">
                        <span id="loading-canceled" class="spinner-border spinner-border-sm text-danger" role="status" aria-hidden="true" style="display: none;"></span>
                    </div>
                    <!-- Invoice List Container -->
                    <div id="canceled-invoice-list">
                        <div class="alert alert-info text-center">فاکتورهای لغو شده در حال بارگذاری هستند...</div>
                    </div>
                    <!-- Pagination links container -->
                    <div id="pagination-canceled" class="mt-4 flex justify-center"></div>
                </div>
            </div>

        </div>

    </div>


@endsection

@section('script')
    <script>
        // Global variable to store the URL of the AJAX fetch endpoint
        const fetchUrl = '{{ route('user.invoices.fetch') }}';

        // Map status types to their corresponding element IDs
        const statusToIds = {
            'current': {
                list: 'current-invoice-list',
                pagination: 'pagination-current',
                search: 'search-current',
                loading: 'loading-current',
                count: '.current-count'
            },
            'completed': {
                list: 'completed-invoice-list',
                pagination: 'pagination-completed',
                search: 'search-completed',
                loading: 'loading-completed',
                count: '.completed-count'
            },
            'canceled': {
                list: 'canceled-invoice-list',
                pagination: 'pagination-canceled',
                search: 'search-canceled',
                loading: 'loading-canceled',
                count: '.canceled-count'
            }
        };

        /**
         * Fetches invoices via AJAX for a specific status.
         * @param {string} statusType - 'current', 'completed', or 'canceled'.
         * @param {number} page - The page number to fetch.
         * @param {string} search - The search query.
         */
        function fetchInvoices(statusType, page = 1, search = '') {
            const ids = statusToIds[statusType];
            if (!ids) return;

            const listContainer = document.getElementById(ids.list);
            const paginationContainer = document.getElementById(ids.pagination);
            const loadingSpinner = document.getElementById(ids.loading);
            const countElement = document.querySelector(ids.count);

            // Show initial loading state
            if (listContainer) {
                listContainer.innerHTML = '<div class="alert alert-info text-center">در حال بارگذاری...</div>';
            }
            if (paginationContainer) {
                paginationContainer.innerHTML = '';
            }
            if (loadingSpinner) {
                loadingSpinner.style.display = 'inline-block';
            }

            const params = new URLSearchParams({ page: page, search: search, status: statusType });
            const url = `${fetchUrl}?${params.toString()}`;

            const maxRetries = 3;
            let currentAttempt = 0;

            const executeFetch = async () => {
                while (currentAttempt < maxRetries) {
                    try {
                        const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();

                        // Update DOM elements
                        if (listContainer) listContainer.innerHTML = data.html;
                        if (paginationContainer) paginationContainer.innerHTML = data.links;
                        if (countElement) countElement.textContent = data.count.toLocaleString('fa-IR'); // Update count badge

                        setupEventListeners(statusType); // Re-attach listeners after content update
                        return; // Exit loop on success

                    } catch (error) {
                        currentAttempt++;
                        if (currentAttempt < maxRetries) {
                            const delay = Math.pow(2, currentAttempt) * 1000; // Exponential backoff
                            await new Promise(resolve => setTimeout(resolve, delay));
                        } else {
                            console.error(`Error fetching ${statusType} invoices after multiple attempts:`, error);
                            if (listContainer) {
                                listContainer.innerHTML = '<div class="alert alert-danger text-center">خطا در بارگذاری لیست فاکتورها. لطفا بعداً دوباره امتحان کنید.</div>';
                            }
                        }
                    } finally {
                        if (loadingSpinner) {
                            loadingSpinner.style.display = 'none';
                        }
                    }
                }
            };

            executeFetch();
        }

        /**
         * Attaches event listeners for pagination links and copy functionality for a given status.
         * @param {string} statusType - The status type to attach listeners for.
         */
        function setupEventListeners(statusType) {
            const ids = statusToIds[statusType];
            if (!ids) return;

            // 1. Pagination Listeners
            const paginationContainer = document.getElementById(ids.pagination);
            if (paginationContainer) {
                const paginationLinks = paginationContainer.querySelectorAll('a');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        const page = url.searchParams.get('page');
                        const search = document.getElementById(ids.search)?.value || '';
                        fetchInvoices(statusType, page, search);
                    });
                });
            }


            // 2. Copy Tracking Code Listener (since this is generic across all tabs)
            const copyIcons = document.querySelectorAll('.copy-icon');
            copyIcons.forEach(icon => {
                icon.removeEventListener('click', handleCopyClick); // Remove previous listener to prevent duplication
                icon.addEventListener('click', handleCopyClick);
            });
        }

        /**
         * Handles the click event for the copy icon.
         */
        function handleCopyClick() {
            const icon = this;
            const trackingCodeElement = icon.closest('.meta-item').querySelector('.trackingCode');
            if (trackingCodeElement) {
                const code = trackingCodeElement.textContent.trim();

                // Fallback for document.execCommand('copy') in iFrames
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);
                tempInput.value = code;
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);

                // Show temporary feedback (like changing icon or text)
                const originalColor = icon.style.fill;
                icon.style.fill = 'green';
                setTimeout(() => {
                    icon.style.fill = originalColor;
                }, 1000);
            }
        }

        /**
         * Function to print the content of a specific modal.
         */
        function printModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) {
                console.error('Modal element not found:', modalId);
                return;
            }

            const content = modal.querySelector('.modal-body').innerHTML;
            const printWindow = window.open('', '', 'height=600,width=800');

            printWindow.document.write('<html><head><title>چاپ فاکتور</title>');
            // Include minimal styles for printing (especially for right-to-left layout and table)
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: \'Vazirmatn\', sans-serif; direction: rtl; text-align: right; }');
            printWindow.document.write('.seven { margin-bottom: 20px; border-right: 5px solid #3b82f6; padding-right: 15px; }');
            printWindow.document.write('.seven h1 { font-size: 1.5rem; }');
            printWindow.document.write('.card { border: 1px solid #ccc; margin-bottom: 10px; padding: 10px; }');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 10px; }');
            printWindow.document.write('th, td { border: 1px solid #ddd; padding: 8px; }');
            printWindow.document.write('th { background-color: #f2f2f2; }');
            printWindow.document.write('.table-blue { background-color: #3b82f6; color: white; }');
            printWindow.document.write('.text-danger { color: red; font-weight: bold; }');
            printWindow.document.write('</style>');

            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.print();
        }


        // Debounce utility function
        function debounce(func, timeout = 500) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }


        document.addEventListener('DOMContentLoaded', () => {

            // Initial setup for current invoices (which are already loaded by Blade)
            setupEventListeners('current');
            window.printModal = printModal; // Expose print function globally

            // --- Tab Switching Logic ---
            const tabButtons = document.querySelectorAll('#invoiceTabs button');
            let loadedTabs = { 'current': true, 'completed': false, 'canceled': false };

            tabButtons.forEach(button => {
                button.addEventListener('shown.bs.tab', function (e) {
                    const statusType = this.getAttribute('data-status');

                    // Load content only once (or on force refresh if needed)
                    if (!loadedTabs[statusType]) {
                        fetchInvoices(statusType, 1, '');
                        loadedTabs[statusType] = true;
                    }
                });
            });


            // --- Search Event Listener Setup ---
            const debouncedSearch = debounce((statusType, searchValue) => {
                fetchInvoices(statusType, 1, searchValue);
            }, 500);

            // Attach search listener to all search inputs
            Object.keys(statusToIds).forEach(statusType => {
                const searchInput = document.getElementById(statusToIds[statusType].search);
                if (searchInput) {
                    searchInput.addEventListener('keyup', (e) => {
                        debouncedSearch(statusType, e.target.value);
                    });
                }
            });

        });

    </script>


@endsection
