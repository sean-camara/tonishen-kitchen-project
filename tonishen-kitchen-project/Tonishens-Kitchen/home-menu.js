// ========== CATEGORY FILTER ==========
const categorySelect = document.getElementById("category");
const categoryParagraph = document.getElementById("category-paragraph");

categorySelect.addEventListener("change", function () {
  const selected = categorySelect.value.toLowerCase();
  const capitalized = selected.charAt(0).toUpperCase() + selected.slice(1);

  categoryParagraph.textContent =
    selected === "all" ? "All Category" : capitalized + " Category";

  const cards = document.querySelectorAll(".card");

  cards.forEach((card) => {
    const category = card.getAttribute("data-category");
    if (selected === "all" || selected === category) {
      card.style.display = "flex";
    } else {
      card.style.display = "none";
    }
  });
});

// ========== BUY BUTTON FUNCTION ==========
document.querySelectorAll(".buy-btn").forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    const card = button.closest(".card");
    const itemName = card.querySelector(".dish-name").textContent;
    const price = parseFloat(
      card.querySelector(".price").textContent.replace("₱", "")
    );
    const quantity = 1;
    const total = price * quantity;

    const url = `cart.php?item=${encodeURIComponent(
      itemName
    )}&price=${price}&quantity=${quantity}&total=${total}&action=buy`;

    window.location.href = url;
  });
});

// ========== ADD TO CART BUTTON FUNCTION ==========
document.querySelectorAll(".cart-btn").forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    const card = button.closest(".card");
    const itemName = card.querySelector(".dish-name").textContent;
    const price = parseFloat(
      card.querySelector(".price").textContent.replace("₱", "")
    );
    const quantity = 1;
    const total = price * quantity;

    const url = `cart.php?item=${encodeURIComponent(
      itemName
    )}&price=${price}&quantity=${quantity}&total=${total}&action=add`;

    window.location.href = url;
  });
});
