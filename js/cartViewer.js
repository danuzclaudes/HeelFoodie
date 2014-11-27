/**
 * @author Qiongcheng Xu
 */
//Caution!!! url_base is different!
//var url_base = "http://wwwp.cs.unc.edu/Courses/comp426-f14/qcxu/HeelFoodie";
var url_base = "http://localhost/~QiongchengXu/HeelFoodie";

$(document).ready(function() {
	//Display cart items from COOKIE
	$.ajax(url_base + "/menuV1.php/cart", {
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
		$('#food-list').append(t.makeCompactLi());
	};

	//Click "Place Order" button, update cart items to COOKIE
	$('#order-option').on('click', '.order-button', function(event) {
		event.preventDefault();
		var button_id = $(this);
		console.log(button_id);
		
		order_entry.all = [];
		$(".food-entry").each(function(i, e) {
			qty = $(this).find("select").val();
			if (qty != 0) {
				//object t
				var t = $(this).data('food');
				//console.log(t);
				//new object Cart: cart_item
				var cart_item = new Cart(t);
				cart_item.qty = qty;
				//console.log(cart_item);
				order_entry.all.push(cart_item);
			}
		});
		
		var entry_object = JSON.stringify(order_entry.all);
			//console.log(entry_object);
			//console.log( order_entry.all );
		$.ajax({
			url : "./entry_order.php",
			type : "POST",
			//contentType: "Application/json",
			data : {
				'entry_object' : entry_object
			},
			success : function(data, status, jqXHR) {
				if (button_id.attr("id") == "place-order") {
					window.location = "address_input.php";
				}
				else {
					window.location = "Restaurant_main.php?rid=1";
				}
			},
			error : function(jqXHR, status, error) {
				alert(jqXHR.responseText);
			}
		});
	
	});
	
	
	//Click button "remove" to remove the cart item and update total price
	$("#food-list").on('mousedown', '.remove-food', function(event) {
		var food_to_remove = $(this).parent();
		food_to_remove.remove();
		updateTotalPrice();
	});

	//Change cart item quantity and update total price
	$("#food-list").on('change', 'select', function(event) {
		var li = $(this).parents("li");
		var qty = $(this).val();
		var cart_item = li.data('food');
		cart_item.updateItemQty(qty);
		//console.log(cart_item);
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
