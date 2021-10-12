<?php

$connection = getConnection();

function getConnection(){
    define("HOST","localhost");
    define("USER","root");
    define("PWD","");
    define('DB', 'login');
    
    $connection = mysqli_connect(HOST,USER,PWD,DB);
    return $connection;
}

?>