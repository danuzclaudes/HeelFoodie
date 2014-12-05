<?php
date_default_timezone_set("America/New_York");

require_once("./orm/Menu.php");
require_once("./orm/Customer.php");
// require_once("./orm/Restaurant.php");
require_once("./orm/Review.php");
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
			
			// Normal lookup.
			// Generate JSON encoding as response
			header("Content-type: application/json");
			print($customer->getJSON());
			exit();
		}elseif ($path_components[1] == 'review') {
				
			$menu_id = intval($path_components[2]);
			$food_info = Menu::findFoodEntryByID($menu_id);
			
			if ($food_info == null) {
       		// Menu not found.
				header("HTTP/1.0 404 Not Found");
				print("Menu id: " . $menu_id . " not found.");
				exit();
			}

			
			// print $path_components[2];
			if(count($path_components) == 3){
				// $review_id_list = json_encode(Review::get_all_review_by_menu_ids($menu_id));
				$review_id_list = Review::get_all_review_by_menu_ids($menu_id);

				$return_obj = array('food_info' => $food_info,
			      'review_id_list' => $review_id_list);
				// Normal lookup.
				// Generate JSON encoding as response
				header("Content-type: application/json");
				print(json_encode($return_obj));
				exit();
				
			}elseif(count($path_components) > 3){
				$review_id = intval($path_components[3]);
				$review = Review::findByID($review_id);
				if ($review == null) {
	       		// Menu not found.
					header("HTTP/1.0 404 Not Found");
					print("Review id: " . $review_id . " not found.");
					exit();
				}
				// Check to see if deleting
				if (isset($_REQUEST['delete'])) {
					$review->delete();
					header("Content-type: application/json");
					print(json_encode(true));
					exit();
				}
				// $review_info = $review->getJSON();
				// $return_obj = array('menu_info' => $menu_info,
			    //   'review_info' => $review_info);
				header("Content-type: application/json");
				print($review->getJSON());
				exit();
			}
			
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
			    $password = false;
			    if (isset($_REQUEST['password'])) {
			      $new_password = trim($_REQUEST['password']);
			      if ($new_password == "") {
			        	header("HTTP/1.0 400 Bad Request");
			        	print("Bad password");
			        	exit();
			      }
			    }
				//var_dump($_REQUEST);
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
			    //echo "customer-getJSON:",$customer->getJSON(); 
			    print($customer->getJSON());
			    exit();
			} elseif ($path_components[1] == 'review'&& count($path_components) == 3){
				
				$menu_id = intval($path_components[2]);
			    $customer_id = '1';
			    
			    $title = trim($_REQUEST['title']);
			    if ($title == "") {
			      header("HTTP/1.0 400 Bad Request");
			      print("Bad title");
			      exit();
			    }

			    $comment = "";
			    if (isset($_REQUEST['comment'])) {
			      $comment = trim($_REQUEST['comment']);
			    }

			    $rating = "";
			    if (isset($_REQUEST['rate'])) {
			      $rating = trim($_REQUEST['rate']);
			    }

			    $comment_date = null;

			    $reviewimage = null;

			    // Create new Todo via ORM
			    $new_review = Review::create_review($menu_id, $customer_id, $rating, $comment, $title, $reviewimage, $comment_date);

			    // Report if failed
			    if ($new_review == null) {
			      header("HTTP/1.0 500 Server Error");
			      print("Server couldn't create new review.");
			      exit();
			    }
    
			    //Generate JSON encoding of new Todo
			    header("Content-type: application/json");
			    print($new_review->getJSON());
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