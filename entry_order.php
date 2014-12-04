<?php
	$json = $_POST['entry_object'];
    $entry_object = json_decode($json);
	if ( isset($_COOKIE["CART"])) {
		setcookie("CART", json_encode($entry_object), time()+30000, "/", false);
	} elseif ( !isset($_COOKIE["CART"])) {
		setcookie("CART", json_encode($entry_object), time()+30000, "/", false);
	}	
echo "json=".json_encode($entry_object);

exit();
?>