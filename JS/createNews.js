$('#formCreateNews').submit(function(event){
	formData = $('#formCreateNews').serialize();
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "../PHP/createNewsDB.php",
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
