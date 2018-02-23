<?php
require 'dbconnection1.php';

$data=$_POST;

$ORDERID="";
$USERID="";
$MSTARTDATE="";
$MSTARTDATEID="";
$response=array();
$json = array();

if (array_key_exists('userid', $data)){
    $USERID = $data['userid'];
  }
  if (array_key_exists('orderid', $data)){
      $ORDERID = $data['orderid'];
    }
    if (array_key_exists('mstartdate', $data)){
        $MSTARTDATE = $data['mstartdate'];
      }
      if (array_key_exists('mstartdateid', $data)){
          $MSTARTDATEID = $data['mstartdateid'];
        }
for ($i=0; $i <30 ; $i++) {
  $date = strtotime("+$i day", strtotime($MSTARTDATE));

   $cal=date("d-m-Y", $date);

   // echo $cal." ".$MSTARTDATEID++;
   // echo "<br>";
    $sql="UPDATE  `svasth_enquiry`.`litre` SET  `date` =  '$cal' WHERE  `litre`.`id` ='$MSTARTDATEID' AND `litre`.`userid` ='$USERID' AND `litre`.`orderid` ='$ORDERID'";
     $result = mysqli_query($db, $sql);
      $MSTARTDATEID++;
}
    //  $sql="UPDATE  `svasth_enquiry`.`litre` SET  `date` =  '04-01-2018' WHERE  `litre`.`id` =1482"

    if ($result) {
      $json['success'] = 1;
      $json['message'] ="success";
      echo json_encode($json);
    }else {
      $json['success'] = 0;
      $json['message'] ="failed to modify";
      echo json_encode($json);
    }
 ?>
