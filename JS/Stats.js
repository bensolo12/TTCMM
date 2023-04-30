var problemDict = {"Broken traffic lights":0, "Burst pipe":0, "Blocked drain":0, "Broken streetlight":0, "Exposed cables":0, "Flooding":0, "Graffiti":0, "Litter":0, "Pothole":0, "Wrecked car":0, "Other":0};
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function fetch(inc){
  $.ajax({
    type:"POST",
    url:"../PHP/StatsFetch.php",
    data:"Function=fetch&inc="+inc,
    success: function(msg){
      // console.log(msg);
      data = JSON.parse(msg);

      if(data['result'] == 'false'){
        display();
      }else{
        console.log(data['type']);
        problemDict[data['type']] = problemDict[data['type']] +  1;
        inc = inc + 1;
        fetch(inc);
        var val = problemDict["Litter"];
        console.log(val);
      }

    },
    error: function(msg){
      console.log(msg);
    }
  });
}

function display(){
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Eat', 2],
  ['TV', 4],
  ['Gym', 2],
  ['Sleep', 8]
]);

  var options = {'title':'Most Common Problems', 'width':550, 'height':400};
  var chart = new google.visualization.PieChart(document.getElementById('commonProblems'));
  chart.draw(data, options);
}

fetch(0);
