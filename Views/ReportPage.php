
<!DOCTYPE html>
<html>
<head>
    <title>Council Report Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style.CSS">
</head>
<body class="bodyWrapper">
    <nav>
    <!-- space and framework left to make navbar collapsable if needed -->
          <div class="">
            <ul class="nav">
              <li><a class="NavActive" href="Index.html">Home</a></li>
              <li><a href="Report.html">Report Issue</a></li>
              <li><a href="ContactUs.html">Contact Us</a></li>
              <li style="float:right"><a href="Index.html" id="NavSignIn">Sign In</a></li>
              <!-- <li style="float:right"><a href="AccountSettings.html">Account Settings</a></li> -->
              <li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>
            </ul>
          </div>
    </nav>

    <div class="container mt-5 contentWrapper">
        <h1 class="text-center">Report a Problem</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. </p>
        <ul class="nav nav-tabs mt-5 reportForm">
            <li class="nav-item">
                <a class="nav-link active reportFormTab" data-toggle="tab" href="#step1">Step 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link reportFormTab" data-toggle="tab" href="#step2">Step 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link reportFormTab" data-toggle="tab" href="#step3">Step 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link reportFormTab" data-toggle="tab" href="#step4">Step 4</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="step1">
                <?php include 'Sub-Views/Report-Information.php';?>
            </div>
            <div class="tab-pane" id="step2">
                <?php include 'Sub-Views/Report-IssueType.php';?>
            </div>
            <div class="tab-pane" id="step3">
                <?php include 'Sub-Views/Report-Location.php';?>
            </div>
            <div class="tab-pane" id="step4">
                <?php include 'Sub-Views/Report-FurtherDetails.php';?>
            </div>
        </div>
    </div>

    <footer>
      <div class="" style="width:45%;">
        <a href="ContactUs.html">Contact Us</a><br>
        Report a bug: CheltBugReport@email.com
      </div>
      <div class="" style="width:45%;">
      Made by TEMA TEMA inc
      </div>
      <div class="" style="width:10%;">
        <img src="../Images/tematemalogo.png" height="40px" width="40px" alt="">
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('.nav-tabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
</body>
</html>