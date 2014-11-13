var Order = function (OID, Customer, Phone1, Phone2, Addr) {
 	this.OID = OID;
 	this.customer = Customer;
 	this.phone1 = Phone1;
 	this.phone2 = Phone2;
 	this.addr = Addr;
 	this.order_detail = function () {
 		return ""+ this.customer+"<br>"+this.phone1+ "<br>"+ this.addr;
 	}
};
