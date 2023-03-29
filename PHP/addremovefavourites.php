<?php
    // Create the base SQL variable
    $sql = "";

    $command = $_POST["command"];
    $user_id = $_POST["user_id"];
    $report_id = $_POST["report_id"];

    if ($command == "Favourite") {
        // ADD to favourites table
        $sql = "INSERT INTO favourites_table(user_id, report_id) VALUES ('$user_id', '$report_id')";
    } else if ($command == "Unfavourite") {
        // REMOVE from favourites table
        $sql = "DELETE FROM `favourites_table` WHERE user_id = '$user_id' AND report_id = '$report_id'";
    } else {
        echo "none";
        return;
    }

    if ($sql == "") {
        echo "none";
        return;
    }

    // Get access to the code in the config.php file to access the database
    include "../PHP/dbConfig.php";

    // If the query is executed successfully then echo back "Success"
    if(mysqli_query($connection, $sql)) {
        echo "Success";
    //Otherwise, echo back the error and return
    } else {
        echo mysqli_error($connection);
        return;
    }
