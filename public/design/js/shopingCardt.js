/******************************************************
 * 📁 File: shoping.js and shipping methood.js and checkout.js
 * ******************************************************/

/* ============================
   Change the price by adding or subtracting from the shopping cart
   ============================ */
// Select all quantity control containers
document.querySelectorAll(".quantity-control-btn").forEach((container) => {
  const unitPrice = parseInt(container.dataset.unitPrice);
  const qtySpan = container.querySelector(".quantity");
  const totalPriceEl = container.querySelector(".total-price");
  const increaseBtn = container.querySelector(".increase-btn");
  const decreaseBtn = container.querySelector(".decrease-btn");

  // Update decrease button icon based on quantity
  function updateDecreaseBtn(qty) {
    if (qty <= 1) {
      decreaseBtn.innerHTML = `<svg width="16" height="16" fill="rgb(206, 33, 33)" class="bi bi-trash" viewBox="0 0 16 16">
         <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
         <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
         </svg>`;
    } else {
      decreaseBtn.textContent = "-";
    }
  }

  // Initial check
  updateDecreaseBtn(parseInt(qtySpan.textContent));

  increaseBtn.addEventListener("click", () => {
    let qty = parseInt(qtySpan.textContent);
    qty += 1;
    qtySpan.textContent = qty;
    totalPriceEl.textContent = `${formatPrice(qty * unitPrice)}`;
    updateDecreaseBtn(qty);
  });

  decreaseBtn.addEventListener("click", () => {
    let qty = parseInt(qtySpan.textContent);
    if (qty > 1) {
      qty -= 1;
      qtySpan.textContent = qty;
      totalPriceEl.textContent = `${formatPrice(qty * unitPrice)}`;
    } else {
      // Optional: remove product from cart if clicked on trash
      container.closest(".card").remove();
    }
    updateDecreaseBtn(qty);
  });
});

// Helper function to format price with dots
function formatPrice(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
/* ============================
  End Change the price by adding or subtracting from the shopping cart
   ============================ */  