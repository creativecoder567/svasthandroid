<?php
require 'dbconnection1.php';

$sql="select * from area";
$result=mysqli_query($db,$sql);

$area=array();
while ($row=mysqli_fetch_array($result)) {
  array_push($area,array('id'=>$row['id'],'area'=>$row['area']));
}

echo json_encode($area);
 ?>
