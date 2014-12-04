<!-- @chongrui -->
<?php 
class MenuOrder {
	private $mid;
	private $oid;
	private $qty;
	private $status;

	private function __construct($mid, $oid, $qty, $status){
		$this->mid = $mid;
		$this->oid = $oid;
		$this->qty = $qty;
		$this->status = $status;
	}

	public static function createMenuOrder($mid, $oid, $qty, $status){
		$mysqli = new mysqli("localhost", "root", "333666", "heelfoodie");
		// validation 
		if ($oid == null) {
			$oid = date("YmdHisu", time());
		}

		$result = $mysqli->query('insert into a6_menu_order values ('.
								  "'".$mysqli->real_escape_string($mid)."'".','.
								  "'".$mysqli->real_escape_string($oid)."'".','.
								  "'".$mysqli->real_escape_string($qty)."'".','.
								  "'".$mysqli->real_escape_string($status)."'".
								')');
		// echo "sql=".'insert into a6_menu_order values ('.
		// 						  "'".$mysqli->real_escape_string($mid)."'".','.
		// 						  "'".$mysqli->real_escape_string($oid)."'".','.
		// 						  "'".$mysqli->real_escape_string($qty)."'".','.
		// 						  "'".$mysqli->real_escape_string($status)."'".
		// 						')';
	
		if ($result){
			$id = $mysqli->insert_id;
			// return $new_menu_order = array(
			// 							'mid' => $mid,
			// 							'oid' => $oid,
			// 							'qty' => $qty,
			// 							'status' => $status
			// 						  	);
			return new MenuOrder($mid, $oid, $qty, $status);
		}
		return null;
	}

	public static function getMenuFoodInfoByOrderID($order){
    $mysqli = new mysqli("localhost", "root", "333666", "heelfoodie");

	// SELECT mo.menu_id, mo.quantity, mo.status, m.price, f.food_name, m.item_thumb_image, r.avg_rating
	// FROM a6_menu_order as mo, a6_menu as m, a6_food as f,
	// 	 (SELECT r.menu_id, ROUND(avg(r.rating), 0) as avg_rating FROM heelfoodie.a6_food_review as r group by r.menu_id) as r
	// WHERE mo.menu_id = m.menu_id and m.food_id = f.food_id and m.menu_id = r.menu_id 
	// 	  and mo.order_id = '20141128201836000000'

    $result = $mysqli->query('select mo.menu_id, mo.quantity, mo.status, m.price, f.food_name, '.
							 'm.item_thumb_image, r.avg_rating '.
							 'FROM a6_menu_order as mo, a6_menu as m, a6_food as f, '.
							 ' (SELECT r.menu_id, ROUND(avg(r.rating), 0) as avg_rating FROM heelfoodie.a6_food_review as r group by r.menu_id) as r '.
							 'WHERE mo.menu_id = m.menu_id and m.food_id = f.food_id and m.menu_id = r.menu_id '.			   
							 'and mo.order_id = '."'".$order."'");
    
    // echo '</br>sql='.'select mo.menu_id, mo.quantity, mo.status, m.price, f.food_name, '.
				// 			 'm.item_thumb_image, r.avg_rating '.
				// 			 'FROM a6_menu_order as mo, a6_menu as m, a6_food as f, '.
				// 			 ' (SELECT r.menu_id, ROUND(avg(r.rating), 0) as avg_rating FROM heelfoodie.a6_food_review as r group by r.menu_id) as r '.
				// 			 'WHERE mo.menu_id = m.menu_id and m.food_id = f.food_id and m.menu_id = r.menu_id '.			   
				// 			 'and mo.order_id = '."'".$order."'".'</br>';

    if ($result) {
      if ($result->num_rows == 0){
          return null;
      }

      $return_list = array();

      // $order_info = $result->fetch_array();
      while ( $new_row = $result->fetch_array() ){
          
          $order_track = array( 'mid' => intval($new_row['menu_id']),
                                'qty' => intval($new_row['quantity']),
                                'status' => $new_row['status'],
                                'price' => floatval($new_row['price']),
                                'fname' => $new_row['food_name'],
                                'thumb_image' => $new_row['item_thumb_image'],
                                'rating' => intval($new_row['avg_rating']) );
          $return_list[] = $order_track;
      }
      return $return_list;
    }

    return null;

  }

	public function getJSON() {
		$json_obj = array('mid' => $this->mid,
						  'oid' => $this->oid,
						  'qty' => $this->qty,
						  'status' => $this->status
						 );
		return json_encode($json_obj);
	}

}

?>