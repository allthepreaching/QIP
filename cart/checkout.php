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
                <div class="checkout-data-shipping-backorder">
                </div>
                <div class="checkout-data-shipping-bill-type">
                </div>
                <div class="checkout-data-shipping-address">
                </div>
            </div>
            <div class="checkout-step checkout-step-three">
                <div class="checkout-step-header">
                    <div class="header-arrow-container-ship-method active">
                        <span class="span-header-arrow-ship-method"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <div class="header-check-container-ship-method">
                        <span class="span-header-check-ship-method"><ion-icon name="checkmark-circle"></ion-icon></span>
                    </div>
                    <span class="span-header-ship-method">shipping method</span>
                    <div class="header-edit-container-ship-method">
                        <span class="span-header-edit-ship-method"><ion-icon name="create"></ion-icon></span>
                    </div>
                </div>
                <div class="checkout-data-ship-method-method">
                </div>
                <div class="checkout-data-ship-method-account">
                </div>
                <div class="checkout-data-ship-method-notes">
                </div>
            </div>
            <div class="checkout-step checkout-step-four">
                <div class="checkout-step-header">
                    <div class="header-arrow-container-payment active">
                        <span class="span-header-arrow-payment"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <div class="header-check-container-payment">
                        <span class="span-header-check-payment"><ion-icon name="checkmark-circle"></ion-icon></span>
                    </div>
                    <span class="span-header-payment">payment method</span>
                    <div class="header-edit-container-payment">
                        <span class="span-header-edit-payment"><ion-icon name="create"></ion-icon></span>
                    </div>
                </div>
                <div class="checkout-data-payment">
                </div>
            </div>
            <div class="checkout-step checkout-step-five">
                <div class="checkout-step-header">
                    <div class="header-arrow-container-review active">
                        <span class="span-header-arrow-review"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <span class="span-header-review">order review</span>
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
                <div class='checkout-steps-dropdown-shipping-backorder'>
                    <div class='selected-option-shipping-backorder'>
                        <span>Select Backorder Preference*</span>
                        <ion-icon name="arrow-round-down" class="dropdown-down-arrow"></ion-icon>
                    </div>
                    <ul class="ship-backorder-options">
                        <?php

                        // Retrieve data from table using OOP style
                        $sql = $conn->prepare("SELECT * FROM ship_preference WHERE ship_pref_type = 'backorder'");
                        $sql->execute();
                        $result = $sql->get_result();

                        // Create dropdown menu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li>';
                                echo $row["ship_pref"];
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='checkout-steps-dropdown-shipping-bill-type'>
                    <div class='selected-option-shipping-bill-type'>
                        <span>Select Shipment Billing Type*</span>
                        <ion-icon name="arrow-round-down" class="dropdown-down-arrow"></ion-icon>
                    </div>
                    <ul class="ship-bill-type-options">
                        <?php

                        // Retrieve data from table using OOP style
                        $sql = $conn->prepare("SELECT * FROM ship_preference WHERE ship_pref_type = 'bill_type'");
                        $sql->execute();
                        $result = $sql->get_result();

                        // Create dropdown menu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li>';
                                echo $row["ship_pref"];
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='checkout-steps-dropdown-shipping-address'>
                    <div class='selected-option-shipping-address'>
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
            <div class="checkout-information-ship-method">
                <div class="checkout-info-header">
                    <div class="info-header-arrow-container">
                        <span class="span-info-header-arrow"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <span class="span-info-header">shipping method</span>
                </div>
                <div class="ship-method-weight">
                    <div class="ship-method-weight-title">
                        approximate order weight:
                    </div>
                    <div class="ship-method-weight-weight">
                        <?php echo $_SESSION['order_weight'] . ' lbs.'; ?>
                    </div>
                </div>
                <div class='checkout-steps-dropdown-ship-method'>
                    <div class='selected-option-ship-method'>
                        <span>Select Shipping Method*</span>
                        <ion-icon name="arrow-round-down" class="dropdown-down-arrow"></ion-icon>
                    </div>
                    <ul class="ship-method-options">
                        <?php

                        // Retrieve data from table using OOP style
                        $sql = $conn->prepare("SELECT * FROM ship_preference WHERE ship_pref_type = 'method'");
                        $sql->execute();
                        $result = $sql->get_result();

                        // Create dropdown menu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li>';
                                echo $row["ship_pref"];
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="ship-method-account-number active">
                    <input type="text" name="ship-method-account-number" id="ship-method-account-number" placeholder="account number*" required>
                </div>
                <div class="ship-method-delivery-instructions">
                    <input type="text" name="ship-method-delivery-instructions" id="ship-method-delivery-instructions" placeholder="delivery instructions">
                </div>
                <div class="checkout-info-continue">
                    <button id="submitContinueShipMethod" class="submit-continue">Continue</button>
                    <span>* = Required Field</span>
                </div>
                <div class="checkout-back checkout-back-ship-method">
                    Back
                </div>
                <div class="policy-notes">
                    <span class="note-title">Shipping Charges:</span><span> If charges are not shown, the rate will be calculated & then added at the time of shipment, or collected on delivery.</span>
                    <span class="note-title">Tax Exempt:</span><span> You must have a Sales Tax Exempt Certificate on file before submitting your order to avoid any sales tax. Please contact us for questions or details.</span>
                    <span class="note-title">Tax Amount:</span><span> The estimated sales tax is shown. The actual sales tax collected at the time of billing may vary.</span>
                    <span class="note-title">Expedited Orders:</span><span> Any orders received after 1pm EST, with expedited shipping, may not ship the same day.</span>
                    <span class="note-title">Small Order Fee:</span><span> A small order fee of $10.00 applies to all orders with a net sales value of less than $50.00.</span>
                </div>
            </div>
            <div class="checkout-information-payment">
                <div class="checkout-info-header">
                    <div class="info-header-arrow-container">
                        <span class="span-info-header-arrow"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <span class="span-info-header">Payment method</span>
                </div>
                <div class='checkout-steps-dropdown-payment'>
                    <div class='selected-option-payment'>
                        <span>Select Payment Method*</span>
                        <ion-icon name="arrow-round-down" class="dropdown-down-arrow"></ion-icon>
                    </div>
                    <ul class="payment-options">
                        <?php

                        // Retrieve data from table using OOP style
                        $sql = $conn->prepare("SELECT * FROM payment_options");
                        $sql->execute();
                        $result = $sql->get_result();

                        // Create dropdown menu
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li>';
                                echo $row["pay_opt"];
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="checkout-info-continue">
                    <button id="submitContinuePayment" class="submit-continue">Continue</button>
                    <span>* = Required Field</span>
                </div>
                <div class="checkout-back checkout-back-payment">
                    Back
                </div>
            </div>
            <div class="checkout-information-review">
                <div class="checkout-info-header">
                    <div class="info-header-arrow-container">
                        <span class="span-info-header-arrow"><ion-icon name="arrow-dropright-circle"></ion-icon></span>
                    </div>
                    <span class="span-info-header">order review</span>
                </div>
                <div class='checkout-steps-review'>
                    <div class="order-review-po">
                        <input type="text" name="po-number" id="po-number" placeholder="purchase order number">
                    </div>
                    <div class="order-review-notes">
                        <input type="text" name="order-notes" id="order-notes" placeholder="order notes">
                    </div>
                </div>
                <div class="checkout-info-continue">
                    <button id="submitContinueReview" class="submit-continue">Submit Order</button>
                </div>
                <div class="checkout-back checkout-back-review">
                    Back
                </div>
                <div class="policy-notes">
                    <span class="note-title">Shipping Charges:</span><span> If charges are not shown, the rate will be calculated & then added at the time of shipment, or collected on delivery.</span>
                    <span class="note-title">Tax Exempt:</span><span> You must have a Sales Tax Exempt Certificate on file before submitting your order to avoid any sales tax. Please contact us for questions or details.</span>
                    <span class="note-title">Tax Amount:</span><span> The estimated sales tax is shown. The actual sales tax collected at the time of billing may vary.</span>
                    <span class="note-title">Expedited Orders:</span><span> Any orders received after 1pm EST, with expedited shipping, may not ship the same day.</span>
                    <span class="note-title">Small Order Fee:</span><span> A small order fee of $10.00 applies to all orders with a net sales value of less than $50.00.</span>
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
                $sof = 0;

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

                        // Display the item
                        echo '<tr>';
                        echo '<td>' . $item['code'] . $tdClose;
                        echo '<td>' . $item['desc'] . $tdClose;
                        echo '<td>' . $item['qty'] . $tdClose;
                        echo '<td>$' . $item['price'] . $tdClose;
                        echo '<td>$' . $line_total . $tdClose;
                        echo '</tr>';
                        $subTotal += $line_total_int;
                        $_SESSION['sub_total'] = $subTotal;
                    }
                }
                if ($_SESSION['sub_total'] < 50) {
                    $_SESSION['sof'] = 10;
                } else {
                    $_SESSION['sof'] = 0;
                }
                if (!$_SESSION['taxable'] === true) {
                    $_SESSION['sales_tax'] = 0;
                } else {
                    $_SESSION['sales_tax'] = $subTotal * 0.0625;
                }
                $_SESSION['order_total'] = ($_SESSION['sof'] + $subTotal + $_SESSION['sales_tax'] + $_SESSION['freight']);
                ?>
            <tbody>
        </table>
        <table class="fl-table" id="sub-tax-frt-total" role="none">
            <?php

            // subtotal
            echo '<tr><td class = "tdDark">Sub-Total' . $tdClose . $tdLight . '$' . number_format($subTotal, 2) . $tdClose . $trClose;

            // sof
            if ($_SESSION['sof'] > 0) {
                echo '<tr><td class = "tdDark">Small Order Fee' . $tdClose . $tdLight . '$' . number_format($_SESSION['sof'], 2) . $tdClose . $trClose;
            }

            // tax
            echo '<tr><td class = "tdDark">Tax' . $tdClose . $tdLight . '$' . number_format($_SESSION['sales_tax'], 2) . $tdClose . $trClose;

            // freight
            echo '<tr><td class = "tdDark">Freight' . $tdClose . $tdLight . '$' . number_format($_SESSION['freight'], 2) . $tdClose . $trClose;

            // total
            echo '<tr><td class = "tdTotal">Total' . $tdClose . '<td class = "tdTotal">' . '$' . number_format($_SESSION['order_total'], 2) . $tdClose . $trClose;

            ?>
            </tr>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->