<?php
session_start();
include('db.php');

if (isset($_SESSION['user_id']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $user_id = $_SESSION['user_id'];
    $cart = $_SESSION['cart'];

    // Calculate total order cost
    $total = 0;
    foreach ($cart as $product_id => $quantity) {
        $query = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($query);

        if ($result) {
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $total += $product['price'] * $quantity;
            } else {
                echo "Product with ID $product_id not found.<br>";
            }
        } else {
            echo "Error executing query: " . $conn->error . "<br>";
        }
    }

    // Insert the order into the orders table
    $query = "INSERT INTO orders (user_id, total) VALUES ($user_id, $total)";
    if ($conn->query($query)) {
        $order_id = $conn->insert_id;  // Get the inserted order ID

        // Insert order items into the order_items table
        foreach ($cart as $product_id => $quantity) {
            $query = "SELECT price FROM products WHERE id = $product_id";
            $result = $conn->query($query);
            if ($result && $result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $price = $product['price'];
                $query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES ($order_id, $product_id, $quantity, $price)";
                if (!$conn->query($query)) {
                    echo "Error inserting order item: " . $conn->error . "<br>";
                }
            } else {
                echo "Product with ID $product_id not found while adding to order items.<br>";
            }
        }

        // Clear the cart after placing the order
        unset($_SESSION['cart']);
        echo "Order placed successfully. Your total is " . number_format($total, 2) . " Rupees.";
    } else {
        echo "Error inserting order: " . $conn->error . "<br>";
    }
} else {
    echo "You must be logged in to place an order or your cart is empty.<br>";
}
?>
