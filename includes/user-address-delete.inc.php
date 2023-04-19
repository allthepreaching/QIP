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
} elseif (!empty($uAddId)) {

    // Query user_address table to count the number of addresses where u_id is equal to $userId
    $stmt2 = $conn->prepare("SELECT COUNT(u_add_id) FROM user_address WHERE u_id = ?");
    $stmt2->bind_param("i", $userId);
    $stmt2->execute();

    // Get the count of the addresses and set the billto and shipto if there is only one address
    $stmt2->bind_result($addressCount);
    $stmt2->store_result();
    $stmt2->fetch();

    // execute statement
    if ($addressCount == 1) {
        $_SESSION['address_success'] = false;
        $_SESSION['address_message'] = 'You cannot delete the only address in your account.';
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
        $stmt->close();
    }

    // Query user_address table to count the number of addresses where u_id is equal to $userId
    $stmt1 = $conn->prepare("SELECT COUNT(u_add_id) FROM user_address WHERE u_id = ?");
    $stmt1->bind_param("i", $userId);
    $stmt1->execute();

    // Get the count of the addresses and set the billto and shipto if there is only one address
    $stmt1->bind_result($addressCount);
    $stmt1->store_result();


    if ($stmt1->fetch() && $addressCount == 1) {

        // Get the remaining u_add_id
        $stmt2 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ?");
        $stmt2->bind_param("i", $userId);
        $stmt2->execute();

        $stmt2->bind_result($uAddId);
        $stmt2->store_result();

        if ($stmt2->fetch()) {
            $stmt3 = $conn->prepare("UPDATE user_address SET u_add_shipto = ?, u_add_billto = ? WHERE u_add_id = ?");
            $temp = 1;
            $stmt3->bind_param("iii", $temp, $temp, $uAddId);
            $stmt3->execute();
        }
    }
}

mysqli_close($conn);
