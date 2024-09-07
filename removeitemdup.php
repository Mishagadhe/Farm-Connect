<?php
session_start();

// Check if crop is set and not empty
if (isset($_GET['crop']) && !empty($_GET['crop'])) {
    $cropToRemove = $_GET['crop'];

    // Check if cart exists and is not empty
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Loop through cart items
        foreach ($_SESSION['cart'] as $key => $item) {
            // If crop matches, remove it from the cart
            if ($item['crop'] === $cropToRemove) {
                unset($_SESSION['cart'][$key]);
                // Redirect back to cart page after removing the item
                header("Location: cart.php");
                exit();
            }
        }
    }
}

// If crop not found or cart is empty, redirect back to cart page
header("Location: checkout.php");
exit();
?>
