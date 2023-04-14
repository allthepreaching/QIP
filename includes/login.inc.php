<?php

use ReCaptcha\RequestMethod;

include_once 'dbh-wamp.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submitLogin'])) {

        // retrieve the user's information from the form
        $loginData = $_POST['loginData'];
        $pwd = $_POST['pwd'];

        // prepare the query to retrieve the user's information from the database
        $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE u_name = ? OR u_email = ?");
        mysqli_stmt_bind_param($stmt, "ss", $loginData, $loginData);
        mysqli_stmt_execute($stmt);

        // bind the results of the query to variables
        mysqli_stmt_bind_result($stmt, $u_id, $u_name, $u_pwd, $u_email, $created, $modified);

        // fetch the results
        if (mysqli_stmt_fetch($stmt)) {

            // verify the user's password
            if (password_verify($pwd, $u_pwd)) {

                // start the user's session
                session_start();

                $_SESSION['userid'] = $u_id;
                $_SESSION['username'] = $u_name;
                $_SESSION['email'] = $u_email;

                // redirect the user to the home page
                header("Location: ../account/");
                exit;
            } else {
                $error = "password";
                $url = "../account/index.php?error=" . urlencode($error);
                header("Location: $url");
            }
        } else {
            $error = "username";
            $url = "../account/index.php?error=" . urlencode($error);
            header("Location: $url");
        }
    }
} else {
    header("Location: ../index.php");
}
