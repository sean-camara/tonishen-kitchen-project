<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // If no user is logged in, redirect to sign-in page
    header("Location: sign-in.php");
    exit();
}

$user_name = $_SESSION['user_name']; // Get the user's name from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" id="tab-logo" type="image/png" href="images/Ellipse 2.png">
</head>
<body>
    <div class="nav-bar">
        <a href="home.php" style="text-decoration: none;"><div class="logo">
            <img id="logo-img" src="images/logo.jpg" alt="logo">
            <h1>Tonishen's Kitchen</h1>
        </div></a>

        <div class="nav-link">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>

        <div class="icons">
            <i id="cart" class="fa-solid fa-cart-shopping fa-3x"></i>
            <a href="profile.php"><img id="user" src="images/user.png" alt="User image"></a>
        </div>
    </div>

    <div class="container">
        <div class="box1">
            <div class="myacc">
                <h3>My Account</h3>
            </div>
            <div class="myacc-btn">
                <a href="#"><button id="profile" class="btn">Profile</button></a>
            </div>
            <div class="myacc-btn">
                <a href="#"><button id="address" class="btn">Address</button></a>
            </div>
            <div class="myacc-btn">
                <a href="#"><button id="contact" class="btn">Contact</button></a>
            </div>
            <div class="myacc-btn">
                <a href="#"><button id="settings" class="btn">Settings</button></a>
            </div>
            <div class="myacc-btn">
                <a href="#"><button id="logout" class="btn">Logout</button></a>
            </div>
        </div>

        <div id="profile_con" class="box2">
            <div class="box2-con">
                <h2>Profile</h2>
            </div>
        </div>

        <div id="address_con" class="box2" style="display: none;">
            <div class="box2-con">
                <h2>Address</h2>
            </div>
        </div>

        <div id="contact_con" class="box2" style="display: none;">
            <div class="box2-con">
                <h2>Contact</h2>
            </div>
        </div>

        <div id="settings_con" class="box2" style="display: none;">
            <div class="box2-con">
                <h2>Settings</h2>
            </div>
        </div>

        <div id="logout_con" class="box2" style="display: none;">
            <div class="box2-con">
                <h2>Logout</h2>
            </div>
            <div class="logout-con">
                <p id="logout-text">Logout</p>
                <button id="logoutBtn" class="btn">Logout</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>