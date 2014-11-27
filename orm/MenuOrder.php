<?php 
class MenuOrder {
	private mid;
	private oid;
	private qty;
	private status;

	private function __construct($mid, $oid, $qty, $status){
		$this->mid = $mid;
		$this->oid = $oid;
		$this->qty = $qty;
		$this->status = $status;
	}

	public static function createMenuOrder($mid, $oid, $qty, status){
		
	}
}

?>