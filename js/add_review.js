/**
 * @author Yiqi Wang
 */
 $(document).ready(function(){
 	var add_review_display = $("div#review_inf");
 	add_review_display.hide();
 	$("button#add_review").click( function () {	
		add_review_display.show();
	});
	click_review_submit_button();
	

});
var click_review_submit_button = function () {
	$("button#review_submit").click(function(event){
		var form_content = $("#new_review" ).serializeArray();
		var rate = parseFloat(form_content[0].value);
		var score = rate*100/5;
		var title = form_content[1].value;
		var comment = form_content[2].value;
		var myDate = new Date();
        var displayDate = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
		var time = myDate.getHours() + ":" + myDate.getMinutes() + ":" + myDate.getSeconds();
		var review_all_display = $("div.review_all_display");
		var review_display = $('<div class="review_display"></div>');
		var review_text_display = $('<div class="review_text"></div>');
		var rating_part = $('<div class="rating"></div>');
		var rating_date = $('<div class="rating_date"></div>');
		var rate_display = $('<div id="rate" style="width:'+score+'px; overflow: hidden;" ><img src="./img/rate_star.png" alt="Rate_Star" style="width:100px;height:23px;"></div>');
		var rate_blank_display = $('<div id="rate1"><img src="./img/rate_star_blank.png" alt="Rate_Star_blank" style="width:100px;height:23px;"></div>');
		var date_display = $('<div class="date_display"><p>'+ time +'\t'+displayDate + '</p></div>');
		var title_display = $('<label class="title">'+ title +'</label>');
        var comment_display = $('<p class="comment">'+ comment +'</p>');
        var user_profile = $('<div class="user_profile"><img src="./img/user_profile.png" alt="User Profile" style="width:90px;height:100px"></div>')

        if (title.length ==0){
        	$("#error").html("Title is required!");
        	return false;
        }else if (comment.length ==0){
        	$("#error").html("Comment is required!");
        	return false;
        }

		$.ajax({
			url: "./process.php", // app.php/review
			type: "POST",
			data: form_content,
			datatype: "JSON",
            success: function(){
            		alert("Submit success!");
            		review_display.append(user_profile);
            		rating_part.append(rate_display);
            		rating_part.append(rate_blank_display);
            		rating_date.append(rating_part);
            		rating_date.append(date_display);
            		review_text_display.append(rating_date);
            		review_text_display.append(title_display);
					review_text_display.append(comment_display);
					review_display.append(review_text_display);
					review_all_display.append(review_display);
					$("div#review_inf").hide();
					$('.success').fadeIn(200).show();
					$('.error').fadeOut(200).hide();
					}
		});

		event.preventDefault();

	});
	

}
