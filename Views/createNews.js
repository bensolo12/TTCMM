$('#formCreateNews').submit(function(event){
	formData = $('#formCreateNews').serialize();
    event.preventDefault();
	console.log("gay")

	$.ajax({
		type: "POST",
		url: "createNewsDB.php",
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
