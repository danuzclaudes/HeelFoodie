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
<!--
	Place Your Scripts or CSS links below:
-->
<link href="./css/address_section.css" rel="stylesheet">

</head>
<body>
<div class="main-container">
    <!-- Header -->
    <header id="main-header" class="navbar navbar-custom navbar-fixed-top">
        <div class="logo">
            <a class="navbar-brand" href="#"><img src="./img/logo_footer.png" alt=""></a>
        </div>
	    <h1>HeelFoodie</h1>
    	<div class="header-account">
          <a class="link" href="#">LOGIN</a>
          / <a class="link" href="#">REGISTER</a>
        </div>
    </header>
    <!-- Place Your HTML Here: -->
    <div style = "position: relative; left:100px; margin-bottom: 50px;">
        <div>
            <div style = "display: inline-block; width: 50%">
                <h3 >Address</h3>
                <hr>
            </div>            
            <div style = "display: inline-block">
                <button type="button" class="btn btn-default" style = "display: inline-block">Edit</button>
            </div>

            <div id="Addr_display">    
                 <?php 
                echo $_POST["firstn"]." ".$_POST["lastn"]."</p>";
                echo $_POST["phone1"]."</p>";
                echo $_POST["Addr_l1"]."<br>".$_POST["Addr_l2"]."<br>";
                echo $_POST["Addr_city"]." ,".$_POST["Addr_sta"]." ,".$_POST["Addr_zip"]."</p>";
                ?>
            </div>
        </div>
        <div>
            <div style = "display: inline-block; width: 50%">
                <h3 >Order Detail</h3>
            </div>
            <div style = "display: inline-block">
                <button type="button" class="btn btn-default" style = "display: inline-block">Edit</button>
            </div>
            <div style = "display: inline-block; width: 50%">
            <table class="table" style = "padding-left: 15px">
                <tr>
                    <th>Entry</th>
                    <th>Restaurant</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
                <tr>
                    <td>Crab Rangoon</td>
                    <td>Asia Cafe</td>
                    <td>3</td>
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
        </div>
    </div>

	
    <!-- Place Your HTML Above. -->
   
    <!-- Services -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="logo-footer">
                        <a class="logo-footer" href="#"><img src="./img/logo_footer.png" alt=""></a>
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
