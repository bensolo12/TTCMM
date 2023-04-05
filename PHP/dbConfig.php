<?php
    $servername = "localhost";
    $username = "testUser";
    $password = "J1269c@qp";
    $dbname = "ttcmm2";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if($connection->connect_error) {
        echo $connection->connect_error;
    }
?>
