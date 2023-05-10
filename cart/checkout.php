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

$_SESSION['tracking'] = ['1ZW1X4056587416859456852', '1ZW1X4056577416859456852', '1ZW1X4956587416859456852'];
$_SESSION['ship_via'] = 'UPSGND';
$_SESSION['packages'] = 3;
$_SESSION['order_weight'] = 44;
$_SESSION['freight'] = 10;
$_SESSION['taxable'] = true;
$_SESSION['sub_total'] = 0;
$_SESSION['sales_tax'] = 0;
$_SESSION['order_total'] = 0;

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
    <div class="checkout-steps">
        <div class="checkout-steps-list">
            <div class="checkout-step checkout-step-one">
                <div class="checkout-step-header">
                    <div class="header-arrow-container-billing active">
                        <span class="span-header-arrow-billing"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <div class="header-check-container-billing">
                        <span class="span-header-check-billing"><ion-icon name="checkmark-circle"></ion-icon></span>
                    </div>
                    <span class="span-header-billing">billing information</span>
                    <div class="header-edit-container-billing">
                        <span class="span-header-edit-billing"><ion-icon name="create"></ion-icon></span>
                    </div>
                </div>
                <div class="checkout-data-billing">
                </div>
            </div>
            <div class="checkout-step checkout-step-two">
                <div class="checkout-step-header">
                    <div class="header-arrow-container-shipping active">
                        <span class="span-header-arrow-shipping"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <div class="header-check-container-shipping">
                        <span class="span-header-check-shipping"><ion-icon name="checkmark-circle"></ion-icon></span>
                    </div>
                    <span class="span-header-shipping">shipping information</span>
                    <div class="header-edit-container-shipping">
                        <span class="span-header-edit-shipping"><ion-icon name="create"></ion-icon></span>
                    </div>
                </div>
                <div class="checkout-data-shipping">
                    <div class="user-checkout-shipping">
                        <span id="u_add_company"></span>
                        <span id="u_add_street1"></span>
                        <span id="u_add_street2"></span>
                        <span id="u_add_street3"></span>
                        <span id="u_add_city"></span>
                        <div class="address-state-zip">
                            <span maxlength="2" id="u_add_state"></span>
                            <span id="u_add_zip"></span>
                        </div>
                        <span id="u_add_phone"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-information">
            <div class="checkout-information-billing active">
                <div class="checkout-info-header">
                    <div class="info-header-arrow-container">
                        <span class="span-info-header-arrow"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <span class="span-info-header">billing information</span>
                </div>
                <div class='checkout-steps-dropdown-billing'>
                    <div class='selected-option-billing'>
                        <span>Select Billing Address*</span>
                        <ion-icon name="arrow-round-down" class="dropdown-down-arrow"></ion-icon>
                    </div>
                    <ul class="bill-address-options">
                        <?php
                        $userId = $_SESSION['userid'];

                        // Retrieve data from table using OOP style
                        $sql = $conn->prepare("SELECT * FROM user_address WHERE u_id = ? ORDER BY u_add_billto DESC");
                        $sql->bind_param("i", $userId);
                        $sql->execute();
                        $result = $sql->get_result();

                        // Create dropdown menu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<li id='" . $row["u_add_id"] . "'>";
                                if ($row['u_add_billto'] === 1) {
                                    echo "<ion-icon name='cash' class = 'option-bill-default-icon'></ion-icon>";
                                    echo $row["u_add_company"];
                                    echo " -- ";
                                    echo $row["u_add_street1"];
                                    if ($row['u_add_street2'] != null) {
                                        echo " " . $row['u_add_street2'];
                                    }
                                    if ($row['u_add_street3'] != null) {
                                        echo " " . $row['u_add_street3'];
                                    }
                                    echo " " . $row['u_add_city'];
                                    echo " " . $row['u_add_state'];
                                    echo " " . $row['u_add_zip'];
                                    echo " " . $row['u_add_phone'];
                                    echo "</li>";
                                } else {
                                    echo $row["u_add_company"];
                                    echo " -- ";
                                    echo $row["u_add_street1"];
                                    if ($row['u_add_street2'] != null) {
                                        echo " " . $row['u_add_street2'];
                                    }
                                    if ($row['u_add_street3'] != null) {
                                        echo " " . $row['u_add_street3'];
                                    }
                                    echo " " . $row['u_add_city'];
                                    echo " " . $row['u_add_state'];
                                    echo " " . $row['u_add_zip'];
                                    echo " " . $row['u_add_phone'];
                                    echo "</li>";
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="checkout-info-continue">
                    <button id="submitContinueBill" class="submit-continue">Continue</button>
                    <span>* = Required Field</span>
                </div>
            </div>
            <div class="checkout-information-shipping">
                <div class="checkout-info-header">
                    <div class="info-header-arrow-container">
                        <span class="span-info-header-arrow"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <span class="span-info-header">shipping information</span>
                </div>
                <div class='checkout-steps-dropdown-shipping'>
                    <div class='selected-option-shipping'>
                        <span>Select Shipping Address*</span>
                        <ion-icon name="arrow-round-down" class="dropdown-down-arrow"></ion-icon>
                    </div>
                    <ul class="ship-address-options">
                        <?php
                        $userId = $_SESSION['userid'];

                        // Retrieve data from table using OOP style
                        $sql = $conn->prepare("SELECT * FROM user_address WHERE u_id = ? ORDER BY u_add_shipto DESC");
                        $sql->bind_param("i", $userId);
                        $sql->execute();
                        $result = $sql->get_result();

                        // Create dropdown menu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<li id='" . $row["u_add_id"] . "'>";
                                if ($row['u_add_shipto'] === 1) {
                                    echo "<ion-icon name='car' class = 'option-ship-default-icon'></ion-icon>";
                                    echo $row["u_add_company"];
                                    echo " -- ";
                                    echo $row["u_add_street1"];
                                    if ($row['u_add_street2'] != null) {
                                        echo " " . $row['u_add_street2'];
                                    }
                                    if ($row['u_add_street3'] != null) {
                                        echo " " . $row['u_add_street3'];
                                    }
                                    echo " " . $row['u_add_city'];
                                    echo " " . $row['u_add_state'];
                                    echo " " . $row['u_add_zip'];
                                    echo " " . $row['u_add_phone'];
                                    echo "</li>";
                                } else {
                                    echo $row["u_add_company"];
                                    echo " -- ";
                                    echo $row["u_add_street1"];
                                    if ($row['u_add_street2'] != null) {
                                        echo " " . $row['u_add_street2'];
                                    }
                                    if ($row['u_add_street3'] != null) {
                                        echo " " . $row['u_add_street3'];
                                    }
                                    echo " " . $row['u_add_city'];
                                    echo " " . $row['u_add_state'];
                                    echo " " . $row['u_add_zip'];
                                    echo " " . $row['u_add_phone'];
                                    echo "</li>";
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="checkout-info-continue">
                    <button id="submitContinueShip" class="submit-continue">Continue</button>
                    <span>* = Required Field</span>
                </div>
                <div class="checkout-back checkout-back-ship">
                    Back
                </div>
            </div>
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

                // variables
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
                        $line_total = $item['qty'] * $item['price'];

                        // Display the item
                        echo '<tr>';
                        echo '<td>' . $item['code'] . $tdClose;
                        echo '<td>' . $item['desc'] . $tdClose;
                        echo '<td>' . $item['qty'] . $tdClose;
                        echo '<td>' . $item['price'] . $tdClose;
                        echo '<td>' . $line_total . $tdClose;
                        echo '</tr>';
                        $_SESSION['sub_total'] += $line_total;
                    }
                }
                if (!$_SESSION['taxable'] === true) {
                    $_SESSION['sales_tax'] = 0;
                } else {
                    $_SESSION['sales_tax'] = $_SESSION['sub_total'] * 0.0625;
                }
                $_SESSION['order_total'] = ($_SESSION['sub_total'] + $_SESSION['sales_tax'] + $_SESSION['freight']);
                ?>
            <tbody>
        </table>
        <table class="fl-table" id="sub-tax-frt-total" role="none">
            <?php

            // show subtotal tax freight total
            echo '<tr><td class = "tdDark">Sub-Total' . $tdClose . $tdLight . '$' . number_format($_SESSION['sub_total'], 2) . $tdClose . $trClose;
            echo '<tr><td class = "tdDark">Tax' . $tdClose . $tdLight . '$' . number_format($_SESSION['sales_tax'], 2) . $tdClose . $trClose;
            echo '<tr><td class = "tdDark">Freight' . $tdClose . $tdLight . '$' . number_format($_SESSION['freight'], 2) . $tdClose . $trClose;
            echo '<tr><td class = "tdTotal">Total' . $tdClose . '<td class = "tdTotal">' . '$' . number_format($_SESSION['order_total'], 2) . $tdClose . $trClose;

            ?>
            </tr>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->