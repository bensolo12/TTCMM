$.ajax({
  type: "POST",
  url: "../PHP/Index.php",
  data: "phpFunction=fetch",
  success: function(msg){
    dataJson = JSON.parse(msg);
    // inserts the data from the php into the details table
    $('#NewsTitle1').text(dataJson['Title']);
    // $('#Brand').text(dataJson['news_date']);
    $('#NewsSummary1').text(dataJson['body']);

    if(dataJson['Status'] == "Stolen"){
      $('#report').prop("disabled");
    }
  }
});
