var Review = function(review_json){

	this.food_review_id = customer_json.food_review_id
	this.menu_id = customer_json.menu_id
	this.customer_id = customer_json.customer_id
	this.rating = customer_json.rating
	this.comment = customer_json.comment
	this.email = customer_json.email
	this.reviewimage = customer_json.reviewimage

}

Customer.prototype.makeReview_infDiv = function() {
    // var cidiv = $("#my_contact_inf");
        var rate = this.rating;
        var score = rate*100/5;
        var title = this.title;
        var comment = this.comment;
        // date might need modified
        var myDate = new Date();
        var displayDate = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
        var time = myDate.getHours() + ":" + myDate.getMinutes() + ":" + myDate.getSeconds();
        // var review_all_display = $("div.review_all_display");
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
        review_display.append(user_profile);
        rating_part.append(rate_display);
        rating_part.append(rate_blank_display);
        rating_date.append(rating_part);
        rating_date.append(date_display);
        review_text_display.append(rating_date);
        review_text_display.append(title_display);
        review_text_display.append(comment_display);
        review_display.append(review_text_display);
        // review_all_display.append(review_display);
    return addr_inf_div
};