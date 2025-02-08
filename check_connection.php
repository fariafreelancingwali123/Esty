<?php
$servername = "localhost";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}

// Close the connection
$conn->close();
?>
