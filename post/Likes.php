<?php
include_once "../db/config.php";
session_start();
$db = new DbConfig();
$connection = $db->getConnection();
if (isset($_GET['post_id']) && !empty($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    //check if post is already liked or not

    $username = $_SESSION['username'];
    $query = "SELECT * from users_liked_post WHERE username = '{$username}' AND post_id = {$post_id}";
    $queryResult = mysqli_query($connection, $query);
    echo mysqli_error($connection);

    $rowCount = mysqli_num_rows($queryResult);
    $like_count = 0;

    if ($rowCount !== 1) {
        //update likes count
        $query = "UPDATE posts SET post_like_count = post_like_count + 1 WHERE post_id = {$post_id}";
        $result = mysqli_query($connection, $query);
        echo mysqli_error($connection);

        //update user_liked_post table
        $query = "INSERT INTO users_liked_post(username,post_id) value('{$username}',{$post_id})";
        $queryResult = mysqli_query($connection, $query);
        echo mysqli_error($connection);
    } else {
        $query = "UPDATE posts SET post_like_count = post_like_count - 1 WHERE post_id = {$post_id}";
        $result = mysqli_query($connection, $query);
        echo mysqli_error($connection);
        //delete from users_liked_post if we dislike a post
        $query = "DELETE from users_liked_post WHERE username = '{$username}' AND post_id = {$post_id}";
        $queryResult = mysqli_query($connection, $query);
        echo mysqli_error($connection);
    }

    //get likes count
    $query = "SELECT post_like_count FROM posts WHERE post_id = {$post_id}";
    $queryResult = mysqli_query($connection, $query);
    //echo mysqli_error($connection);
    $row = mysqli_fetch_assoc($queryResult);
    $like_count = $row['post_like_count'];


    echo $like_count;
}
