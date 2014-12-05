<?php
    if(isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
} 

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (count($path_components) >= 2 && $path_components[1]!='') {
		// matches /cookie.php/resource
		if ($path_components[1] == 'cart') {
			// if cart cookie is set
			if ( isset($_COOKIE["CART"]) ) {
				$cart_info = $_COOKIE["CART"];
				//array $cart_info
    			$cart_info = json_decode($cart_info, true);
				if (count($path_components) >= 3 && $path_components[2] != '') {
					//GET cookie.php/cart/menu_id
					$mid = intval($path_components[2]);
					//Find item on menu_id
					$item = searchSubArray($cart_info, "menu_id", $mid);
					//echo json_encode($item);
					if (isset($_REQUEST['delete'])) {
						//Delete item from cart cookie
				      	//echo "json=".json_encode($cart_info);
				      	$key = array_search($item, $cart_info);
						//echo "key=".$key;
						unset($cart_info[$key]);
						$update_cart_info = array();
						foreach ($cart_info as $subarray){
							$update_cart_info[] = $subarray;
						}
						//echo "cart_info=".json_encode($update_cart_info);
						if ($update_cart_info != null) {
							//reset COOKIE
							setcookie("CART", json_encode($update_cart_info), time()+30000, "/", false);
					      	header("Content-type: application/json");
					      	//echo "unset=".json_encode($update_cart_info);
					      	print(json_encode(true));
					      	exit();
						} else {
							//unset COOKIE
							setcookie("CART", null, time()+30000, "/", false);
					      	print(json_encode(false));
					      	exit();
						}	
				    }
				} else{
					//Get array cart_info
					print(json_encode($cart_info));
					exit();
				}
	
			} else {
				header("Content-type: application/json");
		      	//echo "get cartinfo fail";
		      	$cart_info = null;
		      	print(json_encode($cart_info));
		      	exit();
			}
		} elseif ($path_components[1] == 'login') {
			if ( isset($_COOKIE["USER"]) ) {
				$username = $_COOKIE["USER"];
				print(json_encode("username"));
				exit();
			}
		}
	}

} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
	$json = file_get_contents("php://input");
    $entry_object = json_decode($json, true);
	if ( !isset($_COOKIE["CART"])) {
		$entry_object = array($entry_object);
		if (count($path_components) >= 2 && $path_components[1]!='') {
			if ($path_components[1] == 'cart') {
				if (count($path_components) >= 3 && $path_components[2] != '') {
				} else {
					//setcookie("CART", null, time()+30000, "/~QiongchengXu/HeelFoodie/", false);
					setcookie("CART", json_encode($entry_object), time()+30000, "/", false);	
				}
			}
		}
		echo "json=".json_encode($entry_object);
		exit();
	}elseif (isset($_COOKIE["CART"])) {
		if (count($path_components) >= 2 && $path_components[1]!='') {
			// matches /cookie.php/resource
			if ($path_components[1] == 'cart') {
				// if cart cookie is set
				//var_dump($_REQUEST);
				$cart_info = $_COOKIE["CART"];
				//array $cart_info
    			$cart_info = json_decode($cart_info, true);
				//echo "cart_info: ".$cart_info;
				if (count($path_components) >= 3 && $path_components[2] != '') {
					//GET cookie.php/cart/menu_id
					//Update item in cookie
					//$entry_object = array($entry_object);
					$mid = intval($path_components[2]);
					//Find item on menu_id
					$item = searchSubArray($cart_info, "menu_id", $mid);
					//echo json_encode($item);
					$key = array_search($item, $cart_info);
					//echo "find qty of this item in cookie:", $cart_info[$key]["qty"];
					//echo json_encode($entry_object['qty']);
					//echo "request qty:", $entry_object['qty'];
					$cart_info[$key]["qty"] = $entry_object['qty'];
					
					$update_cart_info = array();
					foreach ($cart_info as $subarray){
						$update_cart_info[] = $subarray;
					}
					setcookie("CART", json_encode($update_cart_info), time()+30000, "/", false);
					echo "json=".json_encode($update_cart_info);
					exit();
				} else {
					//Add item to COOKIE CART
					$cart_info[] = $entry_object;
					setcookie("CART", json_encode($cart_info), time()+30000, "/", false);
					echo "json=".json_encode($cart_info);
					exit();
				}
				
			 }	
			 
		}
	}
}





function searchSubArray(Array $array, $key, $value) {   
    foreach ($array as $subarray){  
        if (isset($subarray[$key]) && $subarray[$key] == $value)
          return $subarray;       
    } 
}
?>