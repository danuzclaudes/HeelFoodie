<?php
date_default_timezone_set('America/New_York');

class Customer
{ 
  private $customer_id;
  private $username;
  private $password;
  private $regi_date;
  private $firstname;
  private $lastname;
  private $middlename;
  private $email;
  private $cellphone1;
  private $cellphone2;
  private $addr_l1;
  private $addr_l2;
  private $city;
  private $state;
  private $zipcode;

  public static function create_customer($customer_id, $username, $password, $regi_date, $firstname, $lastname, $middlename, 
                                $email, $cellphone1, $cellphone2, $addr_l1, $addr_l2, $city, $state, $zipcode) {
    $mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");

    if ($regi_date == null) {
      $dstr = "null";
    } else {
      $dstr = "'" . $due_date->format('Y-m-d') . "'";
    }

    $result = $mysqli->query("insert into a6_Customer values (0, " .
			     "'" . $mysqli->real_escape_string($username) . "', " .
			     "'" . $mysqli->real_escape_string($password) . "', " .
			     "'" . $mysqli->real_escape_string($regi_date) . "', " .
           "'" . $mysqli->real_escape_string($firstname) . "', " .
           "'" . $mysqli->real_escape_string($lastname) . "', " .
           "'" . $mysqli->real_escape_string($middlename) . "', " .
           "'" . $mysqli->real_escape_string($email) . "', " .
           "'" . $mysqli->real_escape_string($cellphone1) . "', " .
           "'" . $mysqli->real_escape_string($cellphone2) . "', " .
           "'" . $mysqli->real_escape_string($addr_l1) . "', " .
           "'" . $mysqli->real_escape_string($addr_l2) . "', " .
           "'" . $mysqli->real_escape_string($city) . "', " .
           "'" . $mysqli->real_escape_string($state) . "', " .
           "'" . $mysqli->real_escape_string($zipcode) . "', " 
           );
    
    if ($result) {
      $customer_id = $mysqli->insert_id;
      return new Customer($customer_id, $username, $password, $regi_date, $firstname, $lastname, $middlename, 
                          $email, $cellphone1, $cellphone2, $addr_l1, $addr_l2, $city, $state, $zipcode);
    }
    return null;
  }

  public static function findByID($customer_id) {
    $mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");

    $result = $mysqli->query("select * from a6_Customer where customer_id = " . $customer_id);
    if ($result) {
      if ($result->num_rows == 0) {
	return null;
      }

      $customer_info = $result->fetch_array();
      return new Customer(intval($customer_info['customer_id']),$customer_info['username'],$customer_info['password'],
		      $customer_info['regi_date'],$customer_info['firstname'],$customer_info['lastname'],$customer_info['middlename'],
          $customer_info['email'],$customer_info['cellphone1'],$customer_info['cellphone2'], $customer_info['addr_l1'],
          $customer_info['addr_l2'], $customer_info['city'], $customer_info['state'],$customer_info['zipcode']
		     );
    }
    return null;
  }

  public static function getAllIDs() {
    $mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");

    $result = $mysqli->query("select customer_id from a6_Customer");
    $customer_id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	      $customer_id_array[] = intval($next_row['customer_id']);
      }
    }
    return $customer_id_array;
  }

  private function __construct($customer_id, $username, $password, $regi_date, $firstname, $lastname ,$middlename, 
                                $email, $cellphone1, $cellphone2, $addr_l1,$addr_l2, $city, $state,$zipcode) {
      $this->customer_id = $customer_id;
      $this->username = $username; 
      $this->password = $password;
      $this->regi_date = $regi_date;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->middlename = $middlename;
      $this->email = $email;
      $this->cellphone1 = $cellphone1;
      $this->cellphone2 = $cellphone2;
      $this->addr_l1 = $addr_l1;
      $this->addr_l2 = $addr_l2;
      $this->city = $city;
      $this->state = $state;
      $this->zipcode = $zipcode;
  }

  public function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this->update();
  }

  public function setMiddlename($lastname) {
    $this->lastname = $lastname;
    return $this->update();
  }

  public function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this->update();
  }

  public function setCellphone1($cellphone1) {
    $this->cellphone1 = $cellphone1;
    return $this->update();
  }

  public function setCellphone2($cellphone2) {
    $this->cellphone2 = $cellphone2;
    return $this->update();
  }

  public function setAddr_l1($addr_l1) {
    $this->addr_l1 = $addr_l1;
    return $this->update();
  }

  public function setAddr_l2($addr_l2) {
    $this->addr_l2 = $addr_l2;
    return $this->update();
  }

  public function setCity($city) {
    $this->city = $city;
    return $this->update();
  }

  public function setState($state) {
    $this->state = $state;
    return $this->update();
  }

  public function setZipcode($zipcode) {
    $this->zipcode = $zipcode;
    return $this->update();
  }

  

  private function update() {
    $mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");
    // if ($this->regi_date == null) {
    //   $rstr = "null";
    // } else {
    //   $rstr = "'" . $this->regi_date->format('Y-m-d') . "'";
    // }
    $query1 = "update a6_Customer set " .
        //   "username=" .
        //    "'" . $mysqli->real_escape_string($this->username) . "', " .
           // "password=" .
           // "'" . $mysqli->real_escape_string($this->password) . "', " .
        //    "regi_date=" .
        //    "'" . $mysqli->real_escape_string($this->regi_date) . "', " .
           "firstname=" .
           "'" . $mysqli->real_escape_string($this->firstname) . "', " .
        //    "lastname=" .
        //    "'" . $mysqli->real_escape_string($this->lastname) . "', " .
           // "middlename=" .
        //    "'" . $mysqli->real_escape_string($this->middlename) . "', " .
        //    "email=" .
        //    "'" . $mysqli->real_escape_string($this->email) . "', " .
        //    "cellphone1=" .
        //    "'" . $mysqli->real_escape_string($this->cellphone1) . "', " .
        //    "cellphone2=" .
        //    "'" . $mysqli->real_escape_string($this->cellphone2) . "', " .
        //    "addr_l1=" .
        //    "'" . $mysqli->real_escape_string($this->addr_l1) . "', " .
        //    "addr_l2=" .
        //    "'" . $mysqli->real_escape_string($this->addr_l2) . "', " .
        //    "city=" .
        //    "'" . $mysqli->real_escape_string($this->city) . "', " .
        //    "state=" .
        //    "'" . $mysqli->real_escape_string($this->state) . "', " .
        //    "zipcode=" .
        //    "'" . $mysqli->real_escape_string($this->zipcode) . "', " .
           " where customer_id= 1";
    $result = $mysqli->query($query1);
    // echo $query1;
    return $result;
  }

  public function delete() {
    $mysqli = new mysqli("localhost", "root", "4023", "wangyiqidb");
    $mysqli->query("delete from a6_Customer where customer_id = " . $this->customer_id);
  }

  public function getJSON() {
    // if ($this->regi_date == null) {
    //   $dstr = null;
    // } else {
    //   $dstr = $this->regi_date->format('Y-m-d');
    // }
     
    $json_obj = array('customer_id' => $this->customer_id,
		      'username' => $this->username,
		      'password' => $this->password,
		      'regi_date' => $this->regi_date,
		      'firstname' => $this->firstname,
		      'lastname' => $this->lastname,
		      'middlename' => $this->middlename,
          'email' => $this->email,
          'cellphone1' => $this->cellphone1,
          'cellphone2'  => $this->cellphone2,
          'addr_l1' => $this->addr_l1,
          'addr_l2' => $this->addr_l2,
          'city' => $this->city,
          'state' => $this->state,
          'zipcode' => $this->zipcode);
    return json_encode($json_obj);
  }
}
