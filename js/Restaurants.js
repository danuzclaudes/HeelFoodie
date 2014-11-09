var Restaurants = function (rid, rname, lat, lng, raddress, rphone, isOpen) {
	this.rid = rid;
	this.rname = rname;
	this.lat = lat;
	this.lng = lng;
	this.raddress = raddress;
	this.rphone = rphone;
	this.isOpen = isOpen;
}

Restaurants.prototype.getLat = function() {
	return this.lat;
}
Restaurants.prototype.getLng = function() {
	return this.lng;
}