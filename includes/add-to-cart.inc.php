<?php
// Start the session
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Get the product information from the form submission
$code = $_POST['code'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];
$price = $_POST['price'];

print_r($desc);

// Check if the item already exists in the cart:
$itemExists = false;
foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['code'] === $code) {
        $_SESSION['cart'][$key]['qty'] += $qty;
        $itemExists = true;
        break;
    }
}

// If the item does not exist in the cart, add the item to the cart
if (!$itemExists) {
    $item = array(
        'code' => $code,
        'desc' => $desc,
        'qty' => $qty,
        'price' => $price
    );
    $_SESSION['cart'][] = $item;
}

// Redirect the user to the cart page
header('Location: ../cart');
exit();
