<?php include_once 'header-cart.php'; ?>

<!-- PAGE CONTENT START -->
<script>
    BcrumbsNavUtil.bcrumbsNav("search", "Search Results");
</script>
<div class="page-container">
    <div class="page-header-container">
        <div class="page-header-title">
            search results
        </div>
    </div>
    <div class="page-table-container">
        <table class="fl-table" aria-describedby="searchResults">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Ext. Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tdClose = '</td>';

                // Display search results
                foreach ($_SESSION['results'] as $result) {
                    echo "<tr>";
                    echo "<td>" . $result['code'] . $tdClose;
                    echo "<td>" . $result['description'] . $tdClose;
                    echo '<td>' . $result["box"] . $tdClose;
                    if (isset($_SESSION['username'])) {
                        echo '<td>' . '$' . number_format($result['cost_box'] * 2, 2) . $tdClose;
                    } else {
                        echo '<td>' . '$' . number_format($result['cost_box'] / 0.4, 2) . $tdClose;
                    }
                    echo '<td>';
                    echo '<form method="post" action="./includes/add-to-cart.inc.php">';
                    echo '<input type="hidden" id="code" name="code" value="' . $result["code"] . '">';
                    echo '<input type="hidden" id="desc" name="desc" value="' . htmlspecialchars($result["description"]) . '">';
                    echo '<input type="hidden" id="price" name="price" value="' . $result["sell_box"] . '">';
                    echo '<input type="number" value="1" min="1" name="qty" id="qty">';
                    echo '<button type="submit" id="addbtn" name="addbtn">[ADD]</button>';
                    echo '</form>';
                    echo $tdClose;
                    echo '</tr>';
                }
                echo "</table>";
                ?>
            <tbody>
        </table>
    </div>
</div>
<!-- PAGE CONTENT END -->