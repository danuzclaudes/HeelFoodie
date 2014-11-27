<?php
date_default_timezone_set("America/New_York");

require_once("/orm/Restaurant.php");
require_once("/orm/Order.php");
$base_url = "localhost:8080/HeelFoodie/index.php";

if(isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
} 

// print_r($path_components);
// Array
// (
//     [0] => 
//     [1] => restaurant
// )

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	// query or deletion
	if (count($path_components) >= 2 && $path_components[1]!='') {
		// matches /app.php/resource form
		if($path_components[1] == 'restaurant') {
			// GET app.php/restaurant[/resource]
			if (count($path_components) >= 3 && $path_components[2] != '') {
				// GET app.php/restaurant/id
				/* GET app.php/restaurant/id/menu??? */
				// get restaurant info and menu items by restaurant id ---> Retrieving a specific instance by id

				// $menu_items = Menu::getAllMenuItemsbyRestaurant($rid);
				// print($json_encode($menu_items));

				
				

				exit();

			} else {
				// GET app.php/restaurant
				// get all restaurants id, lat, lng ---> Retrieving an index of instance ids for the resource
				header("Content-type: application/json");
				$restaurants = Restaurant::getAllRestaurants();// return all restaurants' id, lat, lng
				if ($restaurants == null) {
					// restaurants not found
					header("HTTP/1.1 404 Not Found");
					print("Restaurants are null");
					exit();
				}

				print(json_encode($restaurants));
				exit();
			}
			

		} elseif ($path_components[1] == 'order') {
			// GET app.php/order[/resources]
			if ( count($path_components) >= 2 && $path_components[2] != '') {
				// GET app.php/order/id
				// get order by order id? customer id?

			}
				
		}
	}

} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
	// create or update
	if( count($path_components) >= 2 && $path_components[1] != '' ) {
		// matches /app.php/resource form
		if ($path_components[1] == 'address') {
			// POST /app.php/address
			// after editing the address line, post data to controller
			// receive POST data 
			// validate values
			// set to cookie of Address
			// if address line is empty, the js part will ensure that it won't be submitted
			header("Content-type: application/json");
			if (isset($_COOKIE['ADDRESS'])) {
				// delete previous ADDRESS Cookie, if exists
				setcookie("ADDRESS", false, time()-2592000, /*"/HeelFoodie",*/ false);
			}
			// validate values
			$addr_l1 = "";
			if( isset($_POST['Addr_l1']) && $_POST['Addr_l1'] != null ){
				$addr_l1 = $_POST['Addr_l1'];
			} else {
				// address line 1 is required
				header("HTTP/1.1 400 Bad Request");
				print "Address Line 1 is required";
				exit();
			}
			$phone1 = "";
			if( isset($_POST['Phone1']) && $_POST['Phone1'] != null){
				$phone1 = $_POST['Phone1'];
			} else {
				// address line 1 is required
				header("HTTP/1.1 400 Bad Request");
				print "Phone number is required";
				exit();
			}
			// set a new ADDRESS cookie
			$address = array( 'Addr_l1' => $addr_l1,
							  'Phone1' => $phone1
							);
			
			setcookie("ADDRESS", json_encode($address), time()+3600, /*"/HeelFoodie",*/ false);
			print json_encode($address);
			exit();

		} elseif ($path_components[1] == 'order') {
			// POST app.php/order ---> Creating a new instance
			// After clicking the placing order button,
			// Check if both Cookie of CART and ADDRESS exist
			// if both cookies are set, then
			// 	clear all cookies and set cookie of order
			//  create a new order in db
			//  if just accidentially goes into page??? --> GET order.php? NEVER HAPPENS!
			// if only cookie of ADDRESS is set, then return bad request & no Cart
			// if only cookie of CART is set, then return no Address
			// if neither are set, bad request
			if ( isset($_COOKIE['ADDRESS']) && isset($_COOKIE['CART']) ) {
				// processing Order
				// $cookie = json_decode(stripslashes($_COOKIE['ADDRESS']), true);
				$cookie = $_COOKIE['ADDRESS'];
				$cookie = stripslashes($cookie);
				$cookie = json_decode($cookie);

				// print_r($cookie); // for debugging
				$oaddress = $cookie[0]->Addr_l1;
				$ophone = $cookie[0]->Phone1;
				if(isset($_COOKIE['USER'])) {
					$cid = $_COOKIE['USER'];
				} else {
					$cid = 0;
				}
				$odate = new DateTime(date('Y-m-d')); // print $ODate->format('Y-m-d');
				// echo date("YmdHisu", time()); ---> 20141126192230000000
				$oid = date("YmdHisu", time());
				
				setcookie("ADDRESS", false, time()-2592000, false);
				setcookie("CART", false, time()-2592000, false);
				setcookie("ORDER", sha1($oid), time()+86400, /*"/HeelFoodie",*/ false);

				// insert into table order
				$new_order = Order::createOrder($oid, $cid, $ophone, $oaddress, $odate);
				if ($new_order == null) {
					header("HTTP/1.1 500 Server Error");
					print("Server could not create new order");
					exit();
				} 
				// //Generate JSON encoding of new Order
				// header("Content-type: application/json");
				print_r($new_order);
				// exit();
				echo '</br>'.$new_order['oid'].'</br>';
				echo $_SERVER['REQUEST_TIME'];
				echo substr($_SERVER['REQUEST_TIME'],-1,3);

				// processing MenuOrder...

				exit();
				// echo $oid;
			} elseif (!isset($_COOKIE['ADDRESS'])) {
				header("HTTP/1.1 400 Bad Request");
  				print "Address Information Cannot Be Blank!";
  				exit();
			} elseif (!isset($_COOKIE['CART'])) {
				header("HTTP/1.1 400 Bad Request");
  				print "You have not selected any products!";
	  			exit();
			}
		}

	} 
}
// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.
header("HTTP/1.1 400 Bad Request");
print '<h1 class="title">Page Not Found<h1>';
print '<h4>We\'re sorry but the page you requested is not available on the HeelFoodie website.&nbsp;</h4>';
print '<h4>Please Click <span><a href="'.$base_url.'">Here</a></span> to return to Homepage.</h4>';





// // print_r($restaurants);
// echo '</br>';
// $restaurant = Restaurant::findRestaurantByID(1);
// echo $restaurant->getID();

// echo '</br>';
// echo(date_format($restaurant->getRegisterDate(), "n/d/Y"));
// echo '</br>';
// echo $restaurant->getRegisterDate()->format("n/d/Y");



?>