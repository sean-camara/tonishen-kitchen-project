<?php
session_start();
require_once 'config.php';

// ✅ Handle Sign Up
if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password

    // Check if the email is already registered
    $check_email = $conn->query("SELECT email FROM users WHERE email = '$email'");

    if ($check_email->num_rows > 0) {
        // If the email exists, set a session error message
        $_SESSION['signup_error'] = "❌ Email already exists. Please use a different one.";
        header("Location: sign-up.php"); // Redirect to sign-up page with error message
        exit();
    } else {
        // Insert the new user
        $conn->query("INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')");

        $_SESSION['signup_success'] = "✅ Registration successful! You can now log in.";
        header("Location: sign-in.php"); // Redirect to sign-in page after successful sign-up
        exit();
    }
}

// ✅ Handle Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user session information
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['email'] = $user['email'];

            // Redirect to a welcome page or user dashboard after login
            header("Location: welcome.php"); // You can create a welcome page for logged-in users
            exit();
        } else {
            // Incorrect password
            $_SESSION['login_error'] = "❌ Incorrect password. Please try again.";
            header("Location: sign-in.php");
            exit();
        }
    } else {
        // Email not found
        $_SESSION['login_error'] = "❌ Email not found. Please sign up.";
        header("Location: sign-in.php");
        exit();
    }
}
?>
