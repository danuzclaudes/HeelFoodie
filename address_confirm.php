<?php
// require_once('model.php');

session_start();

if ( $_POST ) {
    if(isset($_POST["Addr_l1"])) {$addr_l1 = $_POST["Addr_l1"];}
    if(isset($_POST["Phone1"])) $addr_l2 = $_POST["Phone1"];

    $address = array();
    $address[] = array( 'Addr_l1' => $_POST["Addr_l1"],
                        'Phone1' => $_POST["Phone1"]  );

    setcookie("ADDRESS", json_encode($address), time()+3600, false);
} elseif( !isset($_COOKIE["ADDRESS"]) && !isset($_COOKIE["CART"]) ) {
    // header("Location: ./index.html");
    if ( isset($_COOKIE["ORDER"]) ) {
        header( "Refresh:2; url=./order_track.php", true, 303);
    } else {
        header( "Refresh:2; url=./address_input.php", true, 303);
    }
    print("Please don't access this page directly.");
    exit("Autodirecting to homepage...");
}

// print_r($cart_lists);
// foreach ($cart_lists as $key => $cart) {
//     print '\\n';
//     echo $cart["oid"];
// }

// session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Template</title>
<!-- Bootstrap Core CSS -->
<!-- Note the path of href-->
<link href="./css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<!-- Template CSS -->
<link rel="stylesheet" type="text/css" href="./css/template.css">
<!-- jQuery -->
<!-- Note the path of src.-->
<script src="./js/jquery-1.11.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!--
	Place Your Scripts or CSS links below:
-->
<link href="./css/address_section.css" rel="stylesheet">
<script>
    console.log(<?php echo json_encode($_COOKIE, JSON_HEX_TAG); ?>);
</script>
<script src="./js/editAddress.js"></script>

</head>
<body>
<div class="main-container">
    <!-- Header -->
    <header id="main-header" class="navbar navbar-custom navbar-fixed-top">
        <div class="logo">
            <a class="navbar-brand" href="index.php"><img src="./img/logo_footer.png" alt=""></a>
        </div>
	    <h1>HeelFoodie</h1>
    	<div class="header-account">
          <a class="link" href="#">LOGIN</a>
          / <a class="link" href="#">REGISTER</a>
        </div>
    </header>
    <!-- Place Your HTML Here: -->
    <div id="wrapper" class="wrapper">
        <div class="address-items">
            <div class="address-title" style = "display: inline-block; width: 50%">
                <h3 >Address</h3>
            </div>            
            <div class="control-panel" style = "display: inline-block">
                <button id="edit-addr" type="button" class="btn btn-info" style = "display: inline-block">Edit Delivery Address</button>
            </div>

            <div id="Addr_display">    
                <!-- <table class="table table-striped">Your address:  -->
                <?php 
                    if ( $_POST == null && isset($_COOKIE["CART"]) ){
                        echo '<table class="table table-hover no-address"><tr>';
                        echo '<td>No address information yet. Please input your delivery address.</td>';
                        echo '</tr></table>';
                       // print_r($_POST);
                       // print_r($_SESSION);
                    } elseif ( $_POST != null ) {
                        echo '<table data-table="address" class="table table-hover" style="padding-left: 15px">';
                        echo '<tr>';
                        echo '<td class="Addr_l1">'.htmlspecialchars($addr_l1).'</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="Phone1">'.htmlspecialchars($addr_l2).'</td>';
                        echo '</tr>';
                        echo '</table>';
                    }
                       
                ?>
            </div>
        </div>
        <div class="menu-items">
            <div style = "display: inline-block; width: 50%">
                <h3 >Order Detail</h3>
            </div>
            <div style = "display: inline-block">
               <a href="shoppingCart.php"><button type="button" class="btn btn-warning" style="display: inline-block">Return to Cart</button></a>
            </div>
            <?php
                if ( isset($_COOKIE["CART"]) ) {
                     $cookie = $_COOKIE["CART"];
                     $cookie = stripslashes($cookie);
                     $cart_lists = json_decode($cookie,true);
                     // echo '<pre>'; print_r($cart_lists); echo '</pre>'
            ?>
            <div id="Cart-display" style = "display: inline-block; width: 80%">
            <table data-table="cart" class="table table-hover" style = "padding-left: 15px">
                <tr>
                    <th>Entry</th>
                    <th>Restaurant</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
                <?php
                    foreach ($cart_lists as $key => $cart) {
                        print "<tr>";
                        echo '<td>'.htmlspecialchars($cart["mid"]).'</td>';
                        echo '<td></td>';
                        echo '<td>'.htmlspecialchars($cart["qty"]).'</td>';
                        // echo '<td>'.htmlspecialchars($cart["price"]).'</td>';
                        echo '<td></td>';
                        echo "</tr>";
                    }

                ?>
                
                <tr>
                    <td>Crab Rangoon</td>
                    <td>Asia Cafe</td>
                    <td></td>
                    <td>$ 4.95</td>
                    <td>14.85</td>
                </tr>
                <tr>
                    <td>Orange Chicken</td>
                    <td>Asia Cafe</td>
                    <td>5</td>
                    <td>$ 8.95</td>
                    <td>44.75</td>
                </tr>
                <tr>
                    <td>Beef with Broccoli</td>
                    <td>Asia Cafe</td>
                    <td>1</td>
                    <td>$ 9.25</td>
                    <td>9.25</td>
                </tr>
            </table>
            </div>
            <?php } ?>
            <button id="place-order" style="display: inline-block" class="btn btn-danger" 
                    type="button" data-loading-text="Loading..." autocomplete="off">Place Your Order
            </button>
            <?php
                if( $_POST != null && !isset($_COOKIE["CART"]) ) { 
                    echo '<div class="empty-cart">You have not selected any products yet. Please return to the shopping cart!</div>';
                } 
                // elseif ( $_POST != null && isset($_SESSION["CART"]) ) {
                //     echo '<script src="./js/checkout.js"></script>';
                // }
            ?>
            <div id="msg"></div>
        </div>
    </div>

	
    <!-- Place Your HTML Above. -->
   
    <!-- Services -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="logo-footer">
                        <a class="logo-footer" href="index.php"><img src="./img/logo_footer.png" alt=""></a>
                </div>
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-compass fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Nearby Restaurants</strong>
                                </h4>
                                <p>You can find restaurants near to you.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-picture-o fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Food with Pictures</strong>
                                </h4>
                                <p>We provide detailed pictures of food from restaurants.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-comments-o fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Rate and Review</strong>
                                </h4>
                                <p>Real rating and comments from UNC students and faculty.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-ticket fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Special and coupon</strong>
                                </h4>
                                <p>And great opportunity for coupons.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
	<!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>HeelFoodie - RTP Food Order Service</strong>
                    </h4>
                    <p>University of North Carolina</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:name@example.com">name@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook-square fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter-square fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-github-square fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright © HeelFoodie 2014</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="./js/checkout.js"></script>
</body>
</html>
