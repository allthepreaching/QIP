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
if (!empty($_POST['u_add_company'])) {
    $company = mysqli_real_escape_string($conn, $_POST['u_add_company']);
    $company = strtoupper($company);
}
if (!empty($_POST['u_add_street1'])) {
    $street1 = mysqli_real_escape_string($conn, $_POST['u_add_street1']);
    $street1 = strtoupper($street1);
}
$street2 = mysqli_real_escape_string($conn, $_POST['u_add_street2']);
$street2 = strtoupper($street2);

$street3 = mysqli_real_escape_string($conn, $_POST['u_add_street3']);
$street3 = strtoupper($street3);

if (!empty($_POST['u_add_city'])) {
    $city = mysqli_real_escape_string($conn, $_POST['u_add_city']);
    $city = strtoupper($city);
}
if (!empty($_POST['u_add_state'])) {
    $state = mysqli_real_escape_string($conn, $_POST['u_add_state']);
    $state = strtoupper($state);
}
if (!empty($_POST['u_add_zip'])) {
    $zip = mysqli_real_escape_string($conn, $_POST['u_add_zip']);
}
$shipto = isset($_POST['u_add_shipto']) ? 1 : 0;
$billto = isset($_POST['u_add_billto']) ? 1 : 0;

// Check if required inputs are filled out
if (empty($company) || empty($street1) || empty($city) || empty($state) || empty($zip)) {
    $_SESSION['address_success'] = false;
    $_SESSION['address_message'] = 'You must fill in all required fields.';
    header("Location: $url");
} else {

    // Check if $shipto is greater than 0
    $stmt1 = null;
    if ($shipto > 0) {

        // Query user_address table to find all addresses where u_id is equal to $userId
        $stmt1 = $conn->prepare("SELECT u_add_id, u_add_shipto FROM user_address WHERE u_id = ?");
        $stmt1->bind_param("i", $userId);
        $stmt1->execute();
        $stmt1->bind_result($uAddId, $uAddShipto);
        $stmt1->store_result();

        while ($stmt1->fetch()) {

            // Check if u_add_shipto is greater than 0
            if ($uAddShipto > 0) {

                // Update u_add_shipto column to 0
                $stmt2 = $conn->prepare("UPDATE user_address SET u_add_shipto = ? WHERE u_add_id = ?");
                $temp = 0;
                $stmt2->bind_param("ii", $temp, $uAddId);
                $stmt2->execute();
            }
        }
    }

    // set $uAddId
    $uAddId = $_POST['u_add_id'];

    // Check if $billto is greater than 0
    $stmt1 = null;
    if ($billto > 0) {

        // Query user_address table to find all addresses where u_id is equal to $userId
        $stmt1 = $conn->prepare("SELECT u_add_id, u_add_billto FROM user_address WHERE u_id = ?");
        $stmt1->bind_param("i", $userId);
        $stmt1->execute();

        // Bind result variables
        $stmt1->bind_result($uAddId, $uAddbillto);
        $stmt1->store_result();

        while ($stmt1->fetch()) {

            // Check if u_add_billto is greater than 0
            if ($uAddbillto > 0) {

                // Update u_add_billto column to 0
                $stmt2 = $conn->prepare("UPDATE user_address SET u_add_billto = ? WHERE u_add_id = ?");
                $temp = 0;
                $stmt2->bind_param("ii", $temp, $uAddId);
                $stmt2->execute();
            }
        }
    }

    // set $uAdddId
    $uAddId = $_POST['u_add_id'];

    // Prepare and bind parameters for user input
    $stmt = $conn->prepare("UPDATE user_address SET u_add_company = ?, u_add_street1 = ?,  u_add_street2 = ?, u_add_street3 = ?, u_add_city = ?, u_add_state = ?, u_add_zip = ?, u_add_shipto = ?, u_add_billto = ? WHERE u_add_id = ? AND u_id = ?");
    $stmt->bind_param("sssssssiiii", $company, $street1, $street2, $street3, $city, $state, $zip, $shipto, $billto, $uAddId, $userId);

    // Bind parameters and execute statement
    if ($stmt->execute()) {
        $_SESSION['address_success'] = true;
        $_SESSION['address_message'] = 'Success: Address updated successfully.';
        header("Location: $url");
    } else {
        $_SESSION['address_success'] = false;
        $_SESSION['address_message'] = 'An error occurred.';
        header("Location: $url");
    }
    $stmt->close();
}

// set $uAddId
$uAddId = $_POST['u_add_id'];

// Query user_address table to count the number of addresses where u_id is equal to $userId
$stmt1 = $conn->prepare("SELECT COUNT(u_add_id) FROM user_address WHERE u_id = ?");
$stmt1->bind_param("i", $userId);
$stmt1->execute();

// Get the count of the addresses and set the billto and shipto if there is only one address
$stmt1->bind_result($addressCount);
$stmt1->store_result();

if ($stmt1->fetch() && $addressCount == 1) {
    $stmt2 = $conn->prepare("UPDATE user_address SET u_add_shipto = ?, u_add_billto = ? WHERE u_add_id = ?");
    $temp = 1;
    $stmt2->bind_param("iii", $temp, $temp, $uAddId);
    $stmt2->execute();
}
mysqli_close($conn);
