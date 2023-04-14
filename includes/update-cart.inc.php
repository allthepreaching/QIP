<?php

session_start();

// Get the item key and new quantity from the form submission
$item_key = $_POST['itemKey'];
$new_qty = $_POST['qty'];

// Ensure the new quantity is a positive integer
$new_qty = max(1, intval($new_qty));

// Update the quantity in the session cart array
if (isset($_SESSION['cart'][$item_key])) {
    $_SESSION['cart'][$item_key]['qty'] = $new_qty;
}

// Redirect the user back to the cart page
header('Location: ../cart');
exit();
