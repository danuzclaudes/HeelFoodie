$(document).ready(function(){
	var order_id = Math.floor((Math.random() * 10) + 1);
	var addr_val = "";
	var phone1 = "";
	var phone2 = "";
	var customer = "";
	$("#Address_Input").submit(function(event){
		var addr_l1 = $("#Addr_l1").val();
		var addr_l2 = $("#Addr_l2").val();
		var addr_city = $("#Addr_city").val();
		var addr_sta = $("#Addr_sta").val();
		var addr_zip = $("#Addr_zip").val();
		addr_val = addr_l1+'\t'+ addr_l2 + '<br>'+ addr_city+','+addr_sta +','+addr_zip
		$("#test").html(addr_val);
		event.preventDefault();

	});
	$("#Contact_Input").submit(function(event){
		customer = $("#firstn").val() + $("#lastn").val()
		phone1 = $("#phone1").val();
		phone2 = $("#phone2").val();
		contact_val = title +'\t'+ lastn
		$("#test1").html(customer+'<br>'+phone1+'<br>'+phone2);
		event.preventDefault();
	});

	$("#nextstep").click(function(event){
		instant_order = new Order(order_id,customer,phone1,phone2,addr_val);
		$("#test2").html(instant_order.order_detail());

	});
	
	
	
	
	
});