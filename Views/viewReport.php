<?php
function json(){
          $conn = mysqli_connect("localhost", "username", "password", "database");
          $query = "SELECT latitude, longitude FROM report_table";
          $result = mysqli_query($conn, $query);
          $data = array();
          while($row = mysqli_fetch_assoc($result)) {
            $lat = $row['latitude'];
            $lng = $row['longitude'];
            $data[] = array(
              'lat' => $lat,
              'lng' => $lng
            );
          }
          header('Content-Type: application/json');
          echo json_encode($data);
        }
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Reports</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Style.CSS">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type = "text/javascript" src = "../JS/showMap.js" > </script>


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
      width: 75%;
      text-align: left;
      border: 5px solid black;
      background-color: lightgray;
    }
    .buttons{
        right: 0;
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
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);
    include "../PHP/dbConfig.php";
    session_start();
    $reportID = $_SESSION['reportID'];
    $sql = ("SELECT * FROM `report_table`  WHERE `report_id` = '".$reportID."'");
		$result=mysqli_query($connection,$sql);
    ?>
  <div class = 'viewReported'>
    <table style="width: 100%;">
      <tr>
        <th>Problem Title</th>
        <th>Upvotes</th>
        <th>Date</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Report Status</th>
      </tr>

        <?php

        while($rows = mysqli_fetch_assoc($result)):



        ?>
        <tr>
          <td><?php echo $rows['type']; ?></td>
          <td><?php echo $rows['favourites']; ?></td>
          <td><?php echo $rows['date_reported']; ?></td>
          <td><?php echo $rows['longitude']; ?></td>
          <td><?php echo $rows['latitude']; ?></td>
          <td><?php echo $rows['report_status']; ?></td>

        </tr>


    </table>
    User description: <?php echo $rows['description']; ?>

      <?php endwhile; ?>

    <div class ="buttons">
        <button id = "contractor" type = "submit" >Assign to contractor</button>
        <button id = "fake" type = "submit" >Class as fake</button>
    </div>


    <div class="footer">
      <a href="ContactUs.html">Contact Us</a><br>
      Report a bug: CheltBugReport@email.com
      Made by TEMA TEMA inc
      <img src="../Images/tematemalogo.png" height="40px" width="40px">
    </div>
</body>
</html>
