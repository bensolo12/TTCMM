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

      const form = document.getElementById("formResetPassword2");
      const password = document.getElementById("password");
      const confirm_password = document.getElementById("confirm_password");
      const error_message = document.getElementById("error-message");

      if (password.value !== confirm_password.value) {
        error_message.value = "Passwords do not match"
        console.log("lol");
      }
      else{
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
      }
    });
  });
