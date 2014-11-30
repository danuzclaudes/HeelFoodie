<?php
date_default_timezone_set('America/New_York');

class Order {
  private $oid;
  private $cid;
  private $ophone;
  private $oaddress;
  private $odate;

  private function __construct($oid, $cid, $ophone, $oaddress, $odate) {
    $this->oid = $oid;
    $this->cid = $cid;
    $this->ophone = $ophone;
    $this->oaddress = $oaddress;
    $this->odate = $odate;
  }

  public static function createOrder ($oid, $cid, $ophone, $oaddress, $odate) {
    $mysqli = new mysqli("localhost", "root", "333666", "heelfoodie");
    
    // validation
    if ($odate == null) {
      $odate = date('Y-m-d');
    } else {
      $odate = "'".$odate->format("Y-m-d")."'";
    }

    if ($oid == null) {
      $oid = date("YmdHisu", time());
    }
    $result = $mysqli->query("insert into a6_Order values (".
                             $mysqli->real_escape_string($oid).",".
                             "'".$mysqli->real_escape_string($cid)."',".
                             "'".$mysqli->real_escape_string($ophone)."',".
                             "'".$mysqli->real_escape_string($oaddress)."',".
                             $odate.");"
                             );
    echo 'sql='."insert into a6_Order values (".
                             $mysqli->real_escape_string($oid).",".
                             "'".$mysqli->real_escape_string($cid)."',".
                             "'".$mysqli->real_escape_string($ophone)."',".
                             "'".$mysqli->real_escape_string($oaddress)."',".
                             $odate.");";
    if($result) {
      $id = $mysqli->insert_id;
      $order = array( 
                    'oid' => $oid,
                    'cid' => intval($cid),
                    'ophone' => $ophone,
                    'oaddress' => $oaddress,
                    'odate' => $odate
                    );
      return $order;
    }
    return null;
  }

}

?>