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
var user_role = '<%=session.getAttribute("user_role")%>';
if(user_role == "citizen"){
  ClearBar();
  CitizenNav();
}
else if(user_role == "contractor"){
  ClearBar();
  ContractorNav();
}
else if(user_role == "employee"){
  ClearBar();
  EmployeeNav();
}
//clears the navbar to allow a new navbar to take its place
function ClearBar(){
  $("#NavHome").remove()
  $("#NavReport").remove()
  $("#NavContact").remove()
  $("#NavSearch").remove()
  $("#NavSignIn").remove()
}

//adds the new navbar for citizen
function CitizenNav(){
  nav=$("#NavList")
  ClearBar();
  nav.append('<li><a class="NavActive" href="Index.html">Home</a></li>');
  nav.append('<li><a href="Report.html">Report Issue</a></li>');
  nav.append('<li><a href="ContactUs.html">Contact Us</a></li>');
  nav.append('<li style="float:right"><a href="Index.html" id="NavSignIn">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignIn">Account</a></li>');
  nav.append('<li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>');
}

fetch(0)


var user = "NL"
//creates navbar for the contractors
function ContractorNav(){
  nav=$("#NavList")
  prompt=$("#ReportPrompt")
  ClearBar();
  $("#ReportLink").remove()
  $("#ReportText").remove()
  nav.append('<li><a class="NavActive" href="Index.html">Home</a></li>');
  nav.append('<li><a href="Jobs.html">Jobs</a></li>');
  nav.append('<li><a href="ContactUs.html">Contact Us</a></li>');
  nav.append('<li style="float:right"><a href="Index.html" id="NavSignIn">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignIn">Account</a></li>');
  nav.append('<li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>');
  prompt.append('<a href="Jobs.html" class="ButtonLink">View your Jobs</a><br>');
  prompt.append('<p style="margin-top:30px;">View your accepted jobs and any jobs that are availiable for you to accept</p>');
}
//creates navbar for the employees
function EmployeeNav(){
  nav=$("#NavList")
  prompt=$("#ReportPrompt")
  ClearBar();
  $("#ReportLink").remove()
  $("#ReportText").remove()
  nav.append('<li><a class="NavActive" href="Index.html">Home</a></li>');
  nav.append('<li><a href="viewReported.php">User Reports</a></li>');
  nav.append('<li><a href="createNews.html">News</a></li>');
  nav.append('<li><a href="stats.html">Statistics</a></li>');
  nav.append('<li><a href="Contractors.html">Contractors</a></li>');
  nav.append('<li style="float:right"><a href="Index.html" id="NavSignIn">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignIn">Account</a></li>');
  nav.append('<li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>');
  prompt.append('<a href="UserReports.html" class="ButtonLink">View User Reports</a><br>');
}
