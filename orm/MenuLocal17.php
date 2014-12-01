<?php

//ORM: Menu
class Menu {
	private $menu_id;
	private $food_id;
	private $restaurant_id;
	private $item_image;
	private $item_thumb_image;
	private $price;
	private $is_recommended; 
	
	public static function create($menu_id, $food_id, $restaurant_id, $item_image, $item_thumb_image, $price, $is_recommended) {
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");

	}

	public static function findByID($mid) {
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");

		$result = $mysqli -> query("select * from a6_Menu where menu_id = " . $mid);
		if ($result) {
			if ($result -> num_rows == 0) {
				return null;
			}

			$menu_info = $result -> fetch_array();

			return new Menu(intval($menu_info['menu_id']), $menu_info['food_id'], $menu_info['restaurant_id'], $menu_info['item_image'], $menu_info['item_thumb_image'], 
			$menu_info['price'], intval($menu_info['is_recommended']));
		}
		return null;
	}
	
	public static function findFoodEntryByID($mid) {
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");

		$result = $mysqli -> query("select M.menu_id, M.item_thumb_image, F.food_name, M.price, ROUND(AVG(R.rating), 0) AS rating from a6_Menu M INNER JOIN a6_Food F ON M.food_id = F.food_id INNER JOIN a6_Food_Review R ON M.menu_id = R.menu_id where M.menu_id = " . $mid);
		if ($result) {
			if ($result -> num_rows == 0) {
				return null;
			}

			$food_info = $result -> fetch_array();
			
			$food = array('menu_id' => $food_info['menu_id'], 'item_thumb_image' => $food_info['item_thumb_image'], 'food_name' => $food_info['food_name'], 'price' => $food_info['price'], 'rating' => $food_info['rating']);
			return $food;
			//return new Menu(intval($food_info['menu_id']), $menu_info['food_id'], $menu_info['restaurant_id'], $menu_info['item_image'], $menu_info['item_thumb_image'], 
			//$menu_info['price'], intval($menu_info['is_recommended']));
		}
		return null;
	}

	public static function getAllIDsByRestID($rest_id) {
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");

		$result = $mysqli -> query("select menu_id from a6_Menu where restaurant_id = " . $rest_id);
		$mid_array = array();

		if ($result) {
			while ($next_row = $result -> fetch_array()) {
				$mid_array[] = intval($next_row['menu_id']);
			}
		}
		return $mid_array;
	}

	private function __construct($menu_id, $food_id, $restaurant_id, $item_image, $item_thumb_image, $price, $is_recommended) {
		$this -> menu_id = $menu_id;
		$this -> food_id = $food_id;
		$this -> restaurant_id = $restaurant_id;
		$this -> item_image = $item_image;
		$this -> item_thumb_image = $item_thumb_image;
		$this -> price = $price;
		$this -> is_recommended = $is_recommended;
	}

	public function getMenuID() {
		return $this -> menu_id;
	}

	public function getFoodID() {
		return $this -> food_id;
	}

	public function getRestID() {
		return $this -> restaurant_id;
	}

	public function getImg() {
		return $this -> item_image;
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
		$json_obj = array('menu_id' => $this -> menu_id, 'item_thumb_image' => $this -> item_thumb_image, 'price' => $this -> price, 'food_name' => $this -> food_name, 'rating' => $this -> rating);
		
		return json_encode($json_obj);
	}

}
