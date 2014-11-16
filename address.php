<?php 
session_start();
header('Content-type: application/json'); // without this, will return no json back

$address = array();
$address[] = array( 'Addr_l1' => $_POST["Addr_l1"],
			   'Addr_l2' => $_POST["Addr_l2"]	
			 );


$_SESSION["ADDRESS"] = $address;
// $address[] = array('Session' => $_SESSION);

print json_encode($address);
// print(json_encode($message));

?>

