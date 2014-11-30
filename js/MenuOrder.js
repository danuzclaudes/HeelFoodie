// MenuOrder Object
var MenuOrder = function(mo_json_obj) {
    this.menu_id = mo_json_obj.mid;
    this.food_name = mo_json_obj.fname;
    this.price = mo_json_obj.price;
    this.qty = mo_json_obj.qty
    this.rating = mo_json_obj.rating;
    this.status = mo_json_obj.status;
    this.item_thumb_image = mo_json_obj.thumb_image;
};

MenuOrder.prototype.makeCompactLi = function() {
    var menuli = $("<li></li>");
    menuli.addClass('food-entry');
    // thumbImg
	var thumbImg = $("<div class='food-image'></div>");
	thumbImg.addClass('food-thumb-image');
    var image_url = $('<img src="img/foodPic/'+this.item_thumb_image+'", class="img-rounded">');
    menuli.append(thumbImg);
    thumbImg.append(image_url);
    // food name
    var foodName = $("<div></div>");
    foodName.addClass('food');
    foodName.html(this.food_name);
    menuli.append(foodName);
    // quantity
    var qty = $("<div class='qty'></div>");
    qty.addClass('qty').html(this.qty);
	menuli.append(qty);
	// price
	var price = $("<div></div>");
    price.addClass('price');
    price.html('$'+this.price);
    menuli.append(price);
    
    // rating
    var rate_bar = $("<div></div>");
    rate_bar.addClass('rate-bar');
    var width = this.rating / 5 * 100;
    var rate = $("<div class='rate', style='width:"+width+"%;'></div>");
    menuli.append(rate_bar);
    rate_bar.append(rate);
    //rate.addClass(next_food.rate);
	menuli.data('food', this);
	   
    // tracking status
    var progress = 0;
    var status_words = '';
    switch (this.status) {
        case 'one':
            progress = 25;
            status_words = 'TO BE CONFIRMED BY BUSINESS';
            break;
        case 'two':
            progress = 50;
            status_words = 'RESTAURANT CONFIRMED';
            break;
        case 'three':
            progress = 75;
            status_words = 'IN DELIVERY';
            break;
        case 'four':
            progress = 100;
            status_words = 'ORDER COMPLETE';
            break;
        default:
            progress = 0;
    }
    var status_bar_div = $("<div></div>");
    status_bar_div.addClass('tracking-status');
    var status_bar = $('<div class="progress-bar progress-bar-striped active progress-status"\
                        role="progressbar" aria-valuenow="'+progress+'" aria-valuemin="0"\
                        aria-valuemax="100" style="width: '+progress+'%; height: 2%"></div>\
                        <span class="status-words">'+status_words+'</span>');
    status_bar_div.append(status_bar);
    menuli.append(status_bar_div);

    return menuli;
};