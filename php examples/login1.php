<?php
// Database connection details
$host = "localhost";
$dbname = "testdb";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($pass, $user['password'])) {
            echo "Login successful! Welcome, " . htmlspecialchars($user['username']) . ".";
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with this email. Please register first.";
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
