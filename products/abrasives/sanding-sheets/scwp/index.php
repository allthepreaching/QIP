<?php
include_once '../../../../header-products.php';
?>
<!-- PAGE CONTENT START -->
<script>
    BcrumbsNavUtil.bcrumbsNav("products", "Products", "products/abrasives", "Abrasives", "products/abrasives/sanding-sheets", "Sanding Sheets", "products/abrasives/sanding-sheets/scwp", "Silicon Carbide Waterproof Paper Sheets");
</script>
<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            Silicon Carbide Waterproof Paper Sheets
        </div>
    </div>
    <div class="page-sub-header-container">
        <div class="page-sub-image-only">
            <img src="./images/categories/abrasives/sanding-sheets-scwp.png" alt="Silicon Carbide Waterproof Paper Sheets">
        </div>
    </div>
    <div class="page-info">
        <p class="info">
            <?php
            $query = 'SELECT * FROM `cat_sub_abr` WHERE `sub_cat` = "sanding-sheets" && `type` = "scwp"';
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) :
                while ($output = mysqli_fetch_assoc($result)) :
                    echo $output['info'];
                endwhile;
            endif;
            ?>
        </p>
    </div>
    <div class="page-table-container">
        <div class="table-note">
            these items are sold by the box
        </div>
        <table class="fl-table" role="none">
            <thead>
                <tr>
                    <th hidden>Cost Box</th>
                    <th>Item Code</th>
                    <th>Description</th>
                    <th hidden>OD</th>
                    <th hidden>ID</th>
                    <th hidden>Grit</th>
                    <th hidden>Material</th>
                    <th>Box Qty</th>
                    <th>Box Price</th>
                    <th>Add To Cart</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT * FROM `cat_sub_sub_abr_sanding_sheets` WHERE sub_sub_cat="scwp" ORDER BY material ASC';
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) :
                    while ($output = mysqli_fetch_assoc($result)) :
                        echo '<tr>';
                        echo '<td hidden>' . $output["cost_box"] . '</td>';
                        echo '<td>' . $output["code"] . '</td>';
                        echo '<td>' . $output["description"] . '</td>';
                        echo '<td hidden>' . $output["od"] . '</td>';
                        echo '<td hidden>' . $output["id_1"] . '</td>';
                        echo '<td hidden>' . $output["grit"] . '</td>';
                        echo '<td hidden>' . $output["material"] . '</td>';
                        echo '<td>' . $output["box"] . '</td>';
                        if (isset($_SESSION['username'])) {
                            echo '<td>' . '$' . number_format($output['cost_box'] * 2, 2) . '</td>';
                        } else {
                            echo '<td>' . '$' . number_format($output['cost_box'] / 0.4, 2) . '</td>';
                        }
                        echo '<td>';
                        echo '<form method="post" action="./includes/add-to-cart.inc.php">';
                        echo '<input type="hidden" id="code" name="code" value="' . $output["code"] . '">';
                        echo '<input type="hidden" id="desc" name="desc" value="' . htmlspecialchars($output["description"]) . '">';
                        echo '<input type="hidden" id="price" name="price" value="' . $output["sell_box"] . '">';
                        echo '<input type="number" value="1" min="1" name="qty" id="qty">';
                        echo '<button type="submit" id="addbtn" name="addbtn">[ADD]</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    endwhile;
                endif;
                ?>
            <tbody>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->