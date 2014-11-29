<?php
// } else
if ( isset($_COOKIE["ORDER"]) ) {
    $order = strval($_COOKIE["ORDER"]);
} else {
    echo "bad";
}

?>
<html>
  <head>
    <title>Good</title>
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
      <div id="non-wrapper">outside of wrapper</div>
      
      <div id="wrapper">
        <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
            <span class="sr-only">25% Complete</span>
          </div>
        </div>
        <pre><span class="order-info-label">ORDER #</span> <span class="order-info-value"><?php echo $order;?></span></pre>
        <h3>...will retrieve database to track this order status...</h3>
        <div>
            <h3><a href="Restaurant_manage.html">Click to Restaurant-Side Management Page</a></h3>
        </div>
        <div>
            <h3><a href="My_MainPage.php">Click to "My Account" Page designed for login individual users</a></h3>
        </div>


      </div>
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
  </body>
</html> 
