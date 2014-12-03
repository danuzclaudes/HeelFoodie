
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>HeelFoodie - RTP Food Order Service</title>
<!-- Bootstrap Core CSS -->
<link href="./css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<!-- Template CSS -->
<link rel="stylesheet" type="text/css" href="./css/template.css">
<!-- jQuery -->
<script src="./js/jquery-1.11.1.js"></script>

<!-- Google Map API -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<!-- Google Map User CSS-->
<link rel="stylesheet" type="text/css" href="./css/gmap.css">
<!-- Data - will be replaced by JSON -->
<script src="./js/Restaurant.js" type="text/javascript"></script>
<script src="./js/Menu.js" type="text/javascript"></script>

<!-- Scripts for sending out request for restaurants -->

<script>
// Restaurants.all = [];
$.ajax("app.php/restaurant",
    {
        type: "GET",
        dataType: "json",
        success: function(json, status, jqXHR){
            for(var i = 0; i < json.length; i++) {
                var restaurant_obj = new Restaurant(json[i]);
                Restaurant.all.push(restaurant_obj);
            }
        }
    }
);


// Restaurant.all.push(
//  {
//  "rid": "2014001",
//  "rname": "Asian Cafe",
//  "lat": "35.913237", 
//  "lng": "-79.055839", 
//  "raddress": "118 E Franklin St, Chapel Hill, NC 27514", 
//  "rphone": "(919) 929-0168", 
//  "isOpen": "true"
//  }
// );

</script>

<!-- Scripts for Google Map -->
<script>
function initialize() {
  var unc = new google.maps.LatLng(35.914137, -79.054082);
  var mapOptions = {
    zoom: 17,
    center: unc, // center: {lat: 35.90, lng: -79.05}
    disableDefaultUI: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    // display pan control
    panControl: true,
    // display zoom control as default
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.DEFAULT
    },
    // display mapType control as dropdown
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
    }
  };
  // get map div and initialize by mapOptionsObject
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // set up info window  ---> only one info window is needed
  var infowindow = new google.maps.InfoWindow();
  
  // set up marker for all the restaurants ---> multiple markers required
  for(var i = 0; i < Restaurant.all.length; i++){
    // In reality, the location should point to where user pinned or searched...
    var location = new google.maps.LatLng(Restaurant.all[i].getLat(),Restaurant.all[i].getLng())
    // Create marker objects
    var marker = new google.maps.Marker({
        position: location,
        animation:google.maps.Animation.DROP
    });
    // To add the marker to the map, call setMap();
    marker.setMap(map);
    console.log("marker=",marker) // for debugging
    
    // register click event for each marker separately
    registerMarkerEvent(marker, i, map, infowindow);
  }
}
// Funtion Closure to solve Loop+Event Bug
function registerMarkerEvent(marker, i, map, infowindow){
    google.maps.event.addListener(marker,'click', function(){
        // get restaurant info to be displayed on InfoWindow specific to this marker
        var contentString = getRestaurantInfo(i);
        infowindow.setContent(contentString);
        infowindow.maxWidth = 300;
        infowindow.open(map, this);
    });
}
// Function Closure
function getRestaurantInfo(index){
    var restaurant_id = Restaurant.all[index].rid;
    var restaurant_name = Restaurant.all[index].rname;
    var restaurant_address = Restaurant.all[index].raddress;
    var restaurant_phone = Restaurant.all[index].rphone;
    var restaurant_isOpen = Restaurant.all[index].isOpen?"Open":"Close";
    // set up content
    var contentString = '<div id="info-window">'+
        // '<span class="iw-close close_btn">×</span>'+
        '<h1 class="rest-name">'+restaurant_name+'</h1>'+
        '<p class="rest-address">'+restaurant_address+'</p>'+
        '<p class="rest-phone">'+restaurant_phone+'</p>'+
        '<p class="rest-open"><span class="highlight">'+restaurant_isOpen+'</span></p>'+
        '<a class="iw-btn btn btn-info" target="_blank" \
            href="./Restaurant_main.php?rid='+restaurant_id+'&isOpen='+restaurant_isOpen+'">Look Inside</a>'+
        '</div>';
    return contentString;
}


google.maps.event.addDomListener(window,'load',initialize);

</script>
</head>
<body>
<div class="main-container">
	<header id="main-header" class="navbar navbar-custom navbar-fixed-top">
      <div class="logo">
        <a class="navbar-brand" href="index.php"><img src="./img/logo_footer.png" alt=""></a>
      </div>
	  <h1>HeelFoodie</h1>
      <div class="header-account">
        <a class="link" href="#">LOGIN</a>
        / <a class="link" href="http://ele.me/register">REGISTER</a>
      </div>
	<div class="change-bg">
	  <span>close background</span>
	</div>	
	</header>
	<div id="background"></div>
	<!-- Map -->
    <section id="main-map" class="map-container">
        <div id="map-background"></div>
        <div id="map-canvas"></div>
    </section>
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
    <footer class="active">
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
<!-- Scripts for Controlling Background -->
<script>
    $(document).ready(function () {
    	var divbg = $("div#background");
        var mapbg = $("div#map-background");
    	var footer = $("footer");
        var logo_footer = $(".logo-footer");
        logo_footer.css({display: "none"});
    	$("div.change-bg").on("mousedown",function(){
    	  if(divbg.hasClass("active")){
    		divbg.removeClass("active");
    		$(this).find("span").text("open background");
            logo_footer.css({display: "none"});
    		footer.removeClass("active");
            divbg.css({display: "none"});
            mapbg.css({height: "100%"});
            logo_footer.css({display: "initial"});
    		console.log("divbg is active, now close background."); // for debugging
    	  }else{
    		divbg.addClass("active");
    		$(this).find("span").text("close background");
    		footer.addClass("active");
            divbg.css({display: "initial"});
            mapbg.css({height: "0"});
            logo_footer.css({display: "none"});
            console.log("divbg is inactive, now open background."); // for debugging
    	  }	    
    	});

        
    });
</script>
</body>
</html>
