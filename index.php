<?php
include('db.php');

// Fetch all products from the database
$query = "SELECT * FROM products";
$result = $conn->query($query);

// Check if there are products
if ($result->num_rows > 0) {
    echo "<h1>Our Products</h1>";
    while ($product = $result->fetch_assoc()) {
        // Display product details
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<h2>" . htmlspecialchars($product['name']) . "</h2>";
        echo "<p>" . htmlspecialchars($product['description']) . "</p>";
        echo "<p>Price: " . number_format($product['price'], 2) . " Rupees</p>";
        echo "<form action='addtocart.php' method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $product['id'] . "'>";
        echo "Quantity: <input type='number' name='quantity' min='1' value='1'><br>";
        echo "<button type='submit'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "No products available.";
}
?>
