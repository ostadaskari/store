// <!--================== changhe content col-md-9 ================-->

function showSection(sectionId) {
  const sections = [
    "edit-profile-section",
    "user-orders-section",
    "user-invoice-section",
    "user-Wallet-section"
  ];

  sections.forEach(id => {
    document.getElementById(id).style.display = (id === sectionId) ? "block" : "none";
  });
}

document.querySelectorAll("[data-target]").forEach(btn => {
  btn.addEventListener("click", function () {
    const targetId = this.getAttribute("data-target");
    showSection(targetId);

    // Remove color from all buttons
    document.querySelectorAll("[data-target]").forEach(b => {
      b.classList.remove("soft-select");
    });

    // Add a yellow fade color to the clicked button
    this.classList.add("soft-select");
  });
});


// Scroll to content in mobile mode
document.querySelectorAll('.go-scroll').forEach(item => {
  item.addEventListener('click', function () {
    const targetId = this.dataset.target;
    const targetElement = document.getElementById(targetId);

    // Scroll only in mobile mode.
    if (window.innerWidth <= 768 && targetElement) {
      //A little delay to make sure everything is rendered.
      setTimeout(() => {
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }, 300);
    }
  });
});


// <!--================ end changhe content col-md-9 ================-->
// =======================changhe avatar=======================
function previewAvatar(event) {
const input = event.target;
const reader = new FileReader();
reader.onload = function(){
document.getElementById('avatarPreview').src = reader.result;
};
if(input.files[0]) {
reader.readAsDataURL(input.files[0]);
}
}
// =======================end changhe avatar=======================


// <!-- =======================edit date======================= -->

const daySelect = document.getElementById("birthDay");
const monthSelect = document.getElementById("birthMonth");
const yearSelect = document.getElementById("birthYear");

const months = [
  "فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور",
  "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"
];

// Fill years (from 1404 to 1345)
for (let y = 1404; y >= 1345; y--) {
  const option = document.createElement("option");
  option.value = y;
  option.textContent = y;
  yearSelect.appendChild(option);
}

// Fill months
function fillMonths(disableSecondHalf = false) {
  monthSelect.innerHTML = '<option value=""></option>';
  months.forEach((month, index) => {
    const option = document.createElement("option");
    option.value = index + 1;
    option.textContent = month;
    if (disableSecondHalf && index + 1 > 6) {
      option.disabled = true;
      option.style.color = "#ccc";
    }
    monthSelect.appendChild(option);
  });
}

fillMonths(); // initial

// Fill all 31 days always
for (let d = 1; d <= 31; d++) {
  const option = document.createElement("option");
  option.value = d;
  option.textContent = d;
  daySelect.appendChild(option);
}

// Handle day change
daySelect.addEventListener("change", function () {
  const selectedDay = parseInt(this.value);
  if (selectedDay === 31) {
    fillMonths(true); // disable
    if (parseInt(monthSelect.value) > 6) {
      monthSelect.value = ""; // reset if invalid
    }
  } else {
    fillMonths(false);
  }
});

// <!-- =======================end edit date======================= -->

// <!-- =======================edit password======================= -->

// Elements
const currentInput = document.getElementById("currentPassword");
const newInput = document.getElementById("newPassword");
const confirmInput = document.getElementById("confirmPassword");

const currentError = document.getElementById("currentPasswordError");
const newError = document.getElementById("newPasswordError");
const confirmError = document.getElementById("confirmPasswordError");

const ruleLength = document.getElementById("rule-length");
const ruleLower = document.getElementById("rule-lower");
const ruleUpper = document.getElementById("rule-upper");
const ruleSymbol = document.getElementById("rule-symbol");

const emailInput = document.querySelector('input[type="email"]');
const phoneInput = document.querySelector('input[placeholder^="09"]');

// Strong password validation
function isStrongPassword(pw) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
  return regex.test(pw);
}

// Email validation
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Phone validation (starts with 09 and numeric)
function isValidPhone(phone) {
  return /^09\d{9}$/.test(phone);
}

// Clear errors
function clearErrors() {
  currentError.classList.add("d-none");
  newError.classList.add("d-none");
  confirmError.classList.add("d-none");
}

// Update rule visuals
function updateRule(element, condition, text) {
  if (condition) {
    element.classList.remove("text-danger");
    element.classList.add("text-success");
    element.textContent = "✔ " + text;
  } else {
    element.classList.add("text-danger");
    element.classList.remove("text-success");
    element.textContent = "⬤ " + text;
  }
}

// Validate password visually
function validatePasswordRules(value) {
  updateRule(ruleLength, value.length >= 8, "حداقل ۸ کاراکتر");
  updateRule(ruleLower, /[a-z]/.test(value), "حروف کوچک (a-z)");
  updateRule(ruleUpper, /[A-Z]/.test(value), "حروف بزرگ (A-Z)");
  updateRule(ruleSymbol, /[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]/.test(value), "یک کاراکتر خاص (مثل @#$!)");
}

newInput.addEventListener("input", () => {
  validatePasswordRules(newInput.value);
});

// Main submit button
document.getElementById("mainSaveBtn").addEventListener("click", function (e) {
  e.preventDefault();
  clearErrors();

  let isValid = true;

  // Email check
  if (!isValidEmail(emailInput.value)) {
    alert("ایمیل وارد شده معتبر نیست ❌");
    isValid = false;
  }

  // Phone check
  if (!isValidPhone(phoneInput.value)) {
    alert("شماره موبایل معتبر نیست ❌ (باید با 09 شروع شود)");
    isValid = false;
  }

  // Password checks
  if (currentInput.value.trim() === "") {
    currentError.classList.remove("d-none");
    isValid = false;
  }

  if (!isStrongPassword(newInput.value)) {
    newError.classList.remove("d-none");
    isValid = false;
  }

  if (newInput.value !== confirmInput.value) {
    confirmError.classList.remove("d-none");
    isValid = false;
  }

  if (isValid) {
    alert("اطلاعات با موفقیت ذخیره شد ✅");
  }
});

// <!-- =======================end edit password======================= -->
// <!--============================address============================-->

document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("address-modal");
  const openBtn = document.querySelector(".add-address-btn");
  const addressCancelBtn = document.querySelector("#address-modal .address-cancel-btn");
  const addressSubmitBtn = document.querySelector(".address-submit-btn");
  const addressInput = document.getElementById("address-input");
  const receiverInput = document.getElementById("receiver-input");
  const phoneInput = document.getElementById("phone-input");
  const addressList = document.getElementById("address-section");

  let addressCounter = document.querySelectorAll('input[name="selectedAddress"]').length;

  if (!openBtn) return;

  // Open the modal
  openBtn.addEventListener("click", () => {
    modal.style.display = "flex";
  });

  // Close the modal
  addressCancelBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  // Close the modal when clicking outside of it
  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });

  // Add the new address
  addressSubmitBtn.addEventListener("click", () => {
    const address = addressInput.value.trim();
    const receiver = receiverInput.value.trim();
    const phone = phoneInput.value.trim();

    if (address && receiver && phone) {
      addressCounter++;

      // Create a new address card with radio
      const card = document.createElement("div");
      card.className = "mb-3 p-3 border rounded d-flex gap-3 align-items-start";
      card.innerHTML = `
        <input class="form-check-input mt-1" type="radio" name="selectedAddress" id="address${addressCounter}" value="${addressCounter}">
        <label for="address${addressCounter}" class="flex-grow-1 cursor-pointer">
          <div class="d-flex gap-2 align-items-start">
            <div class="fs-4">📍</div>
            <div>
              ${address}<br>
              <strong>گیرنده:</strong> ${receiver} - ${phone}
            </div>
          </div>
        </label>
      `;

      addressList.appendChild(card);

      // Clear inputs
      addressInput.value = "";
      receiverInput.value = "";
      phoneInput.value = "";

      // Close the modal
      modal.style.display = "none";
    } else {
      alert("لطفاً همه فیلدها را کامل پر کنید.");
    }
  });
});

// <!--======================= end address =======================-->

// <!-- ======================= order-detail =======================-->
// -------------------
//  copy trackingCode
// -------------------
  document.addEventListener('click', function (e) {
    if (e.target.closest('.copy-icon')) {
      const icon = e.target.closest('.copy-icon');
      const container = icon.closest('.meta-item');
      const span = container.querySelector('.trackingCode');
      const text = span.innerText.trim();

      navigator.clipboard.writeText(text).then(() => {
        alert('کپی شد: ' + text);
      }).catch(() => {
        alert('کپی ناموفق بود');
      });
    }
  });
// -------------------
//  copy trackingCode
// -------------------

document.addEventListener("DOMContentLoaded", function () {
  const orderCards = document.querySelectorAll(".order-card");
  const allDetails = document.querySelectorAll(".order-detail-content");

  orderCards.forEach(card => {
    card.addEventListener("click", function () {
      // Hide all order detail sections
      allDetails.forEach(detail => detail.classList.add("d-none"));

      // Remove active border from all cards
      orderCards.forEach(c => c.classList.remove("borderGold"));

      // Add active border to the clicked card
      this.classList.add("borderGold");

      // Get data from clicked card
      const orderId = this.dataset.orderId;
      const orderDate = this.dataset.date;
      const orderPrice = this.dataset.price;
      const trackingCode = this.dataset.trackingCode;

      // Determine the element to be scrolled.
      let targetElement = null;

      if (card.classList.contains("order-active")) {
        targetElement = document.getElementById("current-order-detail");
      } 
      else if (card.classList.contains("order-delivered")) {
        targetElement = document.getElementById("delivered-order-detail");
      } 
      else if (card.classList.contains("order-returned")) {
        targetElement = document.getElementById("returned-order-detail");
      }

      if (targetElement) {
        targetElement.classList.remove("d-none");

        // ✨ Scroll after appearing in mobile mode
        if (window.innerWidth <= 768) {
          setTimeout(() => {
            targetElement.scrollIntoView({
              behavior: "smooth",
              block: "start"
            });
          }, 100);
        }
      }
    });
  });
});


// <!--======================  end order-detail ======================-->

// <!--====================== invoice ======================-->

// invoice Accordion toggle 
document.querySelectorAll('.accordion-header-invoice').forEach(button => {
button.addEventListener('click', () => {
const currentBody = button.nextElementSibling;
const isOpen = currentBody.style.display === 'block';

// Close all accordion bodies
document.querySelectorAll('.accordion-body-invoice').forEach(body => {
  body.style.display = 'none';
});
document.querySelectorAll('.toggle-icon').forEach(icon => {
  icon.textContent = '+';
});

// Open current accordion if not already open
if (!isOpen) {
  currentBody.style.display = 'block';
  button.querySelector('.toggle-icon').textContent = '−';
}
});
});

// Convert Persian numbers to English
function convertPersianToEnglish(str) {
return str.replace(/[\u06F0-\u06F9]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d));
}

// Searchbar in invoice
document.getElementById('invoiceSearch').addEventListener('input', function () {
const query = convertPersianToEnglish(this.value.trim().toLowerCase());
const invoices = document.querySelectorAll('#invoice-list .accordion-item');

invoices.forEach(invoice => {
const buttonText = invoice.querySelector('.accordion-header-invoice div')
  .textContent.replace(/\s+/g, ' ')
  .trim()
  .toLowerCase();
const normalizedText = convertPersianToEnglish(buttonText);

if (normalizedText.includes(query)) {
  invoice.style.display = 'block';
} else {
  invoice.style.display = 'none';
}
});
});
// End searchbar in invoice

// <!-- ###### end Accordion for invoice ###### -->

// <!-- ######### download invoice as pdf ######### -->
function downloadInvoiceAsPDF(invoiceId) {
const invoiceElement = document.getElementById(invoiceId);

// If it was hidden, temporarily show it.
const wasHidden = invoiceElement.style.display === 'none';
if (wasHidden) invoiceElement.style.display = 'block';

const opt = {
margin:       0.5,
filename:     'invoice.pdf',
image:        { type: 'jpeg', quality: 0.98 },
html2canvas:  { scale: 2 },
jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
};

html2pdf().set(opt).from(invoiceElement).save().then(() => {
if (wasHidden) invoiceElement.style.display = 'none'; // hide again
});
}

// <!-- ######### end download invoice as pdf ######### -->
// <!--======================= end invoice =======================--!>

// <!-- ######### wallet ######### -->
function goToNextStep() {
document.getElementById("walletStep1").classList.add("d-none");
document.getElementById("walletStep2").classList.remove("d-none");
}

function goBack() {
document.getElementById("walletStep2").classList.add("d-none");
document.getElementById("walletStep1").classList.remove("d-none");
}

function submitCharge() {
const amount = document.getElementById("amountInput").value;
if (!amount || amount < 1000) {
alert("لطفاً مبلغ معتبر وارد کنید.");
return;
}

// Here you can add AJAX or form submission.
alert("درخواست شارژ " + amount + " ریال ثبت شد.");
}
// code for Separator of thousands
const input = document.getElementById("amountInput");

input.addEventListener("input", function (e) {
// Raw number without separator
let rawValue = e.target.value.replace(/\D/g, "");

//Thousands separator with a dot
let formatted = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

e.target.value = formatted;
});
// <!-- ######### end wallet ######### -->


//  btn copy in gift cart
function copyGiftSerial() {
const serial = document.getElementById("giftSerial").innerText;
navigator.clipboard.writeText(serial).then(() => {
alert("شماره سریال کپی شد!");
}).catch(() => {
alert("مشکلی در کپی پیش آمد.");
});
}

//############## formatNumberInput #############
document.addEventListener("DOMContentLoaded", function () {
document.querySelectorAll("input.number-format").forEach(function (input) {
input.addEventListener("input", function (e) {
  //Remove all non-numeric characters.
  let rawValue = e.target.value.replace(/\D/g, "");

  //Add thousands separator (.)
  let formatted = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

  e.target.value = formatted;
});
});
});

//############# for form bank info #############
  const form = document.getElementById('bankInfoForm');

  const cardNumberInput = document.getElementById('cardNumber');
  const shabaInput = document.getElementById('shabaNumber');
  const accountInput = document.getElementById('accountNumber');
  const bankLogo = document.getElementById('bankLogo');
  const bankLogoContainer = document.getElementById('bankLogoContainer');

  // just number
  function allowOnlyNumbers(input) {
    input.addEventListener('input', () => {
      input.value = input.value.replace(/\D/g, '');
    });
  }

  [cardNumberInput, shabaInput, accountInput].forEach(el => allowOnlyNumbers(el));

  const bankIcons = {
    '603799': 'design/image/bank/ملی.png',     
    '610433': 'design/image/bank/ملت.png',       
    '603769': 'design/image/bank/صادرات.png',  
    '622106': 'design/image/bank/پارسیان.png',   
    '589210': 'design/image/bank/سپه.png',    
    '627381': 'design/image/bank/انصار.png',     
    '621986': 'design/image/bank/سامان.png',   
    '603799': 'design/image/bank/مسکن.png',    
    '636214': 'design/image/bank/آینده.png',    
    '502938': 'design/image/bank/دی.png',        
    '502806': 'design/image/bank/شهر.png', 
    '627353': 'design/image/bank/تجارت.png',      

  };
  


  cardNumberInput.addEventListener('input', () => {
    const value = cardNumberInput.value.replace(/\D/g, '');
    cardNumberInput.value = value;

    if (value.length >= 6) {
      const prefix = value.substring(0, 6);
      if (bankIcons[prefix]) {
        bankLogo.src = bankIcons[prefix];
        bankLogoContainer.style.display = 'inline-flex';
      } else {
        bankLogoContainer.style.display = 'none';
      }
    } else {
      bankLogoContainer.style.display = 'none';
    }
  });

  // Final validation of the form
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    let isValid = true;

    // The night number must be exactly 24 digits.
    if (shabaInput.value.length !== 24) {
      shabaInput.classList.add('is-invalid');
      isValid = false;
    } else {
      shabaInput.classList.remove('is-invalid');
    }

    // 16-digit card number
    if (cardNumberInput.value.length !== 16) {
      cardNumberInput.classList.add('is-invalid');
      isValid = false;
    } else {
      cardNumberInput.classList.remove('is-invalid');
    }

    // Account number only number
    if (!accountInput.value.match(/^\d+$/)) {
      accountInput.classList.add('is-invalid');
      isValid = false;
    } else {
      accountInput.classList.remove('is-invalid');
    }

    if (isValid) {
      alert('اطلاعات با موفقیت ثبت شد!');
      form.reset();
      bankLogoContainer.style.display = 'none';
    }
  });

