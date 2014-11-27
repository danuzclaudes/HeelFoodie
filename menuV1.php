<?php

//I am Controller!

//Menu ORM
require_once("orm/MenuLocalV1.php");

//Cart ORM (but seems no need)
require_once("orm/Cart.php");

if(isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
} 

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	// query or deletion
	if (count($path_components) >= 2 && $path_components[1]!='') {
		// matches /app.php/resource form
		if($path_components[1] == 'restaurant') {
			// GET app.php/restaurant[/<rest_id>]
			$rest_id = intval($path_components[2]);
			header("Content-type: application/json");
			print(json_encode(Menu::getAllIDsByRestID($rest_id)));
			exit();
		}
		if ($path_components[1] == 'menu') {
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
		}
		
		
		if ($path_components[1] == 'cart') {
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
}
?>
