<?php
    // Create the base SQL command
    $sql = "SELECT * FROM `favourites_table`";

    // Get access to the code in the config.php file to access the database
    include "config.php";
    // Get the result from executing the sql query
    $res = mysqli_query($connection, $sql);
    // Create an array to store the rows from the query
    $rows = array();
    
    // If there are no results then echo back "none"
    if(!$res) {
        echo "none";
    // Otherwise, loop through the result, adding all the rows to the rows array
    } else {
        while ($r = mysqli_fetch_assoc($res)) {
            $rows[] = $r;
        }

        // If rows is empty afterwards then echo back "none"
        if (count($rows) == 0) {
            echo "none";
        // Otherwise, echo back the array of rows
        } else {
            echo json_encode($rows);
        }
    }