$(document).ready(function() {
	$.ajax("cookie.php/login",
	{type: "GET",
	 dataType: "json",
	 success: function(username, status, jqXHR) {
		if (username != null) {
			$("#lean_overlay").fadeOut(200);
				$('#modal').css({
					"display" : "none"
				});
				$("#modal_trigger").remove();
				var user = $('<a class="link" id="user" href="#"></a>');
				user.html("Hello Foodie ");
				$(".header-account").append(user);
				var logout = $('<a class="link" id="logout" href="#"></a>');
				logout.html("/ logout");
				$(".header-account").append(logout);
		}
	   }
	});
	

	$('#loginForm').on('submit', function(e) {
		e.stopPropagation();
		e.preventDefault();
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		console.log(username);
		console.log(password);
		$.ajax("login.php", {
			type : "POST",
			dataType: "json",
			data : {username: username, password: password},
			success : function(data, status, jqXHR) {
				//console.log("success");
				$("#lean_overlay").fadeOut(200);
				$('#modal').css({
					"display" : "none"
				});
				$("#modal_trigger").remove();
				var user = $('<a class="link" id="user" href="#"></a>');
				user.html("Hello Foodie ");
				$(".header-account").append(user);
				var logout = $('<a class="link" id="logout" href="#"></a>');
				logout.html("/ logout");
				$(".header-account").append(logout);
				
			}
		});
		
	});
	
	$('#resgisterForm').on('submit', function(e) {
		//e.stopPropagation();
		e.preventDefault();
		//console.log($('#registerForm').serialize());
		var username = $('input[name="username"]').val();
		var email = $('input[name="email"]').val();
		var password = $('input[name="password"]').val();
		console.log(username);
		console.log(email);
		console.log(password);
		$.ajax({
			url : "register.php",
			type : "POST",
			dataType: "json",
			data : {username: username, email: email, password: password},
			success : function(data, status, jqXHR) {
				console.log("success");
				$("#lean_overlay").fadeOut(200);
				$('#modal').css({
					"display" : "none"
				});
				$("#modal_trigger").remove();
				var user = $('<a class="link" id="user" href="#"></a>');
				user.html("Hello Foodie!");
				$(".header-account").append(user);
				
			}
		});
	});
	
}); 