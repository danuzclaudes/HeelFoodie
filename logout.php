<?php 
    require("config.php"); 
    unset($_SESSION['user']);	
    setcookie("USER", null, time()+30000, "/", false);  	
	print(json_encode(true));
?>