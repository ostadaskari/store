<!-- User Addresses Modal -->

<div class="modal fade" id="userAddressesModal" tabindex="-1" aria-labelledby="userAddressesModalLabel" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userAddressesModalLabel">مدیریت آدرس‌ها</h5>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted" id="address-limit-text">شما می‌توانید تا ۴ آدرس را برای ارسال سفارشات خود ثبت کنید.</p>

                <!-- Existing Addresses Display (This is now a container for JS rendering) -->
                <div id="address-section" class="mb-4">
                    <div class="text-center p-3 text-muted" id="address-loading-message">در حال بارگذاری آدرس‌ها...</div>
                    {{-- Addresses will be dynamically rendered here by JavaScript --}}
                </div>

                <!-- Add New Address Button -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type="button" class="btn btn-sm btn-success add-address-btn" id="btnNew-address">+ افزودن آدرس جدید</button>
                </div>

                <!-- New/Edit Address Form (Initially hidden) -->
                <div class="container mt-2 px-0 d-none" id="new-address-form-container">
                    <div class="card border border-warning">
                        <div class="card-header bg-warning-subtle py-2">
                            <h6 class="mb-0" id="addressFormTitle">افزودن آدرس جدید</h6>
                        </div>
                        <div class="card-body p-0">
                            <form id="address-form" class="p-3">
                                @csrf
                                <input type="hidden" name="address_id" id="editAddressId">

                                <div class="row g-3 mb-3 d-flex align-items-center">
                                    {{-- Province/City --}}
                                    <div class="col-md-4">
                                        <label for="provinceSelect" class="fieldlabels">استان<span class="text-danger">*</span></label>
                                        <select class="form-select" id="provinceSelect" name="province" required>
                                            <option value="" selected disabled>...</option>
                                        </select>
                                        <small class="text-danger address-province-error"></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="citySelect" class="fieldlabels">شهر<span class="text-danger">*</span></label>
                                        <select class="form-select" id="citySelect" name="city" required disabled>
                                            <option value="" selected disabled>ابتدا استان را انتخاب کنید</option>
                                        </select>
                                        <small class="text-danger address-city-error"></small>
                                    </div>
                                    {{-- End Province/City --}}

                                    <div class="col-md-4">
                                        <label for="new_receiver_name" class="fieldlabels">نام کامل گیرنده<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="new_receiver_name" name="full_name" placeholder="نام و نام خانوادگی گیرنده" required>
                                        <small class="text-danger address-full_name-error"></small>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="new_plate" class="fieldlabels">پلاک<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="new_plate" name="plate" placeholder="مثال: ۱۲" required>
                                        <small class="text-danger address-plate-error"></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="new_postalCode" class="fieldlabels">کد پستی <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="new_postalCode" name="post_code" inputmode="numeric" placeholder="مثال: 1234567890" required>
                                        <small class="text-danger address-post_code-error"></small>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="new_mobile" class="fieldlabels">شماره موبایل گیرنده<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="new_mobile" name="mobile" inputmode="numeric" placeholder="مثال: 09123456789" required>
                                        <small class="text-danger address-mobile-error"></small>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="new_fullAddress" class="fieldlabels">آدرس کامل (بدون پلاک و کد پستی)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control w-100" id="new_fullAddress" name="address" placeholder="مثال: بلوار ولیعصر، کوچه ۳، واحد ۲" required>
                                        <small class="text-danger address-address-error"></small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="new_phone" class="fieldlabels">تلفن ثابت (اختیاری)</label>
                                        <input type="tel" class="form-control" id="new_phone" name="phone" placeholder="مثال: 021xxxxxxx">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="new_companyName" class="fieldlabels">نام شرکت (اختیاری)</label>
                                        <input type="text" class="form-control" id="new_companyName" name="company_name" placeholder="جهت فاکتور رسمی">
                                    </div>
                                </div>
                            </form>

                            <div id="new-address-error-message" class="text-danger p-3 small d-none"></div>
                            <div class="text-end p-3">
                                <button type="button" id="saveAddressBtn" class="btn btn-primary">ثبت و ذخیره آدرس</button>
                                <button type="button" id="cancelAddressBtn" class="btn btn-secondary me-2">لغو</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End New/Edit Address Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>


</div>

@push('script')
    <script>
        // Ensure you have an AJAX setup block in the main script of the page to handle CSRF token.

        $(document).ready(function () {
            // --- Global Variables (Moved inside ready for scope safety) ---
            let IRAN_LOCATIONS = {}; // Stores the province/city data
            let userAddresses = []; // Stores the current list of user addresses
            let currentEditId = null; // To track if we are editing an existing address or creating a new one

            const modal = $('#userAddressesModal');
            const addAddressBtn = $('#btnNew-address');
            const saveAddressBtn = $('#saveAddressBtn');
            const newAddressFormContainer = $('#new-address-form-container');
            const addressForm = $('#address-form');
            const addressFormTitle = $('#addressFormTitle');

            // --- Utility Functions (Adapted from user input) ---

            /**
             * Shows feedback message (used for address operations).
             * NOTE: Assumes showFeedback function is globally available from the main script section.
             */
            function showAddressFeedback(message, type) {
                // Use the globally defined showFeedback function for consistency
                if (typeof showFeedback === 'function') {
                    showFeedback(message, type);
                } else {
                    console.warn('showFeedback function is missing. Displaying feedback in console.');
                    alert(`${type.toUpperCase()}: ${message}`);
                }
            }

            /**
             * Clears all error messages displayed next to form inputs.
             */
            function clearAddressErrors() {
                $('.address-form-error').addClass('d-none').text(''); // Specific error message container
                $('.text-danger[class^="address-"]').text('').hide(); // Input specific errors
                addressForm.find('.is-invalid').removeClass('is-invalid');
            }

            /**
             * Displays validation errors returned by the server.
             */
            function displayAddressErrors(errors) {
                clearAddressErrors();
                $.each(errors, function(key, value) {
                    // Prepend 'address-' to match the error class names in the modal partial
                    $(`.address-${key}-error`).text(value[0]).show();
                    $(`[name="${key}"]`, addressForm).addClass('is-invalid');
                });
                $('#new-address-error-message').removeClass('d-none').text('لطفاً خطاهای موجود در فرم را برطرف کنید.');
            }

            // --- 1. Location Data Management ---

            /**
             * Fetches Iran's province/city data from the new API route.
             */
            function fetchIranLocations(callback = null, selectProvince = null, selectCity = null) {
                const $provinceSelect = $('#provinceSelect');
                $provinceSelect.empty().append('<option value="" selected disabled>در حال بارگذاری...</option>');
                $('#citySelect').empty().prop('disabled', true);

                // Skip fetch if already loaded
                if (Object.keys(IRAN_LOCATIONS).length > 0) {
                    loadProvinces(selectProvince, selectCity);
                    if (callback) callback();
                    return;
                }

                $.ajax({
                    url: "{{ route('api.iran.locations') }}",
                    type: "GET",
                    success: function (res) {
                        if (res.status && res.locations) {
                            IRAN_LOCATIONS = res.locations;
                            loadProvinces(selectProvince, selectCity); // Load provinces now that data is available
                            if (callback) callback();
                        } else {
                            $provinceSelect.empty().append('<option value="" selected disabled>خطا در بارگذاری استان‌ها</option>');
                            console.error('Error: Location data not found in API response.');
                        }
                    },
                    error: function (xhr) {
                        $provinceSelect.empty().append('<option value="" selected disabled>خطا در برقراری ارتباط با API. کد خطا: ' + xhr.status + '</option>');
                        console.error('AJAX Error: Could not fetch Iran locations.', xhr);
                    }
                });
            }


            function loadProvinces(provinceToSelect = null, cityToSelect = null) {
                const $select = $('#provinceSelect');
                $select.empty().append('<option value="" selected disabled>استان را انتخاب کنید</option>');

                if (Object.keys(IRAN_LOCATIONS).length === 0) return;

                Object.keys(IRAN_LOCATIONS).forEach(province => {
                    $select.append(`<option value="${province}" ${provinceToSelect === province ? 'selected' : ''}>${province}</option>`);
                });

                if (provinceToSelect) {
                    loadCities(provinceToSelect, cityToSelect);
                }
            }

            function loadCities(provinceName, cityToSelect = null) {
                const $citySelect = $('#citySelect');
                $citySelect.empty();

                if (provinceName && IRAN_LOCATIONS[provinceName]) {
                    IRAN_LOCATIONS[provinceName].forEach(city => {
                        $citySelect.append(`<option value="${city}" ${cityToSelect === city ? 'selected' : ''}>${city}</option>`);
                    });
                    $citySelect.prop('disabled', false);
                } else {
                    $citySelect.append('<option value="" selected disabled>ابتدا استان را انتخاب کنید</option>');
                    $citySelect.prop('disabled', true);
                }
            }

            // Event listener for province selection
            $('#provinceSelect').off('change').on('change', function() {
                const selectedProvince = $(this).val();
                loadCities(selectedProvince);
            });


            // --- 2. Address Rendering and Management ---

            /**
             * Renders the addresses stored in the userAddresses array.
             */
            function renderAddresses() {
                const $addressList = $('#address-section');
                $('#address-loading-message').remove();
                $addressList.empty();

                const $addressCountText = $('#address-limit-text');
                $addressCountText.text(`شما می‌توانید تا ۴ آدرس را ثبت کنید. (ثبت شده: ${userAddresses.length})`);


                if (userAddresses.length === 0) {
                    $addressList.html('<div class="text-center p-3 text-muted">هیچ آدرسی ثبت نشده است. آدرس جدید اضافه کنید.</div>');
                    updateHiddenAddressFields(null);
                    return;
                }

                // Determine which address should be checked (the first one by default, or the previously selected one)
                let lastSelectedId = $('.address-radio:checked').val();
                if (!lastSelectedId || !userAddresses.some(a => a.id == lastSelectedId)) {
                    lastSelectedId = userAddresses[0].id;
                }

                userAddresses.forEach((address) => {
                    // Combine required address parts for display
                    const displayAddress = `${address.province}, ${address.city}, ${address.address}`;
                    const receiverInfo = `<strong>گیرنده:</strong> ${address.first_name} ${address.last_name} - ${address.mobile}`;
                    const isChecked = address.id == lastSelectedId;

                    // Data attributes store individual components for easy editing/re-population
                    const addressHtml = `
        <div class="mb-3 p-3 shadow-sm d-flex gap-3 align-items-start address-item border rounded ${isChecked ? 'border-primary bg-white' : 'border-light'}"
            data-id="${address.id}"
            data-province="${address.province}"
            data-city="${address.city}"
            data-address="${address.address}"
            data-plate="${address.plate}"
            data-postcode="${address.post_code}"
            data-mobile="${address.mobile}"
            data-firstname="${address.first_name}"
            data-lastname="${address.last_name}"
            data-phone="${address.phone || ''}"
            data-company="${address.company_name || ''}">

            <input class="form-check-input mt-1 address-radio" type="radio"
                name="selectedAddress" id="address-${address.id}" value="${address.id}" ${isChecked ? 'checked' : ''}>
            <label for="address-${address.id}" class="flex-grow-1 cursor-pointer">
                <div class="d-flex gap-2 align-items-start">
                    <div class="fs-4">📍</div>
                    <div>
                        ${displayAddress} (کد پستی: ${address.post_code})<br>
                        ${receiverInfo}
                    </div>
                </div>
            </label>
            <div class="d-flex gap-2 mt-1 address-actions">
                <button type="button" class="btn btn-sm btn-outline-info edit-address-btn" data-id="${address.id}">ویرایش</button>
                <button type="button" class="btn btn-sm btn-outline-danger delete-address-btn" data-id="${address.id}">حذف</button>
            </div>
        </div>
    `;
                    $addressList.append(addressHtml);
                });

                // Update the state of the Add New Address button based on the limit
                if (userAddresses.length >= 4) {
                    addAddressBtn.prop('disabled', true).text('حداکثر 4 آدرس مجاز است');
                } else {
                    addAddressBtn.prop('disabled', false).text('+ افزودن آدرس جدید');
                }

                // Attach event listeners for actions
                attachAddressEventListeners();

                // Set initial hidden fields based on the selected address
                updateHiddenAddressFields();
            }

            function attachAddressEventListeners() {
                // Radio change listener (for selection)
                $('.address-radio').off('change').on('change', function() {
                    $('.address-item').removeClass('border-primary bg-white').addClass('border-light');
                    $(this).closest('.address-item').addClass('border-primary bg-white').removeClass('border-light');
                    updateHiddenAddressFields();
                });

                // Edit button listener
                $('.edit-address-btn').off('click').on('click', function() {
                    const addressId = $(this).data('id');
                    const addressData = userAddresses.find(a => a.id == addressId);
                    if (addressData) {
                        currentEditId = addressId; // Set current ID for editing
                        populateAddressForm(addressData);
                        toggleAddressForm(true, 'ویرایش آدرس');
                    }
                });

                // Delete button listener (Requires modal confirmation logic which is omitted for brevity)
                $('.delete-address-btn').off('click').on('click', function() {
                    const addressId = $(this).data('id');
                    if (confirm('آیا مطمئن هستید که می‌خواهید این آدرس را حذف کنید؟')) {
                        deleteAddress(addressId);
                    }
                });
            }

            /**
             * Fetches user addresses via AJAX.
             */
            function loadUserAddresses() {
                const $addressList = $('#address-section');
                $addressList.html('<div class="text-center p-3 text-muted" id="address-loading-message">در حال بارگذاری آدرس‌ها...</div>');

                $.ajax({
                    url: "{{ route('user.addresses.index') }}", // Assuming this route exists
                    type: "GET",
                    success: function (res) {
                        if (res.status && res.addresses) {
                            userAddresses = res.addresses;
                            renderAddresses();
                        } else {
                            userAddresses = [];
                            renderAddresses();
                        }
                    },
                    error: function (xhr) {
                        userAddresses = [];
                        renderAddresses();
                        showAddressFeedback('خطا در بارگذاری آدرس‌ها: ' + (xhr.status === 404 ? 'مسیر API آدرس‌ها یافت نشد.' : 'خطای سرور.'), 'danger');
                    }
                });
            }


            /**
             * Helper: Update Hidden Address Fields based on selected radio button
             * (This is required for the main profile page to know the selected address data)
             */
            function updateHiddenAddressFields() {
                // NOTE: This logic requires hidden inputs in the main profile form (`#profileInfoForm`)
                // with IDs like #address_id, #address_first_name, etc.
                const $checkedAddress = $('.address-radio:checked').closest('.address-item');

                if (!$checkedAddress.length) {
                    $('#address_id').val('');
                    // Optionally set default values from the user model if needed
                    return;
                }

                // Data extraction is simplified as components are stored in data attributes
                $('#address_id').val($checkedAddress.data('id') || '');
                $('#address_first_name').val($checkedAddress.data('firstname') || '');
                $('#address_last_name').val($checkedAddress.data('lastname') || '');
                $('#address_mobile').val($checkedAddress.data('mobile') || '');
                $('#address_email').val($checkedAddress.data('email') || '');
                $('#address_company_name').val($checkedAddress.data('company') || '');
            }

            // --- 3. Form Interaction ---

            function toggleAddressForm(show, title = 'افزودن آدرس جدید') {
                addressFormTitle.text(title);
                if (show) {
                    newAddressFormContainer.slideDown(300);
                    addAddressBtn.text('- لغو');
                    // Scroll to form view if necessary
                    modal.animate({ scrollTop: newAddressFormContainer.offset().top - modal.offset().top + modal.scrollTop() - 50 }, 500);
                } else {
                    newAddressFormContainer.slideUp(300);
                    addAddressBtn.text('+ افزودن آدرس جدید');
                    addressForm[0].reset();
                    currentEditId = null;
                    clearAddressErrors();
                }
            }

            function populateAddressForm(addressData) {
                // Clear the form first
                addressForm[0].reset();
                clearAddressErrors();

                // Set hidden ID (for update/edit logic)
                $('#editAddressId').val(addressData.id);

                // Populate fields
                // NOTE: We combine first/last name to match the 'full_name' input field
                $('#new_receiver_name').val(`${addressData.first_name} ${addressData.last_name}`);
                $('#new_plate').val(addressData.plate);
                $('#new_postalCode').val(addressData.post_code);
                $('#new_mobile').val(addressData.mobile);
                $('#new_fullAddress').val(addressData.address);
                $('#new_phone').val(addressData.phone);
                $('#new_companyName').val(addressData.company_name);

                // Load province/city dropdowns and pre-select the values
                fetchIranLocations(null, addressData.province, addressData.city);
            }

            // --- 4. AJAX Handlers ---

            /**
             * Handles saving/updating an address.
             */
            saveAddressBtn.on('click', function(e) {
                e.preventDefault();
                const form = addressForm;
                const url = currentEditId
                    ? `{{ route('user.address.update', ['address' => '__ID__']) }}`.replace('__ID__', currentEditId)
                    : "{{ route('user.address.store') }}";
                const method = currentEditId ? 'PUT' : 'POST'; // Use PUT for updates

                saveAddressBtn.prop('disabled', true).text('در حال ثبت...');
                clearAddressErrors();

                $.ajax({
                    url: url,
                    method: method,
                    data: form.serialize(),
                    success: function(response) {
                        showAddressFeedback(response.message, 'success');
                        toggleAddressForm(false); // Hide and reset form
                        loadUserAddresses(); // Reload the list to show the new/updated address
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            displayAddressErrors(xhr.responseJSON.errors);
                            showAddressFeedback('لطفاً خطاهای موجود در فرم را برطرف کنید.', 'danger');
                        } else {
                            showAddressFeedback('خطا در ثبت آدرس. کد خطا: ' + xhr.status, 'danger');
                        }
                    },
                    complete: function() {
                        saveAddressBtn.prop('disabled', false).text('ثبت و ذخیره آدرس');
                    }
                });
            });

            /**
             * Handles deleting an address.
             */
            function deleteAddress(addressId) {
                $.ajax({
                    url: `{{ route('user.address.destroy', ['address' => '__ID__']) }}`.replace('__ID__', addressId),
                    method: 'DELETE', // Assuming DELETE method for destroy route
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // Laravel needs CSRF for DELETE
                    },
                    success: function(response) {
                        showAddressFeedback(response.message, 'success');
                        loadUserAddresses();
                    },
                    error: function(xhr) {
                        showAddressFeedback('خطا در حذف آدرس. کد خطا: ' + xhr.status, 'danger');
                    }
                });
            }

            // --- 5. Modal Lifecycle ---

            // Show New Address Form button handler
            addAddressBtn.on('click', function() {
                // If the form is currently hidden or we are not in edit mode
                if (newAddressFormContainer.is(':hidden') || currentEditId !== null) {
                    currentEditId = null; // Ensure new address mode
                    addressForm[0].reset();
                    clearAddressErrors();
                    fetchIranLocations(); // Ensure locations are loaded/reset
                    toggleAddressForm(true);
                } else {
                    // If showing, hide it
                    toggleAddressForm(false);
                }
            });

            // Cancel button handler
            $('#cancelAddressBtn').on('click', function() {
                toggleAddressForm(false);
            });


            // When the modal is shown, fetch data
            modal.on('shown.bs.modal', function () {
                loadUserAddresses();
                fetchIranLocations();
            });

            // When the modal is hidden, reset state
            modal.on('hidden.bs.modal', function () {
                toggleAddressForm(false);
                // Clear the main profile hidden fields based on last selection when closing
                updateHiddenAddressFields();
            });

            // Initial call to load location data when the page loads (optional, but good for speed)
            // fetchIranLocations();
        });
    </script>


@endpush
