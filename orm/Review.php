<?php
date_default_timezone_set('America/New_York');

class Review
{ 
  private $food_review_id;
  private $menu_id;
  private $customer_id;
  private $rating;
  private $comment;
  private $email;
  private $reviewimage;

  public static function create_customer($customer_id, $username, $password, $regi_date, $firstname, $lastname, $middlename, 
                                $email, $cellphone1, $cellphone2, $address, $city, $state) {
    $mysqli = new mysqli("localhost", "root", "4023", "test");

    if ($regi_date == null) {
      $dstr = "null";
    } else {
      $dstr = "'" . $due_date->format('Y-m-d') . "'";
    }

    $result = $mysqli->query("insert into a6_Customer values (0, " .
           "'" . $mysqli->real_escape_string($menu_id) . "', " .
           "'" . $mysqli->real_escape_string($customer_id) . "', " .
           "'" . $mysqli->real_escape_string($regi_date) . "', " .
           "'" . $mysqli->real_escape_string($rating) . "', " .
           "'" . $mysqli->real_escape_string($comment) . "', " .
           "'" . $mysqli->real_escape_string($reviewimage) . "', " 
           );
    
    if ($result) {
      $food_review_id = $mysqli->insert_id;
      return new Customer($food_review_id, $menu_id, $customer_id, $rating, $comment, $email, $reviewimage);
    }
    return null;
  }

  public static function findByID($food_review_id) {
    $mysqli = new mysqli("localhost", "root", "4023", "test");

    $result = $mysqli->query("select * from a6_Food_Review where food_review_id = " . $food_review_id);
    if ($result) {
      if ($result->num_rows == 0) {
        return null;
      }

      $review_info = $result->fetch_array();
      return new Review (intval($review_info['food_review_id']),$review_info['menu_id'],$review_info['customer_id'],
		      $review_info['rating'],$review_info['comment'],$review_info['email'],$review_info['reviewimage']);
    }
    return null;
  }

  public static function get_all_review_by_menu_ids($menu_id) {
    $mysqli = new mysqli("localhost", "root", "4023", "test");

    $result = $mysqli->query("select food_review_id from a6_Food_Review where menu_id= " . $menu_id);
    $food_review_id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	      $food_review_id_array[] = intval($next_row['food_review_id']);
      }
    }
    return $food_review_id_array;
  }

  private function __construct($food_review_id, $menu_id, $customer_id, $rating, $comment, $email ,$reviewimage) {
      $this->food_review_id = $food_review_id;
      $this->menu_id = $menu_id; 
      $this->customer_id = $customer_id;
      $this->rating = $rating;
      $this->comment = $comment;
      $this->email = $email;
      $this->reviewimage = $reviewimage;
  }

  // public function setAddr($address) {
  //   $this->address = $address;
  //   return $this->update();
  // }

  // public function setCity($city) {
  //   $this->city = $city;
  //   return $this->update();
  // }

  // public function setState($state) {
  //   $this->state = $state;
  //   return $this->update();
  // }

  // public function setCellphone1($cellphone1) {
  //   $this->cellphone1 = $cellphone1;
  //   return $this->update();
  // }

  // public function setCellphone2($cellphone2) {
  //   $this->cellphone2 = $cellphone2;
  //   return $this->update();
  // }

  private function update() {
    $mysqli = new mysqli("localhost", "root", "4023", "test");

    $result = $mysqli->query("update a6_Food_Review set " .
			     "menu_id=" .
			     "'" . $mysqli->real_escape_string($this->menu_id) . "', " .
			     "customer_id=" .
			     "'" . $mysqli->real_escape_string($this->customer_id) . "', " .
           "rating=" .
           "'" . $mysqli->real_escape_string($this->rating) . "', " .
			     "comment=" .
           "'" . $mysqli->real_escape_string($this->comment) . "', " .
           "email=" .
           "'" . $mysqli->real_escape_string($this->email) . "', " .
           "reviewimage=" .
           "'" . $mysqli->real_escape_string($this->reviewimage) . "', " .
			     " where food_review_id =" . $this->food_review_id);
    
    return $result;
  }

  public function delete() {
    $mysqli = new mysqli("localhost", "root", "4023", "test");
    $mysqli->query("delete from a6_Food_Review where food_review_id = " . $this->food_review_id);
  }

  public function getJSON() {
    $json_obj = array('customer_id' => $this->customer_id,
		      'menu_id' => $this->menu_id,
		      'customer_id' => $this->customer_id,
		      'rating' => $rating,
		      'comment' => $comment,
          'email' => $this->email,
          'reviewimage' => $this->reviewimage);
    return json_encode($json_obj);
  }
}
