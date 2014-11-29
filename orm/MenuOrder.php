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