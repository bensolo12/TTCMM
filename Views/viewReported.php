<!DOCTYPE html>
<html>
<head>
    <title>User Reports</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">

</head>
<body>
    
    <style>

    table,th,td{
      border:3px solid black;
    }
    .sortBy{
      position: absolute;
      right: 150px;
  
    }
    .viewReported{
      width: 50%;
      text-align: left;
      border: 5px solid black;
      background-color: lightgray;
    }

    .footer {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: black;
      color: white;
      
    }

    </style>
    <nav>
<!-- space and framework left to make navbar collapsable if needed -->
      <div class="">
        <ul class="nav">
          <li><a href="Index.html">Home</a></li>
          <li><a href="Report.html">Report</a></li>
          <li><a class="NavActive" href="viewReported.php">User Reports</a></li>
          <li><a href="createNews.html">News</a></li>
          <li><a href="stats.html">Statistics</a></li>
          <li><a href="contractors.html">Contractors</a></li>
          <li style="float:right"><p>Account</p></li>
          <li style="float:right"><input type="text" name="Search" value="" placeholder="Search"></li>
          
        </ul>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <div class = 'sortBy'>
      <label for="sort">Sort by:</label>

      <select name="sort" id="sort">
        <option value="Date">Date</option>
        <option value="Favourites">Favourites</option>
        <option value="Location">Location</option>
      </select>
    </div>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);
    include "../PHP/dbConfig.php";
    $sql = ("SELECT * FROM `report_table`");
		$result=mysqli_query($connection,$sql);
    ?>
  <div class = 'viewReported'>
    <table style="width: 100%;">
      <tr>
        <th>Problem Title</th>
        <th>Upvotes</th>
        <th>Date</th>
      </tr>
      <?php while($rows=mysqli_fetch_assoc($result)):?>
        <tr>
          <td><?php echo $rows['type']; ?></td> 
          <td><?php echo $rows['favourites']; ?></td> 
          <td><?php echo $rows['date_reported']; ?></td>
          <td><button id=<?php echo $rows['report_id'] ?> onclick=" window.open('viewReport.php','_blank')">Show full report</button></td>
          <?php
          session_start();
          $reportID = $rows['report_id'];
          $_SESSION['reportID'] = $reportID;          
          ?>         

        </tr>
      <?php endwhile; ?>
      
    </table>      
    <div class="footer">
      <a href="ContactUs.html">Contact Us</a><br>
      Report a bug: CheltBugReport@email.com
      Made by TEMA TEMA inc
      <img src="../Images/tematemalogo.png" height="40px" width="40px">
    </div>
</body>
</html>