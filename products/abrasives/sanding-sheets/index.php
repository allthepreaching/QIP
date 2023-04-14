<?php include_once '../../../header-products.php'; ?>

<!-- PAGE CONTENT START -->
<script>
    BcrumbsNavUtil.bcrumbsNav("products/", "Products", "products/abrasives", "Abrasives", "products/abrasives/sanding-sheets", "Sanding Sheets");
</script>
<div class="page-container-categories">
    <div class="page-options-container-categories">
        <div class="page-options-title-categories">
            Sanding Sheets
        </div>
        <div class="page-options-image-categories">
            <img src="./images/categories/abrasives/sanding-sheets-header.png" alt="Sanding Sheets">
        </div>
    </div>
    <div class="products-list-categories">
        <?php
        $i = 1;
        echo '<div class="products-row">';
        $query = 'SELECT * FROM cat_sub_abr WHERE sub_cat = "sanding-sheets" && sub_sub_cat = "sanding-sheets" ORDER BY type ASC';
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) :
            while ($output = mysqli_fetch_assoc($result)) :
                echo '<div class="products-box"><a href="products/';
                echo $output['main_cat'];
                echo '/';
                echo $output["sub_cat"];
                echo '/';
                echo $output["type"];
                echo '"><div class="product-image"><img src="./images/categories/';
                echo $output['main_cat'];
                echo '/';
                echo $output["sub_sub_cat"];
                echo '-';
                echo $output["type"];
                echo '.png" alt="';
                echo $output["type_name"];
                echo '"></div><div class="product-title">';
                echo $output["type_name"];
                echo '</div></a></div>';
                if ($i % 3 == 0) {
                    echo '</div><div class="products-row">';
                }
                $i++;
            endwhile;
        endif;
        ?>
    </div>
</div>
<!-- PAGE CONTENT END -->