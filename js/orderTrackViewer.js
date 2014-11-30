/**
 * @author Chongrui
 */
$(document).ready(function() {
	var oid = $('.order-info-value').text();
	if (!oid) { oid = ''; }
	// if cookie value does not exist??? ---> GET app.php/order/
	$.ajax("app.php/order/"+oid,
		{	// GET /app.php/order/<oid> ---> Order::getOrderbyID
			type: "GET",
			dataType: "json",
			success: function(order_json_obj, status, jqXHR) {
				console.log(order_json_obj);
				var order = new Order(order_json_obj);
				$('#warning-board').append(order.order_detail());
				$('.order-info').append(order.makeOrderInfoDiv());
				// after the first ajax, call the function to execute another ajax...
				load_menu_order_info(oid);
			}
		}

	);

	$(document).ajaxError( function(event, request, setting) {
		console.log(request);
		$('#warning-board').append(request.responseText);
	});

	var load_menu_order_info = function (oid) {
		$.ajax("app.php/order/"+oid+"/menu",
			{	// GET /app.php/order/<oid>/menu ---> MenuOrder::getMenuFoodInfoByOrderID
				type: "GET",
				dataType: "json",
				success: function(response, status, jqXHR){
					var menuul = $('<ul></ul>');
					menuul.addClass("mo-displayer");
					for (var i = 0; i < response.length; i++){
						console.log(response[i]);
						var mo = new MenuOrder(response[i]);
						mo.makeCompactLi().appendTo(menuul);
					}
					
					$('.menu-order-info').append(menuul);
				},
				error: function (jqXHR, status, errorThrown) {

				}
			});
	}

});