<?php
require 'dbconnection1.php';

$USERID="";
$ORDERID="";
$SESSION="";
$data=$_POST;
$response=array();
$json = array();

if (array_key_exists('userid', $data)){
    $USERID = $data['userid'];
  }
  if (array_key_exists('orderid', $data)){
      $ORDERID = $data['orderid'];
    }
    if (array_key_exists('session', $data)){
        $SESSION = $data['session'];
      }
if ($SESSION=='Morning') {
  //echo $SESSION;
  $sql="select * from litre WHERE userid = '$USERID' AND  orderid ='$ORDERID' AND active_m ='1'  ";
  $result=mysqli_query($db,$sql);

  while ($row=mysqli_fetch_array($result)) {
    array_push($response,array('id'=>$row['id'],'orderid'=>$row['orderid'],'date'=>$row['date'],'morning_litre'=>$row['morning_litre'],'evening_litre'=>$row['evening_litre']));
  }
}else {
  //echo $SESSION;
    $sql="select * from litre WHERE userid = '$USERID' AND  orderid ='$ORDERID'  AND active_e ='1' ";
    $result=mysqli_query($db,$sql);

    while ($row=mysqli_fetch_array($result)) {
      array_push($response,array('id'=>$row['id'],'orderid'=>$row['orderid'],'date'=>$row['date'],'morning_litre'=>$row['morning_litre'],'evening_litre'=>$row['evening_litre']));
    }
}

    $json = json_encode($response,JSON_NUMERIC_CHECK);
    echo $json;
 ?>
