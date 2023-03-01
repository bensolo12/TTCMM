<?php
// connection to the sql database
  $servername = "localhost";
  $username = "CT4034BTUser";
  $password = "E6@g9xx9";
  $dbname = "s4005098_CT4034DB";

  $connection = new mysqli($servername, $username, $password, $dbname);

  if($connection->connect_error){
    echo $connection->connect_error;
  }
 ?>
