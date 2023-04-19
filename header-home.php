<?php

include_once 'includes/dbh-wamp.inc.php';

session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['order_date'])) {

    // Set the default timezone to the customer's timezone
    date_default_timezone_set('America/New_York');

    // Create a DateTime object for the current date and time
    $now = new DateTime();

    // Format the date and time as a string
    $_SESSION['order_date'] = $now->format('m-d-Y');
}

// Loop through the cart and calculate the total cost of the cart:
$cart_total = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_total += $item['price'] * $item['qty'];
}

// Store the total cost of the cart in a session variable
$_SESSION['cart_total'] = $cart_total;

// Calculate the total number of items
$total_items = count($_SESSION['cart']);

// Store the total number of items in a session variable
$_SESSION['total_items'] = $total_items;
?>

<!DOCTYPE html>
<html lang="en-US" class="background-100-e">

<!-- HEAD START -->

<head>

    <!-- META START -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Quality Industrial Products. A full line industrial supply wholesaler specializing in customer problem solving, Vendor Managed Inventory Systems, fasteners and industrial supplies." />
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="fastener,fasteners,nut,bolt,washer,screw,industry,industrial,supply,supplies,rags,chemicals,tools,accessories,hardware,vmi,vendor,managed,inventory,stock,delivery,quote,order,abrasives,drills,drill,bit,bits,hand,tool,tools,spray,chemical,mro,shop,janitorial,office,sanitation,wholesale,store,specialty" />
    <!-- META END -->

    <!-- META OG START -->
    <meta property="og:locale" content="en_US" />
    <meta property=”og:type” content=”article” />
    <meta property="og:title" content="Quality Industrial Products" />
    <meta property="og:description" content="Quality Industrial Products. A full line industrial supply wholesaler specializing in customer problem solving, Vendor Managed Inventory Systems, fasteners and industrial supplies." />
    <meta property="og:url" content="http://www.qip.qualityindustrialproducts.com" />
    <meta property="og:image" content="http://www.qip.qualityindustrialproducts.com/images/qip.png" />
    <meta property="og:image:alt" content="Quality Industrial Products" />
    <!-- META OG END -->

    <!-- FAVICON START -->
    <link rel="shortcut icon" href="./favicon/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png" />
    <link rel="manifest" href="./favicon/site.webmanifest" />
    <!-- FAVICON END -->

    <!-- BASE HREF START -->
    <base href="http://192.168.0.171/!QIP/QIP/">
    <!-- BASE HREF END -->

    <!-- CSS START -->
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/breadcrumbs_navigation.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/contact-bar.css">
    <link rel="stylesheet" href="./css/cart-search-bar.css">
    <link rel="stylesheet" href="./css/content-container.css">
    <link rel="stylesheet" href="./css/pages-categories.css">
    <link rel="stylesheet" href="./css/pages.css">
    <link rel="stylesheet" href="./css/page-table.css">
    <!-- CSS END -->

    <!-- JS START -->
    <script defer src="./js/navbar.js"></script>
    <script defer src="./js/categories-home.js"></script>
    <script src="./js/breadcrumbs_navigation.js"></script>
    <!-- JS END -->


    <!-- ICONS START -->
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <!-- ICONS END -->

    <!-- TITLE -->
    <title>Quality Industrial</title>

</head>

<!-- BODY START -->

<body class="body-container">

    <!-- NAVBAR START -->
    <?php include_once 'navigation-bar-home.php'; ?>
    <!-- NAVBAR END -->

    <!-- CONTACT BAR START -->
    <?php include_once 'contact-bar.php'; ?>
    <!-- CONTACT BAR END -->

    <!-- CART / SEARCH BAR START -->
    <?php include_once 'cart-search-bar.php'; ?>
    <!-- CART / SEARCH BAR END -->

    <!-- BREADCRUMBS START -->
    <div class="breadcrumbs">
        <span id="bcrumbsNavElement" class="breadcrumbs-element"></span>
    </div>
    <!-- BREADCRUMBS END -->