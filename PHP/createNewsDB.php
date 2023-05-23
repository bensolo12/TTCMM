<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        session_start();
        $newsTitle = $_POST['NewsTitle'];
		$newsBody = $_POST['newsBody'];
		//$image = $_SESSION['fileName'];
        $date = date("Y/m/d");
        $userID = $_SESSION["user_id"];;
        
		include "../PHP/dbConfig.php";
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