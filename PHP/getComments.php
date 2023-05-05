<?php
    //Get the report id from the superglobal $_POST and store it in a variable called id
    $id = $_POST["report_id"];

    //Make a sql statement to get all the info on a report based on the given report id
    $sql = "SELECT user_table.first_name, comment_date, comment_text FROM `comments_table`,`user_table` WHERE user_table.user_id = comments_table.user_id AND report_id='" .$id. "'";
    //$sql = "SELECT comments_table.*, user_table.first_name FROM `comments_table` WHERE report_id='".$id."'";

    //Get access to the code in the config.php file (used to access the database)
    include "../PHP/dbConfig.php";

    //Get the result of the sql query being executed
    $res = mysqli_query($connection, $sql);

    //If there's no result then echo "none" back
    if(!$res){
        echo "none";
    } else {
        while ($r = mysqli_fetch_assoc($res)) {
            $rows[] = $r;
        }

        // If rows is empty afterwards then echo back "none"
        if (empty($rows)) {
            echo "none";
        // Otherwise, echo back the array of rows
        } else {
            echo json_encode($rows);
        }
    }