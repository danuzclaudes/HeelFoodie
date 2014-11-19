<?php
require_once('model.php');

//session_start();

// session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Address Input</title>
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
<link href="./css/address_input.css" rel="stylesheet">
<script src="./js/address_input.js"></script>

<!--
	Place Your Scripts or CSS links below:

<script>
    console.log(<?php echo json_encode($_SESSION, JSON_HEX_TAG); ?>);
</script>
-->

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


    <div id="Addr_display" style="position: relative; left: 100px; margin-bottom: 50px;">
        <div id="Error_Message1"></div>
        <div class="address-title">
            <h2>Address</h2>
        </div>
        <form role="form" action="address_confirm.php" method="post">
            <div class="form-group long_textinput">
                <input type="text" class="form-control" id = "Addr_l1" name = "Addr_l1" placeholder="＊Address line 1" required>
            </div>
            <div class="form-group long_textinput">
                <input type="text" class="form-control" name = "Addr_l2" placeholder="Address line 2" >
            </div>
            <div class="form_inline long_textinput">
                <div class="form-group inline_display" style = "width : 33%">
                    <input type="text" class="form-control"  id = "Addr_city" name = "Addr_city" placeholder="City">
                </div>
                <div class="form-group inline_display" style = "width : 32%" >
                    <select class="form-control" id = "Addr_sta" name = "Addr_sta" style = "float: left">
                        <option value="Alabama">AL</option>
                        <option value="Alaska">AK</option>
                        <option value="Arizona">AZ</option>
                        <option value="Arkansas">AR</option>
                        <option value="California">CA</option>
                        <option value="Colorado">CO</option>
                        <option value="Connecticut">CT</option>
                        <option value="Delaware">DE</option>
                        <option value="Florida">FL</option>
                        <option value="Georgia">GA</option>
                        <option value="Hawaii">HI</option>
                        <option value="Idaho">ID</option>
                        <option value="Illinois">IL</option>
                        <option value="Indiana">IN</option>
                        <option value="Iowa">IA</option>
                        <option value="Kansas">KS</option>
                        <option value="Kentucky">KY</option>
                        <option value="Louisiana">LA</option>
                        <option value="Maine">ME</option>
                        <option value="Maryland">MD</option>
                        <option value="Massachusetts">MA</option>
                        <option value="Minnesota">MN</option>
                        <option value="Mississippi">MS</option>
                        <option value="Missouri">MO</option>
                        <option value="Montana">MT</option>
                        <option value="Nebraska">NE</option>
                        <option value="Nevada">NV</option>
                        <option value="New hampshire">NH</option>
                        <option value="New jersey">NJ</option>
                        <option value="New mexico">NM</option>
                        <option value="New York">NY</option>
                        <option value="North Carolina">NC</option>
                        <option value="North Dakota">ND</option>
                        <option value="Ohio">OH</option>
                        <option value="Oklahoma">OK</option>
                        <option value="Oregon">OR</option>
                        <option value="Pennsylvania">PA</option>
                        <option value="Rhode island">RI</option>
                        <option value="South carolina">SC</option>
                        <option value="South dakota">SD</option>
                        <option value="Tennessee">TN</option>
                        <option value="Texas">TX</option>
                        <option value="Utah">UT</option>
                        <option value="Vermont">VT</option>
                        <option value="Virginia">VA</option>
                        <option value="Washington">WV</option>
                        <option value="West Virginia">WV</option>
                        <option value="Wisconsin">WI</option>
                        <option value="Wyoming">WY</option>
                    </select>
                </div>
                <div class="form-group inline_display" style = "width : 32% ">
                    <input type="text" class="form-control" id = "Addr_zip" name="Addr_zip" placeholder="Zip Cpde" required>
                </div> 
            </div>
            
            <div style="clear:left">
                <h2>Contact Information</h2>
            </div>
            <div id="Error_Message2"></div>
            <div>
                <div class="form-group inline_display" style = "width : 10%" >
                    <input type="text" class="form-control" name= "firstn" placeholder="First Name" >
                </div>
                <div class="form-group inline_display" style = "width : 10%">
                    <input type="text" class="form-control" name="midn" placeholder="Middle Name" >
                </div>
                <div class="form-group inline_display" style = "width : 10%">
                    <input type="text" class="form-control" name="lastn" placeholder="Last Name" >
                </div>
                <div class="form-group inline_display"  style = "width : 8.5%">
                    <select class="form-control" name="title" >
                        <option value="Mrs">Mrs</option>
                        <option value="Mr">Mr</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
            </div>
            <div class="form-group  long_textinput" style = "clear:left">
                <input type="text" class="form-control" id="phone1" name="phone1" id="phone1" placeholder="＊Phone1" required>
             </div>
            <div class="form-group long_textinput">
                <input type="text" class="form-control" name="phone2" id="phone2" placeholder="Phone2" >
            </div>   
            <button type="submit" class="btn btn-default" id="nextstep" >Next Step</button>
        </form>
    </div>
    
    
    

   
   
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
</body>
</html>