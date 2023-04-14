<?php $userId = $_SESSION['userid']; ?>

<div class="form-account-update">
    <form class="form-user" action="includes/user-account-add.inc.php" method="post">
        <input type="text" id="u_name" name="u_name" placeholder="Username">
        <br>
        <input type="text" id="u_email" name="u_email" placeholder="Email">
        <br>
        <div class="account-buttons">
            <input type="submit" id="btn-account-submit" value="Add">
            <div class="btn-account-add-cancel">Cancel</div>
        </div>
    </form>
</div>