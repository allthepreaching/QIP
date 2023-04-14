<?php

$url = '../account/';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    // Redirect user to error page
    header("Location: $url");
    exit();
}

include_once 'dbh-wamp.inc.php';

session_start();

// Sanitize and set variables for user input
$userId = $_SESSION['userid'];
$uAddId = $_POST['u_add_id'];

// Check if required inputs are filled out
if (empty($uAddId)) {
    $_SESSION['address_success'] = false;
    $_SESSION['address_message'] = 'An error occurred.';
    header("Location: $url");
} else {

    // Query user_address table to delete address where u_add_id is equal to $uAddId
    $stmt = $conn->prepare("DELETE FROM user_address WHERE u_add_id = ?");
    $stmt->bind_param("i", $uAddId);

    // execute statement
    if ($stmt->execute()) {
        $_SESSION['address_success'] = true;
        $_SESSION['address_message'] = 'Success: Address deleted successfully.';
        header("Location: $url");
    } else {
        $_SESSION['address_success'] = false;
        $_SESSION['address_message'] = 'An error occurred.';
        header("Location: $url");
    }
}

$stmt->close();

mysqli_close($conn);
