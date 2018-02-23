<?php
require 'dbconnection1.php';

$sql="SELECT * FROM `app-status`";
$result=mysqli_query($db,$sql);
$response=array();
$json = array();

while ($row = mysqli_fetch_array($result)) {

  $response=array(
    'min_version_code'=>$row['min_version_code'],
    'current_version_code'=>$row['current_version_code'],
    'update_notice_text'=>$row['update_notice_text']
  );
}
$json = json_encode($response,JSON_NUMERIC_CHECK);
echo $json;
 ?>
