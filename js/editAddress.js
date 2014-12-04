/**
 * @author chongrui
 */
$(document).ready(function(){
	click_edit_Address_button();
});
var click_edit_Address_button = function () {
	var editable = false;
	// save existing value
	var addr_l1 = $("td.Addr_l1").text();
	var phone1 = $("td.Phone1").text();

	var cancel_button = $('<button id="cancel" class="btn btn-link" type="button">cancel</button>');
	$("button#edit-addr").click( function () {	
	  // if the field is not editable, i.e. clicking edit button => make it editable
	  if(!editable){
		editable = true; // change state to editable
		// clear the wrapper displayer
		var addr_display = $("#Addr_display");
		addr_display.empty();
		$(this).text("Submit");

		// while editting, placing button could not be clicked?
		// now address line is editable, disable placing order btn
		$('button#place-order').prop("disabled",true);

		// display cancel button
		var control_panel = $("div.control-panel");
		cancel_button.show();
		control_panel.append(cancel_button); // cancel button is newly created into DOM; 
		// BUG: event handler for dynamically created element

		console.log("cancel_button=",cancel_button);

		// replace by original form input
		var form = $('<form role="form" action="" method="post"></form>');
		var form_group = $('<div class="form-group long_textinput"></div>');

		var addr_l1_input = $('<input type="text" value="'+addr_l1+'" \
			placeholder="Address line 1" name="Addr_l1" class="form-control">');
		form_group.append(addr_l1_input).appendTo(form);
		// form_group.appendTo(form);
		var phone1_input = $('<input type="text" value="'+phone1+'" \
			placeholder="Phone Number" name="Phone1" class="form-control">');
		form_group.append(phone1_input).appendTo(form);
		// form_group.appendTo(form);
		addr_display.append(form);
		console.log("after edit:",editable);
		
	  } else {
		// the field is now editable, i.e. clicking on submit => make it not editable	
		// console.log($('input[name="Addr_l1"]').val()); // for debugging
	  	addr_l1 = $('input[name="Addr_l1"]').val();
	  	phone1 = $('input[name="Phone1"]').val();
	  	// alert("addr_l1="+addr_l1);

	  	if( !addr_l1 && !phone1 ) {
	  		editable = true; // no input value, still make it editable!
	  		// alert(!addr_l1);
	  	} else {
	  		editable = false;
	  		$("button#edit-addr").text("Edit Delivery Address");
			$("button#cancel").hide();

			$.ajax({
				url: "app.php/address",
				// url: "./address.php",
				type: "POST",
				dataType: "json",
				data: {
					Addr_l1: addr_l1,
					Phone1: phone1
				},
				success: function(address, textStatus, jqXHR){
					console.log("address=",address);
					return_to_table(address.Addr_l1, address.Phone1);
					// even successfully add/update address, can click if cart is empty?
	  				$('button#place-order').prop("disabled",false);
					$('#msg').empty();
				},
				error: function(xhr, status, errorThrown){
					alert(xhr.responseText);  // should validate by js, instead of using HTTP status text
				}
			});
	  	}
	  	
		// alert("Submit your Change");
	  	
	  }

	});
	// BUG: event handler for dynamically created element
	// if click on cancel, return to uneditable state
	cancel_button.on('click',function () {
		// cancel_to_initial($(this));
		editable = false; // click on cancel making it uneditable
		// alert("cancel edit");
		$("button#edit-addr").text("Edit Delivery Address");
		$('button#place-order').prop("disabled",false);
		cancel_button.hide();
		console.log("after cancel:",editable); // for debugging
		return_to_table(addr_l1,phone1);
		
	});
	

}
var return_to_table = function (addr_l1, addr_l2) {
		// change back to table
		var table = $('<table style="padding-left: 15px" class="table table-hover" data-table="address"></table>');
		var addr_l1_td = $('<tr><td class="Addr_l1">'+addr_l1+'</td></tr>');
		var addr_l2_td = $('<tr><td class="Addr_l1">'+addr_l2+'</td></tr>');
		addr_l1_td.appendTo(table);
		addr_l2_td.appendTo(table);
		$("#Addr_display").empty().append(table);
}