/**
 * @author Qiongcheng Xu
 */
$(document).ready(function() {
	order_entry.all=[];
		$(".food-entry").each(function(i,e){
			qty = $(this).find("select").val();
			if (qty != 0) {
				mid = $(this).attr('id');
				order_entry.all.push(new order_entry(mid, qty));
			}
		});
	
	$("#order").click(function(event) {
		order_entry.all = [];
		$(".food-entry").each(function(i,e){
			qty = $(this).find("select").val();
			if (qty != 0) {
				mid = $(this).attr('id');
				order_entry.all.push(new order_entry(mid, qty));
			}
		});
		console.log(order_entry.all);
		
		var entry_object = JSON.stringify(order_entry.all);
		console.log( JSON.stringify(order_entry.all) );
		$.ajax({
			url: "./entry_order.php",
			type: "POST",
			//contentType: "Application/json",
			data: 
				{'entry_object': entry_object},
			success: function(data, textStatus, jQxhr){
				window.location="address_input.php";
				alert(entry_object);
			},
			error: function(){
					alert("xhr.statusText");
			}
		});
		event.preventDefault();
	});

	$("#food-list").on('mousedown', '.remove-food', function(event) {
		var food_to_remove = $(this).parent();
		var index = $(this).attr("rel");
		order_entry.all = $.grep(order_entry.all, function(e){ 
    		return e.mid !== index; 
		});
		//console.log(order_entry.all);
		food_to_remove.remove();
		updateTotalPrice();
	});
	
	$("#food-list").on('change', 'select', function(event){
			var index = $(this).parents("li").attr("id");
			var qty = $(this).val();
			order_entry.all = $.grep(order_entry.all, function(e){ 
    		return e.mid != index; 
		});
		//console.log(order_entry.all);
			if (qty != 0) {
				order_entry.all.push(new order_entry(index, qty));
				console.log(order_entry.all);
			}
			updateTotalPrice();
	});

	
	function updateTotalPrice() {
		var total = 0;
		$(".food-entry").each(function(i,e){
			var qty = $(this).find("select").val();
			var price = $(this).find(".price").text();
			price = price.slice(2);
			console.log(qty);
			console.log(price);
			total += qty * price;
		});
		total = Math.round(total*Math.pow(10,2))/Math.pow(10,2);
		total = total.toFixed(2);
		$(".totalPrice").html("Total: " + total);
		//console.log(total);
	}
	
	updateTotalPrice();
	
}); 