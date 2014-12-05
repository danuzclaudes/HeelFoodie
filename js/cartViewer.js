$(document).ready(function() {
	//Display cart items from COOKIE
	$.ajax("cookie.php/cart", {
		type : "GET",
		dataType : "json",
		success : function(cart_info, status, jqXHR) {
			for (var i = 0; i < cart_info.length; i++) {
				//console.log(cart_info[i]);
				load_cart_item(cart_info[i]);
			}
			updateTotalPrice();
		},
		error : function(jqXHR, status, error) {
			alert("Error");
		}
	});

	//Load cart item
	var load_cart_item = function(cart_item) {
		var t = new Cart(cart_item);
		t.makeCompactLi().appendTo($('#food-list'));
	};

	//Click "Place Order" button, update cart items to COOKIE
	$('#order-option').on('click', '.order-button', function(event) {
		event.preventDefault();
		button_id = $(this);
		$.ajax("cookie.php/cart", {
			type : "GET",
			dataType : "json",
			success : function(cart_info, status, jqXHR) {
				//console.log("menu_id in function find_qty:", mid);
				if (button_id.attr("id") == "place-order") {
					if (cart_info == null) {
						alert("You didn't choose any food! Back to Homepage...");
						window.location = "index.php";
					} else {
						window.location="address_input.php";
					} 
				}else {
					if (cart_info != null) {
						var t = new Cart(cart_info[0]);
						$.ajax("app.php/menu/" + t.menu_id,
							{type: "GET",
							 dataType: "json",
							 success: function(menu_json, status, jqXHR) {
								console.log("menu_json:", menu_json);
								var t = new Menu(menu_json);
								console.log("rid:", t.restaurant_id);
								var rid = t.restaurant_id;
								window.location = "Restaurant_main.php?rid=" + rid;
							 },
							 error: function(jqXHR, status, error){
								window.location = "index.php";
							}
						});
					} else {
						window.location = "index.php";
					} 
				}
			}
		});
	});
		
		

	//Click button "remove" to remove the cart item and update total price
	$("#food-list").on('mousedown', '.remove-food', function(event) {
		var food_to_remove = $(this).parent();
		var remove_item = food_to_remove.data('food');
		console.log(remove_item);
		$.ajax("cookie.php/cart/", {
			type : "GET",
			dataType : "json",
			success : function(cart_info, status, jqXHR) {
				//console.log("menu_id in function find_qty:", mid);
				if (cart_info != null) {
					var cart_array = [];
					for (var i = 0; i < cart_info.length; i++) {
					//console.log(cart_info[i]);
						var t = new Cart(cart_info[i]);
						cart_array.push(t);
					}
					console.log("cart_array:", cart_array);
					//Check if the item is already in the cart cookie
					var result_item = $.grep(cart_array, function(e){ 
						return e.menu_id == remove_item.menu_id; });
					if (result_item.length == 1) {
						console.log("delete from cookie");
						remove_item.delete_from_cookie();
					}
				}
			}

		});
		food_to_remove.remove();
		updateTotalPrice();
	});


	//Change cart item quantity and update total price
	$("#food-list").on('change', 'select', function(event) {
		var li = $(this).parents("li");
		var qty = $(this).val();
		var change_item = li.data('food');
		change_item.updateItemQty(qty);
		console.log(change_item);
		$.ajax("cookie.php/cart/", {
			type : "GET",
			dataType : "json",
			success : function(cart_info, status, jqXHR) {
				//console.log("menu_id in function find_qty:", mid);
				if (cart_info != null) {
					var cart_array = [];
					for (var i = 0; i < cart_info.length; i++) {
					//console.log(cart_info[i]);
						var t = new Cart(cart_info[i]);
						cart_array.push(t);
					}
					//console.log("cart_array:", cart_array);
					//Check if the item is already in the cart cookie
					var result_item = $.grep(cart_array, function(e){ 
						return e.menu_id == change_item.menu_id; });
						//item is already in the cart cookie
						//console.log(change_item.qty);
						if (result_item.length == 1) {
							console.log("item already in cart cookie");
							if (change_item.qty == 0) {
								console.log("delete from cookie");
								change_item.delete_from_cookie();
							} else if (change_item.qty != result_item.qty) {
								console.log("update from cookie");
								change_item.update_from_cookie();
							}
						} else {
							//item not in the cookie
							if (change_item.qty != 0) {
								console.log("add to cookie");
								change_item.add_to_cookie();
							}
						}
					
				} else{
					//There is no cart cookie
					console.log("add to cookie");
					change_item.add_to_cookie();
				}
				
			}

		});
		
		updateTotalPrice();	
	});
	

	function updateTotalPrice() {
		var total = 0;
		$(".food-entry").each(function(i, e) {
			var cart_item = $(this).data('food');
			//console.log(cart_item);
			total += cart_item.qty * cart_item.price;
		});
		total = Math.round(total * Math.pow(10, 2)) / Math.pow(10, 2);
		total = total.toFixed(2);
		$(".totalPrice").html("Total: " + total);
		//console.log(total);
	}

});
