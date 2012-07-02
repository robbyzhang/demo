<?php
   session_start();
   //print($_SESSION['redislogin_user']);
   session_destroy();
   header("Location:./demo.php")
?>