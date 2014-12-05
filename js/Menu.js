// Menu Object
var Menu = function(menu_json) {
    this.menu_id = menu_json.menu_id;
    this.item_thumb_image = menu_json.item_thumb_image;
    this.price = menu_json.price;
    this.food_name = menu_json.food_name;
    this.rating = menu_json.rating;
    this.restaurant_id = menu_json.restaurant_id;
    this.restaurant_name = menu_json.restaurant_name;
};

Menu.prototype.makeCompactLi = function(cookie_qty) {
    var menuli = $("<li></li>");
    menuli.addClass('food-entry');

	var thumbImg = $("<div class='food-image'></div>");
	thumbImg.addClass('food-thumb-image');
    var image_url = $('<img src="./img/foodPic/'+this.item_thumb_image+'", class="img-rounded">');
    menuli.append(thumbImg);
    thumbImg.append(image_url);
    
    var foodName = $("<div></div>");
    foodName.addClass('food');
    foodName.html(this.food_name);
    menuli.append(foodName);
    
    var qty = $("<div class='qty'></div>");
    qty.addClass('qty');  
    var qty_select = $("<select name=qty[]></select>");
    qty_select.addClass('select-qty');
    for (var j = 0; j < 6; j++){
    	var option = $("<option value="+j+">"+j+"</option>");
    	if (j == cookie_qty) {
			option.attr("selected", "true");
		}
    	qty_select.append(option);
    }
	qty.append(qty_select);
	menuli.append(qty);
	
	var price = $("<div>$ </div>");
    price.addClass('price');
    price.html(this.price);
    menuli.append(price);
    
    //Food rate
    var rate_bar = $("<div></div>");
    rate_bar.addClass('rate-bar');
    var width = this.rating / 5 * 100;
    var rate = $("<div class='rate', style='width:"+width+"%;'></div>");
    menuli.append(rate_bar);
    rate_bar.append(rate);
    //rate.addClass(next_food.rate);
	menuli.data('food', this);
	
    return menuli;
};