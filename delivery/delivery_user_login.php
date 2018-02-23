<?php
require 'dbconnection1.php';

$DELIVERYBOYID="";
$PASSWORD="";
$data = $_POST;

if (array_key_exists('deliveryBoyId', $data)){
    $DELIVERYBOYID = $data['deliveryBoyId'];
  }

  if (array_key_exists('password', $data)){
      $PASSWORD = $data['password'];
    }

    $sql = "SELECT * FROM `user` WHERE  'deliveryboyid'='$DELIVERYBOYID' AND 'password'='$PASSWORD' ";
    $result = mysqli_query($db, $sql);

if ($result) {
  $json['success'] = 200;
 $json['message'] ="success";
  echo json_encode($json);
}else {
  $json['success'] = 404;
 $json['message'] ="fail";
  echo json_encode($json);
}

 ?>
