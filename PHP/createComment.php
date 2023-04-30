<?php
        $commentText = $_POST['addCommentsField'];
		$reportID = $_POST['reportID'];
        $date = $_POST['date'];
        $userID = $_POST['userID'];
        
		include "../PHP/dbConfig.php";
		$sql = "INSERT INTO `comments_table`(user_id, report_id, comment_text, comment_date)".
			   " values".
			   "('$userID', '$reportID', '$commentText' , '$date')";

        if(mysqli_query($connection, $sql)) {
            echo "Successfully commented.";
        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
?>