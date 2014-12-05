var Customer = function(customer_json){
	console.log(customer_json);
    this.customer_id = customer_json.customer_id;
	this.username = customer_json.username;
	this.password = customer_json.password;
	this.regi_date = customer_json.regi_date;
	this.firstname = customer_json.firstname;
	this.lastname = customer_json.lastname;
	this.middlename = customer_json.middlename;
	this.email = customer_json.email;
	this.cellphone1 = customer_json.cellphone1;
	this.cellphone2 = customer_json.cellphone2;
	this.addr_l1 = customer_json.addr_l1;
    this.addr_l2 = customer_json.addr_l2;
	this.city = customer_json.city;
	this.state = customer_json.state;
    this.zipcode = customer_json.zipcode;
}

Customer.prototype.makeContact_InfDiv = function() {
    
    var cellphone_repr= this.cellphone1.substr(0,3)+'-'+this.cellphone1.substr(3,3)+'-'+this.cellphone1.substr(6,4);

    var addr_inf_div = $("<div></div>");
    addr_inf_div.attr('id',"Def_Addr_display");

    var name_display=$("<p></p>");
    var phone_display=$("<p></p>");
    var add_l1_display=$("<p></p>");
    var add_l2_display=$("<p></p>");
    var city_state_zip_display=$("<p></p>");
    name_display.attr('id',"name_display");
	phone_display.attr('id',"phone_display");
	add_l1_display.attr('id',"add_l1_display");
	add_l2_display.attr('id',"add_l2_display");
    city_state_zip_display.attr('id',"city_state_zip_display");
    
    var full_name = this.firstname+' , '+this.lastname;
    name_display.html(full_name);
    phone_display.html(cellphone_repr);
    add_l1_display.html(this.addr_l1);
    add_l2_display.html(this.addr_l2);
    var city_state_zip = this.city +' , '+ this.state +' , '+this.zipcode
    city_state_zip_display.html(city_state_zip)

    addr_inf_div.append(name_display);
    addr_inf_div.append(phone_display);
    addr_inf_div.append(add_l1_display);
    addr_inf_div.append(add_l2_display);
    addr_inf_div.append(city_state_zip_display);

    addr_inf_div.data('contact_inf', this);

    return addr_inf_div
};