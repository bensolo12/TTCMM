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