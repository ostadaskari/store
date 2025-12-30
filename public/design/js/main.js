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

    // Helper to check if dropdown is currently active
    function isDropdownOpen() {
        const cartBtn = document.getElementById('cartBtn');
        if (!cartBtn) return false;
        return cartBtn.classList.contains('show') || cartBtn.getAttribute('aria-expanded') === 'true';
    }

    async function syncCartAction(id, qty, isRemove = false) {
        const url = isRemove ? `/cart/ajax/remove/${id}` : `/cart/ajax/update/${id}`;
        const wasOpen = isDropdownOpen();
        const cartBtn = document.getElementById('cartBtn');

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

            if (data.count_html) {
                const countContainer = document.getElementById('header-cart-count-container');
                if (countContainer) countContainer.innerHTML = data.count_html;
            }

            if (data.list_html) {
                const listContainer = document.getElementById('header-cart-list-container');
                if (listContainer) {
                    listContainer.innerHTML = data.list_html;
                    if (wasOpen && cartBtn) {
                        const oldInstance = bootstrap.Dropdown.getInstance(cartBtn);
                        if (oldInstance) oldInstance.dispose();
                        const newDropdown = new bootstrap.Dropdown(cartBtn);
                        newDropdown.show();
                        cartBtn.classList.add('show');
                        cartBtn.setAttribute('aria-expanded', 'true');
                        const newMenu = cartBtn.nextElementSibling || listContainer.querySelector('.dropdown-menu');
                        if (newMenu) newMenu.classList.add('show');
                    }
                }
            }

            const cartItemsContainer = document.getElementById('cart-items-container');
            if (cartItemsContainer) {
                if (isRemove || data.is_empty) {
                    const row = document.getElementById(`item-${id}`);
                    if (row) row.remove();
                    if (!cartItemsContainer.innerText.trim() || data.is_empty) {
                        cartItemsContainer.innerHTML = '<div class="text-center py-5"><p>سبد خرید شما خالی است</p></div>';
                    }
                } else {
                    const lineTotal = document.getElementById(`line-total-${id}`);
                    const qtyDisplay = document.getElementById(`qty-${id}`);
                    
                    if (lineTotal) lineTotal.innerText = new Intl.NumberFormat().format(data.line_total);
                    
                    if (qtyDisplay) {
                        if (qtyDisplay.tagName === 'INPUT') {
                            qtyDisplay.value = qty;
                        } else {
                            qtyDisplay.innerText = qty;
                        }
                    }
                }
                updateTotals(data.grand_total);
            }

        } catch (error) {
            console.error("Cart Sync Error:", error);
        }
    }

    function updateTotals(total) {
        const formatted = new Intl.NumberFormat().format(total);
        const gTotal = document.getElementById('grand-total');
        const sTotal = document.getElementById('summary-total');
        if (gTotal) gTotal.innerText = formatted;
        if (sTotal) sTotal.innerText = formatted + " تومان";
    }

    document.addEventListener('click', function(e) {
        const qtyBtn = e.target.closest('.qty-btn') || e.target.closest('.header-qty-btn');
        const removeBtn = e.target.closest('.header-remove-btn') || e.target.closest('.cart-remove-page');

        if (qtyBtn || removeBtn) {
            e.preventDefault();
            e.stopPropagation();
        }

        if (qtyBtn) {
            const id = qtyBtn.dataset.id;
            const type = qtyBtn.dataset.type;
            const displayField = document.getElementById(`qty-${id}`);

            let currentQty;
            if (displayField) {
                currentQty = parseInt(displayField.value || displayField.innerText);
            } else {
                const parent = qtyBtn.closest('.cart-item-wrapper') || qtyBtn.parentNode;
                const span = parent.querySelector('.qty-value-js') || parent.querySelector('span');
                currentQty = span ? parseInt(span.innerText) : 1;
            }

            let newQty = (type === 'plus') ? currentQty + 1 : currentQty - 1;
            if (newQty > 0) {
                syncCartAction(id, newQty);
            } else if (newQty === 0) {
                Swal.fire({
                    title: 'حذف محصول؟',
                    text: "آیا می‌خواهید این مورد را از سبد حذف کنید؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله، حذف شود',
                    cancelButtonText: 'خیر'
                }).then((result) => {
                    if (result.isConfirmed) syncCartAction(id, 0, true);
                });
            }
        }

        if (removeBtn) {
            const id = removeBtn.dataset.id;
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "این آیتم حذف شود؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله',
                cancelButtonText: 'انصراف'
            }).then((result) => {
                if (result.isConfirmed) syncCartAction(id, 0, true);
            });
        }
    });
});


// ++++++++++++++++++++++++++ add_to_wishlist ===============
// ================= add_to_wishlist =================

// Global CSRF for all AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.wishlist-btn', function () {

    const btn = $(this);
    const productId = btn.data('product');
    const url = btn.data('url');
    const icon = btn.find('i');

    $.ajax({
        url: url,
        method: "POST",
        data: {
            product_id: productId
        },
        beforeSend() {
            icon.addClass('opacity-50');
        },
        success(res) {

            if (res.status === 'added') {
                icon.removeClass('bi-heart')
                    .addClass('bi-heart-fill text-danger');
            }

            if (res.status === 'removed') {
                icon.removeClass('bi-heart-fill text-danger')
                    .addClass('bi-heart');
            }

            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                text: res.message,
                showConfirmButton: false,
                timer: 1500
            });
        },
        error(xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                text: 'خطا در انجام عملیات'
            });
        },
        complete() {
            icon.removeClass('opacity-50');
        }
    });
});


// ========================== end add to wishlist





