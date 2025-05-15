<?php
require_once 'connect.php';

// Fetch all dishes from the database
$sql = "SELECT dish_name, price, image, category, description FROM dishes ORDER BY dish_name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu</title>
    <link rel="stylesheet" href="home-menu-style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet" />
    <link rel="icon" id="tab-logo" type="image/png" href="images/Ellipse 2.png" />
</head>
<body>
    <div class="nav-bar">
        <a href="home.php" style="text-decoration: none;">
            <div class="logo">
                <img id="logo-img" src="images/logo.jpg" alt="logo" />
                <h2>Tonishen's Kitchen</h2>
            </div>
        </a>

        <div class="nav-link">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>

        <div class="icons">
            <a href="cart.php"><i id="cart" class="fa-solid fa-cart-shopping fa-3x"></i></a>
            <a href="profile.php"><img id="user" src="images/user.png" alt="User image" /></a>
        </div>
    </div>

    <div class="welcome-page">
        <h3>Tonishen's MENU</h3>
        <p id="category-paragraph">All Category</p>
    </div>

    <div class="category">
        <label for="category" style="font-family: 'Poppins', sans-serif; font-size: 18px;">Choose Category:</label>
        <select id="category" name="category" style="margin: 10px 0; padding: 8px 12px; font-family: 'Poppins', sans-serif; border-radius: 6px;">
            <option value="all">All</option>
            <option value="pork">Pork</option>
            <option value="beef">Beef</option>
            <option value="chicken">Chicken</option>
            <option value="seafood">Seafood</option>
            <option value="vegetable">Vegetable</option>
        </select>
    </div>

    <div class="card-container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($dish = $result->fetch_assoc()): ?>
                <div class="card" data-category="<?= htmlspecialchars(strtolower($dish['category'])) ?>">
                    <?php if (!empty($dish['image'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($dish['image']) ?>" alt="<?= htmlspecialchars($dish['dish_name']) ?>" class="dish-image" />
                    <?php else: ?>
                        <img src="images/default-dish.png" alt="No Image" class="dish-image" />
                    <?php endif; ?>

                    <h2 class="dish-name"><?= htmlspecialchars($dish['dish_name']) ?></h2>
                    <p class="price">₱<?= number_format($dish['price'], 2) ?></p>
                    <p class="description"><?= htmlspecialchars($dish['description']) ?></p>

                    <form action="cart.php" method="get" class="btn-group">
                        <input type="hidden" name="item" value="<?= htmlspecialchars($dish['dish_name']) ?>">
                        <input type="hidden" name="price" value="<?= $dish['price'] ?>">
                        <input type="number" name="quantity" value="1" min="1" style="width: 60px;" />
                        <input type="hidden" name="total" value="<?= $dish['price'] ?>">
                        <button type="submit" name="action" value="buy" class="buy-btn">Buy</button>
                        <button type="submit" name="action" value="add" class="cart-btn">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No dishes found.</p>
        <?php endif; ?>
    </div>

    <script src="home-menu.js"></script>
</body>
</html>
