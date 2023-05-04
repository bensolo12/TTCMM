<?php
// ensures the php performs the correct operation
ini_set('dispaly_errors', 'On');
error_reporting(E_ALL);
if($_POST['Function'] == 'fetch'){
  fetch();
}

function fetch(){
  $inc = $_POST['inc'];
  include"dbConfig.php";
  $sql = "SELECT `type` from `report_table` LIMIT 1 OFFSET $inc;";
  $result = mysqli_query($connection, $sql);
  $num_row = mysqli_num_rows($result);
  if($num_row > 0){
    while($row = $result->fetch_assoc()){
      echo json_encode($row);
    }
  }else{
    $resp = array("result"=>"false");
    echo json_encode($resp);
  }
  mysqli_close($connection);
}
 ?>
