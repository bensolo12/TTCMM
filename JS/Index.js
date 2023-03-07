
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
        if (inc == 0){
          // inserts the data from the php into the details table
          $('#NewsTitle1').text(dataJson['Title']);
          // $('#NewsDate1').text(dataJson['news_date']);
          $('#NewsSummary1').text(dataJson['body']);
        }else if (inc == 1) {
          // inserts the data from the php into the details table
          $('#NewsTitle2').text(dataJson['Title']);
          // $('#NewsDate1').text(dataJson['news_date']);
          $('#NewsSummary2').text(dataJson['body']);
        }else if (inc == 2) {
          // inserts the data from the php into the details table
          $('#NewsTitle3').text(dataJson['Title']);
          // $('#NewsDate1').text(dataJson['news_date']);
          $('#NewsSummary3').text(dataJson['body']);
          return("End")
        }
        inc = inc + 1;
        fetch(inc);
      }
    }



  });
}

fetch(0)
