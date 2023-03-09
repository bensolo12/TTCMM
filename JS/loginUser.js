$('#formLoginUser').submit(function(event){
	formData = $('#formLoginUser').serialize();

	$.ajax({
		type: "POST",
		url: "../PHP/LoginCheckDB.php",
		data: formData+"&phpFunction=create",
		datatype: 'json',
	    success: function(msg){
			console.log(msg)
			dataJson = JSON.parse(msg)
            if(dataJson['result'] =='false') {
                $("#msg").html("Wrong username or password");
            } else {
				window.location = "../Views/Index.html";
	    	}
		},
		error: function(msg){
			console.log(msg);
	    }
	});
	event.preventDefault();
});
