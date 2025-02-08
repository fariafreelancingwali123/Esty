<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include('db.php');

// Fetch the content from the database
$query = "SELECT * FROM content_table"; // Replace 'content_table' with your actual table name
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Loop through and display each content entry
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";  // Display the title of the content
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";  // Display the content
    }
} else {
    echo "No content found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
</head>
<body>
    <h1>Welcome to the Content Page</h1>
</body>
</html>
