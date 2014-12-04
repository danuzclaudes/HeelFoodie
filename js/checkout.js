/**
 * @author chongrui
 */
$("document").ready(function(){
	// $('button#place-order').trigger('click');
	var allow_redirect = true;
	$('.ctl_redirect').on('click', function(){
		if (allow_redirect) {
			$(this).empty().text("allow redirecting");
			allow_redirect = false;
		} else {
			$(this).empty().text("disallow redirecting");
			allow_redirect = true;
		}

		
	});

	$('button#place-order').on('click', function (event) {
	    var btn = $(this);
	    // alert("plc order btn clicked");
	    $.ajax({
	    	url: "app.php/order",
	    	type: "POST",
	    	dataType: "json",
	    	// data: {
	    	// 	JUST_PLACED: 1
	    	// },
	    	success: function (response, textStatus, jqXHR) {
	    		// console.log("oid=",response.oid); // for debugging
	    		btn.button('loading').prop("disabled",false);
	    		// ... replace by track.php?
	    		var msg = $('<div id="success">Order Success! Now redirecting...</div>');
	    		$("#msg").empty().css({
	    			float: "right",
	    			color: "red",
	    			position: "relative",
	    			left: "-45px"
	    		});
	    		msg.appendTo($('div#msg'));
	    		console.log ("allow_status=",allow_redirect);
	    		if (allow_redirect) {
	    			setTimeout(function () {
	    			    redirect_page(event)
	    			    $(this).button('reset');
	    			}, 1000);
	    			alert("will direct");
	    		} else {
	    			alert("Redirection Disallowed!");
	    		}
	    		
	    	},
	    	error: function (xhr, status, errorThrown) {
	    		// alert("bad");
	    		btn.prop("disabled",true);
	    		btn.button('reset');
	    		console.log('xhr=',xhr); // for debugging
	    		// error_info = xhr.responseText
	    	}
		});
	    
	})

  	$( document ).ajaxError( function( event, request, settings ) {
  		console.log("request=",request);
  		$( "#msg" ).empty().css({
	    			float: "right",
	    			color: "red",
	    			position: "relative",
	    			left: "-55px"
	    		}).append( '<div id="error">Sorry, '+ request.responseText + '</div>' );
  		// diappear in 10 seconds or undated with p
  		// setTimeout(function () {
    // 		$("#msg").empty();
    // 		window.location.href = "address_confirm.php";
    // 	}, 3000);
  	});

  	var redirect_page = function (event) {
  		event.preventDefault(); //will stop the link href to call the page
  		setTimeout(function (){
  			window.location = "order_track.php";
  		}, 3000);
  	}

});