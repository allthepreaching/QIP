<?php $userId = $_SESSION['userid']; ?>

<div class="btn-address-add active">Add New</div>
<div class="form-address-add">
    <form class="form-user" action="includes/user-address-add.inc.php" method="post">
        <input type="text" id="u_add_company" name="u_add_company" placeholder="Company Name">
        <br>
        <input type="text" id="u_add_street1" name="u_add_street1" placeholder="Street 1">
        <br>
        <input type="text" id="u_add_street2" name="u_add_street2" placeholder="Street 2">
        <br>
        <input type="text" id="u_add_street3" name="u_add_street3" placeholder="Street 3">
        <br>
        <input type="text" id="u_add_city" name="u_add_city" placeholder="City">
        <br>
        <div class="address-state-zip">
            <input type="text" maxlength="2" id="u_add_state" name="u_add_state" placeholder="State">
            <input type="text" id="u_add_zip" name="u_add_zip" placeholder="Zip">
        </div>
        <br>
        <div class="address-checks">
            <input type="checkbox" id="u_add_shipto" name="u_add_shipto">Ship To
            <input type="checkbox" id="u_add_billto" name="u_add_billto">Bill To
        </div>
        <br>
        <div class="buttons-user">
            <input type="submit" id="btn-address-add-submit" value="Add">
            <div class="btn-address-add-cancel">Cancel</div>
        </div>
    </form>
</div>

<div class="form-address-update">
    <form class="form-user" action="includes/user-address-update.inc.php" method="post">
        <input type="hidden" id="u_add_id" name="u_add_id">
        <input type="text" id="u_add_company" name="u_add_company" placeholder="Company Name">
        <br>
        <input type="text" id="u_add_street1" name="u_add_street1" placeholder="Street 1">
        <br>
        <input type="text" id="u_add_street2" name="u_add_street2" placeholder="Street 2">
        <br>
        <input type="text" id="u_add_street3" name="u_add_street3" placeholder="Street 3">
        <br>
        <input type="text" id="u_add_city" name="u_add_city" placeholder="City">
        <br>
        <div class="address-state-zip">
            <input type="text" maxlength="2" id="u_add_state" name="u_add_state" placeholder="State">
            <input type="text" id="u_add_zip" name="u_add_zip" placeholder="Zip">
        </div>
        <br>
        <div class="address-checks">
            <input type="checkbox" id="u_add_shipto" name="u_add_shipto">Ship To
            <input type="checkbox" id="u_add_billto" name="u_add_billto">Bill To
        </div>
        <br>
        <div class="buttons-user">
            <input type="submit" id="btn-address-update-submit" value="Update">
            <div class="btn-address-update-cancel">Cancel</div>
        </div>
    </form>
</div>

<div class="user-address-list">
    <?php
    $divClose = "</div>";
    $query = "SELECT * FROM user_address WHERE u_id = $userId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // listing start
            echo '<div class = "user-address-listing">';
            // main start
            echo '<div class = "user-address-main">';
            // main info start
            echo '<div class = "user-address-main-info">';
            echo '<div class = "u-add-id">' . $row["u_add_id"] . $divClose;
            echo '<div class = "u-add-company">' . $row["u_add_company"] . $divClose;
            echo '<div class = "u-add-street1">' . $row["u_add_street1"] . $divClose;
            echo '<div class = "u-add-street2">' . $row["u_add_street2"] . $divClose;
            echo '<div class = "u-add-street3">' . $row["u_add_street3"] . $divClose;
            // city state zip start
            echo '<div class = "u-add-city-state-zip">';
            echo '<div class = "u-add-city">' . $row["u_add_city"] . $divClose;
            echo '<div class = "u-add-state">' . $row["u_add_state"] . $divClose;
            echo '<div class = "u-add-zip">' . $row["u_add_zip"] . $divClose;
            // city state zip end
            echo $divClose;
            // main info end
            echo $divClose;
            // main ship bill start
            echo '<div class = "user-address-main-ship-bill">';
            if ($row["u_add_shipto"] > 0) {
                echo '<div class = "user-address-ship-icon"><ion-icon name="car"></ion-icon>' . $divClose;
                echo '<div class = "user-address-ship-value">' . $row["u_add_shipto"] . $divClose;
            } else {
                echo '<div class = "user-address-ship-value">' . $row["u_add_shipto"] . $divClose;
            }
            if ($row["u_add_billto"] > 0) {
                echo '<div class = "user-address-bill-icon"><ion-icon name="cash"></ion-icon>' . $divClose;
                echo '<div class = "user-address-bill-value">' . $row["u_add_billto"] . $divClose;
            } else {
                echo '<div class = "user-address-bill-value">' . $row["u_add_billto"] . $divClose;
            }
            // main ship bill end
            echo $divClose;
            // main end
            echo $divClose;
            // edit delete start
            echo '<div class = "user-address-edit-delete">';
            echo '<div class = "user-address-edit-icon"><ion-icon name="create"></ion-icon>' . $divClose;
            echo '<div class = "user-address-delete-icon"><ion-icon name="trash"></ion-icon>' . $divClose;
            // edit delete end
            echo $divClose;
            // listing end
            echo $divClose;
            echo '<div class="form-address-delete">';
            echo '<form class="form-user" action="includes/user-address-delete.inc.php" method="post">';
            echo '<input type="hidden" id="u_add_id" name="u_add_id">';
            echo '<div class="buttons-user">';
            echo '<input type="submit" id="btn-address-delete-submit" value="Delete">';
            echo '<div class="btn-address-delete-cancel">Cancel</div>';
            echo $divClose;
            echo '</form>';
            echo $divClose;
            echo '<hr>';
        }
    }
    ?>
</div>