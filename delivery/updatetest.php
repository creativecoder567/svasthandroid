<?php
require 'dbconnection1.php';

$data=$_POST;

$ORDERID="";
$USERID="";
$DATEID="";
$BRECEIVED="";
$BTLE_COUNT="";
$DELIVERY_STATUS="";
$response=array();
$json = array();

if (array_key_exists('orderid', $data)){
    $ORDERID= $data['orderid'];
  }
  if (array_key_exists('userid', $data)){
      $USERID= $data['userid'];
    }
    if (array_key_exists('dateid', $data)){
        $DATEID= $data['dateid'];
      }
      if (array_key_exists('breceived', $data)) {
        $BRECEIVED=$data['breceived'];
      }
      if (array_key_exists('btle_count', $data)) {
        $BTLE_COUNT=$data['btle_count'];
      }
      if (array_key_exists('delivery_status', $data)) {
        $DELIVERY_STATUS=$data['delivery_status'];
      }
      //echo $BRECEIVED;

      date_default_timezone_set('Asia/Calcutta');
      $ctime=date('H:i:s');
     $dtime=date('Y-m-d H:i:s');
      if( strtotime($ctime)<=strtotime('12:00:00') ){
        $sql="UPDATE  `svasth_enquiry`.`litre` SET  `delivery_status_m` =  '$DELIVERY_STATUS',`active_m` =  '1',`bottle_received_m`='$BRECEIVED',`bottle_count_m`='$BTLE_COUNT',`delivery_time_m`='$dtime' WHERE  `litre`.`id` = '$DATEID' AND `litre`.`userid` = '$USERID' AND `litre`.`orderid` = '$ORDERID'";
      }else {
       $sql="UPDATE  `svasth_enquiry`.`litre` SET  `delivery_status_e` =  '$DELIVERY_STATUS',`active_e` =  '0',`bottle_received_e`='$BRECEIVED',`bottle_count_e`='$BTLE_COUNT',`delivery_time_e`='$dtime' WHERE  `litre`.`id` = '$DATEID' AND `litre`.`userid` = '$USERID' AND `litre`.`orderid` = '$ORDERID'";
      }

      $result = mysqli_query($db, $sql);

      if ($result) {
          $json['success'] = 200;
         $json['message'] ="success";
          echo json_encode($json);
      } else {
          $json['success'] = 404;
          $json['message'] ="fail";
          echo json_encode($json);
      }
 ?>
