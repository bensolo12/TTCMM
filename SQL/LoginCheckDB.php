<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

		$email = $_POST['email'];
        $password = $_POST['password'];;

		include "../dbConfig.php";

        $sql = "INSERT INTO `user_table`(user_id, contractor_id, first_name, last_name, email, date_of_birth, 
                                        user_password)"."values".
		"($email, '$password')";

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";
        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
    }
?>