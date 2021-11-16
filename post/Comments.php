<?php
include_once "../db/config.php";
session_start();
$db = new DbConfig();
$connection = $db->getConnection();
if (isset($_GET['post_id']) && !empty($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    //check if post is already liked or not

    $username = $_SESSION['username'];
    //get likes count
    $query = "SELECT post_comment_count FROM posts WHERE post_id = {$post_id}";
    $queryResult = mysqli_query($connection, $query);
    //echo mysqli_error($connection);
    $row = mysqli_fetch_assoc($queryResult);
    $comment_count = $row['post_comment_count'];
    echo $comment_count;
}
