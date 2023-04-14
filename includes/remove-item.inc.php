<?php

session_start();

// Get the key of the item to remove from the cart
$key = $_POST['itemKey'];

// Remove the item from the cart
unset($_SESSION['cart'][$key]);

// Redirect back to the cart page
header('Location: ../cart');
exit();
