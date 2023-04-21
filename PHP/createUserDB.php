<?php
if($_POST['phpFunction'] == 'create')
		create();
    function create(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dateOfBirth = $_POST['DoB'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$role = $_POST['role'];

        $companyName = $_POST['companyName'];
        $phoneNumber = $_POST['phoneNumber'];
        $companyDescription = $_POST['companyDescription'];
        $companyAddress = $_POST['companyAddress'];

		include "../PHP/dbConfig.php";

        $sql = "INSERT INTO `user_table`(first_name, last_name, email, date_of_birth,
                                        user_password, role)"."values".
		"('$firstName', '$lastName', '$email', '$dateOfBirth', '$hashedPassword', '$role')";

        if(!empty($companyName) and !empty($phoneNumber) and !empty($companyDescription) and !empty($companyAddress)){
            $sql = "INSERT INTO `contractor_table`(company_name, phone_number, company_description, company_address)"."values".
		            "('$companyName', '$phoneNumber', '$companyDescription', '$companyAddress')";
        }

        if(mysqli_query($connection, $sql)) {
            echo "Successfully registered.";
        } else {
            echo mysqli_error($connection);
            return;
        }
        mysqli_close($connection);
    }
?>
