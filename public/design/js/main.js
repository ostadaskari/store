/******************************************************
 * 📁 File: main.js for index.html
 * 📌 Purpose:
 * This JavaScript file handles all main interactive features
 * of the e-commerce website to enhance user experience,
 * engagement, and navigation.
 *
 * 🛠 Features included:
 *
 * 1. Ads Bar:
 *    - Close the top advertisement banner.
 *    - Adjust top padding of header and banner carousel when the ad is closed.
 *    - Rotate ad messages with fade-in/fade-out effect.
 *
 * 2. Countdown Timer:
 *    - Display remaining time for promotional offers (days, hours, minutes, seconds).
 *    - Update the countdown every second.
 *    - Handle expired offers by updating text, applying blur, and removing countdown.
 *
 * 3. Owl Carousel - Products:
 *    - Initialize multiple product sliders with responsive settings.
 *    - Enable autoplay, loop, and hover pause.
 *    - Custom next/prev buttons for each carousel.
 *
 * 4. Owl Carousel - Brands:
 *    - Initialize a brands slider with responsive layout.
 *    - Autoplay with smooth speed and no navigation dots.
 *
 * 5. Auto-Close Mobile Menu:
 *    - Automatically closes the mobile navbar when clicking outside or on a link.
 *
 * 6. Smooth Scroll:
 *    - Smoothly scrolls to page sections when navbar links are clicked.
 *
 * 💡 Notes:
 * - Uses jQuery for Owl Carousel initialization.
 * - Uses Bootstrap's Collapse component for mobile menu behavior.
 * - Countdown timer automatically updates elements with class "demos".
 ******************************************************/

/* ===============================
=         ads bar               =
================================== */
// Function to close the ad banner
function closeAd() {
  document.getElementById("adBanner").style.display = "none";

  document.querySelectorAll(".StoreHeader").forEach(function (el) {
    el.style.top = "0";
  });

  if (window.innerWidth >= 992) {
    document.getElementById("bannerCarousel").style.paddingTop = "145px";
  } else {
    document.getElementById("bannerCarousel").style.paddingTop = "60px";
  }
}



// List of rotating ad messages
const messagesAd = [
  "فروش ویژه فقط تا پایان هفته!",
  "ارسال رایگان برای سفارش‌های بالای ۵۰۰ هزار تومان",
  "تخفیف تابستانه شروع شد!",
  "عضویت در خبرنامه و دریافت کوپن تخفیف"
];

let index = 0;
const adText = document.getElementById("adText");

// Function to rotate ad messages with fade effect
function rotateAdText() {
  adText.classList.add("fade-out");

  setTimeout(() => {
    index = (index + 1) % messagesAd.length;
    adText.textContent = messagesAd[index];
    adText.classList.remove("fade-out");
  }, 500); // Matches the CSS fade-out duration
}

// Start rotating ads on page load
window.onload = () => {
  adText.textContent = messagesAd[index];
  setInterval(rotateAdText, 3000); // Change message every 3 seconds
};
/* ================================
=        end ads bar             =
================================== */

/* ================================
=          Countdown Timer        =
================================== */

// Set the date we're counting down to
var countDownDate = new Date("January 10, 2026 15:37:25").getTime();

// Update the countdown every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the countdown date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in elements with class="demos"
  var z = document.getElementsByClassName("demos");
  for (var i = 0; i < z.length; i++) {
    z[i].innerHTML =
      '<span id="day">' + days + '</span>' +
      '<span id="hours">' + hours + '</span>' +
      '<span id="minutes">' + minutes + '</span>' +
      '<span id="seconds">' + seconds + '</span>';
  }

  // If the countdown is over
  if (distance < 0) {
    clearInterval(x);

    // Clear countdown content
    var y = document.getElementsByClassName("demos");
    for (var i = 0; i < z.length; i++) {
      y[i].innerHTML = "";
    }

    // Add expired class
    var g = document.getElementsByClassName("offer-expire");
    for (var i = 0; i < z.length; i++) {
      g[i].classList.add("offer-expire-text");
    }

    // Update expired text
    var d = document.getElementsByClassName("offer-expire-text-inner");
    for (var i = 0; i < z.length; i++) {
      d[i].innerHTML = "به پایان رسیده";
    }

    // Apply blur effect
    var t = document.getElementsByClassName("offer-blur");
    for (var i = 0; i < z.length; i++) {
      t[i].style.filter = "blur(1px)";
    }
  }
}, 1000);


/* ================================
=       Owl Carousel - Products   =
================================== */

$(document).ready(function() {
  //First slider
  $(".owl-1 .owl-carousel").owlCarousel({
    rtl: true,
    loop: true,
    margin: 8,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
      0: { items: 2 },
      600: { items: 3 },
      1000: { items: 6 }
    }
  });

  // Second slider
  $(".owl-2 .owl-carousel").owlCarousel({
    rtl: true,
    loop: true,
    margin: 8,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: { items: 2 },
      600: { items: 3 },
      1000: { items: 6 }
    }
  });

  //Third slider
  $(".owl-3 .owl-carousel").owlCarousel({
    rtl: true,
    loop: true,
    margin: 8,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
      0: { items: 2 },
      600: { items: 3 },
      1000: { items: 6 }
    }
  });

  // btns next and prev
  $(".owl-1 .custom-next").click(function() {
    $(".owl-1 .owl-carousel").trigger('next.owl.carousel');
  });
  $(".owl-1 .custom-prev").click(function() {
    $(".owl-1 .owl-carousel").trigger('prev.owl.carousel');
  });

  $(".owl-2 .custom-next").click(function() {
    $(".owl-2 .owl-carousel").trigger('next.owl.carousel');
  });
  $(".owl-2 .custom-prev").click(function() {
    $(".owl-2 .owl-carousel").trigger('prev.owl.carousel');
  });

  $(".owl-3 .custom-next").click(function() {
    $(".owl-3 .owl-carousel").trigger('next.owl.carousel');
  });
  $(".owl-3 .custom-prev").click(function() {
    $(".owl-3 .owl-carousel").trigger('prev.owl.carousel');
  });
});


/* ================================
=        Owl Carousel - Brands    =
================================== */

$(document).ready(function(){
  $(".brands-slider-section .owl-carousel").owlCarousel({
    rtl: true,
    loop: true,
    margin: 30,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 1500,
    smartSpeed: 1500,
    autoplayHoverPause: true,
    dots: false,
    nav: false,
    responsive: {
      0: { items: 2 },
      576: { items: 3 },
      768: { items: 4 },
      992: { items: 6 }
    }
  });
});




/* ================================
=     Auto Close Mobile Menu
================================== */

document.addEventListener('click', function(event) {
  const menu = document.getElementById('mainMenu');
  const toggler = document.querySelector('.navbar-toggler');

  const clickedInsideMenu = menu.contains(event.target);
  const clickedOnLink = event.target.classList.contains('nav-link');

  if (menu.classList.contains('show') && (
      !clickedInsideMenu && !toggler.contains(event.target) ||
      clickedOnLink
    )) {
    const bsCollapse = bootstrap.Collapse.getOrCreateInstance(menu);
    bsCollapse.hide();
  }
});


// =========================
// scroll
//  ========================
document.querySelectorAll('.nav-item.nav-link').forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();

    const targetId = this.getAttribute('href').substring(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
      targetElement.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});



document.addEventListener('DOMContentLoaded', function() {

    // Helper to keep dropdown open during updates
    function preserveDropdownState() {
        const cartWrapper = document.getElementById('header-cart-wrapper');
        const cartBtn = document.getElementById('cartBtn');
        const isVisible = cartBtn.classList.contains('show') || (cartWrapper && cartWrapper.querySelector('.dropdown-menu.show'));

        return { isVisible, cartBtn };
    }

    async function syncCartAction(id, qty, isRemove = false) {
        const url = isRemove ? `/cart/ajax/remove/${id}` : `/cart/ajax/update/${id}`;

        // Save current state before HTML replacement
        const state = preserveDropdownState();

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: isRemove ? null : JSON.stringify({ qty: qty })
            });

            const data = await response.json();

            if (data.error) {
                Swal.fire({ icon: 'error', title: 'خطا', text: data.error, confirmButtonText: 'متوجه شدم' });
                return;
            }

            // --- 1. Update Header UI ---
            if (data.count_html) document.getElementById('header-cart-count-container').innerHTML = data.count_html;

            if (data.list_html) {
                const listContainer = document.getElementById('header-cart-list-container');
                listContainer.innerHTML = data.list_html;

                // RE-INITIALIZE Dropdown: This is the fix.
                // This uses Bootstrap’s official API instead of manual class manipulation.
                if (state.isVisible) {
                    const dropdown = bootstrap.Dropdown.getOrCreateInstance(state.cartBtn);
                    dropdown.show();
                }
            }

            // --- 2. Update Cart Page UI (Same as before) ---
            const cartTableBody = document.getElementById('cart-body');
            if (cartTableBody) {
                if (isRemove || (data.is_empty)) {
                    const row = document.getElementById(`item-${id}`);
                    if (row) row.remove();
                    if (!cartTableBody.innerText.trim() || data.is_empty) {
                        cartTableBody.innerHTML = '<tr><td colspan="5">سبد خرید خالی است</td></tr>';
                    }
                } else {
                    const lineTotal = document.getElementById(`line-total-${id}`);
                    const qtyInput = document.getElementById(`qty-${id}`);
                    if (lineTotal) lineTotal.innerText = new Intl.NumberFormat().format(data.line_total);
                    if (qtyInput) qtyInput.value = qty;
                }

                const formattedGrand = new Intl.NumberFormat().format(data.grand_total);
                const grandTotalEl = document.getElementById('grand-total');
                const summaryTotalEl = document.getElementById('summary-total');

                if (grandTotalEl) grandTotalEl.innerText = formattedGrand;
                if (summaryTotalEl) summaryTotalEl.innerText = formattedGrand + " تومان";
            }

        } catch (error) {
            console.error("Cart Sync Error:", error);
        }
    }

    // --- Event Listeners ---
    document.addEventListener('click', function(e) {


        // QTY Buttons
        if (e.target.classList.contains('qty-btn') || e.target.classList.contains('header-qty-btn')) {
            const id = e.target.dataset.id;
            const type = e.target.dataset.type;

            let currentQty;
            const inputField = document.getElementById(`qty-${id}`);
            if (inputField) {
                currentQty = parseInt(inputField.value);
            } else {
                currentQty = parseInt(e.target.parentNode.querySelector('span').innerText);
            }

            let newQty = (type === 'plus') ? currentQty + 1 : currentQty - 1;
            if (newQty > 0) syncCartAction(id, newQty);
        }

        // DELETE Buttons
        const removeBtn = e.target.closest('.header-remove-btn') || e.target.closest('.cart-remove-page');
        if (removeBtn) {
            e.preventDefault();
            const id = removeBtn.dataset.id;

            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "این آیتم از سبد خرید شما حذف خواهد شد.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'انصراف'
            }).then((result) => {
                if (result.isConfirmed) {
                    syncCartAction(id, 0, true);
                }
            });
        }
    });

    const addToCartForm = document.querySelector('.formAddToCart');
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function(e) {
            const input = this.querySelector('.product-qty-input-js');
            const max = parseInt(input.getAttribute('max'));
            const val = parseInt(input.value);

            if (val > max) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'تعداد انتخابی بیشتر از موجودی انبار است.'
                });
            }
        });
    }
});






