<?php

class DbConfig
{
    //const HOST = "database-1.c88xiivsd0im.ap-south-1.rds.amazonaws.com";
    const HOST = "localhost";
    const USER = "root";
    const PWD = ""; //const HOST =
    const DB = "login";
    private $connection;
    function __construct()
    {
        $this->connection = mysqli_connect(DbConfig::HOST, DbConfig::USER, DbConfig::PWD, DbConfig::DB);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

class Users
{
    private $queryResult;
    private $query;

    function insertIntoUsers($username, $password, $userId)
    {

        //insert into users table
        global $connection;
        $this->query = "INSERT INTO users ( username, password, user_details_id) VALUES ('{$username}', '{$password}', '{$userId}')";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }

    function getUser($username)
    {
        global $connection;
        $this->query = "SELECT * FROM users WHERE username = '{$username}'";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }
}

class UserDetails
{
    private $queryResult;
    private $query;

    function insertIntoDetail($userId, $firstname, $lastname, $email, $user_image)
    {
        //insert into users table
        global $connection;
        $this->query = "INSERT INTO user_details (user_id, first_name, last_name, email,user_image) VALUES ('{$userId}','{$firstname}', '{$lastname}', '{$email}','{$user_image}')";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }
    function getCountofUsers()
    {
        global $connection;
        $this->query = "select user_id from user_details ORDER BY user_id DESC";
        $this->queryResult = mysqli_query($connection, $this->query);

        $row = mysqli_fetch_assoc($this->queryResult);
        return $row['user_id'];
    }

    function getDetailsFromId($userId)
    {
        global $connection;
        $this->query = "SELECT * FROM user_details WHERE user_id = '{$userId}'";
        $this->queryResult = mysqli_query($connection,  $this->query);
        return mysqli_fetch_assoc($this->queryResult);
    }
    function updateDetail($userId, $firstname, $lastname, $email, $user_image)
    {
        //insert into users table
        global $connection;
        $this->query = "UPDATE user_details SET first_name='{$firstname}', last_name='{$lastname}',email='{$email}',user_image = '{$user_image}' WHERE user_id = '{$userId}'";
        $this->queryResult = mysqli_query($connection, $this->query);
        if (!$this->queryResult) {
            die(mysqli_error($connection));
        }
        return $this->queryResult;
    }
}
class Post
{
    private $queryResult;
    private $query;

    function insertIntoPost($post_author, $post_date, $post_content, $post_image, $post_user_id)
    {
        global $connection;
        $this->query = "INSERT INTO posts ( post_author,post_date,post_image,post_content,post_user_id) VALUES ('{$post_author}','{$post_date}', '{$post_image}', '{$post_content}',{$post_user_id})";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }

    function getPostsFromId($post_id)
    {
        global $connection;
        $this->query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }
    function deletePost($delete_post_id)
    {
        global $connection;
        //delete comment of given post first
        $query1 = "DELETE from comments where comment_post_id = {$delete_post_id}";
        $queryResult1 = mysqli_query($connection, $query1);
        if (!$queryResult1) {
            die(mysqli_error($connection));
        }
        //then delete likes from the post
        $query2 = "DELETE from users_liked_post where post_id = {$delete_post_id}";
        $queryResult2 = mysqli_query($connection, $query2);
        if (!$queryResult2) {
            die(mysqli_error($connection));
        }
        //now delete post
        $query3 = "DELETE from posts where post_id = {$delete_post_id}";
        $queryResult3 = mysqli_query($connection, $query3);
        if (!$queryResult3) {
            die(mysqli_error($connection));
        }
    }
    function updatePost($post_id, $post_date, $post_content, $post_image)
    {
        global $connection;

        $this->query = "UPDATE posts SET post_date ='{$post_date}' ,post_image='{$post_image}',post_content ='{$post_content}' ";
        $this->query .= "WHERE post_id = {$post_id}";

        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
        if (!$this->queryResult) {
            die(mysqli_error($connection));
        }
    }
}
