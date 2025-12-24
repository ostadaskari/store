@extends('user.layouts.app')
@section('style')

@endsection

@section('content')






            <!-- Orders -->
            <div class="col-md-9 px-0" >
            <h4>{{ Auth::user()->name }} {{ Auth::user()->family }}</h4>
                <p>به داشبورد خوش آمدید!</p>
            </div>
            <!-- end Orders -->










    <!-- end user account -->
@endsection

@section('script')

    <script>
        $(document).ready(function() {
            // ------------------------------------------
            // 1. AJAX Invoice Loading & Search Logic
            // ------------------------------------------

            const invoiceListContainer = $('#invoice-list');
            const invoiceSearchInput = $('#invoiceSearch');
            let typingTimer; // Timer for debouncing search input
            const doneTypingInterval = 500; // Wait 500ms after user stops typing

            /**
             * Loads order invoices via AJAX with search term and page.
             * @param {string} url - The AJAX URL (can include search/page query params).
             */
            function loadInvoices(url) {
                // Use the current search value if it's a new search or loading the initial page
                const searchVal = invoiceSearchInput.val();
                let ajaxUrl = url || "{{ route('user.dashboard') }}"; // Assuming current route handles AJAX

                // If it's the initial load or a search action (not pagination), append search param
                if (!url || ajaxUrl.indexOf('page=') === -1) {
                    ajaxUrl = updateQueryStringParameter(ajaxUrl, 'search', searchVal);
                }

                // Add loading state
                invoiceListContainer.html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">در حال بارگذاری فاکتورها...</p></div>');

                $.ajax({
                    url: ajaxUrl,
                    method: 'GET',
                    data: {
                        ajax: true, // Marker for Laravel controller
                    },
                    success: function(response) {
                        invoiceListContainer.html(response);
                        // After loading new content, re-initialize event handlers for new elements
                        setupNewInvoiceEvents();
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        invoiceListContainer.html('<div class="alert alert-danger text-center">خطا در بارگذاری فاکتورها. لطفاً دوباره تلاش کنید.</div>');
                    }
                });
            }

            // Debouncing function to limit API calls during search
            invoiceSearchInput.on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    loadInvoices(); // Load invoices with the new search term
                }, doneTypingInterval);
            });

            invoiceSearchInput.on('keydown', function() {
                clearTimeout(typingTimer);
            });


            // Event listener for pagination links (Delegated event)
            // The links returned by $user_orders->links() will have the class .page-link
            $(document).on('click', '#invoice-list .pagination a', function(e) {
                e.preventDefault();
                // The URL of the clicked pagination link
                const pageUrl = $(this).attr('href');
                loadInvoices(pageUrl);
                // Scroll to the top of the invoice list when changing pages
                $('html, body').animate({
                    scrollTop: $('#user-invoice-section').offset().top - 20
                }, 500);
            });

            // ------------------------------------------
            // 2. Section Toggling (Menu Click)
            // ------------------------------------------

            $('#go-to-invoice').on('click', function() {
                // Get the target ID from data-target
                const targetId = $(this).data('target');
                const targetElement = $('#' + targetId);
                const orderDetailSection = $('#current-order-detail'); // Assuming this is the main orders list

                // 1. Hide the primary orders list
                orderDetailSection.addClass('d-none');

                // 2. Show the invoice section
                targetElement.slideDown(300).css('display', 'block');

                // 3. Load the initial set of invoices (page 1)
                loadInvoices();
            });


            // ------------------------------------------
            // 3. Copy/Print & Other Dynamic Events
            // ------------------------------------------

            // Function to set up events on dynamically loaded content
            function setupNewInvoiceEvents() {
                // Copy Tracking Code functionality (Delegated event)
                $('.copy-icon').off('click').on('click', function(e) {
                    e.stopPropagation();
                    const trackingCode = $(this).prev('.trackingCode').text().trim();

                    // Simple clipboard copy (using temporary input method for wider compatibility)
                    const $tempInput = $('<input>');
                    $('body').append($tempInput);
                    $tempInput.val(trackingCode).select();

                    try {
                        document.execCommand('copy');
                        alert('شماره پیگیری کپی شد: ' + trackingCode); // Use a custom toast/modal in production
                    } catch (err) {
                        alert('خطا در کپی کردن متن'); // Use a custom toast/modal in production
                    }

                    $tempInput.remove();
                });
            }

            // Global Print Modal Function (must be outside of the ready block to be accessible by inline onclick)
            window.printModal = function(modalId) {
                const printContent = document.getElementById(modalId).querySelector('.modal-body').innerHTML;
                const originalBody = document.body.innerHTML;

                // Temporarily replace body content for printing
                document.body.innerHTML = printContent;
                window.print();

                // Restore original body content
                document.body.innerHTML = originalBody;
                location.reload(); // Reload to fully restore event handlers and state (a simple solution)
            };

            // Helper function to update query string parameters
            function updateQueryStringParameter(uri, key, value) {
                const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                const separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }

            // Initial setup for the copy event on the first load orders (if visible)
            setupNewInvoiceEvents();

        });
    </script>
@endsection

