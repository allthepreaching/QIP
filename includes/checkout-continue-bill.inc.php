<?php

$url = 'Location: ../cart/checkout.php';

// Redirect user to error page if request method is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("$url");
    exit();
}

include_once 'dbh-wamp.inc.php';

session_start();