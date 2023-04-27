$.ajax({
    type: "POST",
    url: "../PHP/DBfetch.php",
    data:"fetchType=Multiple&filter=('Employee')&return=`user_id`,`first_name`,`last_name`,`email`,`date_of_birth`",
    datatype: "json",
    success: function(msg){
        if (msg == "none") {
            // Add a message saying no reported reports could be found
        } else {
          // employees = JSON.parse(msg);
          console.log(msg)

        }
    }
})
