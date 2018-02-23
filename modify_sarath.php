<?php
require 'dbconnection1.php';

$USERID="";
$ORDERID="";
$data=$_POST;
$response=array();
$json = array();

if (array_key_exists('userid', $data)){
    $USERID = $data['userid'];
  }
  if (array_key_exists('orderid', $data)){
      $ORDERID = $data['orderid'];
    }

    $sql="select * from litre WHERE userid = '$USERID' AND  orderid ='$ORDERID' AND delivery_status_m ='N' AND delivery_status_e ='N' ORDER BY  id ASC  ";
    $result=mysqli_query($db,$sql);

    while ($row=mysqli_fetch_array($result)) {
      array_push($response,array('id'=>$row['id'],'orderid'=>$row['orderid'],'date'=>$row['date'],'morning_litre'=>$row['morning_litre'],'evening_litre'=>$row['evening_litre']));
    }
    $json = json_encode($response,JSON_NUMERIC_CHECK);
    echo $json;
 ?>
