<?php
require 'dbconnection1.php';

$TITLE="";
$DESCRIPTION="";
$EMAIL="";
$data = $_POST;

if (array_key_exists('title', $data)){
    $TITLE = $data['title'];
  }
  if (array_key_exists('description', $data)){
      $DESCRIPTION = $data['description'];
    }
  if (array_key_exists('email', $data)){
        $EMAIL = $data['email'];
      }
      
        $sql="select * from user WHERE email = '$EMAIL' ";
      $result=mysqli_query($db,$sql);
      $row = $result->fetch_assoc();
     $ID=$row['id'];
     
  $sql = "INSERT INTO `enquiry` ( `user_id`,`title`, `description`) VALUES ('$ID','$TITLE','$DESCRIPTION')";

  $result = mysqli_query($db, $sql);

  if ($result) {
      $json['success'] = 1;
  //      $json['message'] =<a class="p7CH1H1s " style="z-index: 2147483647;" title="Click to Continue > by Advertise" href="#82665404"> 'Sign Up<img src="http://cdncache-a.akamaihd.net/items/it/img/arrow-10x10.png" /></a> Successful';
     $json['message'] ="success";
      echo json_encode($json);
  } else {
      $json['success'] = 0;
    //  $json['message'] =<a class="Eyqj4pXnY " style="z-index: 2147483647;" title="Click to Continue > by Advertise" href="#80760880"> 'Sign Up<img src="http://cdncache-a.akamaihd.net/items/it/img/arrow-10x10.png" /></a> was not Successful';
      $json['message'] ="fail";
      echo json_encode($json);
  }

 ?>
