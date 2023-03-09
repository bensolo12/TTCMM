<?php
if($_POST['phpFunction'] == 'create') 
		create();
    function create(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

		$userID = 4;
        $contractorID = 1;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dateOfBirth = $_POST['DoB'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //$role = $_POST['role'];

		include "../dbConfig.php";

        //NEED TO ADD
        //Submit the user info
        //Get user and contractor ID's auto incrementing
        //Figure out the contractor signup stuff
        //Add password hashing
        $sql = "INSERT INTO `user_table`(user_id, contractor_id, first_name, last_name, email, date_of_birth, 
                                        user_password)"."values".
		"($userID, '$contractorID', '$firstName', '$lastName', '$email', '$dateOfBirth', '$password')";

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";
        } else {
            echo mysqli_error($connection);
            return;
        }	
        mysqli_close($connection);
    }
?>