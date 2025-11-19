//############## formatNumberInput #############
function applyNumberFormat(input) {
  input.addEventListener("input", function () {
    // Remove all non-digit characters
    let rawValue = input.value.replace(/\D/g, "");

    // Prevent leading zero
    if (rawValue.length > 1 && rawValue.startsWith("0")) {
      rawValue = rawValue.replace(/^0+/, ""); // Remove leading zeros
    }

    // Format number with dots
    let formatted = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    input.value = formatted;
  });
}

// Apply automatically to all inputs with class 'number-format'
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("input.number-format").forEach(applyNumberFormat);
});

