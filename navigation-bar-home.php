<div class="navbar-container">
    <div class="logo-container">
        <a href="./">
            <div class="logo">
                <img src="./images/qip/header-logo.png" alt="Quality Logo">
            </div>
            <div class="title-slogan">
                <div class="title">
                    Quality Industrial
                </div>
                <div class="slogan">
                    PRODUCTS. SERVICES. SOLUTIONS.
                </div>
            </div>
        </a>
    </div>
    <div class="navigation">
        <ul>
            <li class="list active">
                <a href="./">
                    <span class="icon">
                        <ion-icon name="home"></ion-icon>
                    </span>
                    <span class="text">Home</span>
                </a>
            </li>
            <li class="list">
                <a href="./products/">
                    <span class="icon">
                        <ion-icon name="pricetags"></ion-icon>
                    </span>
                    <span class="text">Products</span>
                </a>
            </li>
            <li class="list">
                <a href="./services/">
                    <span class="icon">
                        <ion-icon name="cube"></ion-icon>
                    </span>
                    <span class="text">Services</span>
                </a>
            </li>
            <li class="list">
                <a href="./about/">
                    <span class="icon">
                        <ion-icon name="information-circle"></ion-icon>
                    </span>
                    <span class="text">About Us</span>
                </a>
            </li>
            <li class="list">
                <?php
                if (isset($_SESSION['userid'])) {
                    echo '<a href="./account/">';
                } else {
                    echo '<a href="./signup-login/">';
                }
                ?>
                <span class="icon">
                    <ion-icon name="contact"></ion-icon>
                </span>
                <?php
                if (isset($_SESSION['userid'])) {
                    echo '<span class="text">Account</span>';
                } else {
                    echo '<span class="text">SignIn/Up</span>';
                }
                ?>
                </a>
            </li>
            <div class="indicator"></div>
        </ul>
    </div>
    <div class="navigation-mobile">
        <ul>
            <li class="list active">
                <a href="./">
                    <span class="icon">
                        <ion-icon name="home"></ion-icon>
                    </span>
                    <span class="text">Home</span>
                </a>
            </li>
            <li class="list">
                <a href="./products/">
                    <span class="icon">
                        <ion-icon name="pricetags"></ion-icon>
                    </span>
                    <span class="text">Products</span>
                </a>
            </li>
            <li class="list">
                <a href="./services/">
                    <span class="icon">
                        <ion-icon name="cube"></ion-icon>
                    </span>
                    <span class="text">Services</span>
                </a>
            </li>
            <li class="list">
                <a href="./about/">
                    <span class="icon">
                        <ion-icon name="information-circle"></ion-icon>
                    </span>
                    <span class="text">About Us</span>
                </a>
            </li>
            <li class="list">
                <?php
                if (isset($_SESSION['userid'])) {
                    echo '<a href="./account/">';
                } else {
                    echo '<a href="./signup-login/">';
                }
                ?>
                <span class="icon">
                    <ion-icon name="contact"></ion-icon>
                </span>
                <?php
                if (isset($_SESSION['userid'])) {
                    echo '<span class="text">Account</span>';
                } else {
                    echo '<span class="text">SignIn/Up</span>';
                }
                ?>
                </a>
            </li>
            <div class="indicator"></div>
        </ul>
    </div>
</div>