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

        $sql = ("SELECT `user_password` FROM `user_table` WHERE `email` = '".$email."'");
        $result = mysqli_query($connection, $sql);

        $rows=mysqli_fetch_assoc($result);

        $debug = password_hash($password, PASSWORD_DEFAULT);
        $debug2 = $rows['user_password'];
        echo("INPUT RESULT=" . $debug . "');</script>");
        echo("DB RESULT=" . $debug2 . "');</script>");
       
        if(password_verify($password, $rows['user_password'])){
            echo '{"result":"false2"}';
        };
        if(password_verify($password, $rows['user_password'])){
            $sql2 = ("SELECT `user_id` FROM `user_table` WHERE `email` = '".$email."'"); 
            $result2 = mysqli_query($connection, $sql2);
            $rows2=mysqli_fetch_assoc($result2);

            session_start(); 
            echo json_encode($rows2);
            $_SESSION['user_id'] = $rows2['user_id'];
        }
        else{
            echo '{"result":"false"}';
        }

    }
?>