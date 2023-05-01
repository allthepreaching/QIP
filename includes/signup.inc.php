<?php

$url = '../signup-login/';

// Redirect user to error page if request method is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: $url");
    exit();
}
include_once 'dbh-wamp.inc.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Define the required fields
  $requiredFields = ['username', 'pwd', 'pwd2', 'email'];

  // Loop through each required field
  foreach ($requiredFields as $field) {

    // Check if the field has been submitted and is not empty
    if (!isset($_POST[$field]) || empty($_POST[$field])) {

      // Display an error message and exit the script
      die("Please enter a value for the $field field.");
    }
  }

  // If all required fields are present, process the form data
}

if (isset($_POST['submitSignup'])) {

  // retrieve the user's information from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $pwd2 = $_POST['pwd2'];

  // validate the user's information
  if ($pwd != $pwd2) {

    // display an error message if the passwords don't match
    echo "Passwords don't match.";
    exit;
  }

  // hash the user's password
  $u_pwd = password_hash($pwd, PASSWORD_DEFAULT);

  // check if the username already exists
  $stmt = $conn->prepare("SELECT * FROM user WHERE u_name = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  // bind the results of the query to variables
  $stmt->bind_result($u_id, $u_name, $u_pwd, $u_email, $created, $modified);
  $stmt->fetch();

  if ($stmt->num_rows() > 0) {

    // display an error message if the username already exists
    echo "Username already exists.";
    exit;
  }

  // insert the user's information into the database
  $stmt2 = $conn->prepare("INSERT INTO user (u_name, u_pwd, u_email) VALUES (?, ?, ?)");
  $stmt2->bind_param("sss", $username, $u_pwd, $email);
  $stmt2->execute();
  $stmt2->store_result();

  // redirect the user to the thankyou-signup page
  header("Location: ../thankyou-signup/");
  exit;
}

// Close statement objects
$stmt->close();
$stmt2->close();
