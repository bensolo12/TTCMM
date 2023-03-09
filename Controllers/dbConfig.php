<?php
    $servername = "localhost";
    $username = "CT503823Grp1";
    $password = "4t8r8X0l$";
    $dbname = "ttcmm";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if($connection->connect_error) {
        echo $connection->connect_error;
    }
?>