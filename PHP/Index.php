<?php
// ensures the php performs the correct operation
ini_set('dispaly_errors', 'On');
error_reporting(E_ALL);
if($_POST['phpFunction'] == 'fetch'){
  fetch();
}


function fetch(){


  $id = $_POST['id'];
  include"../include/config.php";
// fetches and returns all data redarding the bike
  $sql = "SELECT ('Title','news_date','body') from `news_table` ORDER BY 'news_id' DESC;";
  $result = mysqli_query($connection, $sql);
  $num_row = mysqli_num_rows($result);
  // $row = mysqli_fetch_assoc($result);
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
