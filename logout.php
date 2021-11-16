<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   unset($_SESSION['user_details_id']);
   $_SESSION["valid"] = false;
   
   //echo 'You have cleaned session';
   header('Location:index.php');
?>