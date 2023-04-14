<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include 'dbConfig.php';

		$userID = $_POST['userId'];
        $issueType = $_POST['issueSelect'];
        $otherIssue = mysqli_real_escape_string($connection, $_POST['otherIssue']);
        $long = $_POST['lng'];
        $lat = $_POST['lat'];
        $problemDescription = mysqli_real_escape_string($connection, $_POST['problemDescription']);
        $reportStatus = "Awaiting";
        date_default_timezone_set('Europe/London');
        $dateReported = date('Y/m/d H:i:s');

		include "../PHP/dbConfig.php";

        $sql = "INSERT INTO `report_table`(user_id, type, other, longitude, latitude, description, report_status, date_reported)"."values".
			"($userID, '$issueType', '$otherIssue', '$long', '$lat', '$problemDescription', '$reportStatus', '$dateReported')";

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";

            //CODE FOR THE IMAGE UPLOAD HERE, LIKELY NEED A LOOP???
            $reportId = mysqli_insert_id($connection);
            $sql = "INSERT INTO `images_table`(image_location)"."values"."($imageLocations)";

        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
    }
?>