<?php

$url = '../signup-login/';

// Redirect user to error page if request method is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: $url");
    exit();
}

include_once 'dbh-wamp.inc.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submitLogin'])) {

        // retrieve the user's information from the form
        $loginData = $_POST['loginData'];
        $pwd = $_POST['pwd'];

        // prepare the query to retrieve the user's information from the database
        $stmt = $conn->prepare("SELECT * FROM user WHERE u_name = ? OR u_email = ?");
        $stmt->bind_param("ss", $loginData, $loginData);
        $stmt->execute();

        // bind the results of the query to variables
        $stmt->bind_result($u_id, $u_name, $u_pwd, $u_email, $created, $modified);

        // fetch the results
        if ($stmt->fetch()) {

            // verify the user's password
            if (password_verify($pwd, $u_pwd)) {

                $_SESSION['userid'] = $u_id;
                $_SESSION['username'] = $u_name;
                $_SESSION['email'] = $u_email;

                // redirect the user to the home page
                header("Location: ../account/");
                exit;
            } else {

                // display an error message if the password is wrong
                $_SESSION['login_success'] = false;
                $_SESSION['login_message'] = 'Password is incorrect.';
                header("Location: $url");
                exit;
            }
        } else {

            // display an error message if the username is wrong
            $_SESSION['login_success'] = false;
            $_SESSION['login_message'] = 'Username or Email does not exist.';
            header("Location: $url");
            exit;
        }
    }
} else {
    header("Location: ../index.php");
}
