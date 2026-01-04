// <!--================== changhe content col-md-9 ================-->


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

// =======================end change avatar=======================


// <!-- =======================edit date======================= -->



// <!-- =======================end edit date======================= -->

// <!-- =======================edit password======================= -->

// <!--============================address============================-->


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

