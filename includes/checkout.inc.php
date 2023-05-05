<?php

include_once 'dbh-wamp.inc.php';

session_start();

$urlCart = 'Location: ../cart';
$urlCheckout = 'Location: ../cart/checkout.php';

// if the cart is empty Redirect to cart page
if (empty($_SESSION['cart'])) {
    $_SESSION['cart_success'] = false;
    $_SESSION['cart_message'] = 'Your cart is empty.';
    header($urlCart);
    exit();
} else {
    header($urlCheckout);
}
