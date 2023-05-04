$(document).ready(function() {
    $('#formResetPassword').submit(function(event) {
      event.preventDefault();
      
      var formData = new FormData(this);
      
      $.ajax({
        type: "POST",
        url: "../PHP/changeUserPass.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(msg){
          $("#divMessage").html(msg);	
          alert(msg);
        },
        error: function(msg){
          console.log(msg);
        }
      });
    });

    $('#formResetPassword2').submit(function(event) {
      event.preventDefault();
      
      var formData = new FormData(this);
      
      $.ajax({
        type: "POST",
        url: "../PHP/changeUserPass.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(msg){
          $("#divMessage").html(msg);	
          alert(msg);
        },
        error: function(msg){
          console.log(msg);
        }
      });
    });
  });
