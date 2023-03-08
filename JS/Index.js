
function fetch(inc){
  $.ajax({
    type: "POST",
    url: "../PHP/Index.php",
    data: "inc="+inc+"&phpFunction=fetch",
    success: function(msg){
      console.log(msg)
      dataJson = JSON.parse(msg);
      if(dataJson['result'] == 'false'){
        console.log("No Story Detected")
      }else {
        inc = inc + 1;
        // inserts the data from the php into the details table
        $('#NewsTitle'+(inc)).text(dataJson['Title']);
        $('#NewsDate'+(inc)).text(dataJson['news_date']);
        $('#NewsSummary'+(inc)).text(dataJson['body']);
        $('#NewsBox'+(inc)).css("background-image", ("url(https://s4005098-ct4009.uogs.co.uk/Images/"+dataJson['image']+")"))
        if (inc == 3){
          return("End")
        }
        fetch(inc);
      }
    }



  });
}

fetch(0)
