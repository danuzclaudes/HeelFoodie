/**
 * @author Qiongcheng Xu
 */
$(document).ready(function() {
	$("#order").click(function(event) {
		$("select").each(function(i,e){
			Menu.all[i].qty = $(this).val();
			console.log(Menu.all[i]);
		});
		console.log("3");
		//window.location.href = 'shoppingCart.html';
		
		event.preventDefault();	
	});
	
	//Read data from menu object
	for (var i = 0; i < 6; i++) {
		var next_food = Menu.all[i];
		//One record of food list
        var row = $("<li class='food-entry'></li>");
        $("#menu-entry").append(row); 
        //Food image
        var image = $("<div class='food-image'></div>");
        var image_url = $('<img src="img/foodPic/'+next_food.image+'", class="img-rounded">');
        row.append(image);
        image.append(image_url);
        //Food name
        var food = $("<div class='food'></div>");
        row.append(food);
        food.append(next_food.food);
        //Food quantity
        var qty = $("<div class='qty'></div>");
        row.append(qty);
        var qty_select = $("<select class='select-qty'></select>");
        qty.append(qty_select);
        for (var j = 0; j < 6; j++){
        	var option = $("<option value="+j+">"+j+"</option>");
        	qty_select.append(option);
        }
        //Food price
        var price = $("<div class='price'>$</div>");
        row.append(price);
        price.append(next_food.price);
        //Food rate
        var rate_bar = $("<div class='rate-bar'></div>");
        var width = next_food.rate / 5 * 100;
        var rate = $("<div class='rate', style='width:"+width+"%;'></div>");
        row.append(rate_bar);
        rate_bar.append(rate);
        rate.addClass(next_food.rate);
    }
    
    
});