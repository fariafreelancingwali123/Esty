<?php
function convertToRupees($price) {
    // Convert price to Rupees, if needed (example, converting from USD to INR)
    $conversion_rate = 82.5; // Example conversion rate
    return $price * $conversion_rate;
}

echo convertToRupees(100); // Convert 100 USD to Rupees
?>
