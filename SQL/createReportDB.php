<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

		$userID = 1;
        $issueType = $_POST['issueSelect'];
        $alternateAddress = $_POST['manualAddress'];
        $long = $_POST['lng'];
        $lat = $_POST['lat'];
        $problemDescription = $_POST['problemDescription'];
        $reportStatus = "Awaiting";
        $dateReported = date('d/m/Y H:i:s');

		include "../dbConfig.php";

        //NEED TO ADD
        //Fet current user ID (once log in is working)
        //Get lat/long from the alternate address field
        if (is_null($alternateAddress)){
            $sql = "INSERT INTO `report_table`(user_id, type, long, lat, description, report_status, date_reported)"."values".
			   "($userID, '$issueType', '$long', '$lat', '$problemDescription', '$reportStatus', '$dateReported')";
        }
        else{
            $sql = "INSERT INTO `report_table`(user_id, type, description, report_status, date_reported)"."values".
			   "($userID, '$issueType', '$problemDescription', '$reportStatus', '$dateReported')";
        }
        //Create an insert for the images table, linking the report_id with each image submitted

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";
        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
    }
?>