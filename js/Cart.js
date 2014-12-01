//Cart Object
var Cart = function(cart_json) {
    this.menu_id = cart_json.menu_id;
    this.food_name = cart_json.food_name;
    this.qty = parseInt(cart_json.qty);
    this.price = cart_json.price;
};

Cart.prototype.makeCompactLi = function() {
    var cartli = $("<li></li>");
    cartli.addClass('food-entry');
    
    var foodName = $("<div></div>");
    foodName.addClass('food');
    foodName.html(this.food_name);
    cartli.append(foodName);
    
    var qty = $("<div class='qty'></div>");
    qty.addClass('qty');  
    var qty_select = $("<select name=qty[]></select>");
    qty_select.addClass('select-qty');
    for (var j = 0; j < 6; j++){
    	var option = $("<option value="+j+">"+j+"</option>");
    	if (j == this.qty) {
			option.attr("selected", "true");
		}
    	qty_select.append(option);
    }
	qty.append(qty_select);
	cartli.append(qty);
	
	var price = $("<div>$ </div>");
    price.addClass('price');
    price.html(this.price);
    cartli.append(price);
    
    var remove_button = $("<button class='remove-food'>remove</button>");
	remove_button.addClass("btn btn-primary btn-xs");
	cartli.append(remove_button);
    
	cartli.data('food', this);
	
    return cartli;
};

Cart.prototype.updateItemQty = function(qty) {
	this.qty = qty;
};

Cart.prototype.delete_from_cookie = function() {
	var entry_object = JSON.stringify(this);
			console.log(entry_object);
			//console.log( order_entry.all );
		$.ajax({
			url : "cookie.php/cart/" + this.menu_id + "?delete",
			type : "GET",
			//contentType: "Application/json",
			success : function(data, status, jqXHR) {
				alert("delete");
			},
			error : function(jqXHR, status, error) {
				alert("delete fail");
			}
		});
};

Cart.prototype.update_from_cookie = function() {
	var entry_object = JSON.stringify(this);
			console.log(entry_object);
			//console.log( order_entry.all );
		$.ajax({
			url : "cookie.php/cart/" + this.menu_id,
			type : "POST",
			//contentType: "Application/json",
			data : entry_object,
			success : function(data, status, jqXHR) {
				alert("update");
			},
			error : function(jqXHR, status, error) {
				alert("update fail");
			}
		});
};

Cart.prototype.add_to_cookie = function() {
	var entry_object = JSON.stringify(this);
			//console.log(entry_object);
			//console.log( order_entry.all );
		$.ajax({
			url : "cookie.php/cart",
			//url : "entry_order.php",
			type : "POST",
			//contentType: "Application/json",
			data : entry_object,
			success : function(data, status, jqXHR) {
				console.log("add_to_cookie:", entry_object);
				alert("add");
			},
			error : function(jqXHR, status, error) {
				alert("add fail");
			}
		});
};

// Cart.prototype.getRestID = function() {
	// //var entry_object = JSON.stringify(this);
	// //console.log(entry_object);
	// //console.log( order_entry.all );
	// $.ajax("app.php/menu/" + this.menu_id,
		// {type: "GET",
		 // dataType: "json",
		 // success: function(menu_json, status, jqXHR) {
			// console.log("menu_json:", menu_json);
			// var t = new Menu(menu_json);
			// console.log("rid:", t.restaurant_id);
			// var rid = t.restaurant_id;
			// return rid;
		 // }
	// });
	
//};
