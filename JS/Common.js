// When the user scrolls the page, execute myFunction
window.onscroll = function() {NavStick()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function NavStick() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}


//Checks what the user is logged in as
$.ajax({
  type: "POST",
  url: "../PHP/Common.php",
  data: "phpFunction=checkLogin",
  success: function(msg){
			// dependend on user role page contents are modified
      if(msg == "Citizen"){
        CitizenNav();
      }else if (msg == "Contractor"){
        ContractorNav();
      }else if (msg == "Employee"){
        EmployeeNav();
      }else if (msg == "Admin"){
        AdminNav();
      }

  },
  error: function(msg){
    console.log(msg);
  }
});

//clears the navbar to allow a new navbar to take its place
function ClearBar(){
  $("#NavHome").remove()
  $("#NavReport").remove()
  $("#NavContact").remove()
  $("#NavSearch").remove()
  $("#NavSignIn").remove()
  $('#NavView').remove()

}

function logout(){
  $.ajax({
    type: "POST",
    url: "../PHP/Common.php",
    data: "phpFunction=logout",
    success: function(msg){
      window.location = "../Views/Index.html";
    },
    error: function(msg){
      console.log(msg);
    }
  });
}

//adds the new navbar for citizen
function CitizenNav(){
  nav=$("#NavList")
  ClearBar();
  nav.append('<li><a class="NavActive" href="Index.html">Home</a></li>');
  nav.append('<li><a href="ReportPage.php">Report Issue</a></li>');
  nav.append('<li id="NavView"><a href="view-problems.html">View Problems</a></li>');
  nav.append('<li><a href="ContactUs.html">Contact Us</a></li>');
  nav.append('<li style="float:right"><a href="javascript:logout()" id="NavSignOut">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignin">Account</a></li>');
  nav.append('<li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>');
}



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
  nav.append('<li style="float:right"><a href="javascript:logout()" id="NavSignOut">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignIn">Account</a></li>');
  nav.append('<li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>');
  prompt.append('<a href="Jobs.html" class="ButtonLink">View your Jobs</a><br>');
  prompt.append('<p style="margin-top:30px;">View your accepted jobs and any jobs that are availiable for you to accept</p>');
}
//creates navbar for the employees
function EmployeeNav(){

  buttons=$("#Buttons")
  buttons.append('<p><button id="assign" text="Assign To Contractor" type="submit"></button></p>');
  buttons.append('<p><button id="reportFake" text="Report as Fake" type="submit"></button></p>');
  nav=$("#NavList")
  prompt=$("#ReportPrompt")
  ClearBar();
  $("#ReportLink").remove()
  $("#ReportText").remove()
  nav.append('<li><a class="NavActive" href="Index.html">Home</a></li>');
  nav.append('<li><a href="view-problems.html">User Reports</a></li>');
  nav.append('<li><a href="createNews.html">News</a></li>');
  nav.append('<li><a href="ReportPage.php">Create Reports</a></li>');
  nav.append('<li><a href="stats.html">Statistics</a></li>');
  nav.append('<li><a href="Contractors.html">Contractors</a></li>');
  nav.append('<li style="float:right"><a href="javascript:logout()" id="NavSignOut">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignIn">Account</a></li>');
  nav.append('<li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>');
  prompt.append('<a href="UserReports.html" class="ButtonLink">View User Reports</a><br>');
}

//adds the new navbar for citizen
function AdminNav(){
  nav=$("#NavList")
  ClearBar();
  nav.append('<li><a class="NavActive" href="Index.html">Home</a></li>');
  nav.append('<li><a href="CreateCouncil.html">Create Council Account</a></li>');
  nav.append('<li style="float:right"><a href="javascript:logout()" id="NavSignOut">Sign Out</a></li>');
  nav.append('<li style="float:right"><a href="Account.html" id="NavSignin">Account</a></li>');
}
