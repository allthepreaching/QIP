<?php

include_once '../header-account.php';


if (isset($_SESSION['address_success'])) {
    $address_success = $_SESSION['address_success'];
} else {
    $address_success = null;
}
if (isset($_SESSION['address_message'])) {
    $address_message = $_SESSION['address_message'];
} else {
    $address_message = null;
}

?>

<script>
    BcrumbsNavUtil.bcrumbsNav("youraccount", " Your Account");

    // check for session variables
    var addressSuccess = <?php echo json_encode($address_success); ?>;
    var addressMessage = <?php echo json_encode($address_message); ?>;
    if (addressSuccess != null && addressMessage != null) {

        // create overlay
        var overlay = document.createElement('div');
        overlay.setAttribute('id', 'popup-overlay');
        document.body.appendChild(overlay);

        //create popup
        var popup = document.createElement('div');
        var content = document.createElement('div');
        var message = document.createTextNode(addressMessage);
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
        if (addressSuccess) {

            // set class for successful popup
            popup.setAttribute('class', 'popup-success popup-message');
            closeButton.setAttribute('class', 'popup-close-btn popup-message popup-success-btn');
        } else {

            // set class for error popup
            popup.setAttribute('class', 'popup-error popup-message');
            closeButton.setAttribute('class', 'popup-close-btn popup-message popup-error-btn');
        }

        // clear session variables
        <?php
        unset($_SESSION['address_success'], $_SESSION['address_message']);
        ?>
    }
</script>

<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            your account
        </div>
        <div class="page-sub-header-container">
            <div class="holder-account" id="holder-account">
                <div class='tabbed'>
                    <div class='tab-list'>
                        <label for="" class="your-account-tab list-element popup-message-your-account activated" id="your-account-tab-id">
                            <ion-icon name="contact"></ion-icon>
                            <span class="topic">Your Account</span>
                        </label>
                        <label for="" class="account-tab list-element popup-message-account" id="account-tab-id">
                            <ion-icon name="contacts"></ion-icon>
                            <span class="topic">Account Info</span>
                        </label>
                        <label for="" class="address-tab list-element popup-message-address" id="address-tab-id">
                            <ion-icon name="book"></ion-icon>
                            <span class="topic">Address Book</span>
                        </label>
                        <label for="" class="orders-tab list-element popup-message-orders" id="orders-tab-id">
                            <ion-icon name="cube"></ion-icon>
                            <span class="topic">Order History</span>
                        </label>
                        <label for="" class="carts-tab list-element popup-message-carts" id="carts-tab-id">
                            <ion-icon name="cart"></ion-icon>
                            <span class="topic">Saved Carts</span>
                        </label>
                        <label for="" class="billing-tab list-element popup-message-billing" id="billing-tab-id">
                            <ion-icon name="copy"></ion-icon>
                            <span class="topic">Billing Info</span>
                        </label>
                        <label for="" class="password-tab list-element popup-message-password" id="password-tab-id">
                            <ion-icon name="lock"></ion-icon>
                            <span class="topic">Password</span>
                        </label>
                    </div>
                </div>
                <div class="account-content" id="account-content">
                    <div class="your-account-info  list-element popup-message-your-account activated" id="your-account-tab">
                        <div class="account-data-header">
                            your account
                        </div>
                        <div class="account-data">
                            You are signed in as <?php echo $_SESSION['username'] . ' (' . $_SESSION['email'] . ').'; ?>
                            <div class="account-tab-links">
                                <div class="account-tab-link">
                                    <label for="" class="account-tab">
                                        <ion-icon name="contacts"></ion-icon>
                                        <span class="topic">Account Information</span>
                                    </label>
                                    <span class="description">View and modify your username & email address.
                                    </span>
                                </div>
                                <div class="account-tab-link">
                                    <label for="" class="address-tab">
                                        <ion-icon name="book"></ion-icon>
                                        <span class="topic">Address Book</span>
                                    </label>
                                    <span class="description">View, modify & add new shipping or billing addresses.
                                    </span>
                                </div>
                                <div class="account-tab-link">
                                    <label for="" class="orders-tab">
                                        <ion-icon name="cube"></ion-icon>
                                        <span class="topic">Order History</span>
                                    </label>
                                    <span class="description">View, duplicate, or get tracking for previously placed orders.
                                    </span>
                                </div>
                                <div class="account-tab-link">
                                    <label for="" class="carts-tab">
                                        <ion-icon name="cart"></ion-icon>
                                        <span class="topic">Saved Shopping Carts
                                        </span>
                                    </label>
                                    <span class="description">View & modify saved carts for checkout, or print them as a quote.
                                    </span>
                                </div>
                                <div class="account-tab-link">
                                    <label for="" class="billing-tab">
                                        <ion-icon name="copy"></ion-icon>
                                        <span class="topic">Billing Information</span>
                                    </label>
                                    <span class="description">View, modify & add new information related to payments and terms.
                                    </span>
                                </div>
                                <div class="account-tab-link">
                                    <label for="" class="password-tab">
                                        <ion-icon name="lock"></ion-icon>
                                        <span class="topic">Update Password</span>
                                    </label>
                                    <span class="description">Modify your account password.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-info list-element popup-message-account" id="account-tab">
                        <div class="account-data-header">
                            account information
                        </div>
                        <div class="account-data">
                            <?php include_once 'account-info.php'; ?>
                        </div>
                    </div>
                    <div class="address-info list-element popup-message-address" id="address-tab">
                        <div class="account-data-header">
                            address book
                        </div>
                        <div class="account-data">
                            <?php include_once 'address-book.php'; ?>
                        </div>
                    </div>
                    <div class="orders-info list-element popup-message-orders" id="orders-tab">
                        <div class="account-data-header">
                            orders information header
                        </div>
                        <div class="account-data">
                            orders information content
                        </div>
                    </div>
                    <div class="carts-info list-element popup-message-carts" id="carts-tab">
                        <div class="account-data-header">
                            saved shopping carts header
                        </div>
                        <div class="account-data">
                            saved shopping carts content
                        </div>
                    </div>
                    <div class="billing-info list-element popup-message-billing" id="billing-tab">
                        <div class="account-data-header">
                            billing information header
                        </div>
                        <div class="account-data">
                            billing information content
                        </div>
                    </div>
                    <div class="password-info list-element popup-message-password" id="password-tab">
                        <div class="account-data-header">
                            update password header
                        </div>
                        <div class="account-data">
                            update password content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT END -->