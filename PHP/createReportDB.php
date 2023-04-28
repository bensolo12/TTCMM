<?php
if ($_POST['phpFunction'] == 'create')
    create();
function create()
{
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

    $sql = "INSERT INTO `report_table`(user_id, type, other, longitude, latitude, description, report_status, date_reported)" . "values" .
        "($userID, '$issueType', '$otherIssue', '$long', '$lat', '$problemDescription', '$reportStatus', '$dateReported')";

        if (mysqli_query($connection, $sql)) {
        
            $reportId = mysqli_insert_id($connection);
            $imageLocations = array();
        
            if (count($_FILES['images']['tmp_name']) > 0) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $image_name = $_FILES['images']['name'][$key];
                    $image_size = $_FILES['images']['size'][$key];
                    $image_tmp = $_FILES['images']['tmp_name'][$key];
                    $image_type = $_FILES['images']['type'][$key];
                    
                    if ($image_type == "image/jpeg" || $image_type == "image/png" || $image_type == "") {
                        if ($image_size < 5000000) { // 5 MB limit
                            $image_path = "../media/report_" . $reportId . "_" . $image_name;
                            move_uploaded_file($image_tmp, $image_path);
        
                            $sql = "INSERT INTO `images_table`(image_location, report_id) VALUES ('$image_path', '$reportId')";
                            mysqli_query($connection, $sql);
                        } else {
                            echo "Error: Image is too large.";
                        }
                    } else {
                        echo "Error: Invalid image type.";
                    }
                }
            }
        } else {
            echo mysqli_error($connection);
            return;
        }

    mysqli_close($connection);
}
?>