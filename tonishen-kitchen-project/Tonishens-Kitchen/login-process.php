<?php
session_start();
include 'connect.php'; // make sure this connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT id, fname, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If email is found
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $fname, $hashed_password);
        $stmt->fetch();

        // Check password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $fname;
            header("Location: home.php"); // Redirect to the home page
            exit();
        } else {
            header("Location: sign-in.php?error=Invalid password. Please try again.");
            exit();
        }
    } else {
        header("Location: sign-in.php?error=No account found with that email.");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: sign-in.php");
    exit();
}
