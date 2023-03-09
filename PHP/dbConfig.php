<?php
    $servername = "localhost";
    $username = "CT503823Grp1";
    $password = "t37eN3a5$";
    $dbname = "TTCMM";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if($connection->connect_error) {
        echo $connection->connect_error;
    }
?>
