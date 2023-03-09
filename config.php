<?php
    //Set the details used to access the database
    $servername = "127.0.0.1";
    //$username = "CT503823Grp1";
    $username = "root";
    $password = "";
    //$password = "4t8r8X0l$";
    $dbname = "TTCMM";

    //Create a connection to the mysql database
    $connection = new mysqli($servername, $username, $password, $dbname);

    //If the connection fails to be created then echo that there's a problem
    if (!$connection)
    {
        echo "Error: Could not access the database";
    }
