<?php

$url = '../account/';

// Redirect user to error page if request method is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: $url");
    exit();
}

include_once 'dbh-wamp.inc.php';


session_start();

// Sanitize and set variables for user input
$userId = $_SESSION['userid'];
if (!empty($_POST['u_add_id'])) {
    $uAddId = mysqli_real_escape_string($conn, $_POST['u_add_id']);
    $_SESSION['uAddId'] = $uAddId;
}
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

// Check if required inputs are empty and if they are send user back with error message
if (empty($company) || empty($street1) || empty($city) || empty($state) || empty($zip)) {
    $_SESSION['address_success'] = false;
    $_SESSION['address_message'] = 'You must fill in all required fields.';
    header("Location: $url");
} else {

    // Prepare and execute the update statement
    $stmt0 = $conn->prepare("UPDATE user_address SET u_add_company = ?, u_add_street1 = ?,  u_add_street2 = ?, u_add_street3 = ?, u_add_city = ?, u_add_state = ?, u_add_zip = ?, u_add_shipto = ?, u_add_billto = ? WHERE u_add_id = ? AND u_id = ?");
    $stmt0->bind_param("sssssssiiii", $company, $street1, $street2, $street3, $city, $state, $zip, $shipto, $billto, $uAddId, $userId);
    if ($stmt0->execute()) {
        $_SESSION['address_success'] = true;
        $_SESSION['address_message'] = 'Success: Address updated successfully.';
        header("Location: $url");
    } else {
        $_SESSION['address_success'] = false;
        $_SESSION['address_message'] = 'An error occurred.';
        header("Location: $url");
    }
}

mysqli_close($conn);
