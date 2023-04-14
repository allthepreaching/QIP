<?php

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
  $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE u_name = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);

  // bind the results of the query to variables
  mysqli_stmt_bind_result($stmt, $u_id, $u_name, $u_pwd, $u_email, $created, $modified);
  mysqli_stmt_fetch($stmt);

  if (mysqli_stmt_num_rows($stmt) > 0) {

    // display an error message if the username already exists
    echo "Username already exists.";
    exit;
  }

  // insert the user's information into the database
  $stmt = mysqli_prepare($conn, "INSERT INTO user (u_name, u_pwd, u_email) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sss", $username, $u_pwd, $email);
  mysqli_stmt_execute($stmt);

  // redirect the user to the thankyou-signup page
  header("Location: ../thankyou-signup/");
  exit;
}
