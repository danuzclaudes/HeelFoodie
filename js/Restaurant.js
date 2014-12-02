var Restaurant = function (json) {
	this.rid = json.rid;
	this.rname = json.rname;
	this.lat = json.latitude;
	this.lng = json.longitude;
	this.raddress = json.address+", "+json.city+", "+json.state+" "+json.zipcode;
	this.rphone = json.work_phone;
	this.isOpen = json.isOpen;
};

Restaurant.prototype.getLat = function() {
	return this.lat;
};
Restaurant.prototype.getLng = function() {
	return this.lng;
};
Restaurant.all = [];

