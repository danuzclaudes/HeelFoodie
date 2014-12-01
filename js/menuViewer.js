
$(document).ready(function () {
	//Append restaurant info
	rest_id = $('#Restaurant-Main div:first-child').attr("id");
	$.ajax("./app.php/restaurantInfo/" + rest_id,
	       {type: "GET",
		       dataType: "json",
		       success: function(rest_json, status, jqXHR) {
				   var rest = new restaurant(rest_json);
				   //console.log(rest);
				   $("#restaurant-info").append(rest.showInfo());
		   		}
	       });

	
	//Append menu list
	//rest_id = $('#Restaurant-Main div:first-child').attr("id");
	$.ajax("app.php/restaurant/" + rest_id,
	       {type: "GET",
		       dataType: "json",
		       success: function(menu_ids, status, jqXHR) {
			       for (var i=0; i<menu_ids.length; i++) {
			       	//console.log("menu id:", menu_ids[i]);
			       	 var cookie_qty = load_item_with_qty(menu_ids[i]);
			       	 console.log("cookie qty:", cookie_qty);
			       }
		   		}
	       });

	$('#order').on('click', function(event) {
		$.ajax("cookie.php/cart/", {
			type : "GET",
			dataType : "json",
			success : function(cart_info, status, jqXHR) {
				//console.log("menu_id in function find_qty:", mid);
				if (cart_info == null) {
					alert("You didn't choose any food!");
				} else {
					window.location="shoppingCart.php";
				}
			},
			error: function(jqXHR, status, error){
				alert("error");
			}
		});
	});

	$("#menu-entry").on('change', 'select', function(event) {
		alert("change!");
		var li = $(this).parents("li");
		var qty = $(this).val();
		var menu_item = li.data('food');
		var change_item = new Cart(menu_item);
		change_item.qty = qty;
		console.log("onchange item:", change_item);
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
						return e.menu_id == change_item.menu_id; });
						//item is already in the cart cookie
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
	});
	
		

});

var load_item_with_qty = function (mid) {
	var cookie_qty = 0;
	$.ajax("cookie.php/cart/", {
		type : "GET",
		dataType : "json",
		success : function(cart_info, status, jqXHR) {
			console.log("cart_info:", cart_info);
			if (cart_info != null) {
				//console.log("menu_id in function find_qty:", mid);
				console.log("cart_info[0]:", cart_info[0]);
				for (var i = 0; i < cart_info.length; i++) {
					//console.log(cart_info[i]);
					
					var t = new Cart(cart_info[i]);
					console.log("t:", t);
					if (t.menu_id == mid) {
						console.log("menu_id match, qty:", t.qty);
						cookie_qty = t.qty;
					}
				}
				load_menu_item(mid, cookie_qty);
			} else {
				//console.log("cannot find cart cookie");
				cookie_qty = 0;
				load_menu_item(mid, cookie_qty);
			}
		},
		error : function(jqXHR, status, error) {
			//console.log("cannot find cart cookie");
			cookie_qty = 0;
			load_menu_item(mid, cookie_qty);
		}
	});
};


var load_menu_item = function (id, cookie_qty) {
    $.ajax("app.php/menu/" + id,
	{type: "GET",
	 dataType: "json",
	 success: function(menu_json, status, jqXHR) {
		var t = new Menu(menu_json);
		t.makeCompactLi(cookie_qty).appendTo($('#menu-entry'));
	    }
	});
};
