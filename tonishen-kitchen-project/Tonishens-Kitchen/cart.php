<?php
session_start();

// If the cart array doesn't exist in session, create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle quantity update if user clicked + or -
if (isset($_GET['action'], $_GET['item'])) {
    $action = $_GET['action'];
    $itemName = $_GET['item'];

    foreach ($_SESSION['cart'] as $index => $cartItem) {
        if ($cartItem['item'] === $itemName) {
            if ($action === 'add') {
                $_SESSION['cart'][$index]['quantity'] += 1;
            } elseif ($action === 'subtract') {
                if ($_SESSION['cart'][$index]['quantity'] > 1) {
                    $_SESSION['cart'][$index]['quantity'] -= 1;
                } else {
                    unset($_SESSION['cart'][$index]);
                }
            }
            if (isset($_SESSION['cart'][$index])) {
                $_SESSION['cart'][$index]['total'] = $_SESSION['cart'][$index]['price'] * $_SESSION['cart'][$index]['quantity'];
            }
            break;
        }
    }
    header("Location: cart.php");
    exit();
}

// Handle delete action
if (isset($_GET['delete'])) {
    $itemToDelete = $_GET['delete'];
    foreach ($_SESSION['cart'] as $index => $cartItem) {
        if ($cartItem['item'] === $itemToDelete) {
            unset($_SESSION['cart'][$index]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    header("Location: cart.php");
    exit();
}

// If item is passed from GET (buy or add to cart)
if (isset($_GET['item'], $_GET['price'], $_GET['quantity'], $_GET['total'])) {
    $newItem = [
        'item' => $_GET['item'],
        'price' => floatval($_GET['price']),
        'quantity' => intval($_GET['quantity']),
        'total' => floatval($_GET['total']),
    ];
    $_SESSION['cart'][] = $newItem;
}

$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="nav-bar">
        <a href="home.php" style="text-decoration: none;">
            <div class="logo">
                <img id="logo-img" src="images/logo.jpg" alt="logo">
                <h2>Tonishen's Kitchen</h2>
            </div>
        </a>

        <div class="nav-link">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="home-menu.php">Menu</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>

        <div class="icons">
            <i id="cart" class="fa-solid fa-cart-shopping fa-3x"></i>
            <a href="profile.php"><img id="user" src="images/user.png" alt="User image"></a>
        </div>
    </div>

    <div class="back-btn">
        <button id="back-btn"><i class="fa-solid fa-arrow-left"></i> Back to Home Dashboard</button>
    </div>

    <div class="cart-container">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cart)): ?>
                    <?php foreach ($cart as $cartItem): ?>
                        <tr>
                            <td class="item-column">
                                <label class="custom-checkbox">
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <span class="dish-name"><?php echo htmlspecialchars($cartItem['item']); ?></span>
                            </td>
                            <td class="item-price">₱<?php echo number_format($cartItem['price'], 2); ?></td>
                            <td class="quantity-controls">
                                <a href="cart.php?action=subtract&item=<?php echo urlencode($cartItem['item']); ?>" class="quantity-btn minus">-</a>
                                <span class="quantity"><?php echo $cartItem['quantity']; ?></span>
                                <a href="cart.php?action=add&item=<?php echo urlencode($cartItem['item']); ?>" class="quantity-btn plus">+</a>
                            </td>
                            <td class="item-total">₱<?php echo number_format($cartItem['total'], 2); ?></td>
                            <td>
                                <a href="cart.php?delete=<?php echo urlencode($cartItem['item']); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to remove this item?');">
                                    🗑️ Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Your cart is empty.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['total'];
    }
    $salesTax = $subtotal * 0.12;
    $deliveryFee = $subtotal > 0 ? 50 : 0;
    $grandTotal = $subtotal + $salesTax + $deliveryFee;
    ?>

    <div class="total">
        <table class="summary-table">
            <tbody>
                <tr>
                    <td>Subtotal:</td>
                    <td id="subtotal">₱<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <tr>
                    <td>Sales Tax (12%):</td>
                    <td id="sales-tax">₱<?php echo number_format($salesTax, 2); ?></td>
                </tr>
                <tr>
                    <td>Delivery Fee:</td>
                    <td id="delivery-fee">₱<?php echo number_format($deliveryFee, 2); ?></td>
                </tr>
                <tr class="grand-total-row">
                    <td><strong>Grand Total:</strong></td>
                    <td id="grand-total"><strong>₱<?php echo number_format($grandTotal, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="check-out-btn">
        <button id="check-out-btn">Proceed to Check Out</button>
    </div>
    <script src="cart.js"></script>
</body>
</html>