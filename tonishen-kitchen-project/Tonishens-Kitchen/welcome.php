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
    <title>Home</title>
    <link rel="stylesheet" href="welcome-style.css">
</head>
<body>
    <div class="welcome-container">
        <h1 class="text">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        <p class="text" >You have successfully logged in.</p>
        <!-- Add logout link -->
         <div class="button">
        <a class="text" href="logout.php">Log out</a>
        </div>
    </div>
</body>
</html>
