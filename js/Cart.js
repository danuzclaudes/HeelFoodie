//Cart Object
var Cart = function(cart_json) {
    this.menu_id = cart_json.menu_id;
    this.food_name = cart_json.food_name;
    this.qty = cart_json.qty;
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