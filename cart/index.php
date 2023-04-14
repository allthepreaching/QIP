<?php include_once '../header-cart.php'; ?>

<!-- PAGE CONTENT START -->
<script>
    BcrumbsNavUtil.bcrumbsNav("cart", "Shopping Cart");
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
        <table class="fl-table" role="none">
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

                        // Display the item and allow quantity adjustment
                        echo '<tr>';
                        echo '<td>' . $item['code'] . '</td>';
                        echo '<td>' . $item['desc'] . '</td>';
                        echo "<td><form id='cart-qty' action='./includes/update-cart.inc.php' method='post'>
                              <input type='hidden' name='itemKey' value='" . $itemKey . "'>
                              <input type='number' id='qty' name='qty' value='" . $item['qty'] . "' min='1' inputmode='numeric'>

                              <input type='submit' id='update-cart-qty' value='Update'>
                              </form></td>";
                        echo '<td>' . $item['price'] . '</td>';
                        echo '<td>' . $line_total . '</td>';
                        echo "<td><form method='post' action='./includes/remove-item.inc.php'>
                                 <input type='hidden' name='itemKey' value='" . $itemKey . "'>
                                 <button id='remove-link' type='submit'><ion-icon id='remove-button' name='close-circle'></ion-icon></button>
                                 </form></td>";
                        echo '</tr>';
                    }
                }
                ?>
            <tbody>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->