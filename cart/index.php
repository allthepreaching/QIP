<?php

include_once '../header-cart.php';

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
    BcrumbsNavUtil.bcrumbsNav("cart", "Shopping Cart");

    // check for session variables
    var cartSuccess = <?php echo json_encode($cart_success); ?>;
    var cartMessage = <?php echo json_encode($cart_message); ?>;
    if (cartSuccess != null && cartMessage != null) {
        console.log(cartMessage, cartSuccess);
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
            shopping cart
        </div>
    </div>
    <div class="clear-checkout-container">
        <a href="./includes/clear-cart.inc.php">
            <div class="clear-cart">
                Clear Cart
            </div>
        </a>
        <a href="./includes/checkout.inc.php">
            <div class="checkout">
                Checkout
            </div>
        </a>
    </div>
    <div class="page-table-container">
        <table class="fl-table" id="cart-table" role="none">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Ext. Price</th>
                    <th> X </th>
                </tr>
            </thead>
            <tbody>
                <?php

                // </td> variable
                $tdClose = '</td>';
                $tdClose = '</td>';
                $trClose = '</tr>';
                $tdLight = '<td class = "tdLight">';
                $subTotal = 0;

                // Check if the cart is empty
                if (empty($_SESSION['cart'])) {
                    echo 'Your cart is empty';
                } else {

                    // Retrieve the cart items from the session
                    $cart = $_SESSION['cart'];

                    // Loop through each item in the cart
                    foreach ($_SESSION['cart'] as $itemKey => $item) {

                        // Calculate the line total for this item
                        $line_total_int = ($item['qty'] * $item['price']);
                        $line_total = number_format(($item['qty'] * $item['price']), 2);

                        // Display the item and allow quantity adjustment
                        echo '<tr>';
                        echo '<td>' . $item['code'] . $tdClose;
                        echo '<td>' . $item['desc'] . $tdClose;
                        echo "<td><form id='cart-qty' action='./includes/update-cart.inc.php' method='post'>
                              <input type='hidden' name='itemKey' value='" . $itemKey . "'>
                              <input type='number' id='qty' name='qty' value='" . $item['qty'] . "' min='1' inputmode='numeric'>

                              <input type='submit' id='update-cart-qty' value='Update'>
                              </form></td>";
                        echo '<td>$' . $item['price'] . $tdClose;
                        echo '<td>$' . $line_total . $tdClose;
                        echo "<td><form method='post' action='./includes/remove-item.inc.php'>
                                 <input type='hidden' name='itemKey' value='" . $itemKey . "'>
                                 <button id='remove-link' type='submit'><ion-icon id='remove-button' name='close-circle'></ion-icon></button>
                                 </form></td>";
                        echo '</tr>';
                        $subTotal += $line_total_int;
                    }
                }
                ?>
            <tbody>
        </table>
        <table class="fl-table" id="sub-tax-frt-total" role="none">
            <?php

            // subtotal
            echo '<tr><td class = "tdDark">Sub-Total' . $tdClose . $tdLight . '$' . number_format($subTotal, 2) . $tdClose . $trClose;

            ?>
            </tr>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->