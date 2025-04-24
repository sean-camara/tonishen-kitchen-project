<?php
$servername = "localhost";     // Server name (usually localhost)
$username = "root";            // Default username for XAMPP
$password = "";                // Default password for XAMPP (leave blank)
$database = "users_db";        // The name of your database

// Create the connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
