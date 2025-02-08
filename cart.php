<?php
session_start();
include('db.php');

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Initialize total cost
    $total = 0;
    echo "<h1>Your Cart</h1>";
    echo "<table border='1'><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";

    // Loop through cart and display items
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $query = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $product_total = $product['price'] * $quantity;
            $total += $product_total;
            echo "<tr>";
            echo "<td>" . htmlspecialchars($product['name']) . "</td>";
            echo "<td>" . htmlspecialchars($quantity) . "</td>";
            echo "<td>" . number_format($product['price'], 2) . "</td>";
            echo "<td>" . number_format($product_total, 2) . "</td>";
            echo "</tr>";
        }
    }

    echo "</table>";

    // Display total cost
    echo "<h3>Total: " . number_format($total, 2) . " Rupees</h3>";

    // Checkout form
    echo "<form method='POST' action='place_order.php'>
            <button type='submit'>Proceed to Checkout</button>
          </form>";
} else {
    echo "Your cart is empty.";
}
?>
