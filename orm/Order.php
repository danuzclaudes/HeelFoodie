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

  public static function getAllIDs() {

  }

  public static function getOrderInfoByOrderID($order){
    $mysqli = new mysqli("localhost", "root", "333666", "heelfoodie");

    $result = $mysqli->query("select o.order_id, o.customer_id, o.order_phone, o.order_date,".
                             "o.order_address, mo.menu_id, mo.quantity, mo.status,".
                             "m.price, f.food_name".
                             "FROM a6_order AS o, a6_menu_order as mo, a6_menu as m, a6_food as f".
                             "WHERE o.order_id = mo.order_id and mo.menu_id = m.menu_id and".
                             "m.food_id = f.food_id.".
                             ".and o.order_id = ".$order);
    
    echo 'sql='."select o.order_id, o.customer_id, o.order_phone, o.order_date,".
                             "o.order_address, mo.menu_id, mo.quantity, mo.status,".
                             "m.price, f.food_name".
                             "FROM a6_order AS o, a6_menu_order as mo, a6_menu as m, a6_food as f".
                             "WHERE o.order_id = mo.order_id and mo.menu_id = m.menu_id and".
                             "m.food_id = f.food_id.".
                             ".and o.order_id = ".$order;

    if ($result) {
      if ($result->num_rows == 0){
          return null;
      }

      $return_list = array();

      // $order_info = $result->fetch_array();
      while ( $new_row = $result->fetch_array() ){
          if ($new_row['order_date']) {
            $order_date = new DateTime($new_row['order_date']);
          } else {
            $order_date = null;
          }
          $order_track = array( 'oid' => $new_row['order_id'],
                                'cid' => $new_row['customer_id'],
                                'ophone' => $new_row['order_phone'],
                                'odate' => $order_date,
                                'oaddress' => $new_row['order_address'],
                                'mid' => intval($new_row['menu_id']),
                                'qty' => intval($new_row['quantity']),
                                'status' => $new_row['quantity'],
                                'price' => floatval($new_rwo['price']),
                                'fname' => $new_row['food_name'] );
          $return_list[] = $order_track;
      }
      return $return_list;
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