<?php
require 'dbconnection1.php';

$COUPON="";
$data = $_POST;
if (array_key_exists('coupon', $data)){
    $COUPON = $data['coupon'];
  }
 
  $response=array();
  $json = array();
  $sql="select * from discount where status=0 and coupon_code='$COUPON'" ;
  $result=mysqli_query($db,$sql);
  while ($row = mysqli_fetch_array($result)) {
    // $response['success']=1;
    // $response['code'] = $row['coupon_code'];

    $coupon_code = $row['coupon_code'];
    $percent=$row['coupon_discount'];
  }

if ($COUPON==$coupon_code) {
  $response['success']=1;
  $response['couponPercent'] =$percent ;
  //echo "Success";
}else {
  $response['success']=0;
  $response['message'] ="Invalid Coupon" ;
}
   $json = json_encode($response);
   echo $json;
?>
