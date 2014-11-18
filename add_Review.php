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

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<link href="./css/star_rating.css" media="all" rel="stylesheet" type="text/css">
<script src="./js/star_rating.js" type="text/javascript"></script>
<link href="./css/food_review.css" rel="stylesheet">


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

    
    <div id="content_display">
        <div id="food_inf">
            <h3 >Food description</h3>
            <div >
                <table class="table" style = "padding-left: 15px">
                    <tr>
                        <th>Food Picture</th>
                        <th>Food Name</th>
                        <th>Restaurant Name</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                    <?php 
                    echo '<td>'.$_POST["item_image"].'</td>';
                    echo '<td>'.$_POST["food_id"].'</td>';
                    echo '<td>'.$_POST["restaurant_id"].'</td>';
                    echo '<td>'.$_POST["price"].'</td>';
                    ?>
                    </tr>
                </table>
            </div>
        </div>
        <div id="review_inf">
            <h3 >Food Review</h3>
            <form role="form">
                <div class="form-group">
                    <label >Rating</label>
                    <input id="rating" type="number" class="rating" min="0" max="5" step="0.5" data-stars=5
            data-symbol="&#xe005;" data-default-caption="{rating} hearts" data-star-captions="{}" data-size="xs">
                </div>
                <div class="form-group">
                    <label >Title</label>
                    <input class="form-control"  placeholder="Title">
                </div>
                <div class="form-group">
                    <label >Content</label>
                    <!-- <input  class="form-control"  placeholder="Make your comment here..."> -->
                    <textarea class="form-control" rows="5" placeholder="Make your comment here..."></textarea>
                </div>
                <div class="form-group">
                    <label >Add photos</label>
                    <input type="file" id="exampleInputFile">
                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                </div>
                <div class="checkbox">
                    <label>
                    <input type="checkbox"> Anonymous
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
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
