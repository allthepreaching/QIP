<?php

include_once 'dbh-wamp.inc.php';

session_start();

// Check if the logout button has been clicked
if (isset($_POST['submitLogout'])) {

  // Clear all session variables
  $_SESSION = array();

  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();

  // Redirect the user to the login page
  header('Location: ../');
  exit();
}
