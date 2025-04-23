<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="sign-up-style.css">
</head>
<body>
    <div class="container">
        <div class="box1">
            <img id="logo" src="images/logo.jpg" alt="logo">
            <div class="box1-text">
                <h1>Let's get started!</h1>

                <form action="login_register.php" method="post" class="form">
                <?= showError($errors['register']); ?>
                    <div class="input-box">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname">
                    </div>

                    <div class="input-box">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname">
                    </div>

                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>

                    <div class="input-box">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>

                    <p>Already have an account? <a href="sign-in.html">Sign in</a></p>

                    <button type="submit" name="register">Login</button>
                </form>
            </div>
        </div>
        <div class="box2">
            <img src="images/Rectangle 22.png" alt="background image">
        </div>
    </div>
</body>
</html>