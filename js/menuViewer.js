
//Caution!!! url_base is different!

//var url_base = "http://wwwp.cs.unc.edu/Courses/comp426-f14/qcxu/HeelFoodie";
var url_base = "http://localhost/~QiongchengXu/HeelFoodie";

$(document).ready(function () {
	//Append menu list
	rest_id = $('#Restaurant-Main div:first-child').attr("id");
	$.ajax(url_base + "/menuV1.php/restaurant/" + rest_id,
	       {type: "GET",
		       //dataType: "json",
		       success: function(menu_ids, status, jqXHR) {
			       for (var i=0; i<menu_ids.length; i++) {
				   load_menu_item(menu_ids[i]);
			       }
		   		}
	       });


	$('#order').on('click', function (e) {
		   e.preventDefault();
		   order_entry.all = [];
			$(".food-entry").each(function(i,e){
				qty = $(this).find("select").val();
				if (qty != 0) {
					//object t
					var t = $(this).data('food');
					console.log(t);
					//new object Cart: cart_item
					var cart_item = new Cart(t);
					cart_item.qty = qty;
					console.log(cart_item);
					order_entry.all.push(cart_item);
				}
			});
			
			var entry_object = JSON.stringify(order_entry.all);
			console.log(entry_object);
			//console.log( order_entry.all );
			$.ajax({
				url: "./entry_order.php",
				type: "POST",
				//contentType: "Application/json",
				data: 
					{'entry_object': entry_object},
				success: function(data, status, jqXHR){
					window.location="shoppingCart.php";
				},
				error: function(jqXHR, status, error){
						alert(jqXHR.responseText);
				}
			});	
	});

});

var load_menu_item = function (id) {
    $.ajax(url_base + "/menuV1.php/menu/" + id,
	{type: "GET",
	 dataType: "json",
	 success: function(menu_json, status, jqXHR) {
		var t = new Menu(menu_json);
		$('#menu-entry').append(t.makeCompactLi());
	    }
	});
};