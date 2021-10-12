<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   $_SESSION["valid"] = false;
   
   echo 'You have cleaned session';
   header('Location:index.php');
?>