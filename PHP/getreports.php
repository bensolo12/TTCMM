<?php
    // Create the base SQL command
    $sql = "SELECT * FROM `report_table`";

    $filters = $_POST["filters"];
    $favourites = $_POST["favourites"];
    $user_id = $_POST["user_id"];
    $statusFilter = "";

    // If an asterisk is found in the filter string (representing a status filter)
    if (strpos($filters, "*") !== false) {
        // Split the filter string by the asterisk
        $exploded = explode("*", $filters);
        // The first part of the string is the filters
        $filters = $exploded[0];
        // The second part of the string is the status filter
        $statusFilter = $exploded[1];
        if ($statusFilter == "'Any'") {
            $statusFilter = "";
        }
    }

    // If there is a filter for problem type
    if ($filters != "") {
        // Get all reports where the problem type is in the filter array
        $sql = $sql . " WHERE type IN ($filters)";
    }

    // If there is a filter for status
    if ($statusFilter != "") {
        // Preface string to connect to previous query
        $preface = " AND ";
        // However, if type filters is empty then it must become WHERE because there's nothing to connect to
        if ($filters == "") {
            $preface = " WHERE ";
        }
        // Create the string
        $sql = $sql . $preface . "report_status = $statusFilter";
    }

    if ($favourites === "true") {
        $preface = " AND ";
        if ($filters == "" && $statusFilter == "") {
            $preface = " WHERE ";
        }

        $sql = $sql . $preface . "report_id IN (SELECT report_id FROM favourites_table WHERE user_id = $user_id)";
    }

    // Get access to the code in the config.php file to access the database
    include "../PHP/dbConfig.php";
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