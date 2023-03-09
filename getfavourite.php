<?php
    //Get the report id + user id from the superglobal $_POST
    $report_id = $_POST["report_id"];
    $user_id = $_POST["user_id"];

    //Make a sql statement to get all the info on a report based on the given report id
    $sql = "SELECT * FROM `favourites_table` WHERE report_id='".$report_id."' AND user_id='".$user_id."'";

    //Get access to the code in the config.php file (used to access the database)
    include "config.php";

    //Get the result of the sql query being executed
    $res = mysqli_query($connection, $sql);

    //If there's no result then echo "none" back
    if(!$res){
        echo "none";
    }

    //Get the number of rows in the result of the query
    $num_row = mysqli_num_rows($res);

    //Get the row from the result of the query
    $row = mysqli_fetch_assoc($res);
    
    //If there's one row in the result then encode the row and echo it back
    if($num_row == 1){
        echo json_encode($row);
    //Otherwise echo back "none"
    } else {
        echo "none";
    }