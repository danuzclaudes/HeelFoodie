<?php

//ORM: Cart (seems no use)
class Cart {
	private $menu_id;
	private $food_name;
	private $qty;
	private $price;
	
	public static function getCartList($food) {
		if($food){
			$menu_id = intval($food.menu_id);
			$food_name = $food.food_name;
			$price = $food.price;
			$qty = intval($food.qty);
			return new Cart($menu_id, $food_name, $qty, $price);
		}
		else{
			return null;
		}	
	}
	
	private function __construct($menu_id, $food_name, $qty, $price) {
		$this -> menu_id = $menu_id;
		$this -> food_name = $food_name;
		$this -> price = $price;
		$this -> qty = $qty;
	}

	public function getMenuID() {
		return $this -> menu_id;
	}

	
	public function getThumbImg() {
		return $this -> item_thumb_image;
	}
	
	public function getPrice() {
		return $this -> price;
	}
	
	public function isRecommended() {
		return $this -> is_recommended;
	}
	
	public function setMenuID($menu_id) {
		$this -> menu_id = $menu_id;
		return $this -> update();
	}

	public function setFoodID($food_id) {
		$this -> food_id = $food_id;
		return $this -> update();
	}

	public function setRestID($restaurant_id) {
		$this -> restaurant_id = $restaurant_id;
		return $this -> update();
	}

	public function setImg($item_image) {
		$this -> item_image = $item_image;
		return $this -> update();
	}

	public function setThumbImg($item_thumb_image) {
		$this -> item_thumb_image = $item_thumb_image;
		return $this -> update();
	}

	public function setPrice($price) {
		$this -> price = $price;
		return $this -> update();
	}

	public function setRecommended($is_recommended) {
		$this -> is_recommended = $is_recommended;
		return $this -> update();
	}


	private function update() {
		$mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");

		// if ($this -> due_date == null) {
			// $dstr = "null";
		// } else {
			// $dstr = "'" . $this -> due_date -> format('Y-m-d') . "'";
		// }
// 
		// if ($this -> complete) {
			// $cstr = "1";
		// } else {
			// $cstr = "0";
		// }

		$result = $mysqli -> query("update Menu set " . "food_id=" . "'" . $mysqli -> $this -> food_id . "', " . "restaurant_id=" . "'" . $mysqli -> $this -> restaurant_id . "', " . "project=" . "'" . $mysqli -> real_escape_string($this -> project) . "', " . "due_date=" . $dstr . ", " . "priority=" . $this -> priority . ", " . "complete=" . $cstr . " where id=" . $this -> id);
		return $result;
	}

	public function delete() {
		$mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");
		$mysqli -> query("delete from a6_Menu where menu_id = " . $this -> menu_id);
	}

	public function getJSON() {
		// if ($this -> due_date == null) {
			// $dstr = null;
		// } else {
			// $dstr = $this -> due_date -> format('Y-m-d');
		// }
		$json_obj[] = array('menu_id' => $this -> menu_id, 'food_name' => $this -> food_name, 'qty' => $this -> qty, 'price' => $this -> price);
		return json_encode($json_obj);
		//return $json_obj;
	}

}
?>