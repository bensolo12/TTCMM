<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //Get the report id from the superglobal $_POST and store it in a variable called id
    $id = $_POST["report_id"];

    //Make a sql statement to get all the info on a report based on the given report id
    $sql = "SELECT * FROM `report_table` WHERE report_id='".$id."'";

    //Get access to the code in the config.php file (used to access the database)
    include "../PHP/dbConfig.php";

    //Get the result of the sql query being executed
    $res = mysqli_query($connection, $sql);

    //If there's no result then echo "none" back
    if(!$res){
        echo "none";
    }

    //$role = $_SESSION['user_role'];
    //Get the number of rows in the result of the query
    $num_row = mysqli_num_rows($res);

    //Get the row from the result of the query
    $row = mysqli_fetch_assoc($res);
    
    $role = $_SESSION['user_role'];
    //If there's one row in the result then encode the row and echo it back
    if($num_row == 1){
        $response = array('row' => $row, 'role' => $role);
        echo json_encode($response);
        
    //Otherwise echo back "none"
    } else {
        echo "none";
    }