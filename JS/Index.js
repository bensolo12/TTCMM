//this function loops 3 times to fill the news boxes with news stories
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
        // inserts the data from the php into the news box
        $('#NewsTitle'+(inc)).text(dataJson['Title']);
        $('#NewsDate'+(inc)).text(dataJson['news_date']);
        $('#NewsSummary'+(inc)).text(dataJson['body']);
        // if inc reaches the limit it stops the loop
        if (inc == 3){
          return("End")
        }
        fetch(inc);
      }
    }



  });
}

fetch(0)
