$('#formCreateUser').submit(function(event){
	formData = $('#formCreateUser').serialize();
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "../PHP/createUserDB.php",
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
