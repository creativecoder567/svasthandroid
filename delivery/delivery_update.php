<?php
require 'dbconnection1.php';
$datamain = file_get_contents("php://input", TRUE);
$data = json_decode($datamain , true);

$ORDERID= $data['orderid'];
$USERID= $data['userid'];
$DATEID= $data['dateid'];
$BRECEIVED=$data['breceived'];
$BTLE_COUNT=$data['btle_count'];
$mobile=$data['mobile'];
$DELIVERY_STATUS=$data['delivery_status'];
$LOC=$data['loc'];
// $LONG=$data['long'];
date_default_timezone_set('Asia/Calcutta');
$ctime=date('H:i:s');
$dtime=date('Y-m-d H:i:s');

$sql2="select * from order_history where id=$ORDERID";
    $result2=mysqli_query($db,$sql2);
          while($row2=mysqli_fetch_assoc($result2)){
         $tnxid= json_decode($row2['result'],true);

  }

  foreach($tnxid as $key=>$value){
  if($key=="txnid"){
  //echo $key. '<br>';
  $txnid= $value;

  }
 
  }

if( strtotime($ctime)<=strtotime('12:00:00') ){

  $sql="UPDATE  `svasth_enquiry`.`litre` SET  `delivery_status_m` =  '$DELIVERY_STATUS',`active_m` =  '1',`bottle_received_m`='$BRECEIVED',`bottle_count_m`='$BTLE_COUNT',`delivery_location_m`='$LOC',`delivery_time_m`='$dtime' WHERE  `litre`.`id` = '$DATEID' AND `litre`.`userid` = '$USERID' AND `litre`.`orderid` = '$ORDERID'";
}else {
 $sql="UPDATE  `svasth_enquiry`.`litre` SET  `delivery_status_e` =  '$DELIVERY_STATUS',`active_e` =  '1',`bottle_received_e`='$BRECEIVED',`bottle_count_e`='$BTLE_COUNT',`delivery_location_e`='$LOC',`delivery_time_e`='$dtime' WHERE  `litre`.`id` = '$DATEID' AND `litre`.`userid` = '$USERID' AND `litre`.`orderid` = '$ORDERID'";
}
// code to get transaction id



$result = mysqli_query($db, $sql);

if ($result) {

//$json['success'] = 200;

    if ($DELIVERY_STATUS=="Y" && !empty($mobile)) {
      $apiKey = urlencode('BY81OBTb428-dpxkbEI8T87LkkP7vs9WizuZfiaxOp');
// Message details
// $_POST['mobile'] = 917845642159;
// $mobile = $_POST['mobile'];
$numbers = array($mobile);
$sender = urlencode('TXTLCL');
//$txnid = 123456;
$message = rawurlencode('Your order '.$txnid.' has been delivered. Thanks for using Svasth Life Milk.');
      //$number=917845642159;
$numbers = implode(',', $numbers);

// Prepare data for POST request
$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

// Send the POST request with cURL
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
    }

       // $textlocal=new textlocal('mohtashim.ae@prathigna.co.in','f21881b7ee24fca00976dd103db31d104b634decb19cf0364d400e496459152b');
       // $textlocal->sendSms('917845642159','Your car - KA01 HG 9999 - is due for service on July 24th, please text SERVICE to 92205 92205 for a callback','PRTGNA');
    $json['success'] = 200;
   $json['message'] ="success";
    echo json_encode($json);
} else {
    $json['success'] = 404;
    $json['message'] ="fail";
    echo json_encode($json);
}
 ?>
