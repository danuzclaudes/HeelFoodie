<<<<<<< HEAD
<?php
date_default_timezone_set("America/New_York");

require_once("/orm/Restaurant.php");
require_once("/orm/Order.php");
require_once("/orm/MenuOrder.php");
//Menu ORM
require_once("orm/MenuLocalV1.php");
$base_url = "localhost:8080/HeelFoodie/index.php";

if(isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
} else {
	$path_components = [];
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
				$rest_id = intval($path_components[2]);
				header("Content-type: application/json");
				print(json_encode(Menu::getAllIDsByRestID($rest_id)));
				exit();

			} else {
				// GET app.php/restaurant
				// get all restaurants id, lat, lng ---> Retrieving an index of instance ids for the resource
				header("Content-type: application/json");
				$all_restaurants = Restaurant::getAllRestaurants();// return all restaurants' id, lat, lng
				if ($all_restaurants == null) {
					// restaurants not found
					header("HTTP/1.1 404 Not Found");
					print("Restaurants are null");
					exit();
				}

				print(json_encode($all_restaurants));
				exit();
			}
			

		} elseif ($path_components[1] == 'order') {
			if ( count($path_components) >= 3 && $path_components[2] != '') {
				// GET app.php/order[/resources]
				// oid was stored in Cookie to track the placed order
				if( count($path_components) == 3 && strlen($path_components[2]) > 10 ) {
					// GET app.php/order/<oid> ---> order id must be stored in cookie to be tracked
					$id = $path_components[2];
					header("Content-type: application/json");
					$track_order_obj = Order::getOrderByID($id);

					if($track_order_obj == null) {
						// Order not found
						header("HTTP/1.1 404 Not Found");
						header("Content-type: text/html");
						// print '</br>track order obj is null</br>';
						print('<h1>You order id: '.$id.' is not found</h1>');
						print '<h3>If you want to keep all your orders records, please login or register!"</h3>';
		    			print '<h3><a href="index.php">return home</a></h3>';
		    			exit();
					}

					print ($track_order_obj->getJSON());
					exit();	

				} elseif ( count($path_components) == 4 && strlen($path_components[2]) > 10
						   && $path_components[3] == 'menu' ) {
					// GET app.php/order/id/menu
					$id = $path_components[2];
					header("Content-type: application/json");
					$track_mo_obj = MenuOrder::getMenuFoodInfoByOrderID($id);
					if($track_mo_obj == null) {
						header("HTTP/1.0 404 not found");
						header("Content-type: text/html");
						// print '</br>trackm mo obj is null</br>';
						print('<h1>You order id: '.$id.' is not found</h1>');
						print '<h3>If you want to keep all your orders records, please login or register!"</h3>';
		    			print '<h3><a href="index.php">return home</a></h3>';
						exit();
					}
					// Normal lookup for menu order
					// Generate JSON encoding as response
					header("Content-type: application/json");
					print(json_encode($track_mo_obj));
					exit();
				}
			} elseif( count($path_components) < 3 || $path_components[2] == '' ) {
				// GET app.php/order/
				header("HTTP/1.1 400 Bad Request");
				header("Content-type: text/html");
				echo "<h1>You order is not found!</h1>";
				echo '<h3>If you want to keep all your orders information, please login or register!"</h3>';
		    	echo '<h3><a href="index.php">return home</a></h3>';
		    	exit();
			} 
				
		} elseif ($path_components[1] == 'menu') {
			// GET app.php/menu/<menu_id>
			// get restaurant info and menu items
			$menu_id = intval($path_components[2]);
			$menu = Menu::findByID($menu_id);
			$menu_food = Menu::findFoodEntryByID($menu_id);	
			
    		if ($menu == null) {
       		// Menu not found.
				header("HTTP/1.0 404 Not Found");
				print("Menu id: " . $menu_id . " not found.");
				exit();
			}

			// Check to see if deleting
			if (isset($_REQUEST['delete'])) {
			$menu->delete();
			header("Content-type: application/json");
			print(json_encode(true));
			exit();
			}
			
			// Normal lookup.
			// Generate JSON encoding as response
			header("Content-type: application/json");
			print(json_encode($menu_food));
			exit();

		} elseif ($path_components[1] == 'cart') {
			// GET app.php/cart
			if ( isset($_COOKIE["CART"]) ) {
    			$cart_info = $_COOKIE["CART"];
				//array $cart_info
    			$cart_info = json_decode($cart_info, true);
				header("Content-type: application/json");
				print(json_encode($cart_info));
				exit();
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
			// 	if required address line is empty, the js part can also ensure that it won't be submitted
			// set to cookie of Address	
			header("Content-type: application/json");
			if (isset($_COOKIE['ADDRESS'])) {
				// delete previous ADDRESS Cookie, if exists
				// unset($_COOKIE['ADDRESS']);
				setcookie("ADDRESS", false, time()-2592000, "/", false);

			}
			// validate address line one
			$addr_l1 = "";
			if( isset($_POST['Addr_l1']) && $_POST['Addr_l1'] != null ){
				$addr_l1 = $_POST['Addr_l1'];
			} else {
				// address line 1 is required
				header("HTTP/1.1 400 Bad Request");
				print "Address Line 1 is required";
				exit();
			}
			// validate phone number
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
							  'Phone1' => $phone1 );
			
			setcookie("ADDRESS", json_encode($address), time()+3600, "/", false);
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
				header("Content-type: application/json");
				// processing Order
				// $cookie = json_decode(stripslashes($_COOKIE['ADDRESS']), true);
				$cookie_address = $_COOKIE['ADDRESS'];
				$cookie_address = stripslashes($cookie_address);
				$cookie_address = json_decode($cookie_address);
				// print_r($cookie_address);

				// print_r($cookie); // for debugging
				// stdClass Object
				// 	(
				// 	    [Addr_l1] => test3
				// 	    [Phone1] => 1113334444
				// 	)
				
				$cookie_cart = $_COOKIE['CART'];
				$cookie_cart = stripslashes($cookie_cart);
				$cookie_cart = json_decode($cookie_cart);
				// print_r($cookie_cart);
				
				// unset($_COOKIE['ADDRESS']);
				// unset($_COOKIE['CART']);
				setcookie("ADDRESS", false, time()-2592000, "/", false);
				setcookie("CART", false, time()-2592000, "/", false);
				// MUST before any output
				setcookie("ORDER", date("YmdHisu", time()), time()+86400, "/", false);
				// setcookie("ORDER", sha1($oid), time()+86400, /*"/HeelFoodie",*/ false);

				$oid = date("YmdHisu", time());

				$oaddress = $cookie_address->Addr_l1;
				$ophone = $cookie_address->Phone1;
				if(isset($_COOKIE['USER'])) {
					$cid = $_COOKIE['USER'];
				} else {
					$cid = substr($_SERVER['REQUEST_TIME'],3,7);
				}
				$odate = new DateTime(date('Y-m-d')); // print $ODate->format('Y-m-d');
				// echo date("YmdHisu", time()); ---> 20141126192230000000
				

				// insert into table order
				$new_order = Order::createOrder($oid, $cid, $ophone, $oaddress, $odate);
				if ($new_order == null) {
					header("HTTP/1.1 500 Server Error");
					print("Server could not create new order");
					exit();
				} 
				
				// processing MenuOrder...
				$status = 'one';

				foreach($cookie_cart as $key => $cart_item){
					// echo $cart_item->menu_id.'</br>';
					// $mid, $oid, $qty, status
					$new_menu_order = MenuOrder::createMenuOrder(intval($cart_item->menu_id),
																 $new_order->getOid(),
																 intval($cart_item->qty),
																 $status);
					// Report if failed
					if ($new_menu_order == null) {
						header("HTTP/1.1 500 Server Error");
						print("Server couldn't create new menu_order");
						exit();
					}

					// Generate JSON encoding of new menu_order
					// print($new_menu_order->getJSON());
					// {"mid":2,"oid":"20141128152943000000","qty":1,"status":"one"}
					// {"mid":3,"oid":"20141128152943000000","qty":1,"status":"one"}
				}			
				// header("HTTP/1.1 201 Created"); //--> only order obj is created...
				// Generate JSON encoding of new Order
				print($new_order->getJSON());
				// {"oid":"20141128152943000000","cid":7206583,"ophone":"1113334444","oaddress":"test1","odate":"'2014-11-28'"}		
				exit();

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



=======
<?php
date_default_timezone_set("America/New_York");

require_once("/orm/Restaurant.php");
require_once("/orm/Order.php");
require_once("/orm/MenuOrder.php");
//Menu ORM
require_once("orm/MenuLocalV1.php");
$base_url = "localhost:8080/HeelFoodie/index.php";

if(isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
} else {
	$path_components = [];
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
				$rest_id = intval($path_components[2]);
				header("Content-type: application/json");
				print(json_encode(Menu::getAllIDsByRestID($rest_id)));
				exit();

			} else {
				// GET app.php/restaurant
				// get all restaurants id, lat, lng ---> Retrieving an index of instance ids for the resource
				header("Content-type: application/json");
				$all_restaurants = Restaurant::getAllRestaurants();// return all restaurants' id, lat, lng
				if ($all_restaurants == null) {
					// restaurants not found
					header("HTTP/1.1 404 Not Found");
					print("Restaurants are null");
					exit();
				}

				print(json_encode($all_restaurants));
				exit();
			}
			

		} elseif ($path_components[1] == 'order') {
			if ( count($path_components) >= 3 && $path_components[2] != '') {
				// GET app.php/order[/resources]
				// oid was stored in Cookie to track the placed order
				if( count($path_components) == 3 && strlen($path_components[2]) > 10 ) {
					// GET app.php/order/<oid> ---> order id must be stored in cookie to be tracked
					$id = $path_components[2];
					header("Content-type: application/json");
					$track_order_obj = Order::getOrderByID($id);

					if($track_order_obj == null) {
						// Order not found
						header("HTTP/1.1 404 Not Found");
						header("Content-type: text/html");
						// print '</br>track order obj is null</br>';
						print('<h1>You order id: '.$id.' is not found</h1>');
						print '<h3>If you want to keep all your orders records, please login or register!"</h3>';
		    			print '<h3><a href="index.php">return home</a></h3>';
		    			exit();
					}

					print ($track_order_obj->getJSON());
					exit();	

				} elseif ( count($path_components) == 4 && strlen($path_components[2]) > 10
						   && $path_components[3] == 'menu' ) {
					// GET app.php/order/id/menu
					$id = $path_components[2];
					header("Content-type: application/json");
					$track_mo_obj = MenuOrder::getMenuFoodInfoByOrderID($id);
					if($track_mo_obj == null) {
						header("HTTP/1.0 404 not found");
						header("Content-type: text/html");
						// print '</br>trackm mo obj is null</br>';
						print('<h1>You order id: '.$id.' is not found</h1>');
						print '<h3>If you want to keep all your orders records, please login or register!"</h3>';
		    			print '<h3><a href="index.php">return home</a></h3>';
						exit();
					}
					// Normal lookup for menu order
					// Generate JSON encoding as response
					header("Content-type: application/json");
					print(json_encode($track_mo_obj));
					exit();
				}
			} elseif( count($path_components) < 3 || $path_components[2] == '' ) {
				// GET app.php/order/
				header("HTTP/1.1 400 Bad Request");
				header("Content-type: text/html");
				echo "<h1>You order is not found!</h1>";
				echo '<h3>If you want to keep all your orders information, please login or register!"</h3>';
		    	echo '<h3><a href="index.php">return home</a></h3>';
		    	exit();
			} 
				
		} elseif ($path_components[1] == 'menu') {
			// GET app.php/menu/<menu_id>
			// get restaurant info and menu items
			$menu_id = intval($path_components[2]);
			$menu = Menu::findByID($menu_id);
			$menu_food = Menu::findFoodEntryByID($menu_id);	
			
    		if ($menu == null) {
       		// Menu not found.
				header("HTTP/1.0 404 Not Found");
				print("Menu id: " . $menu_id . " not found.");
				exit();
			}

			// Check to see if deleting
			if (isset($_REQUEST['delete'])) {
			$menu->delete();
			header("Content-type: application/json");
			print(json_encode(true));
			exit();
			}
			
			// Normal lookup.
			// Generate JSON encoding as response
			header("Content-type: application/json");
			print(json_encode($menu_food));
			exit();

		} elseif ($path_components[1] == 'cart') {
			// GET app.php/cart
			if ( isset($_COOKIE["CART"]) ) {
    			$cart_info = $_COOKIE["CART"];
				//array $cart_info
    			$cart_info = json_decode($cart_info, true);
				header("Content-type: application/json");
				print(json_encode($cart_info));
				exit();
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
			// 	if required address line is empty, the js part can also ensure that it won't be submitted
			// set to cookie of Address	
			header("Content-type: application/json");
			if (isset($_COOKIE['ADDRESS'])) {
				// delete previous ADDRESS Cookie, if exists
				// unset($_COOKIE['ADDRESS']);
				setcookie("ADDRESS", false, time()-2592000, "/", false);

			}
			// validate address line one
			$addr_l1 = "";
			if( isset($_POST['Addr_l1']) && $_POST['Addr_l1'] != null ){
				$addr_l1 = $_POST['Addr_l1'];
			} else {
				// address line 1 is required
				header("HTTP/1.1 400 Bad Request");
				print "Address Line 1 is required";
				exit();
			}
			// validate phone number
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
							  'Phone1' => $phone1 );
			
			setcookie("ADDRESS", json_encode($address), time()+3600, "/", false);
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
				header("Content-type: application/json");
				// processing Order
				// $cookie = json_decode(stripslashes($_COOKIE['ADDRESS']), true);
				$cookie_address = $_COOKIE['ADDRESS'];
				$cookie_address = stripslashes($cookie_address);
				$cookie_address = json_decode($cookie_address);
				// print_r($cookie_address);

				// print_r($cookie); // for debugging
				// stdClass Object
				// 	(
				// 	    [Addr_l1] => test3
				// 	    [Phone1] => 1113334444
				// 	)
				
				$cookie_cart = $_COOKIE['CART'];
				$cookie_cart = stripslashes($cookie_cart);
				$cookie_cart = json_decode($cookie_cart);
				// print_r($cookie_cart);
				
				// unset($_COOKIE['ADDRESS']);
				// unset($_COOKIE['CART']);
				setcookie("ADDRESS", false, time()-2592000, "/", false);
				setcookie("CART", false, time()-2592000, "/", false);
				// MUST before any output
				setcookie("ORDER", date("YmdHisu", time()), time()+86400, "/", false);
				// setcookie("ORDER", sha1($oid), time()+86400, /*"/HeelFoodie",*/ false);

				$oid = date("YmdHisu", time());

				$oaddress = $cookie_address->Addr_l1;
				$ophone = $cookie_address->Phone1;
				if(isset($_COOKIE['USER'])) {
					$cid = $_COOKIE['USER'];
				} else {
					$cid = substr($_SERVER['REQUEST_TIME'],3,7);
				}
				$odate = new DateTime(date('Y-m-d')); // print $ODate->format('Y-m-d');
				// echo date("YmdHisu", time()); ---> 20141126192230000000
				

				// insert into table order
				$new_order = Order::createOrder($oid, $cid, $ophone, $oaddress, $odate);
				if ($new_order == null) {
					header("HTTP/1.1 500 Server Error");
					print("Server could not create new order");
					exit();
				} 
				
				// processing MenuOrder...
				$status = 'one';

				foreach($cookie_cart as $key => $cart_item){
					// echo $cart_item->menu_id.'</br>';
					// $mid, $oid, $qty, status
					$new_menu_order = MenuOrder::createMenuOrder(intval($cart_item->menu_id),
																 $new_order->getOid(),
																 intval($cart_item->qty),
																 $status);
					// Report if failed
					if ($new_menu_order == null) {
						header("HTTP/1.1 500 Server Error");
						print("Server couldn't create new menu_order");
						exit();
					}

					// Generate JSON encoding of new menu_order
					// print($new_menu_order->getJSON());
					// {"mid":2,"oid":"20141128152943000000","qty":1,"status":"one"}
					// {"mid":3,"oid":"20141128152943000000","qty":1,"status":"one"}
				}			
				// header("HTTP/1.1 201 Created"); //--> only order obj is created...
				// Generate JSON encoding of new Order
				print($new_order->getJSON());
				// {"oid":"20141128152943000000","cid":7206583,"ophone":"1113334444","oaddress":"test1","odate":"'2014-11-28'"}		
				exit();

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



>>>>>>> 38d22165515e8e5028df7e9655aca48d2fe763d6
?>