/**
 * @author Yiqi Wang
 */
 $(document).ready(function(){
 	// alert("Hi");
 	var edit_contact_inf = $("#contact_edit");
 	var contact_inf_display = $("div#my_contact_inf");
 	edit_contact_inf.hide();
 	$("button#edit").click( function () {	
		contact_inf_display.hide();
		edit_contact_inf.show();
	});
	click_submit_button();
	$("button#cancel").click( function () {	
		contact_inf_display.show();
		edit_contact_inf.hide();
	});
});
var click_submit_button = function () {
	$("button#submit").click(function(event){
		var form_content = $("#edit_contact_form" ).serializeArray();
		console.log(form_content);
		var full_name = form_content[0].value;
		var phone = form_content[1].value;
		var phone_rep = phone.substr(0,3)+'-'+phone.substr(3,3)+'-'+phone.substr(6,4);
		var addr_l1 = form_content[2].value;
		var addr_l2 = form_content[3].value;
		var city = form_content[4].value;
		var state = form_content[5].value;
		var zipcode = form_content[6].value;
		var name_display = $("#name_display");
		var phone_display = $("#phone_display");
		var add_l1_display = $("#add_l1_display");
		var add_l2_display = $("#add_l2_display");
		var city_state_zip_display = $("#city_state_zip_display");

		// console.log(phone.length,phone_rep);
		// console.log(phone.length,phone.substr(0,3));
		// console.log(phone.length,phone.substr(3,3));
		// console.log(phone.length,phone.substr(6,4));


        if (full_name.length ==0){
        	$("#error").html("Name is required!");
        	return false;
        }else if (phone.length ==0){
        	$("#error").html("Phone number is required!");
        	return false;
        }else if (addr_l1.length ==0){
        	$("#error").html("Address first line is required!");
        	return false;
        }else {
        	var phoneNumberRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
        	if (!phoneNumberRegex.test(phone)) {
        		// usually show some kind of error message here
 				$("#error").html("Your phone number is invalid!");
        		// prevent the form from submitting
        		return false;
    		} else {
    			// alert("Submit success!");
    		}
        }

		$.ajax({
			url: "./process.php",
			type: "POST",
			data: form_content,
			datatype: "JSON",
            success: function(){
            		alert("Submit success!");
            		name_display.html(full_name);
					phone_display.html(phone_rep);
					add_l1_display.html(addr_l1);
					add_l2_display.html(addr_l2);
					city_state_zip_display.html(city+', '+state+', '+zipcode);
					$("#contact_edit").hide();
					$("div#my_contact_inf").show();
					$('.success').fadeIn(200).show();
					$('.error').fadeOut(200).hide();
					}
		});

		event.preventDefault();

	});
	

}
