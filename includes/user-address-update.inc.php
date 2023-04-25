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

    // set $uAddId
    $uAddId = $_POST['u_add_id'];

    $stmt0 = null;

    // Prepare and bind parameters for user input
    $stmt0 = $conn->prepare("UPDATE user_address SET u_add_company = ?, u_add_street1 = ?,  u_add_street2 = ?, u_add_street3 = ?, u_add_city = ?, u_add_state = ?, u_add_zip = ?, u_add_shipto = ?, u_add_billto = ? WHERE u_add_id = ? AND u_id = ?");
    $stmt0->bind_param("sssssssiiii", $company, $street1, $street2, $street3, $city, $state, $zip, $shipto, $billto, $uAddId, $userId);

    // Bind parameters and execute statement
    if ($stmt0->execute()) {

        $stmt1 = null;
        $stmt2 = null;
        $stmt3 = null;
        $stmt4 = null;
        $stmt5 = null;
        $stmt6 = null;

        // Check if $shipto is greater than 0
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

            // set $uAddId
            $uAddId = $_POST['u_add_id'];

            $stmt6 = $conn->prepare("UPDATE user_address SET u_add_shipto = ? WHERE u_add_id = ? AND u_id = ?");
            $temp = 1;
            $stmt6->bind_param("iii", $temp, $uAddId, $userId);
        } elseif ($shipto < 1) {

            // Query user_address table to find all addresses where u_id is equal to $userId and u_add_shipto is set to 1
            $stmt3 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ? AND u_add_shipto = 1");
            $stmt3->bind_param("i", $userId);
            $stmt3->execute();
            $stmt3->store_result();

            $rowShipCount = $stmt3->num_rows;

            // If there are no rows where u_add_shipto is set to 1, select the row with the lowest value for u_add_id and set u_add_shipto to 1
            if ($rowShipCount < 1) {
                $stmt4 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ? ORDER BY u_add_id ASC LIMIT 1");
                $stmt4->bind_param("i", $userId);
                $stmt4->execute();
                $stmt4->bind_result($uAddId);
                $stmt4->store_result();
                while ($stmt4->fetch()) {
                    $stmt5 = $conn->prepare("UPDATE user_address SET u_add_shipto = 1 WHERE u_add_id = ?");
                    $stmt5->bind_param("i", $uAddId);
                    $stmt5->execute();
                }
            }
        }

        $stmt1 = null;
        $stmt2 = null;
        $stmt3 = null;
        $stmt4 = null;
        $stmt5 = null;
        $stmt6 = null;

        // Check if $billto is greater than 0
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

            // set $uAddId
            $uAddId = $_POST['u_add_id'];

            $stmt6 = $conn->prepare("UPDATE user_address SET u_add_billto = ? WHERE u_add_id = ? AND u_id = ?");
            $temp = 1;
            $stmt6->bind_param("iii", $temp, $uAddId, $userId);
        } elseif ($billto < 1) {

            // Query user_address table to find all addresses where u_id is equal to $userId and u_add_billto is set to 1
            $stmt3 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ? AND u_add_billto = 1");
            $stmt3->bind_param("i", $userId);
            $stmt3->execute();
            $stmt3->store_result();

            $rowbillCount = $stmt3->num_rows;

            // If there are no rows where u_add_billto is set to 1, select the row with the lowest value for u_add_id and set u_add_billto to 1
            if ($rowbillCount < 1) {
                $stmt4 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ? ORDER BY u_add_id ASC LIMIT 1");
                $stmt4->bind_param("i", $userId);
                $stmt4->execute();
                $stmt4->bind_result($uAddId);
                $stmt4->store_result();
                while ($stmt4->fetch()) {
                    $stmt5 = $conn->prepare("UPDATE user_address SET u_add_billto = 1 WHERE u_add_id = ?");
                    $stmt5->bind_param("i", $uAddId);
                    $stmt5->execute();
                }
            }
        }


        $_SESSION['address_success'] = true;
        $_SESSION['address_message'] = 'Success: Address updated successfully.';
        header("Location: $url");
    } else {
        $_SESSION['address_success'] = false;
        $_SESSION['address_message'] = 'An error occurred.';
        header("Location: $url");
    }
    $stmt0->close();
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $stmt4->close();
    $stmt5->close();
}

mysqli_close($conn);
