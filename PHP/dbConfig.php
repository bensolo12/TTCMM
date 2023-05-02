<?php
  // connection to the sql database
  $servername = "localhost";
  $username = "testUser2";
  $password = "S83u6^g9e";
  $dbname = "ttcmm2";

  $connection = new mysqli($servername, $username, $password, $dbname);

  if($connection->connect_error){
    echo $connection->connect_error;
  }
 ?>
