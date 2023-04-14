<div class="content-container">
    <div class="categories-home">
        <ul id="myUL">
            <li class="myUL-li">
                <span class="myUL-span caret">Abrasives</span>
                <ul class="nested">
                    <?php
                    $query = 'SELECT * FROM cat_sub WHERE main_cat = "abrasives" ORDER BY sub_cat ASC';
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) :
                        while ($categories = mysqli_fetch_assoc($result)) :
                            echo $categories['code'];
                        endwhile;
                    endif;
                    ?>
                </ul>
            </li>
            <li class="myUL-li">
                <span class="myUL-span caret">Fasteners</span>
                <ul class="nested">
                    <?php
                    $query = 'SELECT * FROM cat_sub WHERE main_cat = "fasteners" ORDER BY sub_cat ASC';
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) :
                        while ($categories = mysqli_fetch_assoc($result)) :
                            echo $categories['code'];
                        endwhile;
                    endif;
                    ?>
                </ul>
            </li>
            <li class="myUL-li">
                <span class="myUL-span caret">Cutting</span>
                <ul class="nested">
                    <?php
                    $query = 'SELECT * FROM cat_sub WHERE main_cat = "cutting" ORDER BY sub_cat ASC';
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) :
                        while ($categories = mysqli_fetch_assoc($result)) :
                            echo $categories['code'];
                        endwhile;
                    endif;
                    ?>
                </ul>
            </li>
        </ul>
    </div>
    <div class="content-home">
        <?php
        if (isset($_SESSION['username'])) {
            $timezone = '';
            if (isset($_COOKIE['timezone']) && !empty($_COOKIE['timezone'])) {
                $timezone = $_COOKIE['timezone'];
            } elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $language = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
                if (in_array($language, ['en', 'es', 'fr', 'de'])) { // Only support certain languages
                    echo "<script>document.cookie = 'timezone=' + Intl.DateTimeFormat().resolvedOptions().timeZone + '; path=/';</script>";
                    $timezone = $_COOKIE['timezone'];
                }
            }
            if (!$timezone) {
                $timezone = 'America/New_York'; // default timezone
            }
            date_default_timezone_set($timezone);
            $time = date('H:i:s');
            $greeting = '';
            if ($time >= '05:00:00' && $time <= '11:59:59') {
                $greeting = 'Good Morning';
            } elseif ($time >= '12:00:00' && $time <= '17:59:59') {
                $greeting = 'Good Afternoon';
            } elseif ($time >= '18:00:00' && $time <= '23:59:59') {
                $greeting = 'Good Evening';
            } else {
                $greeting = 'Hello';
            }
            echo '<div class="user-welcome">';
            echo $greeting . ', ' . $_SESSION["username"] . '!';
        }

        ?>
        <div class="content-home-header">
            Supply Shopping Simplified.
        </div>
        <div class="content-home-sections">
            <div class="home-section-1">
                <a href="products/index.php">
                    <img src="images/qip/MRO-Supply-Chain.jpg" alt="" width="320px" height="350px">
                </a>
            </div>
            <div class="home-section-2">
                <div class="home-section-2-a">
                    <div class="home-section-2-icon">
                        <img src="images/qip/fast-delivery.png" alt="" width="90px" height="50px">
                    </div>
                    <div class="home-section-2-info">
                        <div class="section-2-a-header">
                            Quick Delivery
                        </div>
                        <div class="home-section-2-a-content">
                            Most stock orders will ship same day. Next day, 2nd day & other express options available.
                            <a href="#">More Info</a>
                        </div>
                    </div>
                </div>
                <div class="home-section-2-b">
                    <div class="home-section-2-icon">
                        <img src="images/qip/box.png" alt="" width="90px" height="50px">
                    </div>
                    <div class="home-section-2-info">
                        <div class="section-2-b-header">
                            25,000+ Stock Items
                        </div>
                        <div class="home-section-2-a-content">
                            Many common MRO, Industrial & Fastener items in stock everyday.
                            <a href="#">More Info</a>
                        </div>
                    </div>
                </div>
                <div class="home-section-2-c">
                    <div class="home-section-2-icon">
                        <img src="images/qip/services.png" alt="" width="90px" height="50px">
                    </div>
                    <div class="home-section-2-info">
                        <div class="section-2-c-header">
                            Services & Solutions
                        </div>
                        <div class="home-section-2-c-content">
                            We offer services & solutions for your business needs such as Vendor Managed Inventory, Kitting & more.
                            <a href="#">More Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-section-3">
            <div class="home-section-3-banner">
                <img src="images/qip/CantFindWhatYoureLookingFor.png" alt="" width="100%" height="300px">
            </div>
        </div>
    </div>
</div>