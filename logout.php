<?php 
    require("config.php"); 
    unset($_SESSION['user']);
    header("Location: Restaurant_main.php"); 
    die("Redirecting to: Restaurant_main.php");
?>