<?php
require 'dbconnection1.php';
//$params = (array) json_decode(file_get_contents('php://input'), TRUE);
//print_r($params);

//echo json_encode($params);
$datamain = file_get_contents("php://input", TRUE);
//$data = json_decode($json);
//print_r($data);
//echo json_encode($data);

$data = json_decode($datamain , true);


$morning=json_encode($data["morning"]);
$evening=json_encode($data["evening"]);
$id=$data["id"];
$userid=$data["userid"];
$orderid=$data["orderid"];

/*$val=explode('&',$_SERVER['QUERY_STRING']);

$num=explode('=',$val[0]);
$id=$num[1];*/
if ($data!=null) {

  date_default_timezone_set('Asia/Calcutta');
  $ctime=date('Y-m-d H:i:s');
  //echo $ctime;
  foreach ($data["morning"] as $key => $value) {
    // echo $value["date"] . ", " . $value["litre"] . "<br>";
  $date=$value["date"];
  $litre=$value["litre"];
 //echo $date.",".$litre . "<br>";
// $sql="INSERT INTO `litre` ( `date`,'litre') VALUES ('$date','$litre') ";
//$sql= "UPDATE  `svasth_enquiry`.`litre` SET  `litre`.`morning_litre` =  '$litre' WHERE  `litre`.`date` ='$date' AND `litre`.`orderid` ='$orderid' AND `litre`.`userid` ='$userid'";
$sql= "UPDATE  `svasth_enquiry`.`litre` SET  `litre`.`morning_litre` =  '$litre',`litre`.`updated_at` =  '$ctime' WHERE  `litre`.`date` =  '$date' AND  `litre`.`orderid` =  '$orderid' AND  `litre`.`userid` =  '$userid' ";
 $result=mysqli_query($db,$sql);
}
foreach ($data["evening"] as $key => $value) {
  $date=$value["date"];
  $litre=$value["litre"];
  $sql= "UPDATE  `svasth_enquiry`.`litre` SET  `litre`.`evening_litre` =  '$litre',`litre`.`updated_at` =  '$ctime' WHERE  `litre`.`date` =  '$date' AND  `litre`.`orderid` =  '$orderid' AND  `litre`.`userid` =  '$userid'";
   $result=mysqli_query($db,$sql);
}

}
//$sql="INSERT INTO `modify` ( `mqty_cal`) VALUES ('$morning') ";


if ($result) {
    $json['success'] = 1;
   $json['message'] ="success";
    echo json_encode($json);
} else {
    $json['success'] = 0;
    $json['message'] =$morning;
    echo json_encode($json);
    }

 ?>
