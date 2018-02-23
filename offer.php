<?php
require 'dbconnection1.php';
$sql="select * from special_offer";
$result=mysqli_query($db,$sql);
$response=array();
$json = array();
while ($row = mysqli_fetch_array($result)) {
  array_push($response,array('name'=>$row['title'],'image'=>$row['image'],'validity'=>$row['validity']));
  //$response['success']=1;
  //$response['name'] = $row['title'];
  //$response['image'] = $row['path'];
    //$response['price']=$row['price'];
}

$json = json_encode($response);
echo $json;
 ?>
