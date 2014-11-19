<?php
	$json = $_POST['entry_object'];
    $entry_object = json_decode($json);
	if ( isset($_COOKIE["CART"])) {
		setcookie("CART", json_encode($entry_object), time()+30000, "/HeelFoodie", false);
	} elseif ( !isset($_COOKIE["CART"])) {
		setcookie("CART", json_encode($entry_object), time()+30000, "/HeelFoodie", false);
	}	
echo "json=".json_encode($entry_object);
//echo $_POST['entry_object'];
exit();
?>