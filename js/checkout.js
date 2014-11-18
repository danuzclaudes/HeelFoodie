/**
 * @author chongrui
 */
$("document").ready(function(){
	// $('button#place-order').trigger('click');

	$('button#place-order').on('click', function (event) {
	    var btn = $(this);
	    // alert("plc order btn clicked");
	    $.ajax({
	    	url: "./order.php",
	    	type: "POST",
	    	dataType: "html",
	    	data: {
	    		JUST_PLACED: 1
	    	},
	    	success: function (response, textStatus, jqXHR) {
	    		// alert("good");
	    		btn.button('loading').prop("disabled",false);
	    		// ... replace by track.php?
	    		var msg = $('<div id="success">Order Success! Now redirecting...</div>');
	    		$("#msg").empty().css({
	    			float: "right",
	    			color: "red",
	    			position: "relative",
	    			left: "-45px"
	    		});
	    		msg.appendTo($('div#msg'))
	    		setTimeout(function () {
    			    redirect_page(event)
    			    $(this).button('reset');
    			}, 1000);
	    	},
	    	error: function (xhr, status, errorThrown) {
	    		// alert("bad");
	    		btn.prop("disabled",true);
	    		btn.button('reset');

	    		
	    	}
		});
	    
	})

  	$( document ).ajaxError( function( event, request, settings ) {
  		$( "#msg" ).empty().css({
	    			float: "right",
	    			color: "red",
	    			position: "relative",
	    			left: "-55px"
	    		}).append( '<div id="error">Sorry, '+ request.statusText + '</div>' );
  		// diappear in 10 seconds or undated with p
  		// setTimeout(function () {
    		// $("#msg").empty();
    		// window.location.href = "address_confirm.php";
    // 	}, 3000);
  	});

  	var redirect_page = function (event) {
  		event.preventDefault(); //will stop the link href to call the page
  		setTimeout(function (){
  			window.location.href = "order_track.php";
  		}, 3000);
  	}

});