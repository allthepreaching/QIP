<?php include_once '../header-cart.php'; ?>

<script>
    BcrumbsNavUtil.bcrumbsNav("thankyou", "Thank You");
</script>

<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            thank you for the order!
        </div>
    </div>
    <div class="print-email-container">
        <a href="./includes/conf-print.inc.php">
            <div class="print-conf">
                <ion-icon name="print"></ion-icon>
                Print Confirmation
            </div>
        </a>
        <a href="./includes/conf-email.inc.php">
            <div class="email-conf">
                <ion-icon name="mail"></ion-icon>
                Email Confirmation
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
                        echo '<td>' . $item['qty'] . '</td>';
                        echo '<td>' . $item['price'] . '</td>';
                        echo '<td>' . $line_total . '</td>';
                    }
                }
                ?>
            <tbody>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->