<?php
    $commentText = $_POST['comment_text'];
    $reportID = $_POST['report_id'];
    $date = $_POST['comment_date'];
    $userID = $_POST['user_id'];

    include "../PHP/dbConfig.php";
    // $sql = "INSERT INTO `comments_table`(user_id, report_id, comment_text, comment_date)".
    // 	   " values".
    // 	   "('$userID', '$reportID', '$commentText' , '$date')";
    $sql = "INSERT INTO `comments_table`(user_id, report_id, comment_text, comment_date) VALUES ('$userID', '$reportID', '$commentText' , '$date')";

    if(mysqli_query($connection, $sql)) {
        echo "Successfully commented.";
    } else {
        echo mysqli_error($connection);
        return;
    }	
    mysqli_close($connection);