/**
 * @author Qiongcheng Xu
 */
$(document).ready(function() {
	$("#order").click(function(event) {
		$("select").each(function() {
			var index = $(this).attr("rel");
			OrderList.all[index].qty = $(this).val();
			console.log(OrderList.all[index]);
		});
	});

	$("#food-list").on('mousedown', '.remove-food', function(event) {
		var food_to_remove = $(this).parent();
		var index = $(this).attr("rel");
		OrderList.all[index].qty = 0;
		console.log(OrderList.all[index].qty);
		food_to_remove.remove();
		updateTotalPrice();
	});
	
	$("#food-list").on('change', 'select', function(event){
			var index = $(this).attr("rel");
			OrderList.all[index].qty = $(this).val();
			console.log(OrderList.all[index]);
			updateTotalPrice();
	});

	//Read data from menu object
	for (var i = 0; i < 6; i++) {
		var next_food = OrderList.all[i];
		if (next_food.qty != 0) {
			//One record of food list
			var row = $("<li class='food-entry'></li>");
			$("#food-list").append(row);
			//Food name
			var food = $("<div class='food'></div>");
			row.append(food);
			food.append(next_food.food);
			//Food quantity
			var qty = $("<div class='qty'></div>");
			row.append(qty);
			var qty_select = $("<select class='select-qty', rel=" + i + "></select>");
			qty.append(qty_select);
			for (var j = 0; j < 6; j++) {
				var option = $("<option value=" + j + ">" + j + "</option>");
				if (j == next_food.qty) {
					option.attr("selected", "true");
				}
				qty_select.append(option);
			}
			//Food price
			var price = $("<div class='price'>$ </div>");
			row.append(price);
			price.append(next_food.price);
			//Food remove
			var remove_button = $("<button class='remove-food', rel=" + i + ">remove</button>");
			remove_button.addClass("btn btn-primary btn-xs");
			row.append(remove_button);
		}
	}
	
	
	function updateTotalPrice() {
		var total = 0;
		$("select").each(function() {
			var index = $(this).attr("rel");
			total += $(this).val() * OrderList.all[index].price;	
		});
		total = Math.round(total*Math.pow(10,2))/Math.pow(10,2);
		total = total.toFixed(2);
		$(".totalPrice").html("Total: " + total);
		console.log(total);
	}
	
	updateTotalPrice();
	
}); 