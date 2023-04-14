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

    // Check if address already exists in database
    $checkStmt = $conn->prepare("SELECT * FROM user_address WHERE u_id=? AND u_add_company=? AND u_add_street1=? AND u_add_street2=? AND u_add_street3=? AND u_add_city=? AND u_add_state=? AND u_add_zip=?");
    $checkStmt->bind_param("isssssss", $userId, $company, $street1, $street2, $street3, $city, $state, $zip);
    $checkStmt->execute();
    $checkStmt->store_result(); // fixes "Commands out of sync" error

    if ($checkStmt->num_rows > 0) {

        // Address already exists, do not insert
        $_SESSION['address_success'] = false;
        $_SESSION['address_message'] = 'Address already exists.';
        header("Location: $url");
    } else {

        // Check if $shipto is greater than 0
        $stmt = null;
        if ($shipto > 0) {

            // Query user_address table to find all addresses where u_id is equal to $userId
            $stmt = $conn->prepare("SELECT u_add_id, u_add_shipto FROM user_address WHERE u_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            $stmt->bind_result($uAddId, $uAddShipto);
            $stmt->store_result();

            while ($stmt->fetch()) {

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

        // Check if $billto is greater than 0
        $stmt = null;
        if ($billto > 0) {

            // Query user_address table to find all addresses where u_id is equal to $userId
            $stmt = $conn->prepare("SELECT u_add_id, u_add_billto FROM user_address WHERE u_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            $stmt->bind_result($uAddId, $uAddbillto);
            $stmt->store_result();

            while ($stmt->fetch()) {

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

        // Prepare and bind parameters for user input
        $stmt = $conn->prepare("INSERT INTO user_address (u_id, u_add_company, u_add_street1, u_add_street2, u_add_street3, u_add_city, u_add_state, u_add_zip, u_add_shipto, u_add_billto)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssii", $userId, $company, $street1, $street2, $street3, $city, $state, $zip, $shipto, $billto);

        // execute statement
        if ($stmt->execute()) {
            $_SESSION['address_success'] = true;
            $_SESSION['address_message'] = 'Success: Address added successfully.';
            header("Location: $url");
        } else {
            $_SESSION['address_success'] = false;
            $_SESSION['address_message'] = 'An error occurred.';
            header("Location: $url");
        }
        $stmt->close();
    }
    $checkStmt->close();
}
mysqli_close($conn);
