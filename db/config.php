<?php

class DbConfig
{
    const HOST = "localhost";
    const USER = "root";
    const PWD = "";
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

    function getUser($username,$password){
        global $connection;
        $this->query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }
}

class UserDetails
{
    private $queryResult;
    private $query;

    function insertIntoDetail($userId, $firstname, $lastname, $email)
    {
        //insert into users table
        global $connection;
        $this->query = "INSERT INTO user_details (user_id, first_name, last_name, email) VALUES ('{$userId}','{$firstname}', '{$lastname}', '{$email}')";
        $this->queryResult = mysqli_query($connection, $this->query);
        return $this->queryResult;
    }
    function getCountofUsers(){
        global $connection;
        $this->query = "select * from user_details";
        $this->queryResult= mysqli_query($connection, $this->query );
        return mysqli_num_rows($this->queryResult);
    }

    function getDetailsFromId($userId){
        global $connection;
        $this->query = "SELECT * FROM user_details WHERE user_id = '{$userId}'";
        $this->queryResult=mysqli_query($connection,  $this->query);
        return mysqli_fetch_assoc($this->queryResult);
    }
    
}
