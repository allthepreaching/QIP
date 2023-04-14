<?php include_once '../header-account.php'; ?>

<script>
    BcrumbsNavUtil.bcrumbsNav("loginregister", "Log In / Register");

    var error = "<?php echo isset($_GET['error']) ? $_GET['error'] : ''; ?>";
    var errorPassword = "Invalid Password.";
    var errorUsername = "Username Not Found.";

    if (error === 'password') {
        alert(errorPassword);
    } else if (error === 'username') {
        alert(errorUsername);
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
                <form action="includes/signup.inc.php" method="post">
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="pwd" required>
                    <input type="password" placeholder="Password Confirm" name="pwd2" required>
                    <button type="submit" name="submitSignup">Create</button>
                </form>
            </div>
            <div class="form-container sign-in-container<?php if (isset($_SESSION['username'])) {
                                                            echo ' hide-forms';
                                                        } ?>" id="sign-in-container">
                <div class="form-title">
                    Log In
                </div>
                <form action="includes/login.inc.php" method="post">
                    <input type="text" placeholder="Email or Username" name="loginData" required>
                    <input type="password" placeholder="Password" name="pwd" required>
                    <a class="a-login-forgot-pwd" href="#">Forgot Password</a>
                    <button type="submit" name="submitLogin">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT END -->