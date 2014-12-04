var Order = function (order_json_obj) {
 	this.oid = order_json_obj.oid;
 	this.cid = order_json_obj.cid;
 	this.oaddress = order_json_obj.oaddress;
 	this.ophone = order_json_obj.ophone;
 	if (order_json_obj.odate) {
 		this.odate = new Date(order_json_obj.odate);
 	} else {
 		this.odate = null;
 	}
 	
 	this.order_detail = function () {
 		return "welcome, customer "+ this.cid;
 			   // ", Your phone number is: "+this.ophone+". Your address is: "+ this.oaddress;
 	}
};

Order.prototype.makeOrderInfoDiv = function () {
	var return_div = $("<div></div>");
	return_div.addClass('order');

	var phone_div = $("<div></div>");
    phone_div.addClass('phone');
    phone_div.html("<span class='contact-phone'>CONTACT PHONE: </span><b>"+this.ophone+'</b>');
    return_div.append(phone_div);

    var address_div = $("<div></div>");
    address_div.addClass('address');
    address_div.html("DELIVERY ADDRESS:<b> "+this.oaddress+'</b>');
    return_div.append(address_div);

    var order_date_div = $("<div></div>");
    order_date_div.addClass('order-date');
    if (this.odate) {
	order_date_div.html("ORDER PLACED:<b> "+this.odate.toDateString()+"</b>");
    } else {
	order_date_div.html("No Order date");
    }
    return_div.append(order_date_div);

    return_div.data('todo', this);

    return return_div;
}
// Order.pototype.makeMenuOrderInfoDiv = function() {

// }