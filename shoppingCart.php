
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Resaurant</title>
<!-- Bootstrap Core CSS -->
<!-- Note the path of href-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<!-- Template CSS -->
<link rel="stylesheet" type="text/css" href="css/template.css">
<!-- jQuery -->
<!-- Note the path of src.-->
<script src="js/jquery-1.11.1.js"></script>
<!--
	Place Your Scripts or CSS links below:
-->

<link rel="stylesheet" type="text/css" href="css/cartReview.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/Restaurants.js"></script>
<script src="js/Menu.js"></script>
<script src="js/OrderList.js"></script>
<script src="js/order_entry.js"></script>
<!--Newly added js -->
<script src="js/cartViewer.js"></script>
<script src="js/Cart.js"></script>
<!--Newly added js -->
<script src="js/setup.js"></script>


</head>
<body>
<div class="main-container">
    <!-- Header -->
    <header id="main-header" class="navbar navbar-custom navbar-fixed-top">
        <div class="logo">
            <a class="navbar-brand" href="index.php"><img src="img/logo_footer.png" alt=""></a>
        </div>
	    <h1>HeelFoodie</h1>
    	<div class="header-account">
          <a class="link" href="#">LOGIN</a>
          / <a class="link" href="#">REGISTER</a>
        </div>
    </header>
    <!-- Place Your HTML Here: -->
	<div id="shopping-cart" class="container">
		<h2>My Cart</h2>
				<div id="shoppingcart-list" class="center-block">
					
					
						<ul id="food-list">
							<li class='food-entry-title'>
						<div class = "food">
						Entry
					</div>
					<div class = "qty">
						Quantity
					</div>
					<div class = "title-price price">
						Price
					</div>
					</li>
						</ul>
						<div id="total-price">
							<label class="totalPrice"></label>
						</div>
						<div id="order-option">
							<button type="button" id="place-order" class="btn btn-primary pull-right order-button">Place Order</button>
							<button type="button" id="continue-order" class="btn btn-primary pull-right order-button">Continue Ordering</button>
						</div>
					
				</div>
			</div>
    <!-- Place Your HTML Above. -->
   
    <!-- Services -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="logo-footer">
                        <a class="logo-footer" href="#"><img src="img/logo_footer.png" alt=""></a>
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
</body>
</html>
