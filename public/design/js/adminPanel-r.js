
// ===============Photo Preview============
// ========================================
// Preview image when user selects a file
const imageInput = document.getElementById("productImage");
const preview = document.getElementById("previewImage");

imageInput.addEventListener("change", function () {
  const file = this.files[0];
  if (file) preview.src = URL.createObjectURL(file);
});
// ===============Add Feature with Delete Option============
// =========================================================
// Add features dynamically
const addFeatureBtn = document.getElementById("addFeatureBtn");
const featureInput = document.getElementById("featureInput");
const featureList = document.getElementById("featureList");

addFeatureBtn.addEventListener("click", () => {
  const feature = featureInput.value.trim();
  if (feature !== "") {
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.innerHTML = `
      ${feature}
      <button class="trashSvg" onclick="this.parentElement.remove()" title="حذف">
        <svg width="18" height="18" fill="#cd1818" class="bi bi-trash3" viewBox="0 0 16 16">
          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
        </svg>
      </button>
    `;
    featureList.appendChild(li);
    featureInput.value = "";
    featureInput.focus();
  }
});
// ===============Monthly Sales Chart============
// ==============================================
// Chart.js - Monthly Sales Data
const ctx = document.getElementById('monthlySalesChart').getContext('2d');
const monthlySalesChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
    datasets: [{
      label: 'تعداد فروش',
      data: [1200, 1500, 1800, 2200, 1700, 2500, 2700, 2300, 2000, 2100, 2600, 3000],
      backgroundColor: 'rgba(54, 162, 235, 0.7)',
      borderRadius: 10
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false,
        labels: {
          font: {
            family: 'Shabnam'
          }
        }
      },
      tooltip: {
        callbacks: {
          label: ctx => `${ctx.parsed.y} فروش`
        },
        bodyFont: {
          family: 'Shabnam'
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'فروش (تعداد)',
          font: {
            family: 'Shabnam'
          }
        },
        ticks: {
          font: {
            family: 'Shabnam'
          }
        }
      },
      x: {
        title: {
          display: true,
          text: 'ماه',
          font: {
            family: 'Shabnam'
          }
        },
        ticks: {
          font: {
            family: 'Shabnam'
          }
        }
      }
    }
  }
});

//======================= subDetails content
const cards = document.querySelectorAll('.main-card');
const details = document.querySelectorAll('.details-content');

cards.forEach(card => {
  card.addEventListener('click', () => {
    const targetId = card.dataset.target;
    const target = document.getElementById(targetId);

    if (target.classList.contains('show')) return;

    const currentVisible = document.querySelector('.details-content.show');
    const activeArrow = document.querySelector('.arrowCard.active');


    if (currentVisible) {
      currentVisible.classList.remove('show');
      if (activeArrow) activeArrow.classList.remove('active');

      setTimeout(() => {
        currentVisible.style.display = 'none';

        target.style.display = 'block';
        setTimeout(() => {
          target.classList.add('show');
          card.parentElement.querySelector('.arrowCard').classList.add('active');
        }, 10);

      }, 400);
    } else {
      target.style.display = 'block';
      setTimeout(() => {
        target.classList.add('show');
        card.parentElement.querySelector('.arrowCard').classList.add('active');
      }, 10);
    }
  });
});


// ===============Automatic Discount Code Generator============
// ============================================================
// Generate random discount code
function generateCode() {
  const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  let code = "OFF";
  for (let i = 0; i < 6; i++) {
    code += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  document.getElementById("couponCode").value = code;
}
// ===============Sortable Multi Image Upload============
// ======================================================
const sortablePreview = document.getElementById('sortablePreview');
let imageFiles = [];
const MAX_SLOTS = 6;

// --- Helper Functions ---

/**
 * Creates an empty image slot with dashed border styling.
 */
function createEmptySlot() {
    const wrapper = document.createElement('div');
    // Using border-dashed class (assuming it exists or is defined in CSS)
    wrapper.className = 'position-relative border border-2 border-secondary border-dashed rounded overflow-hidden text-center d-flex flex-column align-items-center justify-content-center slot-wrapper';
    wrapper.style.width = '100px';
    wrapper.style.height = '120px';
    wrapper.style.cursor = 'grab';
    wrapper.dataset.filled = 'false'; // Custom attribute to track slot status

    // Placeholder content
    wrapper.innerHTML = `
        <i class="bi bi-image fs-3 text-secondary" style="pointer-events: none;"></i>
        <span class="text-secondary" style="pointer-events: none;">خالی</span>
    `;
    return wrapper;
}

/**
 * Fills an empty slot element with an uploaded image file.
 */
function fillSlot(slotElement, file, imgSrc) {
    slotElement.innerHTML = '';
    slotElement.file = file; // Store the file object on the DOM element
    slotElement.dataset.filled = 'true';

    // Change styling from dashed/secondary to regular border
    slotElement.classList.remove('border-dashed', 'border-secondary', 'border-2');
    slotElement.classList.add('border');

    const img = document.createElement('img');
    img.src = imgSrc;
    img.className = 'w-100';
    img.style.height = '90px';
    img.style.objectFit = 'cover';
    img.alt = 'uploaded';

    const deleteBtn = document.createElement('i');
    deleteBtn.className = 'bi bi-trash3 text-danger mt-1 d-block';
    deleteBtn.style.cursor = 'pointer';
    deleteBtn.title = 'حذف تصویر';
    deleteBtn.addEventListener('click', handleDeleteClick);

    slotElement.appendChild(img);
    slotElement.appendChild(deleteBtn);
}


/**
 * Handles the delete button click: replaces the filled slot with a new empty slot.
 */
function handleDeleteClick(event) {
    const filledWrapper = event.currentTarget.closest('.slot-wrapper');
    if (filledWrapper) {
        // Replace the filled slot with a new empty slot
        filledWrapper.replaceWith(createEmptySlot());
        updateImageFilesOrder(); // Update the main file list
        updateMainPreview();
    }
}

/**
 * Updates the imageFiles array based on the current DOM order (only filled slots).
 */
function updateImageFilesOrder() {
    const newOrder = [];
    // Select all slot wrappers (filled and empty)
    const items = sortablePreview.querySelectorAll('.slot-wrapper');
    items.forEach(item => {
        // Only push files from filled slots
        if (item.dataset.filled === 'true' && item.file instanceof File) {
            newOrder.push(item.file);
        }
    });
    imageFiles = newOrder;
}

/**
 * Updates the main product preview image (top-left).
 */
function updateMainPreview() {
    const previewImg = document.getElementById('previewImage');
    // Find the first slot that is marked as filled
    const firstFilledSlot = sortablePreview.querySelector('[data-filled="true"]');

    if (firstFilledSlot && firstFilledSlot.file) {
        // If a filled slot exists, display its image as the main preview
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
        };
        reader.readAsDataURL(firstFilledSlot.file);
    } else {
        // Otherwise, display the default placeholder image
        previewImg.src = './design/image/peopeo.png';
    }
}

/**
 * Initializes the required number of empty slots (MAX_SLOTS) on load.
 */
function initializeSlots() {
    sortablePreview.innerHTML = ''; // Ensure initial content is cleared
    for (let i = 0; i < MAX_SLOTS; i++) {
        sortablePreview.appendChild(createEmptySlot());
    }
}

// --- Initial Setup ---
initializeSlots();


// --- File Upload Event Handler ---

document.getElementById('productImage').addEventListener('change', function (event) {
    const files = Array.from(event.target.files);
    // Find all currently available empty slots
    const emptySlots = Array.from(sortablePreview.querySelectorAll('[data-filled="false"]'));

    const canAddCount = Math.min(files.length, emptySlots.length);

    if (canAddCount < files.length) {
        alert(`You can add a maximum of ${emptySlots.length} more images. Please select fewer files.`);
    }

    // Only process as many files as there are empty slots
    const filesToProcess = files.slice(0, canAddCount);

    filesToProcess.forEach((file, index) => {
        const reader = new FileReader();
        const slotToFill = emptySlots[index];

        reader.onload = function (e) {
            fillSlot(slotToFill, file, e.target.result);
        };

        reader.readAsDataURL(file);
    });

    // Update the file order and preview after file reading operations complete
    setTimeout(() => {
        updateImageFilesOrder();
        updateMainPreview();
    }, 200);

    // Clear the input file value to allow re-uploading the same files
    event.target.value = '';
});


// --- Drag & Drop with Sortable.js ---

Sortable.create(sortablePreview, {
  animation: 150,
  // Ensure only elements with class .slot-wrapper are draggable
  draggable: '.slot-wrapper',
  onEnd: function () {
    // Extract files with the new order after drag-and-drop
    updateImageFilesOrder();
    updateMainPreview();
  }
});



// ===============Product Purchase Accordion============
// =====================================================
// Add product purchase information dynamically
document.addEventListener('DOMContentLoaded', function () {
  let purchaseCounter = 1;

  function fixNumber(input) {
  const persian = '۰۱۲۳۴۵۶۷۸۹';
  const english = '0123456789';
  return input
    .replace(/[۰-۹]/g, d => english[persian.indexOf(d)])
    .replace(/[^0-9]/g, '');
}

  function isValidNumber(str) {
    const num = Number(str);
    return !isNaN(num) && num > 0;
  }

 document.getElementById('addPurchaseBtn').addEventListener('click', function () {
  const name = document.getElementById('productNameInfo').value;
  const date = document.getElementById('purchaseDate').value.trim();
  const countRaw = document.getElementById('purchaseCount').value.trim();
  const priceRaw = document.getElementById('purchasePrice').value.trim();
  const link = document.getElementById('purchaseLink').value.trim();
  const shop = document.getElementById('shopName').value.trim();

  const count = fixNumber(countRaw);
  const price = fixNumber(priceRaw);

  console.log({
    name, date, count, price, link, shop,
    isValidCount: isValidNumber(count),
    isValidPrice: isValidNumber(price)
  });

  if (!name || !date || !count || !price || !link || !shop ||
      !isValidNumber(count) || !isValidNumber(price)) {
    Swal.fire({
      icon: 'error',
      title: 'خطا در ثبت',
      text: 'لطفاً تمام فیلدها را به‌درستی پر کنید'
    });
    return;
  }

  const accordionId = `collapse${purchaseCounter}`;
  const headingId = `heading${purchaseCounter}`;
  purchaseCounter++;

  const itemHTML = `
    <div class="accordion-item">
      <h2 class="accordion-header" id="${headingId}">
        <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#${accordionId}" aria-expanded="false" aria-controls="${accordionId}">
          <span>${date} - ${name}</span>
        </button>
      </h2>
      <div id="${accordionId}" class="accordion-collapse collapse" aria-labelledby="${headingId}" data-bs-parent="#purchaseList">
        <div class="accordion-body text-end">
          <p><strong>تاریخ خرید:</strong> ${date}</p>
          <p><strong>تعداد خرید:</strong> ${count}</p>
          <p><strong>قیمت خرید:</strong> ${price} ریال</p>
          <p><strong>لینک خرید:</strong> <a href="${link}" target="_blank">${link}</a></p>
          <p><strong>نام فروشگاه:</strong> ${shop}</p>
        </div>
      </div>
    </div>
  `;

  document.getElementById('purchaseList').insertAdjacentHTML('beforeend', itemHTML);

  // ✅ پیام موفقیت
  Swal.fire({
    icon: 'success',
    title: 'کالا با موفقیت اضافه شد!',
    text: 'اطلاعات خرید ثبت شد.',
    confirmButtonText: 'باشه'
  });

  // پاک‌سازی فیلدها
  document.getElementById('productNameInfo').value = '';
  document.getElementById('purchaseDate').value = '';
  document.getElementById('purchaseCount').value = '';
  document.getElementById('purchasePrice').value = '';
  document.getElementById('purchaseLink').value = '';
  document.getElementById('shopName').value = '';
});

});


// ====================================================
//           Definition of category and subcategory
// ====================================================
  let categories = [];

  const addCategoryForm = document.getElementById('addCategoryForm');
  const categoryNameInput = document.getElementById('categoryNameInput');
  const categorySelect = document.getElementById('categorySelect');

  const addSubCategoryForm = document.getElementById('addSubCategoryForm');
  const subCategoryNameInput = document.getElementById('subCategoryNameInput');

  const categoryList = document.getElementById('categoryList');

  //Category selector update
  function updateCategorySelect() {
    categorySelect.innerHTML = '<option value="" disabled selected>یک دسته انتخاب کنید</option>';
    categories.forEach((cat, idx) => {
      categorySelect.innerHTML += `<option value="${idx}">${cat.name}</option>`;
    });
  }

  // Render categories and subcategories as sliders
  function renderCategories() {
    categoryList.innerHTML = '';

    categories.forEach((cat, idx) => {
      // The basic structure of the category
      const categoryDiv = document.createElement('div');
      categoryDiv.className = 'mb-3';

      // Category header that can be clicked to open and close
      const header = document.createElement('div');
      header.className = 'category-header d-flex justify-content-between align-items-center';
      header.textContent = cat.name;

      // Right arrow icon
      const arrowIcon = document.createElement('span');
      arrowIcon.innerHTML = `
        <svg class="rotate-icon"width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6.854 4.646a.5.5 0 0 0-.708.708L8.293 7.5 6.146 9.646a.5.5 0 1 0 .708.708l2.5-2.5a.5.5 0 0 0 0-.708l-2.5-2.5z"/>
        </svg>
      `;
      header.appendChild(arrowIcon);

      //Subcategories
      const subList = document.createElement('ul');
      subList.className = 'subcategories list-unstyled';
      subList.style.display = 'none';

      if(cat.subcategories.length > 0){
        cat.subcategories.forEach(sub => {
          const subLi = document.createElement('li');
          subLi.textContent = sub;
          subList.appendChild(subLi);
        });
      } else {
        const subLi = document.createElement('li');
        subLi.textContent = 'زیر دسته‌ای تعریف نشده';
        subLi.style.color = '#888';
        subList.appendChild(subLi);
      }

      // Add to main category
      categoryDiv.appendChild(header);
      categoryDiv.appendChild(subList);

      //Add to list
      categoryList.appendChild(categoryDiv);

      //Click event to open/close subcategories
      header.addEventListener('click', () => {
        const isVisible = subList.style.display === 'block';
        subList.style.display = isVisible ? 'none' : 'block';
        arrowIcon.querySelector('.rotate-icon').classList.toggle('rotate', !isVisible);
      });
    });
  }

 // Add category
addCategoryForm.addEventListener('submit', e => {
  e.preventDefault();
  const newCatName = categoryNameInput.value.trim();

  if (!newCatName) {
    alert('نام دسته نمی‌تواند خالی باشد');
    return;
  }

  if (categories.some(c => c.name === newCatName)) {
    alert('این دسته قبلاً وجود دارد');
    return;
  }

  if (categories.length >= 4) {
    alert('حداکثر ۴ دسته می‌توانید اضافه کنید');
    return;
  }

  categories.push({ name: newCatName, subcategories: [] });

  categoryNameInput.value = '';
  updateCategorySelect();
  renderCategories();
});


  // Add subcategory
  addSubCategoryForm.addEventListener('submit', e => {
    e.preventDefault();
    const selectedCatIndex = categorySelect.value;
    const newSubName = subCategoryNameInput.value.trim();
    if(selectedCatIndex === '') return alert('یک دسته را انتخاب کنید');
    if(!newSubName) return alert('نام زیر دسته نمی‌تواند خالی باشد');

    if(categories[selectedCatIndex].subcategories.includes(newSubName)){
      return alert('این زیر دسته قبلا برای این دسته تعریف شده');
    }

    categories[selectedCatIndex].subcategories.push(newSubName);
    subCategoryNameInput.value = '';
    renderCategories();
  });

  // initialization
  updateCategorySelect();
  renderCategories();


// ===========================================
//               for sale
// ===========================================
document.addEventListener('DOMContentLoaded', function () {
  const discountForm = document.getElementById('discountForm');

  discountForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const start = document.getElementById('startDate').value.trim();
    const end = document.getElementById('endDate').value.trim();

    // Solar date format validation function
    function isValidJalaliDate(date) {
      const regex = /^14[0-9]{2}\/(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/;
      return regex.test(date);
    }

    // Converting solar date to number for comparison (without library dependency)
    function jalaliToComparableNumber(date) {
      return parseInt(date.replaceAll('/', ''), 10);
    }

    // Credit check
    if (!isValidJalaliDate(start)) {
      Swal.fire({
        icon: 'error',
        title: 'خطا در تاریخ شروع',
        text: 'فرمت تاریخ شروع معتبر نیست (مثلاً: ۱۴۰۴/۰۴/۲۱)'
      });
      return;
    }

    if (!isValidJalaliDate(end)) {
      Swal.fire({
        icon: 'error',
        title: 'خطا در تاریخ پایان',
        text: 'فرمت تاریخ پایان معتبر نیست (مثلاً: ۱۴۰۴/۰۴/۲۵)'
      });
      return;
    }

    if (jalaliToComparableNumber(end) < jalaliToComparableNumber(start)) {
      Swal.fire({
        icon: 'error',
        title: 'ترتیب تاریخ‌ها نادرست است',
        text: 'تاریخ پایان نمی‌تواند قبل از تاریخ شروع باشد'
      });
      return;
    }

    // ✅ If everything was correct, display a success message.
    Swal.fire({
      icon: 'success',
      title: 'کد تخفیف با موفقیت ثبت شد!',
      text: 'اطلاعات وارد شده معتبر است.',
      confirmButtonText: 'باشه'
    });

     discountForm.reset();
  });
});
// ===========================================
//               end for sale
// ===========================================

 // =============================================
//  script for the number of characters allowed
// ==============================================
const textarea = document.getElementById('smsMessage');
const charCounter = document.getElementById('charCount');
const byteCounter = document.getElementById('byteCounter');

textarea.addEventListener('input', () => {
  let length = textarea.value.length;

  // Calculate number of messages
  let messages = Math.ceil(length / 70) || 0;

  // Limit input to 210 characters (3 messages)
  if (length > 210) {
    textarea.value = textarea.value.substring(0, 210);
    length = 210;
    messages = 3;
  }

  // Set max chars depending on the message number
  let maxChars = messages * 70;
  if (maxChars === 0) maxChars = 70; // When empty

  // Update counter text
  charCounter.textContent = `${length} / ${maxChars}  _  پیام: ${messages} / 3`;

  // Change counter color
  if (messages === 1) {
    charCounter.style.color = "green";
  } else if (messages === 2) {
    charCounter.style.color = "orange";
  } else if (messages === 3) {
    charCounter.style.color = "#ff4b04";
  } else {
    charCounter.style.color = "inherit";
  }

  // Show/Hide byteCounter
  if (length === maxChars && messages <= 3) {
    byteCounter.classList.remove('d-none');
  } else {
    byteCounter.classList.add('d-none');
  }
});

// =============================================
// end script for the number of characters allowed
// ==============================================


// ========================================================
// To click the row and edit button in the group list table
// ========================================================

  document.addEventListener("DOMContentLoaded", function () {
    const groupListSection = document.getElementById("groupListSection");
    const groupMembersSection = document.getElementById("groupMembersSection");
    const currentGroupNameEl = document.getElementById("currentGroupName");
    const backToGroupsBtn = document.getElementById("backToGroups");
    let memberCounter = 1;

    // Event handler function for edit buttons
    function attachEditEvents() {
      const editButtons = document.querySelectorAll(".edit-btn");

      editButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
          e.stopPropagation();

          const tr = this.closest("tr");
          const groupId = tr.children[0].innerText.trim();
          const currentName = tr.children[1].innerText.trim();
          const subCount = tr.children[2].innerText.trim();

          tr.innerHTML = `
            <td>${groupId}</td>
            <td><input type="text" class="form-control form-control-sm" id="editName-${groupId}" value="${currentName}"></td>
            <td class="text-center">${subCount}</td>
            <td class="text-center">
              <button class="btn btn-sm btn-success save-btn" style="max-width:78.16px;">
              <svg width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/>
              </svg>
              ذخیره</button>
              <button class="btn btn-sm btn-secondary cancel-btn p-1" style="max-width:78.16px;">
              <svg width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
              </svg>
              انصراف</button>
            </td>
          `;

          // Save changes
          tr.querySelector(".save-btn").addEventListener("click", function (e) {
            e.stopPropagation();
            const newName = document.getElementById(`editName-${groupId}`).value.trim();
            if (newName) {
              tr.innerHTML = `
                <td>${groupId}</td>
                <td>${newName}</td>
                <td class="text-center">${subCount}</td>
                <td class="text-center">
                  <button class="btn btn-sm btn-outline-primary edit-btn">
                    <i class="bi bi-pencil-square"></i> ویرایش
                  </button>
                   <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i> حذف
                  </button>
                </td>
              `;
              attachEditEvents(); // Re-bind the edit events after saving
            }
          });

          // Cancel editing
          tr.querySelector(".cancel-btn").addEventListener("click", function (e) {
            e.stopPropagation();
            tr.innerHTML = `
              <td>${groupId}</td>
              <td>${currentName}</td>
              <td class="text-center">${subCount}</td>
              <td class="text-center">
                <button class="btn btn-sm btn-outline-primary edit-btn">
                  <i class="bi bi-pencil-square"></i> ویرایش
                </button>
                 <button class="btn btn-sm btn-outline-danger">
                  <i class="bi bi-trash"></i> حذف
                </button>
              </td>
            `;
            attachEditEvents(); // Re-bind the edit events after cancel
          });
        });
      });
    }

    // Initial event binding
    attachEditEvents();

    // Row click event – only if clicked outside of a button or input
    document.querySelectorAll("#groupList tr").forEach((row) => {
      row.addEventListener("click", function (e) {
        if (e.target.closest("button") || e.target.closest("input")) return;

        const groupName = row.children[1].innerText;
        currentGroupNameEl.textContent = groupName;
        groupListSection.classList.add("d-none");
        groupMembersSection.classList.remove("d-none");
        memberCounter = 1;
      });
    });

    // Return to group list view
    backToGroupsBtn.addEventListener("click", () => {
      groupMembersSection.classList.add("d-none");
      groupListSection.classList.remove("d-none");
    });

  });

// ===============================================================
// end To click the row and edit button in the group list table
// ===============================================================


// ===============================================================
// Edit Member Modal
// ===============================================================
document.addEventListener("DOMContentLoaded", function () {
  const memberList = document.getElementById("memberList");
  const editModal = new bootstrap.Modal(document.getElementById("editMemberModal"));
  const editForm = document.getElementById("editMemberForm");
  const nameInput = document.getElementById("editMemberName");
  const phoneInput = document.getElementById("editMemberPhone");

  let currentRow = null; // stores the row being edited

  // Handle Edit button click
  memberList.addEventListener("click", function (e) {
    if (e.target.closest(".btn-outline-primary")) {
      const btn = e.target.closest("button");
      currentRow = btn.closest("tr");

      const currentName = currentRow.children[1].textContent.trim();
      const currentPhone = currentRow.children[2].textContent.trim();

      nameInput.value = currentName;
      phoneInput.value = currentPhone;

      editModal.show();
    }
  });

  // Handle Save button in modal
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const updatedName = nameInput.value.trim();
    const updatedPhone = phoneInput.value.trim();

    if (currentRow) {
      currentRow.children[1].textContent = updatedName;
      currentRow.children[2].textContent = updatedPhone;
    }

    editModal.hide();
  });
});
// ===============================================================
// end Edit Member Modal
// ===============================================================


// ===============================================================
// createPagination
// ===============================================================
function createPagination(pages, page) {
  let str = '<ul>';
  let active;
  let pageCutLow = page - 1;
  let pageCutHigh = page + 1;

  if (page > 1) {
    str += `<li class="page-item previous no"><a data-page="${page-1}"><i class="bi bi-chevron-double-left"></i></a></li>`;
  }

  if (pages < 6) {
    for (let p = 1; p <= pages; p++) {
      active = page == p ? "active" : "no";
      str += `<li class="page-item ${active}"><a data-page="${p}">${p}</a></li>`;
    }
  } else {
    if (page > 2) {
      str += `<li class="page-item no"><a data-page="1">1</a></li>`;
      if (page > 3) {
        str += `<li class="out-of-range"><a data-page="${page-2}">...</a></li>`;
      }
    }

    if (page === 1) pageCutHigh += 2;
    else if (page === 2) pageCutHigh += 1;

    if (page === pages) pageCutLow -= 2;
    else if (page === pages-1) pageCutLow -= 1;

    for (let p = pageCutLow; p <= pageCutHigh; p++) {
      if (p === 0) p = 1;
      if (p > pages) continue;
      active = page == p ? "active" : "no";
      str += `<li class="page-item ${active}"><a data-page="${p}">${p}</a></li>`;
    }

    if (page < pages-1) {
      if (page < pages-2) {
        str += `<li class="out-of-range"><a data-page="${page+2}">...</a></li>`;
      }
      str += `<li class="page-item no"><a data-page="${pages}">${pages}</a></li>`;
    }
  }

  if (page < pages) {
    str += `<li class="page-item next no"><a data-page="${page+1}"><i class="bi bi-chevron-double-right"></i></a></li>`;
  }

  str += '</ul>';
  return str;
}

// Apply pagination to all elements with class "pagination"
document.querySelectorAll('.pagination').forEach(pagination => {
  const pages = parseInt(pagination.dataset.pages);
  const current = parseInt(pagination.dataset.current);

  function render(page) {
    pagination.innerHTML = createPagination(pages, page);
    pagination.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        const newPage = parseInt(link.dataset.page);
        render(newPage);
      });
    });
  }

  render(current);
});
// ===============================================================
// end createPagination
// ===============================================================

// ===============================================================
// manageOrder
// ===============================================================

    // دیتای تست سفارش‌ها
    const orders = [
      {
        id: "12345",
        user: "علیرضا راد",
        phone: "09121234567",
        province: "تهران",
        city: "تهران",
        address: "تهران، خیابان ولیعصر، کوچه گلستان",
        date: "1404/06/15 - 14:20",
        payment: "15000000 تومان",
        shipping: "پست",
        status: "در حال جمع آوری",
        items: [
          { name: "گوشی موبایل", qty: 1, price: "15,000,000 تومان" },
          { name: "شارژر", qty: 2, price: "600,000 تومان" }
        ]
      },
      {
        id: "67890",
        user: "مریم احمدی",
        phone: "09351234567",
        province: "اصفهان",
        city: "اصفهان",
        address: "اصفهان، میدان نقش جهان، پلاک 22",
        date: "1404/06/16 - 09:45",
        payment: "450000 تومان",
        shipping: "پیک",
        status: "ارسال شده",
        items: [
          { name: "کتاب", qty: 3, price: "450,000 تومان" }
        ]
      }
    ];

    const tbody = document.getElementById("ordersTable");
    const orderDetails = document.getElementById("orderDetails");

    // Rendering orders
    function renderOrders(list) {
      tbody.innerHTML = "";
      list.forEach((order, index) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${index + 1}</td> <!-- Row number -->
          <td>${order.id}</td>
          <td>${order.user}</td>
          <td>${order.phone}</td>
          <td>${order.date}</td>
          <td>${order.payment}</td>
          <td>${order.shipping}</td>
          <td>
            <span class="status-badge status-${order.status.replace(/\s+/g, "-")}">
              ${order.status}
            </span>
          </td>
          <td>
            <button class="btn btn-sm text-white svgHover" onclick="showDetails('${order.id}')">
              &#128065;&#65039;
            </button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }


    //View order details
    function showDetails(id) {
      const order = orders.find(o => o.id === id);
      orderDetails.innerHTML = `
      <div class="row g-3">
        <div class="col-md-6"><strong>کد سفارش:</strong> ${order.id}</div>
        <div class="col-md-6"><strong>نام کاربر:</strong> ${order.user}</div>

        <div class="col-md-6"><strong>شماره تماس:</strong> ${order.phone}</div>
        <div class="col-md-6"><strong>استان:</strong> ${order.province}</div>

        <div class="col-md-6"><strong>شهر:</strong> ${order.city}</div>
        <div class="col-md-6"><strong>آدرس:</strong> ${order.address}</div>

        <div class="col-md-6"><strong>زمان ثبت:</strong> ${order.date}</div>
        <div class="col-md-6"><strong>مبلغ پرداختی:</strong> ${order.payment}</div>

        <div class="col-md-6"><strong>روش ارسال:</strong> ${order.shipping}</div>
        <div class="col-md-6">
          <strong>وضعیت:</strong>
          <select class="form-select w-auto d-inline-block" onchange="changeStatus('${order.id}', this.value)">
            <option ${order.status === "ارسال شده" ? "selected" : ""}>ارسال شده</option>
            <option ${order.status === "در حال جمع آوری" ? "selected" : ""}>در حال جمع آوری</option>
            <option ${order.status === "لغو شده" ? "selected" : ""}>لغو شده</option>
            <option ${order.status === "آماده برای ارسال" ? "selected" : ""}>آماده برای ارسال</option>
          </select>
        </div>
      </div>
      <hr>
      <h6>محصولات سفارش:</h6>
      <ul>
        ${order.items.map(i => `<li>${i.name} (تعداد: ${i.qty}) - ${i.price}</li>`).join("")}
      </ul>
    `;

      new bootstrap.Modal(document.getElementById("orderModal")).show();
    }

    // Change of status
    function changeStatus(id, newStatus) {
      const order = orders.find(o => o.id === id);
      order.status = newStatus;
      renderOrders(orders);
    }

    // ---------- Province/city filter ----------
    fetch("design/json/iran-provinces-cities.json")
      .then(response => response.json())
      .then(data => {
        const provinces = data.provinces;

        function setupProvinceCityFilter(prefix) {
          const provinceSelect = document.getElementById(`provinceSelect-${prefix}`);
          const citySelect = document.getElementById(`citySelect-${prefix}`);

          provinces.forEach(province => {
            const option = document.createElement("option");
            option.value = province.name;
            option.textContent = province.name;
            provinceSelect.appendChild(option);
          });

          provinceSelect.addEventListener("change", function () {
            const selectedProvince = provinces.find(p => p.name === this.value);
            citySelect.innerHTML = "";
            if (selectedProvince && selectedProvince.cities.length > 0) {
              citySelect.disabled = false;
              selectedProvince.cities.forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
              });
            } else {
              citySelect.disabled = true;
              citySelect.innerHTML = `<option>هیچ شهری موجود نیست</option>`;
            }
          });
        }

        setupProvinceCityFilter("mobile");
        setupProvinceCityFilter("desktop");
      });

    // ---------- Apply filter function ----------
    function applyFilter(prefix) {
      const provinceValue = document.getElementById(`provinceSelect-${prefix}`).value.trim();
      const cityValue = document.getElementById(`citySelect-${prefix}`).value.trim();
      const orderNumberInput = document.getElementById(`orderNumber-${prefix}`).value.trim();

      const shippingMethods = [];
      if (document.getElementById(`post-${prefix}`).checked) shippingMethods.push("پست");
      if (document.getElementById(`tipax-${prefix}`).checked) shippingMethods.push("تیپاکس");
      if (document.getElementById(`courier-${prefix}`).checked) shippingMethods.push("پیک");

      const statuses = [];
      if (document.getElementById(`sent-${prefix}`).checked) statuses.push("ارسال شده");
      if (document.getElementById(`collecting-${prefix}`).checked) statuses.push("در حال جمع آوری");
      if (document.getElementById(`ready-${prefix}`).checked) statuses.push("آماده برای ارسال");

      const amountInput = document.getElementById(`PaymentAmount-${prefix}`).value.trim();
      const faToEn = str => str.replace(/[۰-۹]/g, d => "۰۱۲۳۴۵۶۷۸۹".indexOf(d));
      const rawMin = faToEn(amountInput.replace(/[^\d]/g, ''));
      const minAmount = rawMin ? parseInt(rawMin) : 0;

      // Apply to order list
      const filteredOrders = orders.filter(o => {
        const paymentAmount = parseInt(o.payment.replace(/[^\d]/g, '')) || 0;

        const matchProvince = provinceValue === "" || o.province === provinceValue;
        const matchCity = cityValue === "" || o.city === cityValue;
        const matchOrderNumber = orderNumberInput === "" || o.id.includes(orderNumberInput);
        const matchShipping = shippingMethods.length === 0 || shippingMethods.includes(o.shipping);
        const matchStatus = statuses.length === 0 || statuses.includes(o.status);
        const matchPaymentAmount = amountInput === "" || paymentAmount === minAmount;

        return matchProvince && matchCity && matchOrderNumber && matchShipping && matchStatus && matchPaymentAmount;
      });

      renderOrders(filteredOrders);
    }

    // Apply filter buttons
    document.getElementById("applyFilter-mobile").addEventListener("click", e => {
      e.preventDefault();
      applyFilter("mobile");
    });

    document.getElementById("applyFilter-desktop").addEventListener("click", e => {
      e.preventDefault();
      applyFilter("desktop");
    });

    // Initial rendering
    renderOrders(orders);
// ===============================================================
//                        end manageOrder
// ===============================================================


// ===============================================================
//                       setting profile admin
// ===============================================================
// ===== Step Wizard Existing Code =====
let settingsCurrentStep = 0;
const settingsSteps = document.querySelectorAll(".profile-settings-form .step");
const settingsPrevBtn = document.getElementById("settings-prev-btn");
const settingsNextBtn = document.getElementById("settings-next-btn");
const settingsProgress = document.getElementById("settings-progress");

function showSettingsStep(index) {
    settingsSteps.forEach((step, i) => {
        step.classList.toggle("active", i === index);
    });
    settingsProgress.style.width = ((index + 1) / settingsSteps.length) * 100 + "%";
    settingsPrevBtn.style.display = index === 0 ? "none" : "inline-block";
    settingsNextBtn.textContent = index === settingsSteps.length - 1 ? "ذخیره" : "بعدی";
}

showSettingsStep(settingsCurrentStep);

// ===== Password Validation =====
const newPasswordInput = document.getElementById("new-password");
const repeatPasswordInput = document.getElementById("repeat-password");

const rules = {
    length: document.getElementById("rule-length"),
    lower: document.getElementById("rule-lower"),
    upper: document.getElementById("rule-upper"),
    number: document.getElementById("rule-number"),
    special: document.getElementById("rule-special"),
    match: document.getElementById("rule-match")
};

function validatePasswordLive() {
    const value = newPasswordInput.value;
    rules.length.classList.toggle("text-success", value.length >= 8);
    rules.length.classList.toggle("text-danger", value.length < 8);

    rules.lower.classList.toggle("text-success", /[a-z]/.test(value));
    rules.lower.classList.toggle("text-danger", !/[a-z]/.test(value));

    rules.upper.classList.toggle("text-success", /[A-Z]/.test(value));
    rules.upper.classList.toggle("text-danger", !/[A-Z]/.test(value));

    rules.number.classList.toggle("text-success", /\d/.test(value));
    rules.number.classList.toggle("text-danger", !/\d/.test(value));

    rules.special.classList.toggle("text-success", /[!@#$%^&*(),.?":{}|<>]/.test(value));
    rules.special.classList.toggle("text-danger", !/[!@#$%^&*(),.?":{}|<>]/.test(value));

    // Match validation
    const repeatVal = repeatPasswordInput.value;
    rules.match.classList.toggle("text-success", value && value === repeatVal);
    rules.match.classList.toggle("text-danger", value !== repeatVal);
}

newPasswordInput.addEventListener("input", validatePasswordLive);
repeatPasswordInput.addEventListener("input", validatePasswordLive);

// ===== Step Navigation with Validation =====
settingsNextBtn.addEventListener("click", () => {
    if (settingsSteps[settingsCurrentStep].id === "step-password") {
        const password = newPasswordInput.value;
        const repeat = repeatPasswordInput.value;

        const lengthValid = password.length >= 8;
        const lowerValid = /[a-z]/.test(password);
        const upperValid = /[A-Z]/.test(password);
        const numberValid = /\d/.test(password);
        const specialValid = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const matchValid = password === repeat;

        if (!lengthValid || !lowerValid || !upperValid || !numberValid || !specialValid || !matchValid) {
            Swal.fire({
                icon: 'error',
                title: 'رمز عبور نامعتبر',
                html: `
                    ${!lengthValid ? "• حداقل 8 کاراکتر<br>" : ""}
                    ${!lowerValid ? "• یک حرف کوچک<br>" : ""}
                    ${!upperValid ? "• یک حرف بزرگ<br>" : ""}
                    ${!numberValid ? "• یک عدد<br>" : ""}
                    ${!specialValid ? "• یک کاراکتر خاص<br>" : ""}
                    ${!matchValid ? "• رمزها یکسان نیستند<br>" : ""}
                `
            });
            return;
        }
    }

    if (settingsCurrentStep < settingsSteps.length - 1) {
        settingsCurrentStep++;
        showSettingsStep(settingsCurrentStep);
    } else {
        alert("اطلاعات ذخیره شد!");
    }
});

settingsPrevBtn.addEventListener("click", () => {
    if (settingsCurrentStep > 0) {
        settingsCurrentStep--;
        showSettingsStep(settingsCurrentStep);
    }
});

// ===== Profile Image Preview =====
document.getElementById("settings-profile-image").addEventListener("change", function(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById("settings-profile-preview").src = URL.createObjectURL(file);
    }
});
// ===== Toggle Password Visibility =====
document.querySelectorAll('.input-group').forEach(group => {
  const input = group.querySelector('input');
  const svgs = group.querySelectorAll('.toggle-eye'); // همه svg ها

  svgs.forEach(svg => {
    svg.addEventListener('click', () => {
      if (!input) return;

      if (input.type === 'password') {
        input.type = 'text';
        svgs.forEach(s => s.classList.toggle('d-none'));
      } else {
        input.type = 'password';
        svgs.forEach(s => s.classList.toggle('d-none'));
      }
    });
  });
});


// ===============================================================
// used API
// ===============================================================
  document.getElementById('sendBtn').onclick = function(event) {
    event.preventDefault();

    const apiKey = "7bnCV9x109lA49hn9OdWJgNUi1d7IgmMb84N4HzLXcotcrih";
    const lineNumber = "9830002108003783";
    const mobile = "09171896445";
    const templateId = "107934";

    // send sms
    var headers1 = new Headers();
    headers1.append("Content-Type", "application/json");
    headers1.append("x-api-key", apiKey);

    var body1 = JSON.stringify({
      lineNumber: lineNumber,
      messageText: "سلام! این یک پیامک تستی است.",
      mobiles: [mobile]
    });

    var requestOptions1 = {
      method: 'POST',
      headers: headers1,
      body: body1,
      redirect: 'follow'
    };

    fetch("https://api.sms.ir/v1/send", requestOptions1)
      .then(response => response.json())
      .then(result1 => {
        document.getElementById('output').textContent = "پیامک ساده:\n" + JSON.stringify(result1, null, 2);

        var headers2 = new Headers();
        headers2.append("Content-Type", "application/json");
        headers2.append("Accept", "text/plain");
        headers2.append("x-api-key", apiKey);

        var body2 = JSON.stringify({
          mobile: mobile,
          templateId: templateId,
          parameters: [
            { name: "code", value: "123456" },
            { name: "test", value: "10" }
          ]
        });

        var requestOptions2 = {
          method: 'POST',
          headers: headers2,
          body: body2,
          redirect: 'follow'
        };

        return fetch("https://api.sms.ir/v1/send/verify", requestOptions2);
      })
      .then(response => response.text())
      .then(result2 => {
        document.getElementById('output').textContent += "\n\nپیامک تاییدیه قالب‌دار:\n" + result2;
        console.log(result2);
      })
      .catch(error => {
        document.getElementById('output').textContent = 'Error: ' + error;
        console.error(error);
      });
  };
// ===============================================================
//  end used API
// ===============================================================


// ===============================================================
//  themes
// ===============================================================
//*********** main baner **************
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById('mainBannerForm');
  const bannerInputs = document.querySelectorAll('input[type="file"][id^="bannerUpload"]');

  // 🔸 Preview & validate for each banner input
  bannerInputs.forEach((input, index) => {
    const preview = document.getElementById(`bannerPreview${index + 1}`);

    input.addEventListener('change', e => {
      const file = e.target.files[0];
      if (file) {
        const img = new Image();
        img.onload = function() {
          if (this.width < 1248 || this.height < 275) {
            Swal.fire({
              icon: 'warning',
              title: 'ابعاد تصویر کوچک است!',
              text: 'ابعاد تصویر باید حداقل 1248px در 275px باشد.',
              confirmButtonText: 'باشه'
            });
            input.value = '';
            preview.src = 'design/image/baner.png';
          } else {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
          }
        };
        img.src = URL.createObjectURL(file);
      }
    });
  });

  // 🔸 Handle form submission
  form.addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData();
    let hasFile = false;

    bannerInputs.forEach(input => {
      if (input.files[0]) {
        formData.append('banners[]', input.files[0]);
        hasFile = true;
      }
    });

    if (!hasFile) {
      Swal.fire({
        icon: 'warning',
        title: 'توجه!',
        text: 'لطفاً حداقل یک بنر انتخاب کنید.',
        confirmButtonText: 'باشه'
      });
      return;
    }

    fetch('upload_banner.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: 'موفق!',
            text: 'بنرها با موفقیت بروزرسانی شدند.',
            confirmButtonText: 'باشه'
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'خطا!',
            text: 'در آپلود بنر مشکلی پیش آمد.',
            confirmButtonText: 'باشه'
          });
        }
      })
      .catch(() => {
        Swal.fire({
          icon: 'error',
          title: 'خطا!',
          text: 'ارتباط با سرور برقرار نشد.',
          confirmButtonText: 'باشه'
        });
      });
  });
});

//*********** end main baner **************

// ********** 4-baner **********
document.querySelectorAll('.banner-row-form').forEach(form => {
  const fileInput = form.querySelector('input[type="file"]');
  const imgEl = form.querySelector('img');
  const urlInput = form.querySelector('input[type="url"]');
  const label = form.querySelector('.changeImg');

  // کلیک روی دکمه تغییر تصویر
  label.addEventListener('click', e => {
    e.preventDefault();
    fileInput.click();
  });

  // اعتبارسنجی ابعاد هنگام انتخاب تصویر
  fileInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) return;

    const img = new Image();
    img.onload = function() {
      const minWidth = 296;
      const minHeight = 120;

      if (this.width < minWidth || this.height < minHeight) {
        Swal.fire({
          icon: 'warning',
          title: 'ابعاد تصویر کوچک است!',
          text: `حداقل عرض: ${minWidth}px و ارتفاع: ${minHeight}px باشد.`,
          confirmButtonText: 'باشه'
        });
        fileInput.value = ''; // پاک کردن فایل
      } else {
        imgEl.src = img.src; // نمایش پیش‌نمایش
      }
    };
    img.src = URL.createObjectURL(file);
  });

  // ارسال فرم
  form.addEventListener('submit', e => {
    e.preventDefault();
    const file = fileInput.files[0];

    if (!file) {
      Swal.fire({
        icon: 'warning',
        title: 'توجه!',
        text: 'لطفاً ابتدا فایلی انتخاب کنید.',
        confirmButtonText: 'باشه'
      });
      return;
    }

    const img = new Image();
    img.onload = function() {
      const minWidth = 296;
      const minHeight = 120;

      if (this.width < minWidth || this.height < minHeight) {
        Swal.fire({
          icon: 'warning',
          title: 'ابعاد تصویر کوچک است!',
          text: `حداقل عرض: ${minWidth}px و ارتفاع: ${minHeight}px باشد.`,
          confirmButtonText: 'باشه'
        });
        return;
      }

      // آپلود تصویر و لینک
      const formData = new FormData();
      formData.append('banner', file);
      formData.append('url', urlInput.value);

      fetch('upload_four_banner.php', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          Swal.fire({
            icon: data.success ? 'success' : 'error',
            title: data.success ? 'موفق!' : 'خطا!',
            text: data.success ? 'بنر بروزرسانی شد.' : 'مشکلی در آپلود پیش آمد.'
          });
        })
        .catch(() => {
          Swal.fire({ icon: 'error', title: 'خطا!', text: 'ارتباط با سرور برقرار نشد.' });
        });
    };
    img.src = URL.createObjectURL(file);
  });
});
// *********** end 4-baner ***********

// *********** saleLayout ***********
document.addEventListener("DOMContentLoaded", () => {
  const slots = document.querySelectorAll(".slot");
  let draggedSlot = null;

  slots.forEach(slot => {
    slot.setAttribute("draggable", "true");

    slot.addEventListener("dragstart", (e) => {
      draggedSlot = slot;
      slot.classList.add("dragging");
      e.dataTransfer.effectAllowed = "move";
    });

    slot.addEventListener("dragend", () => {
      slot.classList.remove("dragging");
      draggedSlot = null;
    });

    slot.addEventListener("dragover", (e) => {
      e.preventDefault();
      e.dataTransfer.dropEffect = "move";
      slot.classList.add("drag-over");
    });

    slot.addEventListener("dragleave", () => {
      slot.classList.remove("drag-over");
    });

    slot.addEventListener("drop", () => {
      slot.classList.remove("drag-over");
      if (draggedSlot && draggedSlot !== slot) {
        const parent1 = draggedSlot.parentNode;
        const parent2 = slot.parentNode;

        const temp = document.createElement("div");
        parent1.replaceChild(temp, draggedSlot);
        parent2.replaceChild(draggedSlot, slot);
        parent1.replaceChild(slot, temp);
      }
    });
  });
});
// *********** end saleLayout ***********


// ===============================================================
//  end themes
// ===============================================================


// ===============================================================
//  megaMenu
// ===============================================================

  const menuList = document.getElementById("menuList");
  const addMainMenuBtn = document.getElementById("addMainMenuBtn");
  const mainMenuName = document.getElementById("mainMenuName");
  const mainMenuIcon = document.getElementById("mainMenuIcon");

  let megaMenuData = [];

  // render all menu items
  function renderMenus() {
    menuList.innerHTML = "";
    megaMenuData.forEach((menu, index) => {
      const card = document.createElement("div");
      card.className = "card mb-3";
      card.innerHTML = `
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <img src="${menu.icon || "./design/image/folder.png"}" alt="" width="20" class="me-1">
            <strong>${menu.title}</strong>
          </div>
          <div>
            <button class="btn btn-sm btn-primary me-2" onclick="addSubmenu(${index})">+ زیرمنو</button>
            <button class="btn btn-sm btn-danger" onclick="deleteMenu(${index})">حذف</button>
          </div>
        </div>
        <div class="card-body">
          ${
            menu.submenus.length
              ? menu.submenus
                  .map(
                    (sub, subIndex) => `
              <div class="d-flex justify-content-between align-items-center border-bottom py-1">
                <span>${sub.title}</span>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteSubmenu(${index}, ${subIndex})">×</button>
              </div>`
                  )
                  .join("")
              : '<p class="text-muted m-0">زیرمنویی وجود ندارد</p>'
          }
        </div>
      `;
      menuList.appendChild(card);
    });
  }

  // Add Main Menu
  addMainMenuBtn.addEventListener("click", () => {
    const title = mainMenuName.value.trim();
    const icon = mainMenuIcon.value.trim();

    if (!title) return alert("لطفاً عنوان منو را وارد کنید.");

    megaMenuData.push({ title, icon, submenus: [] });
    mainMenuName.value = "";
    mainMenuIcon.value = "";
    renderMenus();
  });

  // Add Submenu
  window.addSubmenu = (menuIndex) => {
    const submenuTitle = prompt("عنوان زیرمنو را وارد کنید:");
    if (!submenuTitle) return;
    megaMenuData[menuIndex].submenus.push({ title: submenuTitle });
    renderMenus();
  };

  // Delete Menu
  window.deleteMenu = (index) => {
    if (confirm("آیا از حذف این منو مطمئن هستید؟")) {
      megaMenuData.splice(index, 1);
      renderMenus();
    }
  };

  // Delete Submenu
  window.deleteSubmenu = (menuIndex, subIndex) => {
    megaMenuData[menuIndex].submenus.splice(subIndex, 1);
    renderMenus();
  };

  renderMenus();
// ===============================================================
//    end megaMenu
// ===============================================================


// ===============================================================
//    ad section
// ===============================================================
document.addEventListener("DOMContentLoaded", () => {
  const adLinkInput = document.getElementById("adLink");
  const adMessageInput = document.getElementById("newAdMessage");
  const addBtn = document.getElementById("addAdMessageBtn");
  const adMessagesList = document.getElementById("adMessagesList");

  addBtn.addEventListener("click", () => {
    const link = adLinkInput.value.trim();
    const message = adMessageInput.value.trim();

    if (!message) {
      alert("لطفاً جمله تبلیغاتی را وارد کنید.");
      return;
    }

    // Create a new list item
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.innerHTML = `
      <span>${message} ${link ? `- <a href="${link}" target="_blank">${link}</a>` : ""}</span>
      <button type="button" class="btn btn-sm btn-outline-danger">حذف</button>
    `;

    // Add remove functionality to the button
    li.querySelector("button").addEventListener("click", () => {
      adMessagesList.removeChild(li);
    });

    // Append the item to the list
    adMessagesList.appendChild(li);

    // Clear both input fields
    adMessageInput.value = "";
    adLinkInput.value = "";
    adMessageInput.focus();
  });

  // Form submission (optional: send data to server)
  const form = document.getElementById("adSettingsForm");
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    // Collect messages and link for server submission
    const messages = Array.from(adMessagesList.querySelectorAll("li span")).map(span => span.innerHTML);
    const link = adLinkInput.value.trim();
    console.log({ link, messages });
    alert("تغییرات ذخیره شد!");
  });
});

// ===============================================================
//     end ad section
// ===============================================================


// ===============================================================
//    manage brands
// ===============================================================
const previewImage = document.getElementById("previewImage");
const brandImageInput = document.getElementById("brandImageInput");
const brandNameInput = document.getElementById("brandNameInput");
const addBrandBtn = document.getElementById("addBrandBtn");
const brandGallery = document.getElementById("brandGallery");

// Preview the selected image before adding
brandImageInput.addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (event) => {
    previewImage.src = event.target.result;
  };
  reader.readAsDataURL(file);
});

// Load saved brands from localStorage when the page loads
document.addEventListener("DOMContentLoaded", () => {
  const savedBrands = JSON.parse(localStorage.getItem("brands")) || [];
  savedBrands.forEach((brand) => addBrandToGallery(brand.name, brand.image, false));
});

// Add a new brand
addBrandBtn.addEventListener("click", () => {
  const name = brandNameInput.value.trim();
  const file = brandImageInput.files[0];

  if (!name || !file) {
    alert("لطفا نام برند و تصویر آن را وارد کنید.");
    return;
  }

  const reader = new FileReader();
  reader.onload = (event) => {
    const image = event.target.result;
    addBrandToGallery(name, image, true); // Add the brand to gallery
    saveBrand(name, image);               // Save the brand to localStorage
  };
  reader.readAsDataURL(file);

  // Reset form inputs
  brandNameInput.value = "";
  brandImageInput.value = "";
  previewImage.src = "./design/image/logo.png";
});

// Function to add brand element to the gallery
function addBrandToGallery(name, image, animate = true) {
  const div = document.createElement("div");
  div.className = "brand-item text-center";
  div.innerHTML = `
    <div class="position-relative overflow-hidden bg-white" style="width:110px; height:120px;">
      <img src="${image}" alt="${name}" style="width:100%; height:100%; object-fit:contain;">
      <button class="remove-btn position-absolute top-0 end-0 m-1 btn btn-sm btn-danger rounded-circle p-0" title="Remove Brand" style="width:20px; height:20px; line-height:1;">
        <i class="bi bi-x fs-6"></i>
      </button>
    </div>
    <small class="d-block mt-1 text-secondary fw-semibold">${name}</small>
  `;

  // Animate brand appearance if needed
  if (animate) {
    div.style.opacity = "0";
    setTimeout(() => (div.style.opacity = "1"), 50);
  }

  // Remove brand on clicking the remove button
  div.querySelector(".remove-btn").addEventListener("click", () => {
    div.remove();
    removeBrand(name);
  });

  // Append the brand element to the gallery
  brandGallery.appendChild(div);
}

// Function to save brand to localStorage
function saveBrand(name, image) {
  const brands = JSON.parse(localStorage.getItem("brands")) || [];
  brands.push({ name, image });
  localStorage.setItem("brands", JSON.stringify(brands));
}

// Function to remove brand from localStorage
function removeBrand(name) {
  let brands = JSON.parse(localStorage.getItem("brands")) || [];
  brands = brands.filter((b) => b.name !== name);
  localStorage.setItem("brands", JSON.stringify(brands));
}


// ===============================================================
//     end manage brands
// ===============================================================
