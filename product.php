<?php
require 'dbconnection1.php';

$sql="select * from products";
$result=mysqli_query($db,$sql);
$response=array();
$json = array();
while ($row = mysqli_fetch_array($result)) {
  array_push($response,array('name'=>$row['title'],'image'=>$row['path'],'price'=>$row['price'],'halflitre'=>$row['halflitre'],'availability'=>$row['availability'],'shipping'=>$row['shipping'],'offer'=>$row['offer']));
 // array_push($response,array('name'=>$row['title'],'image'=>$row['path'],'price'=>$row['price'],'halflitre'=>$row['halflitre'],'area'=>$row['area'],'availability'=>$row['availability'],'shipping'=>$row['shipping'],'offer'=>$row['offer']));
  //$response['success']=1;
  //$response['name'] = $row['title'];
  //$response['image'] = $row['path'];
    //$response['price']=$row['price'];
}

$json = json_encode($response);
echo $json;
 ?>
