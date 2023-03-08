<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        $newsTitle = $_POST['NewsTitle'];
		$newsBody = $_POST['newsBody'];
		//$image = $_POST['newsImage'];
        $date = date("d/m/Y");
        $userID = 2;
        
		include "dbConfig.php";
		$sql = "INSERT INTO `news_table`(user_id, Title, news_date, body)".
			   " values".
			   "('$userID', '$newsTitle', '$date' , '$newsBody')";

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";
        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
    }
?>