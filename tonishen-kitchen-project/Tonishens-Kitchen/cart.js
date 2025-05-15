document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const minusBtn = row.querySelector('.minus');
        const plusBtn = row.querySelector('.plus');
        const qtyDisplay = row.querySelector('.qty-number');
        const priceElement = row.querySelector('.item-price');
        const totalElement = row.querySelector('.item-total');

        const unitPrice = parseFloat(priceElement.dataset.price);

        plusBtn.addEventListener('click', () => {
            let quantity = parseInt(qtyDisplay.textContent);
            quantity++;
            qtyDisplay.textContent = quantity;
            totalElement.textContent = `₱${quantity * unitPrice}`;
        });

        minusBtn.addEventListener('click', () => {
            let quantity = parseInt(qtyDisplay.textContent);
            if (quantity > 1) {
                quantity--;
                qtyDisplay.textContent = quantity;
                totalElement.textContent = `₱${quantity * unitPrice}`;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const DELIVERY_FEE = 50;
    const TAX_RATE = 0.12;

    const subtotalEl = document.getElementById('subtotal');
    const salesTaxEl = document.getElementById('sales-tax');
    const deliveryFeeEl = document.getElementById('delivery-fee');
    const grandTotalEl = document.getElementById('grand-total');

    // Function to calculate totals
    function calculateTotals() {
        const itemTotals = document.querySelectorAll('.item-total');
        let subtotal = 0;

        itemTotals.forEach(td => {
            // Remove currency symbol and parse number
            let value = td.textContent.replace('₱', '').trim();
            subtotal += parseFloat(value);
        });

        let salesTax = subtotal * TAX_RATE;
        let grandTotal = subtotal + salesTax + DELIVERY_FEE;

        // Update DOM elements with formatted values
        subtotalEl.textContent = `₱${subtotal.toFixed(2)}`;
        salesTaxEl.textContent = `₱${salesTax.toFixed(2)}`;
        deliveryFeeEl.textContent = `₱${DELIVERY_FEE.toFixed(2)}`;
        grandTotalEl.textContent = `₱${grandTotal.toFixed(2)}`;
    }

    // Initial calculation on page load
    calculateTotals();

    // Also, update totals whenever quantity changes
    const plusButtons = document.querySelectorAll('.qty-btn.plus');
    const minusButtons = document.querySelectorAll('.qty-btn.minus');

    plusButtons.forEach(button => {
        button.addEventListener('click', () => {
            const qtyNumber = button.parentElement.querySelector('.qty-number');
            let qty = parseInt(qtyNumber.textContent);
            qty++;
            qtyNumber.textContent = qty;

            // Update the item total for this row
            updateItemTotal(button.closest('tr'), qty);

            calculateTotals();
        });
    });

    minusButtons.forEach(button => {
        button.addEventListener('click', () => {
            const qtyNumber = button.parentElement.querySelector('.qty-number');
            let qty = parseInt(qtyNumber.textContent);
            if (qty > 1) {
                qty--;
                qtyNumber.textContent = qty;

                // Update the item total for this row
                updateItemTotal(button.closest('tr'), qty);

                calculateTotals();
            }
        });
    });

    // Function to update item total price based on quantity
    function updateItemTotal(row, quantity) {
        const priceTd = row.querySelector('.item-price');
        const totalTd = row.querySelector('.item-total');

        let price = parseFloat(priceTd.dataset.price);
        let total = price * quantity;

        totalTd.textContent = `₱${total.toFixed(2)}`;
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const priceElement = document.querySelector(".item-price");
    const quantityElement = document.querySelector(".qty-number");
    const subtotalElement = document.getElementById("subtotal");
    const salesTaxElement = document.getElementById("sales-tax");
    const deliveryFeeElement = document.getElementById("delivery-fee");
    const grandTotalElement = document.getElementById("grand-total");

    if (priceElement && quantityElement) {
        const price = parseFloat(priceElement.getAttribute("data-price"));
        const quantity = parseInt(quantityElement.textContent);
        const deliveryFee = 50; // fixed delivery fee

        const subtotal = price * quantity;
        const salesTax = subtotal * 0.12; // 12% sales tax
        const grandTotal = subtotal + salesTax + deliveryFee;

        // Update the text in the summary table
        subtotalElement.textContent = `₱${subtotal.toFixed(2)}`;
        salesTaxElement.textContent = `₱${salesTax.toFixed(2)}`;
        deliveryFeeElement.textContent = `₱${deliveryFee.toFixed(2)}`;
        grandTotalElement.textContent = `₱${grandTotal.toFixed(2)}`;
    }
});

document.getElementById("back-btn").addEventListener("click", () => {
    window.location.href = "home-menu.php";
});

// cart.js
document.addEventListener("DOMContentLoaded", function () {
    const plusButtons = document.querySelectorAll(".quantity-btn.plus");
    const minusButtons = document.querySelectorAll(".quantity-btn.minus");

    plusButtons.forEach(button => {
        button.addEventListener("click", function () {
            const item = this.dataset.item;
            window.location.href = `cart.php?action=add&item=${encodeURIComponent(item)}`;
        });
    });

    minusButtons.forEach(button => {
        button.addEventListener("click", function () {
            const item = this.dataset.item;
            window.location.href = `cart.php?action=subtract&item=${encodeURIComponent(item)}`;
        });
    });
});