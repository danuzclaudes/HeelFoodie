<?php
session_start();
// After clicking the ordering button,
// Check if both Cookie of CART and ADDRESS exist ---> will display the Order Tracking Page
// the js part ensures that POSTED address line will not be empty
if ( isset($_COOKIE["CART"]) && isset($_COOKIE["ADDRESS"]) ) {
	// if response is html or php file, no header is required
  $address = stripslashes($_COOKIE["ADDRESS"]);
  $cart = stripslashes($_COOKIE["CART"]);
  $address_lists = json_decode($address, true);
  $cart_lists = json_decode($cart, true);

  $oid = "OID110321";
  // should produce a random number for order

  // just placed an order
  if ( isset($_POST["JUST_PLACED"]) && $_POST["JUST_PLACED"] ) {
    // if just placed order, clear all cart cookies
    setcookie("CART",'a', time()-2592000, "/HeelFoodie", false);
    setcookie("ADDRESS",'b', time()-2592000, "/HeelFoodie", false);
    // set COOKIE for ORDER? OID?
    setcookie("ORDER", json_encode($oid), time() + 86400, "/HeelFoodie", false);

    // insert into database here:



  } else {
    echo "redirecting to order page...";
    header( "Refresh:2; url=./order_user.php", true, 303);
    exit();
  }



  
} elseif ( !isset($_COOKIE["CART"]) && !isset($_COOKIE["ADDRESS"]) ) {
  // scenario 1: no cart, no address, login landing from my-account page ---> display history order info?
  // scenario 2: no cart, no address, (unlogin/login user) just placed an order ---> redirect to order_track page
  // scenario 3: no cart, no address, (unlogin) no order in cookie ---> order expired
  
  // if ( isset($_COOKIE["USER"]) ) {
  //   // if landing from my-account page, not clear
  //   echo "display all my previous orders.";
  //   // query database here:

  //   exit();
  // } 
  if ( isset($_COOKIE["ORDER"]) ) {
    header( "Refresh:2; url=./order_track.php", true, 303);
    exit();

  } elseif( !isset($_COOKIE["ORDER"]) ) {
    print "You order is expired! If you want to keep all your orders information, please login or register!"

  ?>
  <html>
  <head>
    <title>Orders Expired</title>
  </head>
  <body>
    <h1>You order is expired!</h3>
    <h3>If you want to keep all your orders information, please login or register!"</h3>
    <h3><a href="index.php">return home</a></h3>
  </body>
  </html>

  <?php  
  }
  // if ( !isset($_COOKIE["USER"]) && !isset($_COOKIE["ORDER"]) ) {
  //   header( "Refresh:2; url=./index.php", true, 303);
  //   echo "No order information here";
  // }


} elseif ( !isset($_COOKIE["ADDRESS"]) ) {
	header("HTTP/1.1 426 Address Information Cannot Be Blank!");
  print "Address Information Cannot Be Blank!";
  if( !isset($_POST["JUST_PLACED"]) ) {
    header( "Location: ./address_confirm.php");
  }
	exit();
} elseif ( !isset($_COOKIE["CART"]) ) {
  header("HTTP/1.1 426 Shopping Cart Cannot Be Empty!");
  print "You have not selected any products!";
  if( !isset($_POST["JUST_PLACED"]) ) {
    header( "Location: ./address_confirm.php");
  }
  exit();
} 

?>