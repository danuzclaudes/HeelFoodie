/**
 * @author Qiongcheng Xu
 */
$(document).ready(function() {
	$("#order").click(function(event) {
		order_entry.all = [];
		$(".food-entry").each(function(i,e){
			qty = $(this).find("select").val();
			if (qty != 0) {
				mid = $(this).attr('id');
				order_entry.all.push(new order_entry(mid, qty));
			}
		});
		
		var entry_object = JSON.stringify(order_entry.all);
		console.log( JSON.stringify(order_entry.all) );
		$.ajax({
			url: "./entry_order.php",
			type: "POST",
			//contentType: "Application/json",
			data: 
				{'entry_object': entry_object},
			success: function(data, textStatus, jQxhr){
				window.location="shoppingCart.php";
			},
			error: function(){
					alert("xhr.statusText");
			}
		});
		event.preventDefault();
			
	});
    
	$('.carousel').carousel({
        interval: 3000
    });

});