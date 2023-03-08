$('#formCreateReport').submit(function(event){
	formData = $('#formCreateReport').serialize();
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "../SQL/createReportDB.php",
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
