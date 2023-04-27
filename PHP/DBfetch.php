<?php
// This file is designed to accept a table,search filter and return filiters from any JS ajax call to fetch data from a table

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_POST["fetchType"] == "Multiple"){
  multiple();
}



function multiple(){
  include "dbConfig.php";
  $filter = $_POST["filter"];
  $return = $_POST["return"];
  $SQL = "SELECT $return from `user_table` WHERE `role` = $filter;";
  // $SQL = "SELECT `user_id`,`first_name`,`last_name`,`email`,`date_of_birth` from `user_table` WHERE `role` = ('Employee');";
  $result = mysqli_query($connection, $SQL);
  // $num_row = mysqli_num_rows($result);
  echo json_encode($result);
}
?>
