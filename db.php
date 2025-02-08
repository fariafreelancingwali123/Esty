<?php
// Replace these placeholders with your actual database details
$servername = "localhost";  // Usually 'localhost'
$username = "uja0kl6bt20sq"; // Replace with your database username
$password = "oadcsszjcpqc";  // Replace with your database password
$dbname = "dbilzi4xfqltxl";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
echo "Connection successful!";
?>
