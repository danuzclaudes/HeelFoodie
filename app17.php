<?php
date_default_timezone_set("America/New_York");


require_once("orm/Customer.php");
// echo $_SERVER['PATH_INFO'];
// if(!isset($_SERVER['PATH_INFO'])){
// 	echo "hello";
// };

//if(isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
//} 



if($_SERVER['REQUEST_METHOD'] == 'GET') {
	// query or deletion
	if (count($path_components) >= 2 && $path_components[1]!='') {
		// matches /app.php/resource form
		if ($path_components[1] == 'customer') {
			$customer_id = intval($path_components[2]);
			$customer = Customer::findByID($customer_id);

			if ($customer == null) {
       		// Customer not found.
				header("HTTP/1.0 404 Not Found");
				print("Customer id: " . $customer_id . " not found.");
				exit();
			}

			// Check to see if deleting
			if (isset($_REQUEST['delete'])) {
				$customer->delete();
				header("Content-type: application/json");
				print(json_encode(true));
				exit();
			}
			
			// Normal lookup.
			// Generate JSON encoding as response
			header("Content-type: application/json");
			print($customer->getJSON());
			exit();
		}
		
	}
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
		// create or update
		if( count($path_components) >= 2 && $path_components[1] != '' ) {
			// matches /app.php/resource form
			if ($path_components[1] == 'customer') {
				//Interpret <id> as integer and look up via ORM
			    $customer_id = intval($path_components[2]);
			    $customer = Customer::findByID($customer_id);
			    if ($customer == null) {
				    // Customer not found.
				    header("HTTP/1.0 404 Not Found");
				    print("Customer id: " . $customer_id . " not found while attempting update.");
				    exit();
	    		}

	    		// Validate values
			    // $password = false;
			    // if (isset($_REQUEST['password'])) {
			    //   $new_password = trim($_REQUEST['password']);
			    //   if ($new_password == "") {
			    //     	header("HTTP/1.0 400 Bad Request");
			    //     	print("Bad password");
			    //     	exit();
			    //   }
			    // }

			    $new_firstname = false;
			    if (isset($_REQUEST['firstname'])) {
			      $new_firstname = trim($_REQUEST['firstname']);
			    }

			    $new_lastname = false;
			    if (isset($_REQUEST['lastname'])) {
			      $new_lastname = trim($_REQUEST['lastname']);
			    }

			    $new_middlename = false;
			    if (isset($_REQUEST['middlename'])) {
			      $new_middlename = trim($_REQUEST['middlename']);
			    }

			    $new_cellphone1 = false;
			    if (isset($_REQUEST['cellphone1'])) {
			      $new_cellphone1 = trim($_REQUEST['cellphone1']);
			    }

			    $new_cellphone2 = false;
			    if (isset($_REQUEST['cellphone2'])) {
			      $new_cellphone2 = trim($_REQUEST['cellphone2']);
			    }

				$new_addr_l1 = false;
			    if (isset($_REQUEST['addr_l1'])) {
			      $new_addr_l1 = trim($_REQUEST['addr_l1']);
			    }

			    $new_addr_l2 = false;
			    if (isset($_REQUEST['addr_l2'])) {
			      $new_addr_l2 = trim($_REQUEST['addr_l2']);
			    }
	  			$new_city = false;
			    if (isset($_REQUEST['city'])) {
			      $new_city = trim($_REQUEST['city']);
			    }

			    $new_state = false;
			    if (isset($_REQUEST['state'])) {
			      $new_state = trim($_REQUEST['state']);
			    }

			    $new_zipcode = false;
			    if (isset($_REQUEST['zipcode'])) {
			      $new_zipcode = trim($_REQUEST['zipcode']);
			    }

			 //    // Update via ORM
			    if ($new_firstname) {
			      $customer->setFirstname($new_firstname);
			    }
			    if ($new_middlename != false) {
			      $customer->setMiddlename($new_middlename);
			    }
			    if ($new_lastname != false) {
			      $customer->setLastname($new_lastname);
			    }
			    if ($new_cellphone1 != false) {
			      $customer->setCellphone1($new_cellphone1);
			    }
			    if ($new_cellphone2 != false) {
			      $customer->setCellphone2($new_cellphone2);
			    }
			    if ($new_addr_l1 != false) {
			      $customer->setAddr_l1($new_addr_l1);
			    }
			    if ($new_addr_l2 != false) {
			      $customer->setAddr_l2($new_addr_l2);
			    }
			    if ($new_city != false) {
			      $customer->setCity($new_city);
			    }
			    if ($new_state != false) {
			      $customer->setState($new_state);
			    }
				if ($new_zipcode != false) {
			      $customer->setZipcode($new_zipcode);
			    }

			    // Return JSON encoding of updated customer
			    header("Content-type: application/json");
			    print($customer->getJSON());
			    exit();
			}

		} 
	}
// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.
header("HTTP/1.1 400 Bad Request!");
print '<h1 class="title">Page Not Found<h1>';
print '<h4>We\'re sorry but the page you requested is not available on the HeelFoodie website.&nbsp;</h4>';
// print '<h4>Please Click <span><a href="'.$base_url.'">Here</a></span> to return to Homepage.</h4>';





// // print_r($restaurants);
// echo '</br>';
// $restaurant = Restaurant::findRestaurantByID(1);
// echo $restaurant->getID();

// echo '</br>';
// echo(date_format($restaurant->getRegisterDate(), "n/d/Y"));
// echo '</br>';
// echo $restaurant->getRegisterDate()->format("n/d/Y");



?>