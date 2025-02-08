<?php
session_start();
include('db.php');

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "Connection successful! Welcome, Seller!";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);
    $query = "INSERT INTO products (name, price, description) VALUES ('$name', '$price', '$description')";
    if ($conn->query($query) === TRUE) {
        $success_message = "Product added successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-color: #f7f8fc;
            color: #333;
            line-height: 1.6;
        }
        /* Dashboard Header */
        h1 {
            color: #2c3e50;
            padding: 2rem;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            font-size: 2rem;
            text-align: center;
        }
        /* Form Container */
        form {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        /* Form Fields */
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #e1e1e1;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52,152,219,0.3);
        }
        textarea {
            min-height: 150px;
            resize: vertical;
        }
        /* Submit Button */
        button[type="submit"] {
            background-color: #2ecc71;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #27ae60;
        }
        /* Form Labels */
        form label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
            font-weight: bold;
        }
        /* Success Message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        /* Error Message */
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                margin: 1rem;
                padding: 1rem;
            }
            h1 {
                padding: 1rem;
                font-size: 1.5rem;
            }
            button[type="submit"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <?php if (isset($success_message)): ?>
        <div class="success-message"><?= $success_message; ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="error-message"><?= $error_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
