<?php
require 'dbconnection1.php';

// $db = mysqli_connect("localhost","svasth","svasth@2017","svasth_enquiry");
//
//
// if ($db) {
//  echo "connection Successful";
// }else {
//  echo "connection fail";
// }

$EMAIL="";
$data = $_POST;
if (array_key_exists('email', $data)){
    $EMAIL = $data['email'];
  }

  $sql="select * from user WHERE email = '$EMAIL' ";
  $result=mysqli_query($db,$sql);
//  $row = $result->fetch_assoc();

$json = array();
while ($row = mysqli_fetch_array($result)) {
//  array_push($response,array('name'=>$row['name'],'email'=>$row['email'],'mobile'=>$row['mobile'],'flat'=>$row['flat'],'apartment'=>$row['apartment'],'street'=>$row['street'],'area'=>$row['area']
//,'pincode'=>$row['pincode'],'city'=>$row['city']));
//array_push($response,array('name'=>$row['name'],'email'=>$row['email'],'mobile'=>$row['mobile']));
  //$response['success']=1;
  $response['name'] = $row['name'];
  $response['email'] = $row['email'];
  $response['mobile']=$row['mobile'];
  $response['flat']=$row['flat'];
$response['apartment']=$row['apartment'];
$response['street']=$row['street'];
$response['area']=$row['area'];
$response['pincode']=$row['pincode'];
$response['city']=$row['city'];
}
$json = json_encode($response);
echo $json;
 ?>
