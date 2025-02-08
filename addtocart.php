<?php
session_start();
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product ID and quantity
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Validate quantity (ensure it's a positive number)
    if (isset($quantity) && $quantity > 0) {
        // Check if cart exists in session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // If the product is already in the cart, update the quantity
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            // If the product is not in the cart, add it
            $_SESSION['cart'][$product_id] = $quantity;
        }

        // Redirect to the cart page
        header("Location: cart.php");
    } else {
        echo "Invalid quantity.";
    }
}
?>
