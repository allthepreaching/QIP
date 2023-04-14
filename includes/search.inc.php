<?php

include_once 'dbh-wamp.inc.php';

session_start();

if (isset($_POST['submitSearch'])) {
    $search_terms = explode(' ', $_POST['search-text']);
    $results = array();
    $sql = "SHOW TABLES LIKE 'cat_sub_sub%'";
    $tables = mysqli_query($conn, $sql);
    while ($table = mysqli_fetch_assoc($tables)) {
        $table_name = $table['Tables_in_quality (cat_sub_sub%)'];
        $regexes = array();
        foreach ($search_terms as $term) {
            $escaped_term = mysqli_real_escape_string($conn, $term);
            $regexes[] = "(?=.*$escaped_term)";
        }
        $regex = implode('', $regexes);
        $query = "SELECT * FROM $table_name WHERE (code REGEXP '$regex' OR description REGEXP '$regex')";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $row['table_name'] = $table_name;
            $results[] = $row;
        }
    }
    mysqli_close($conn);
    $_SESSION['results'] = $results;
    header('Location: ../search.php');
    exit();
}
