<?php
require 'dbconnection1.php';

$GST="";
$data = $_POST;

if (array_key_exists('gst', $data)){
    $GST = $data['gst'];
  }  
  $response=array();
  $json = array();
  $sql="select * from tax where tax_label='$GST'" ;
  $result=mysqli_query($db,$sql);
  while ($row = mysqli_fetch_array($result)) {
    $response['success']=1;
    $response['gstPercent'] = $row['percent'];
  }

  $json = json_encode($response);
  echo $json;
?>
