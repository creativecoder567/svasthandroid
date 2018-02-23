<?php
require 'dbconnection1.php';

$USERID="";

$data=$_POST;
$response=array();
$json = array();

if (array_key_exists('userid', $data)){
    $USERID = $data['userid'];
  }



  $sql="select * from order_history WHERE user_id = '$USERID' AND active ='1' AND pack ='Month' ";
  $result=mysqli_query($db,$sql);

  while ($row=mysqli_fetch_array($result)) {
// $mcal=json_decode($row['mqty_cal']);
// $ecal=json_decode($row['eqty_cal']);
// if ($mcal==null ) {
//     $mcal=[];
//   }
//   if ($ecal==null) {
//     $ecal=[];
//   }
      array_push($response,array('id'=>$row['id'],'userid'=>$row['user_id'],'pack'=>$row['pack'],'startdate'=>$row['startdate'],'routine'=>$row['routine'],'mqty'=>$row['mqty_litre'],'eqty'=>$row['eqty_litre']));
  }

  $json = json_encode($response,JSON_NUMERIC_CHECK);
  echo $json;
 ?>
