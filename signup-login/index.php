<?php

include_once '../header-signup-login.php';

if (isset($_SESSION['signup_success'])) {
    $signup_success = $_SESSION['signup_success'];
} else {
    $signup_success = null;
}
if (isset($_SESSION['signup_message'])) {
    $signup_message = $_SESSION['signup_message'];
} else {
    $signup_message = null;
}
if (isset($_SESSION['login_success'])) {
    $login_success = $_SESSION['login_success'];
} else {
    $login_success = null;
}
if (isset($_SESSION['login_message'])) {
    $login_message = $_SESSION['login_message'];
} else {
    $login_message = null;
}

?>

<script>
    BcrumbsNavUtil.bcrumbsNav("loginregister", "Log In / Register");

    // check for session variables
    var loginSuccess = <?php echo json_encode($login_success); ?>;
    var loginMessage = <?php echo json_encode($login_message); ?>;
    var signupSuccess = <?php echo json_encode($signup_success); ?>;
    var signupMessage = <?php echo json_encode($signup_message); ?>;
    if (signupSuccess != null && signupMessage != null) {

        // create overlay
        var overlay = document.createElement('div');
        overlay.setAttribute('id', 'popup-overlay');
        document.body.appendChild(overlay);

        //create popup
        var popup = document.createElement('div');
        var content = document.createElement('div');
        var message = document.createTextNode(signupMessage);
        content.appendChild(message);
        popup.appendChild(content);

        // create close button
        var closeButton = document.createElement('button');
        closeButton.appendChild(document.createTextNode('Close'));
        popup.appendChild(closeButton);

        closeButton.addEventListener('click', function() {
            document.body.removeChild(popup);
        });

        document.body.appendChild(popup);
        popup.addEventListener('click', function() {
            document.body.removeChild(popup);
        });
        if (signupSuccess) {

            // set class for successful popup
            popup.setAttribute('class', 'popup-success signup-popup-message');
            closeButton.setAttribute('class', 'popup-close-btn signup-popup-message popup-success-btn');
        } else {

            // set class for error popup
            popup.setAttribute('class', 'popup-error signup-popup-message');
            closeButton.setAttribute('class', 'popup-close-btn signup-popup-message popup-error-btn');
        }

        // clear session variables
        <?php
        unset($_SESSION['signup_success'], $_SESSION['signup_message']);
        ?>
    } else if (loginSuccess != null && loginMessage != null) {
        
        // create overlay
        var overlay = document.createElement('div');
        overlay.setAttribute('id', 'popup-overlay');
        document.body.appendChild(overlay);

        //create popup
        var popup = document.createElement('div');
        var content = document.createElement('div');
        var message = document.createTextNode(loginMessage);
        content.appendChild(message);
        popup.appendChild(content);

        // create close button
        var closeButton = document.createElement('button');
        closeButton.appendChild(document.createTextNode('Close'));
        popup.appendChild(closeButton);

        closeButton.addEventListener('click', function() {
            document.body.removeChild(popup);
        });

        document.body.appendChild(popup);
        popup.addEventListener('click', function() {
            document.body.removeChild(popup);
        });
        if (loginSuccess) {

            // set class for successful popup
            popup.setAttribute('class', 'popup-success login-popup-message');
            closeButton.setAttribute('class', 'popup-close-btn login-popup-message popup-success-btn');
        } else {

            // set class for error popup
            popup.setAttribute('class', 'popup-error login-popup-message');
            closeButton.setAttribute('class', 'popup-close-btn login-popup-message popup-error-btn');
        }

        // clear session variables
        <?php
        unset($_SESSION['login_success'], $_SESSION['login_message']);
        ?>
    }
</script>

<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            Log In / Register
        </div>
    </div>
    <div class="page-sub-header-container">
        <div class="holder" id="holder">
            <div class="button-container">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo '<button id="create-account-button" class="new-account">Create</button>
                        <button id="login-button" class="existing-account">Login</button>';
                }
                ?>
            </div>
            <div class="form-container sign-up-container<?php if (isset($_SESSION['username'])) {
                                                            echo ' hide-forms';
                                                        } ?>" id="sign-up-container">
                <div class="form-title">
                    Create
                </div>
                <form class="form-signup" action="includes/signup.inc.php" method="post">
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="pwd" required>
                    <input type="password" placeholder="Password Confirm" name="pwd2" required>
                    <button type="submit" id="submitSignup" name="submitSignup">Create</button>
                </form>
            </div>
            <div class="form-container sign-in-container<?php if (isset($_SESSION['username'])) {
                                                            echo ' hide-forms';
                                                        } ?>" id="sign-in-container">
                <div class="form-title">
                    Log In
                </div>
                <form class="form-login" action="includes/login.inc.php" method="post">
                    <input type="text" placeholder="Email or Username" name="loginData" required>
                    <input type="password" placeholder="Password" name="pwd" required>
                    <a class="a-login-forgot-pwd" href="#">Forgot Password</a>
                    <button type="submit" id="submitLogin" name="submitLogin">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT END -->