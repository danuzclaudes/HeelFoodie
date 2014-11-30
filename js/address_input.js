/**
 * @author Yiqi Wang
 */
 $(document).ready(function(){
  	
	click_contact_submit_button();
	
});

var click_contact_submit_button = function () {
	
	$("button#nextstep").click(function(event){	
		$("#Error_Message1").empty();
	  $("#Error_Message2").empty();
		if ( $( "#Addr_l1" ).val().length === 0 ) {
 			$("#Error_Message1").html("<p class='error'>Address line 1 is required !</p>");
        	return false;
    	} else if ( $( "#phone1" ).val().length === 0 ){
    		$("#Error_Message1").html("<p class='error'>At least phone number is required !</p>");
        	return false;
    	} else{
    		var phonenum = $("#phone1").val();
    		var phone_lenth = phonenum.length; 
            var phoneNumberRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
    		// match only numbers
   			// if the phone number doesn't match the regex
   			// FOR DEBUG
        console.log("isNan",isNaN(phonenum));
   			console.log(!phoneNumberRegex.test(phonenum));
   			console.log(phone_lenth, phone_lenth!=10);
    		if (!phoneNumberRegex.test(phonenum)) {
        		// usually show some kind of error message here
 				$("#Error_Message2").html("<p class='error'>Your phone number is invalid!</p>");
        		// prevent the form from submitting
        		return false;
    		} else {
    			alert("Submit success!");
    		}

    	}
    	
	});
	

}
