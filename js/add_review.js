/**
 * @author Yiqi Wang
 */


 $(document).ready(function(){
 	//should add load food inf here
 	//load review inf according to menu_id
 	$.ajax("./app17.php/review/1",
	       {   type: "GET",
		       dataType: "json",
		       success: function(return_obj, status, jqXHR) {
		      	// console.log(return_obj);
		      	var menu_id = 1;
		      	var review_ids = return_obj.review_id_list;
		      	var food_info = return_obj.food_info;
		      	load_menu_item(food_info);
		      	// console.log(review_ids);
		        for (var i=0; i<review_ids.length; i++) {
		       		// console.log(review_ids[i]);
			   		load_review_item(menu_id,review_ids[i]);
		       }
		   }
	});


 	var add_review_display = $("div#review_inf");
 	add_review_display.hide();
 	$("button#add_review").click( function () {	
		add_review_display.show();
	});
	click_review_submit_button();
	
	

	
});
var click_review_submit_button = function () {
	$("button#review_submit").click(function(event){
		// alert("Submit!");
		event.preventDefault();
		var form_content = $("#new_review" ).serializeArray();
		// var rate = parseFloat(form_content[0].value);
		// var score = rate*100/5;
		// var title = form_content[1].value;
		// var comment = form_content[2].value;
  //       var displayDate = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
		// var time = myDate.getHours() + ":" + myDate.getMinutes() + ":" + myDate.getSeconds();
		var review_all_display = $("div.review_all_display");
  		check_input(form_content);
        

		$.ajax({
			url: "./app17.php/review/1", // app.php/review
			type: "POST",
			data: form_content,
			datatype: "JSON",
            success: function(review_json, status, jqXHR){
            		alert("Submit success!");
            		console.log(review_json);
            		var r = new Review(review_json);
            		console.log(r.food_review_id);
					review_all_display.append(r.addReview_infDiv());
					var new_review_id = r.food_review_id;
					delete_button(new_review_id);
					// $("#delete_button").button();
					$("div#review_inf").hide();
					$('.success').fadeIn(200).show();
					$('.error').fadeOut(200).hide();
					
					}
		});

		
		

	});
}

var load_menu_item = function(food_info){
	var food_name = food_info.food_name;
  	var food_image = food_info.item_thumb_image;
  	var rest_name = food_info.restaurant_name;
  	var food_price = food_info.price;
  	// console.log(food_name);
  	// console.log(food_price);
  	// console.log(rest_name);
  	var food_info_display = $("table");
  	var food_display = $("<tr></tr>")
  	var food_image_display = $("<td>"+food_image+"</td>");
  	var food_name_display = $("<td>"+food_name+"</td>");
  	var rest_name_display = $("<td>"+rest_name+"</td>");
  	var food_price_display = $("<td>"+food_price+"</td>");
  	food_display.append(food_image_display);
  	food_display.append(food_name_display);
  	food_display.append(rest_name_display);
  	food_display.append(food_price_display);
  	food_info_display.append(food_display);
}
var load_review_item = function (menu_id,review_id) {
    var review_all_display = $("div.review_all_display");
    $.ajax("./app17.php/review/1/" + review_id,
		{	type: "GET",
			dataType: "json",
			success: function(review_json, status, jqXHR) {
				// console.log(review_json);
				var r = new Review(review_json);
				review_all_display.append(r.makeReview_infDiv());
			    }
		});
}

var check_input = function (form_content){
	console.log(form_content);
	var title = form_content[1].value;
	var comment = form_content[2].value;
	console.log(comment);
	if (title.length ==0){
        $("#error").html("Title is required!");
        	// console.log("title");
        return false;
        } 
    if (comment.length ==0){
        $("#error").html("Comment is required!");
        return false;
        	// console.log("comment");
        }
}

var delete_button = function(review_id){
	console.log("in delete function",review_id);
	$("body").on('click', "button#delete_button", function(event) {
		event.preventDefault();
        // alert("delete_button!");
        
        $.ajax("./app17.php/review/1/" + review_id.toString() +"?delete",
			{	type: "GET",
				// dataType: "json",
				success: function(review_json, status, jqXHR) {
					// console.log(review_json);
					alert("delete success!");
					var last_review = $("#new_add_review");
        			last_review.remove();
				    }
			});
        
    });
    
}


