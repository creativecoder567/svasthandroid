<?php
require 'dbconnection1.php';

$DBOYID="";

$data=$_POST;
$response=array();
$json = array();

if (array_key_exists('dboyid', $data)){
    $DBOYID= $data['dboyid'];
  }

  $sql="select * from delivery WHERE deliveryboy_id = '$DBOYID' ";
  $result=mysqli_query($db,$sql);

    while ($row = mysqli_fetch_array($result)) {
      array_push($response,array('userid'=>$row['user_id'],'name'=>$row['name'],'address'=>$row['address'],'phone'=>$row['phone']));
    }
    $json = json_encode($response);
    echo $json;
 ?>
