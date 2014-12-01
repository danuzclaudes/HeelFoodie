<?php
date_default_timezone_set('America/New_York');

class Restaurant {
	private $rid;
	private $rname;
	private $registerDate;
	private $address;
	private $city;
	private $state;
	private $zipcode;
	private $phone;
	private $openHour;
	private $closedHour;
	private $min_order;
	private $delivery_fee;
	private $latitude;
	private $longitude;
	private $logo;

	private function __construct($rid, $rname, $registerDate, $address, $city, $state, $zipcode,
								 $phone, $openHour, $closedHour, $min_order, $delivery_fee,
								 $latitude, $longitude, $logo) {
		$this->rid = $rid;
		$this->rname = $rname;
		$this->registerDate = $registerDate;
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->zipcode = $zipcode;
		$this->phone = $phone;
		$this->openHour = $openHour;
		$this->closedHour = $closedHour;
		$this->min_order = $min_order;
		$this->delivery_fee = $delivery_fee;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->logo = $logo;
	}

	// private function __construct1($rid, $latitude, $longitude) {
	// 	$this->rid = $rid;
	// 	$this->latitude = $latitude;
	// 	$this->longitude = $longitude;
	// }

	public static function getAllRestaurants() {
		// echo "invocation success"; // for debugging
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");

		$result = $mysqli->query("select restaurant_id, latitude, longitude from a6_Restaurant");
		$return_list = array();
		if ($result) {
			if($result->num_rows == 0) {
				return null;
			}

			while ( $next_row = $result->fetch_array() ) {
				if( $next_row['restaurant_id'] ) {
					// php objects to store multiple private data ---> cannot be utilized by json_encode
					// $restaurant = new Restaurant ($next_row['restaurant_id'],
					// 							  "","","","","","","","","","","",
					// 							  $next_row['latitude'],
					// 							  $next_row['longitude'],"");
					// asscciative arrays
					$restaurant = array(
									'rid' => $next_row['restaurant_id'],
									'latitude' => $next_row['latitude'],
									'longitude' => $next_row['longitude']
								  );
					$return_list[] = $restaurant;

				}
				
			}

			return $return_list;
		}
		
		return null;
	}

	public static function findRestaurantByID($id) {
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");

		$result = $mysqli->query("select * from a6_Restaurant where restaurant_id = ".$id);
		if($result) {
			if($result->num_rows == 0) {
				echo "query not null but no rows returned";
				return null;
			}

			$row = $result->fetch_array();
			if( $row['regis_date'] ) {
				$registerDate = new DateTime ( $row['regis_date'] );
				// echo date_format($registerDate,"n/d/Y");
				// echo $registerDate->format("n/d/Y");
			} else {
				$registerDate = null;
			}
			// if( $row['open_hour'] ) {
			// 	$openHour = new DateTime ( $row['regis_date'] );
			// 	echo $registerDate;
			// } else {
			// 	$registerDate = null;
			// }

			return new Restaurant(intval($row['restaurant_id']),
								  $row['restaurant_name'],
								  $registerDate,
								  // date_format($registerDate,"n/d/Y"),
								  $row['address'],
								  $row['city'],
								  $row['state'],
								  $row['zipcode'],
								  $row['work_phone'],
								  $row['open_hour'],   // require time type
								  $row['closed_hour'], // require time type
								  floatval($row['min_order']),   // require decimal
								  floatval($row['delivery_fee']), // require decimal
								  $row['latitude'],
								  $row['longitude'],
								  $row['logo']);
		}
		echo "find by id result is null";
		return null;
	}

	public function deleteRestaurant() {
		$mysqli = new mysqli("localhost", "root", "333666", "wangyiqidb");
		$mysqli->query('delete from a6_Restaurant where id='.$this->id);
	}

	public function getID() {
		return $this->rid;
	}

	public function getRegisterDate() {
		return $this->registerDate;
	}
}

?>