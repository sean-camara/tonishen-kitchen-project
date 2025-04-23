<?php

session_start();
required_once 'config.php';

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')");
    }

    header("Location: sign-up.php");
    exit();
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $username = $result->fetch_assoc();
        if (password_verify($password, $username['password'])) {
            $_SESSION['fname'] = $username['fname'];
            $_SESSION['lname'] = $username['lname'];
            $_SESSION['email'] = $username['email'];

        }
        exit();
    }
}
$_SESSION['login_error'] = 'Incorrect email or password';
$_SESSION['active_form'] = 'login';
header("Location: sign-in.php");
exit();
?>