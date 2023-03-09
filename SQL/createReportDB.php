<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

		$userID = 1;
        $issueType = $_POST['issueSelect'];
        $long = $_POST['lng'];
        $lat = $_POST['lat'];
        $problemDescription = $_POST['problemDescription'];
        $reportStatus = "Awaiting";
        $dateReported = date('d/m/Y H:i:s');
        // $image = $_POST['image-upload'];
        // $imageName = $_FILES['image-upload']['name'];
        // $imageType = $_FILES['image-upload']['type'];
        // $imageError = $_FILES['image-upload']['error'];
        // $imageTemp = $_FILES['image-upload']['tmp_name'];
        // $imagePath = "../Images";

        // if(!is_null($imageTemp)) {
        //     move_uploaded_file($imageTemp, $imagePath . $imageName);
        // }

		include "../dbConfig.php";

        $sql = "INSERT INTO `report_table`(user_id, type, description, report_status, date_reported)"."values".
			"($userID, '$issueType', '$problemDescription', '$reportStatus', '$dateReported')";

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";
        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
    }
?>