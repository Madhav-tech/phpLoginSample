<?php
include_once "../db/config.php";
session_start();
$db = new DbConfig();
$connection = $db->getConnection();
if (isset($_GET['username']) && !empty($_GET['username'])) {
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
    //check if user  already exist or not

    $query = "SELECT * from users WHERE username = '{$username}'";
    $queryResult = mysqli_query($connection, $query);
    echo mysqli_error($connection);

    $rowCount = mysqli_num_rows($queryResult);

    if ($rowCount === 0) {
        echo '<P class=" text-success"><i class="bi bi-check-lg"></i> Username available to use</P>';
    } else {
        echo '<P class=" text-danger"><i class="bi bi-x-lg"></i> Username already exist</P>';
    }
}
