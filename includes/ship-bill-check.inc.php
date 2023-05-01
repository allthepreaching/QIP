<?php

$userId = $_SESSION['userid'];


// shipto Check
// select all rows from user_address where u_id = $userId and u_add_shipto = 1
$stmt1 = $conn->prepare("SELECT * FROM user_address WHERE u_id = ? AND u_add_shipto = 1");
$stmt1->bind_param("i", $userId);
$stmt1->execute();
$stmt1->store_result();

$rowShipCount = $stmt1->num_rows;

// If there are no rows where u_add_shipto is set to 1, select the row with the lowest value for u_add_id and set u_add_shipto to 1
if ($rowShipCount < 1) {
    $stmt2 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ? ORDER BY u_add_id ASC LIMIT 1");
    $stmt2->bind_param("i", $userId);
    $stmt2->execute();
    $stmt2->bind_result($uAddId);
    $stmt2->store_result();
    while ($stmt2->fetch()) {
        $stmt3 = $conn->prepare("UPDATE user_address SET u_add_shipto = 1 WHERE u_add_id = ?");
        $stmt3->bind_param("i", $uAddId);
        $stmt3->execute();
    }
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();

    // If there is more than 1 row where u_add_shipto is set to 1, set all rows u_add_shipto to 0
} elseif ($rowShipCount > 1) {
    $stmt1 = null;
    $stmt2 = null;
    $stmt3 = null;

    $stmt1 = $conn->prepare("SELECT * FROM user_address WHERE u_id = ? AND u_add_shipto = 1");
    $stmt1->bind_param("i", $userId);
    $stmt1->execute();
    $stmt1->store_result();
    while ($stmt1->fetch()) {
        $stmt2 = $conn->prepare("UPDATE user_address SET u_add_shipto = 0 WHERE u_id = ?");
        $stmt2->bind_param("i", $userId);
        $stmt2->execute();
    }

    // reset uAddId to POST value
    $uAddId = $_SESSION['uAddId'];

    $stmt3 = $conn->prepare("UPDATE user_address SET u_add_shipto = 1 WHERE u_add_id = ?");
    $stmt3->bind_param("i", $uAddId);
    $stmt3->execute();

    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
}

// billto Check
$stmt1 = null;
$stmt2 = null;
$stmt3 = null;

// select all rows from user_address where u_id = $userId and u_add_billto = 1
$stmt1 = $conn->prepare("SELECT * FROM user_address WHERE u_id = ? AND u_add_billto = 1");
$stmt1->bind_param("i", $userId);
$stmt1->execute();
$stmt1->store_result();

$rowbillCount = $stmt1->num_rows;

// If there are no rows where u_add_billto is set to 1, select the row with the lowest value for u_add_id and set u_add_billto to 1
if ($rowbillCount < 1) {
    $stmt2 = $conn->prepare("SELECT u_add_id FROM user_address WHERE u_id = ? ORDER BY u_add_id ASC LIMIT 1");
    $stmt2->bind_param("i", $userId);
    $stmt2->execute();
    $stmt2->bind_result($uAddId);
    $stmt2->store_result();
    while ($stmt2->fetch()) {
        $stmt3 = $conn->prepare("UPDATE user_address SET u_add_billto = 1 WHERE u_add_id = ?");
        $stmt3->bind_param("i", $uAddId);
        $stmt3->execute();
    }
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();

    // If there is more than 1 row where u_add_billto is set to 1, set all rows u_add_billto to 0
} elseif ($rowbillCount > 1) {
    $stmt1 = null;
    $stmt2 = null;
    $stmt3 = null;

    $stmt1 = $conn->prepare("SELECT * FROM user_address WHERE u_id = ? AND u_add_billto = 1");
    $stmt1->bind_param("i", $userId);
    $stmt1->execute();
    $stmt1->store_result();
    while ($stmt1->fetch()) {
        $stmt2 = $conn->prepare("UPDATE user_address SET u_add_billto = 0 WHERE u_id = ?");
        $stmt2->bind_param("i", $userId);
        $stmt2->execute();
    }

    // reset uAddId to POST value
    $uAddId = $_SESSION['uAddId'];

    $stmt3 = $conn->prepare("UPDATE user_address SET u_add_billto = 1 WHERE u_add_id = ?");
    $stmt3->bind_param("i", $uAddId);
    $stmt3->execute();

    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
}
