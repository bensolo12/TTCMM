$('#formLoginUser').submit(function(event){
	formData = $('#formLoginUser').serialize();
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "../SQL/LoginCheckDB.php",
		data: formData+"&phpFunction=create",
	    success: function(msg){ 
			$("#divMessage").html(msg);	
			alert(msg);
	    },
		error: function(msg){ 
			console.log(msg);
	    }
	});
});