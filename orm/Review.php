<?php
date_default_timezone_set('America/New_York');

class Review
{ 
  private $food_review_id;
  private $menu_id;
  private $customer_id;
  private $rating;
  private $comment;
  private $title;
  private $reviewimage;
  private $comment_date;


  public static function create_review($menu_id, $customer_id, 
    $rating, $comment, $title, $reviewimage, $comment_date) {
    $mysqli = new mysqli("classroom.cs.unc.edu", "wangyiqi", "333666", "wangyiqidb");

    if ($reviewimage == null) {
      $ristr = "null";
    }

    $dstr = "'" . gmdate('Y-m-d H:i:s') . "'";
    $sql_query = "insert into a6_Food_Review values (null,".
           "'" . $mysqli->real_escape_string($menu_id) . "', " .
           "'" . $mysqli->real_escape_string($customer_id) . "', " .
           "'" . $mysqli->real_escape_string($rating) . "', " .
           "'" . $mysqli->real_escape_string($comment) . "', " .
           "'" . $mysqli->real_escape_string($title) . "'," . $ristr . ", " . $dstr . ")" ;
    $result = $mysqli->query($sql_query);

    // $result = $mysqli->query("insert into a6_Food_Review values (null,".
    //        "'" . $mysqli->real_escape_string($menu_id) . "', " .
    //        "'" . $mysqli->real_escape_string($customer_id) . "', " .
    //        "'" . $mysqli->real_escape_string($rating) . "', " .
    //        "'" . $mysqli->real_escape_string($comment) . "', " .
    //        "'" . $mysqli->real_escape_string($title) . "'," . $ristr . ", " . $dstr . ")" 
    //        );
    if ($result) {
      $food_review_id = $mysqli->insert_id;
      return new Review($food_review_id, $menu_id, $customer_id, $rating, $comment, $title, $reviewimage, $comment_date);
    }
    return null;
  }

  public static function findByID($food_review_id) {
    $mysqli = new mysqli("classroom.cs.unc.edu", "wangyiqi", "333666", "wangyiqidb");

    $result = $mysqli->query("select * from a6_Food_Review where food_review_id = " . $food_review_id);
    if ($result) {
      if ($result->num_rows == 0) {
        return null;
      }

      $review_info = $result->fetch_array();
      return new Review (intval($review_info['food_review_id']),$review_info['menu_id'],$review_info['customer_id'],
		      $review_info['rating'],$review_info['comment'],$review_info['title'],$review_info['reviewimage'],$review_info['comment_date']);
    }
    return null;
  }

  public static function get_all_review_by_menu_ids($menu_id) {
    $mysqli = new mysqli("classroom.cs.unc.edu", "wangyiqi", "333666", "wangyiqidb");

    $result = $mysqli->query("select food_review_id from a6_Food_Review where menu_id= " . $menu_id);
    $food_review_id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	      $food_review_id_array[] = intval($next_row['food_review_id']);
      }
    }
    return $food_review_id_array;
  }

  private function __construct($food_review_id, $menu_id, $customer_id, $rating, $comment, $title ,$reviewimage, $comment_date) {
      $this->food_review_id = $food_review_id;
      $this->menu_id = $menu_id; 
      $this->customer_id = $customer_id;
      $this->rating = $rating;
      $this->comment = $comment;
      $this->title = $title;
      $this->reviewimage = $reviewimage;
      $this->comment_date = $comment_date;
  }

  private function update() {
    $mysqli = new mysqli("classroom.cs.unc.edu", "wangyiqi", "333666", "wangyiqidb");

    $result = $mysqli->query("update a6_Food_Review set " .
			     "menu_id=" .
			     "'" . $mysqli->real_escape_string($this->menu_id) . "', " .
			     "customer_id=" .
			     "'" . $mysqli->real_escape_string($this->customer_id) . "', " .
           "rating=" .
           "'" . $mysqli->real_escape_string($this->rating) . "', " .
			     "comment=" .
           "'" . $mysqli->real_escape_string($this->comment) . "', " .
           "title=" .
           "'" . $mysqli->real_escape_string($this->title) . "', " .
           "reviewimage=" .
           "'" . $mysqli->real_escape_string($this->reviewimage) . "', " .
           "comment_date=" .
           "'" . $mysqli->real_escape_string($this->comment_date) . "' " .
			     " where food_review_id =" . $this->food_review_id);
    
    return $result;
  }

  public function delete() {
    $mysqli = new mysqli("classroom.cs.unc.edu", "wangyiqi", "333666", "wangyiqidb");
    $mysqli->query("delete from a6_Food_Review where food_review_id = " . $this->food_review_id);
  }

  public function getJSON() {
    $json_obj = array('food_review_id' => $this->food_review_id,
		      'menu_id' => $this->menu_id,
		      'customer_id' => $this->customer_id,
		      'rating' => $this->rating,
		      'comment' => $this->comment,
          'title' => $this->title,
          'reviewimage' => $this->reviewimage,
          'comment_date' => $this->comment_date);
    return json_encode($json_obj);
  }
}
