<?php

include_once '../header-checkout.php';

// check for and / or set popup message variables
if (isset($_SESSION['cart_success'])) {
    $cart_success = $_SESSION['cart_success'];
} else {
    $cart_success = null;
}
if (isset($_SESSION['cart_message'])) {
    $cart_message = $_SESSION['cart_message'];
} else {
    $cart_message = null;
}

?>

<!-- PAGE CONTENT START -->

<script>
    BcrumbsNavUtil.bcrumbsNav("cart", "Shopping Cart", "checkout", " Checkout");

    // check for session variables
    var cartSuccess = <?php echo json_encode($cart_success); ?>;
    var cartMessage = <?php echo json_encode($cart_message); ?>;
    if (cartSuccess != null && cartMessage != null) {

        // create overlay
        var overlay = document.createElement('div');
        overlay.setAttribute('id', 'popup-overlay');
        document.body.appendChild(overlay);

        //create popup
        var popup = document.createElement('div');
        var content = document.createElement('div');
        var message = document.createTextNode(cartMessage);
        content.appendChild(message);
        popup.appendChild(content);

        // create close button
        var closeButton = document.createElement('button');
        closeButton.appendChild(document.createTextNode('Close'));
        popup.appendChild(closeButton);

        closeButton.addEventListener('click', function() {
            document.body.removeChild(popup);
        });

        document.body.appendChild(popup);
        popup.addEventListener('click', function() {
            document.body.removeChild(popup);
        });
        if (cartSuccess) {

            // set class for successful popup
            popup.setAttribute('class', 'popup-success cart-popup-message');
            closeButton.setAttribute('class', 'popup-close-btn cart-popup-message popup-success-btn');
        } else {

            // set class for error popup
            popup.setAttribute('class', 'popup-error cart-popup-message');
            closeButton.setAttribute('class', 'popup-close-btn cart-popup-message popup-error-btn');
        }

        // clear session variables
        <?php
        unset($_SESSION['cart_success'], $_SESSION['cart_message']);
        ?>
    }
</script>

<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            confirm checkout
        </div>
    </div>
    <div class="confirm-checkout-container">
        <a href="./cart/index.php">
            <div class="modify-cart">
                Modify Cart
            </div>
        </a>
        <a href="./includes/checkout-confirm.inc.php">
            <div class="checkout-confirm">
                Submit Order
            </div>
        </a>
    </div>
    <div class="page-table-container">
        <table class="fl-table" id="checkout-table" role="none">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Ext. Price</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // </td> variable
                $tdClose = '</td>';

                // Check if the cart is empty
                if (empty($_SESSION['cart'])) {
                    echo 'Your cart is empty';
                } else {

                    // Retrieve the cart items from the session
                    $cart = $_SESSION['cart'];

                    // Loop through each item in the cart
                    foreach ($_SESSION['cart'] as $itemKey => $item) {

                        // Calculate the line total for this item
                        $line_total = $item['qty'] * $item['price'];

                        // Display the item
                        echo '<tr>';
                        echo '<td>' . $item['code'] . $tdClose;
                        echo '<td>' . $item['desc'] . $tdClose;
                        echo '<td>' . $item['qty'] . $tdClose;
                        echo '<td>' . $item['price'] . $tdClose;
                        echo '<td>' . $line_total . $tdClose;
                        echo '</tr>';
                    }
                }
                ?>
            <tbody>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->