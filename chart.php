<?php
require 'dbconnection1.php';
$sql="select * from purity";
$result=mysqli_query($db,$sql);
$response=array();
$json = array();

while ($row=mysqli_fetch_array($result)) {
  array_push($response,array('parameter'=>$row['parameter'],'actual'=>$row['actual'],'standard'=>$row['standard']));
}

$json=json_encode($response);
echo $json;
 ?>
