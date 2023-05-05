<?php include_once '../header-cart.php'; ?>

<!-- PAGE CONTENT START -->

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
</div>

<!-- PAGE CONTENT END -->