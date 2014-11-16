/**
 * @author Qiongcheng Xu
 */
 $(document).ready(function(){
	click_edit_Address_button();
});
var click_edit_Address_button = function () {
	var editable = false;
	// save existing value
	var addr_l1 = $("td.Addr_l1").text();
	console.log("addr_l1=",addr_l1);
	var addr_l2 = $("td.Addr_l2").text();
	console.log("addr_l2=",addr_l2);

	var cancel_button = $('<button id="cancel" class="btn btn-link" type="button">cancel</button>');
	$("button#edit-addr").click( function () {	
	  // if the field is not editable, i.e. clicking edit button => make it editable
	  if(!editable){
		editable = true; // change state to editable
		// clear the wrapper displayer
		var addr_display = $("#Addr_display");
		addr_display.empty();
		$(this).text("Submit");

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
		var addr_l2_input = $('<input type="text" value="'+addr_l2+'" \
			placeholder="Address line 2" name="Addr_l2" class="form-control">');
		form_group.append(addr_l2_input).appendTo(form);
		// form_group.appendTo(form);
		addr_display.append(form);
		console.log("after edit:",editable);
		
	  } else {
		// the field is now editable, i.e. clicking on submit => make it not editable
		editable = false;
		// alert("Submit your Change");
		$("button#edit-addr").text("Edit Delivery Address")
		$("button#cancel").hide();
	  	console.log("after submit:",editable); // for debugging
	  	addr_l1 = $('input[name="Addr_l1"]').val();
	  	addr_l2 = $('input[name="Addr_l2"]').val();
	  	// console.log($('input[name="Addr_l1"]').val()); // for debugging
	  	

	  	$.ajax({
			url: "./address.php",
			type: "POST",
			dataType: "json",
			data: {
				Addr_l1: addr_l1,
				Addr_l2: addr_l2,
			},
			success: function(json){
				// return_to_table(json.addr_l1, addr_l2);
				console.log("JSON back success");
				console.log("json=",json);
				// console.log('<?php echo json_encode($_SESSION, JSON_HEX_TAG); ?>');
				return_to_table(json[0].Addr_l1, json[0].Addr_l2);
			},
			error: function(xhr, status,errorThrown){
				console.log("error!");
				console.log("xhr=",xhr);
			}

		});

	  }

	});
	// BUG: event handler for dynamically created element
	// if click on cancel, return to uneditable state
	cancel_button.on('click',function () {
		// cancel_to_initial($(this));
		editable = false; // click on cancel making it uneditable
		// alert("cancel edit");
		$("button#edit-addr").text("Edit Delivery Address");
		cancel_button.hide();
		console.log("after cancel:",editable); // for debugging
		return_to_table(addr_l1,addr_l2);
		
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