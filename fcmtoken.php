<?php
require 'dbconnection1.php';

$TOKEN="";
$EMAIL="";
$data = $_POST;

if (array_key_exists('email', $data)){
    $EMAIL = $data['email'];
  }
  if (array_key_exists('token', $data)){
      $TOKEN = $data['token'];
    }
    if (array_key_exists('userid', $data)){
        $USERID = $data['userid'];
      }
  $sql="UPDATE  `svasth_enquiry`.`user` SET  `fcm_token` =  '$TOKEN' WHERE  `user`.`email` ='$EMAIL'";


    $result = mysqli_query($db, $sql);

    if ($result) {
        $json['success'] = 1;
       $json['message'] ="success";
        echo json_encode($json);
    } else {
        $json['success'] = 0;
        $json['message'] ="fail";
        echo json_encode($json);
    }
 ?>
