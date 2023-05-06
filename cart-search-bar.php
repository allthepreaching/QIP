<div class="cart-search-container">
    <div class="cart-express-container">
        <div class="cart-container">
            <div class="cart-icon-items">
                <a class="items-total" href="./cart/">
                    <ion-icon id="cart-icon" name="cart"></ion-icon>
                    <?php
                    if ($_SESSION['total_items'] > 1 || $_SESSION['total_items'] < 1) {
                        echo '<span class="cart-items">' . $_SESSION['total_items'] . ' Items</span> ';
                    } else {
                        echo '<span class="cart-items">' . $_SESSION['total_items'] . ' Item</span> ';
                    }
                    ?>
                </a>
            </div>
            <div class="cart-total-span">
                <a class="items-total" href="./cart/">
                    <?php
                    echo '<span class="cart-total">$' . number_format($_SESSION['cart_total'], 2) . '</span>';
                    ?>
                </a>
            </div>
        </div>
        <div class="shopcart-express-container">
            <a id="shopcart-link" href="./cart/">
                <div class="shopcart">
                    Shopping Cart
                </div>
            </a>
            <a id="express-link" href="./express/">
                <div class="express">
                    Express
                </div>
            </a>
            <?php
            if (isset($_SESSION['userid'])) {
                echo '<form method="POST" action="includes/logout.inc.php"><button type="submit" name="submitLogout" id="logout-button" class="logout">Log Out</button></form>';
            } else {
                echo '<a id="login-link" href="./signup-login/"><div class="login">Log In</div></a>';
            }
            ?>
        </div>
    </div>
    <div class="search-container">
        <form method="POST" action="includes/search.inc.php">
            <input type="text" name="search-text" id="search-text" placeholder="Search codes or keywords...">
            <button type="submit" name="submitSearch" id="search-button">
                <ion-icon name="search"></ion-icon>
            </button>
        </form>
    </div>
</div>