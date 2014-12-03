var restaurant = function (rest_json) {
	this.rid = rest_json.rid;
	this.rname = rest_json.rname;
	if (rest_json.registerDate) {
		this.registerDate = new Date(rest_json.registerDate);
	} else {
		this.registerDate = null;
	}
	this.address = rest_json.address;
	this.city = rest_json.city;
	this.state = rest_json.state;
	this.zipcode = rest_json.zipcode;
	this.phone = rest_json.phone;
	this.openHour = rest_json.openHour;
	this.closedHour = rest_json.closedHour;
	this.min_order = rest_json.min_order;
	this.delivery_fee = rest_json.delivery_fee;
	this.latitude = rest_json.latitude;
	this.longitude = rest_json.longitude;
	this.logo = rest_json.logo;
	
};

restaurant.prototype.getLat = function() {
	return this.lat;
};
restaurant.prototype.getLng = function() {
	return this.lng;
};

restaurant.prototype.showInfo = function() {
	var rdiv = $("<div></div>");
    rdiv.addClass('rest-info');
    
    //var rname_div = $("<div></div>");
    //rname_div.addClass('rname');
    //rname_div.html(this.rname);
    //rdiv.append(rname_div);

	var raddress_div = $("<div></div>");
    raddress_div.addClass('address');
    raddress_div.html(this.address);
    rdiv.append(raddress_div);

	var rcity_div = $("<div></div>");
    rcity_div.addClass('city-state');
    rcity_div.html(this.city + ", " + this.state, this.zipcode);
    rdiv.append(rcity_div);

	var phone_div = $("<div></div>");
    phone_div.addClass('phone');
    phone_div.html(this.phone);
    rdiv.append(phone_div);

    var openHour_div = $("<div></div>");
    openHour_div.addClass('openHour');
	openHour_div.html("Open Hour:<br />" + this.openHour + "-" + this.closedHour);
    rdiv.append(openHour_div);

    rdiv.data('rest', this);

    return rdiv; 
};
