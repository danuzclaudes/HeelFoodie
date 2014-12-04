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
      $order_date = date('Y-m-d');
    } else {
      $order_date = "'".$odate->format("Y-m-d")."'";
    }

    if ($oid == null) {
      $oid = date("YmdHisu", time());
    }

    $result = $mysqli->query("insert into a6_Order values (".
                             "'".$mysqli->real_escape_string($oid)."'".",".
                             "'".$mysqli->real_escape_string($cid)."',".
                             "'".$mysqli->real_escape_string($ophone)."',".
                             "'".$mysqli->real_escape_string($oaddress)."',".
                             $order_date.");"
                             );
    // echo 'sql='."insert into a6_Order values (".
    //                          $mysqli->real_escape_string($oid).",".
    //                          "'".$mysqli->real_escape_string($cid)."',".
    //                          "'".$mysqli->real_escape_string($ophone)."',".
    //                          "'".$mysqli->real_escape_string($oaddress)."',".
    //                          $odate.");";
    if($result) {
      $id = $mysqli->insert_id;
      $new_order = new Order($oid, $cid, $ophone, $oaddress, $odate);
      return $new_order;
    }
    return null;
  }

  public static function getOrderByID($oid) {
    $mysqli = new mysqli("localhost", "root", "333666", "heelfoodie");

    $result = $mysqli->query("select * from a6_Order where order_id = ".$oid);
    if($result){
      if($result->num_rows == 0) {
        return null;
      }
      $order_info = $result->fetch_array();
      if($order_info['order_date'] == null) {
        $order_date = null;
      } else {
        $order_date = new DateTime($order_info['order_date']);
      }
      return new Order($oid, 
                       intval($order_info['customer_id']),
                       $order_info['order_phone'],
                       $order_info['order_address'],
                       $order_date);

    }
    return null;
  }

  public function getJSON() {
    // $oid, $cid, $ophone, $oaddress, $odate
    // still needs to convert from PHP DateTime object to date string
    // should only store string instead of Date object
    if ($this->odate == null) {
      $mydate = null;
    } else {
      $mydate = $this->odate->format('Y-m-d');
    }

    $json_obj = array('oid' => $this->oid,
                      'cid' => $this->cid,
                      'ophone' => $this->ophone,
                      'oaddress' => $this->oaddress,
                      'odate' => $mydate );
    return json_encode($json_obj);
  }

  public function getOid() {
    return $this->oid;
  }

}

?>