<?php
$host = "localhost"; // Change if using a different host
$user = "root";      // Your MySQL username
$password = "";      // Your MySQL password
$database = "user_management"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
