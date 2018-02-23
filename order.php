<?php
require 'dbconnection1.php';

$datamain = file_get_contents("php://input", TRUE);
$data = json_decode($datamain , true);

$result=json_encode($data["result"]);
$userid=$data["userid"];
$pack=$data["pack"];
$startdate=$data["startdate"];
$routine=$data["routine"];
$mqty_litre=$data["mqty_litre"];
$eqty_litre=$data["eqty_litre"];
$shipping_price=$data["shipping_price"];
$discount_price=$data["discount_price"];
$paid=$data["paid"];
$location=$data["location"];
$address=$data["address"];
$payuResponse=$data["payuResponse"];
$payment_status=$data["payment_status"];

$payment_mode=$data["payment_mode"];

// mysql_real_escape_string($result);
// mysql_real_escape_string($address);

     
if ($payment_mode=="cod") {

$payment_status=2;
  $sql="INSERT INTO `order_history` (`id`, `user_id`, `pack`, `startdate`, `routine`, `mqty_litre`, `eqty_litre`, `shipping_price`, `discount_price`, `amount_paid`, `location`, `address`, `result`,`payuResponse`, `errorCode`, `message`, `active`, `responseCode`, `product_id`, `coupon_id`
    , `order_id`, `payment_mode`, `payment_status`, `created_at`,`updated_at`)VALUES (NULL, '$userid', '$pack', '$startdate', '$routine', '$mqty_litre', '$eqty_litre', '$shipping_price', '$discount_price', '$paid', '$location', '$address', '$result','$payuResponse', '', '', '2', '', '1',
      '', '', '$payment_mode','$payment_status', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
      $result=mysqli_query($db,$sql);

      if ($result) {
        $json['success'] = 1;
        $json['message'] ="success";
        echo json_encode($json);
      }else {
        $json['success'] = 0;
        $json['message'] ="fail";
        echo json_encode($json);
      }
}else if ($payment_mode=="netBanking") {

  $lastid=mysqli_insert_id($db);
  //echo $lastid;

if ($payment_status=="0") {
  $sql="INSERT INTO `order_history` (`id`, `user_id`, `pack`, `startdate`, `routine`, `mqty_litre`, `eqty_litre`, `shipping_price`, `discount_price`, `amount_paid`, `location`, `address`, `result`,`payuResponse`, `errorCode`, `message`, `active`, `responseCode`, `product_id`, `coupon_id`
    , `order_id`, `payment_mode`, `payment_status`, `created_at`,`updated_at`)VALUES (NULL, '$userid', '$pack', '$startdate', '$routine', '$mqty_litre', '$eqty_litre', '$shipping_price', '$discount_price', '$paid', '$location', '$address', '$result','$payuResponse', '', '', '2', '', '1',
      '', '', '$payment_mode','$payment_status', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
      $result=mysqli_query($db,$sql);

      if ($result) {
           $json['success'] = 400;
           $json['message'] ="Transaction Failed";
           echo json_encode($json);

         }else {
           $json['success'] = 0;
           $json['message'] ="fail";
           echo json_encode($json);
         }
}else if ($payment_status=="1") {
  $sql="INSERT INTO `order_history` (`id`, `user_id`, `pack`, `startdate`, `routine`, `mqty_litre`, `eqty_litre`, `shipping_price`, `discount_price`, `amount_paid`, `location`, `address`, `result`,`payuResponse`, `errorCode`, `message`, `active`, `responseCode`, `product_id`, `coupon_id`
    , `order_id`, `payment_mode`, `payment_status`, `created_at`,`updated_at`)VALUES (NULL, '$userid', '$pack', '$startdate', '$routine', '$mqty_litre', '$eqty_litre', '$shipping_price', '$discount_price', '$paid', '$location', '$address', '$result','$payuResponse', '', '', '1', '', '1',
      '', '', '$payment_mode','$payment_status', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

      $result=mysqli_query($db,$sql);
if ($result && $pack=='Trial') {
  $json['success'] = 1;
  $json['message'] ="success";
  echo json_encode($json);
}else if ($result && $pack=='Month') {
      $lastid=mysqli_insert_id($db);

                if ($routine=='Daily') {
                  for ($i=0; $i <30 ; $i++) {
                    $date = strtotime("+$i day", strtotime($startdate));

                     $cal=date("d-m-Y", $date);

                    // $sql="INSERT INTO `litre` (`id`, `userid`, `orderid`, `litre_date`, `morning_litre`, `evening_litre`) VALUES (NULL, '$lastid', '$startdate', '$cal', '$mqty_litre', //'$eqty_litre')";
                     $sql2="INSERT INTO `litre` (`id`, `userid`, `orderid`, `date`, `morning_litre`, `evening_litre`) VALUES (NULL, '$userid', '$lastid', '$cal', '$mqty_litre', '$eqty_litre')";
                     $finalresult = mysqli_query($db, $sql2);

                if ($finalresult) {
                  // $json['success'] = 1;
                  // $json['message'] ="success";
                  // echo json_encode($json);
                }else {
                  $json['success'] = 0;
                  $json['message'] ="failed to insert litre";
                  echo json_encode($json);
                }

                }

                }else {

                 for ($i=0; $i <60 ; $i++) {

                    if ($i%2==0) {

                      $date = strtotime("+$i day", strtotime($startdate));
                      $cal=date("d-m-Y", $date);

                      $sql2="INSERT INTO `litre` (`id`, `userid`, `orderid`, `date`, `morning_litre`, `evening_litre`) VALUES (NULL, '$userid', '$lastid', '$cal', '$mqty_litre', '$eqty_litre')";
                      $finalresult = mysqli_query($db, $sql2);
                    }

                  }

                  if ($finalresult) {
                    // $json['success'] = 1;
                    // $json['message'] ="success";
                    // echo json_encode($json);
                  }else {
                    $json['success'] = 0;
                    $json['message'] ="failed to insert litre";
                    echo json_encode($json);
                  }

                }

         }

}


}



// else {
//     $json['success'] = 0;
//     $json['message'] ="failed to insert in Order History";
//     echo json_encode($json);
//     }
 ?>
