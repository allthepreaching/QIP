<?php include_once '../header-cart.php'; ?>

<script>
    BcrumbsNavUtil.bcrumbsNav("express", "Express Add");
</script>

<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            express add
        </div>
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
                // Retrieve the cart items from the session
                $cart = $_SESSION['cart'];

                // Loop through each item in the cart
                foreach ($cart as $item) {

                    // Calculate the line total for this item
                    $line_total = $item['qty'] * $item['price'];

                    // Display the line total in the cart
                    echo "<tr>";
                    echo "<td>{$item['code']}</td>";
                    echo "<td>{$item['desc']}</td>";
                    echo "<td>{$item['qty']}</td>";
                    echo "<td>{$item['price']}</td>";
                    echo "<td>{$line_total}</td>";
                    echo "</tr>";
                }

                ?>
            <tbody>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->