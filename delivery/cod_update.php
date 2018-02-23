<?php
require 'dbconnection1.php';

$data=$_POST;

$ORDERID="";
$USERID="";
$response=array();
$json = array();

if (array_key_exists('orderid', $data)){
    $ORDERID= $data['orderid'];
  }
  if (array_key_exists('userid', $data)){
      $USERID= $data['userid'];
    }

    if ($ORDERID!=NULL && $USERID!=NULL) {

      $sqltest="select * from order_history where id = $ORDERID and user_id =$USERID ";
      $resulttest= mysqli_query($db,$sqltest);

     while ($rowtest= mysqli_fetch_array($resulttest)) {
       $payment_status=$rowtest['payment_status'];
       $pack=$rowtest['pack'];
     }

     if ($payment_status=='1') {
       $json['success'] = 0;
       $json['message'] ="Already cash Collected";
       echo json_encode($json);
     }else if ($pack=='Month') {
       $sql="UPDATE  `svasth_enquiry`.`order_history` SET `active` =  '1', `payment_status` =  '1' WHERE  `order_history`.`id` = '$ORDERID' AND `order_history`.`user_id` = '$USERID' ";
       $result = mysqli_query($db, $sql);

       // echo $USERID;
       // echo $ORDERID;
       if ($result) {
         $sql1="select * from order_history where id = $ORDERID and user_id =$USERID ";
       //$sql1="SELECT * FROM  `svasth_enquiry`.`order_history` WHERE `order_history`.'id' ='215' AND `order_history`.'user_id' ='116' ";
       //$sql1="select * from `svasth_enquiry`.'order_history' where `order_history`.`id` = '$ORDERID' AND `order_history`.`user_id` = '$USERID'";
       $result1 = mysqli_query($db, $sql1);


   while ($row1 = mysqli_fetch_array($result1)) {
       $startdate=$row1['startdate'];
       $mqty_litre=$row1['mqty_litre'];
       $eqty_litre=$row1['eqty_litre'];
       $routine=$row1['routine'];
       // echo $startdate;
       // echo $mqty_litre;
       // echo $eqty_litre;
   }

if ($routine=='Daily') {
  for ($i=0; $i <30 ; $i++) {
    $date = strtotime("+$i day", strtotime($startdate));

     $cal=date("d-m-Y", $date);

    // $sql="INSERT INTO `litre` (`id`, `userid`, `orderid`, `litre_date`, `morning_litre`, `evening_litre`) VALUES (NULL, '$lastid', '$startdate', '$cal', '$mqty_litre', //'$eqty_litre')";
     $sql2="INSERT INTO `litre` (`id`, `userid`, `orderid`, `date`, `morning_litre`, `evening_litre`) VALUES (NULL, '$USERID', '$ORDERID', '$cal', '$mqty_litre', '$eqty_litre')";
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

      $sql2="INSERT INTO `litre` (`id`, `userid`, `orderid`, `date`, `morning_litre`, `evening_litre`) VALUES (NULL, '$USERID', '$ORDERID', '$cal', '$mqty_litre', '$eqty_litre')";
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

   $json['success'] = 200;
   $json['message'] ="successfully updated";
   echo json_encode($json);
 }else {
   $json['success'] = 0;
   $json['message'] ="failed to update";
   echo json_encode($json);
 }
     }else{

         $sqlTrail="UPDATE  `svasth_enquiry`.`order_history` SET  `payment_status` =  '1' WHERE  `order_history`.`id` = '$ORDERID' AND `order_history`.`user_id` = '$USERID' ";
         $resultTrial = mysqli_query($db, $sqlTrail);
         if ($resultTrial) {
           $json['success'] = 200;
           $json['message'] ="successfully Trail updated";
           echo json_encode($json);
         }else {
           $json['success'] = 0;
           $json['message'] ="failed to update Trail";
           echo json_encode($json);
         }



     }



}else {
  $json['success'] = 0;
  $json['message'] ="values are null";
  echo json_encode($json);
}

 ?>
