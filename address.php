<?php 
session_start();
// After editing the address line, 
// Check if Cookie of ADDRESS exists ---> Update if does; Set cookie if not.
// if address line is empty, the js part ensures that it will not be submitted
// header('Content-type: application/json'); // without this, will return no json back

$address = array();
$address[] = array( 'Addr_l1' => $_POST["Addr_l1"],
		   			'Addr_l2' => $_POST["Addr_l2"]	);

// $_SESSION["ADDRESS"] = $address;
// $address[] = array('Session' => $_SESSION);

if ( isset($_COOKIE["ADDRESS"]) ){
	$_COOKIE["ADDRESS"] = json_encode($address);
} elseif ( !isset($_COOKIE["ADDRESS"]) ){
	setcookie("ADDRESS", json_encode($address), time()+3600, "/HeelFoodie", false);
}

print json_encode($address);
exit();



?>

