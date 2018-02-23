<?php
require 'dbconnection1.php';

$DBOYID="";

$data=$_POST;
$response=array();
$response["litre:"]=array();
$json = array();

if (array_key_exists('dboyid', $data)){
    $DBOYID= $data['dboyid'];
  }


//echo "Today is " . date("d-m-Y") . "<br>";
//$today=date("d-m-Y");
$today="10-01-2018";
//$sql="select date from litre WHERE date ='$date' AND  userid= (select user_id from order_history where location = 'Banshankari')";
date_default_timezone_set('Asia/Calcutta');
$ctime=date('H:i:s');
//echo $ctime;
if( strtotime($ctime)<=strtotime('24:00:00') )
{

  switch ($DBOYID) {
    case 'SVD_001':
      $sql="select * from litre WHERE date ='$today' AND delivery_status_m='N' AND active_m='0' AND orderid  IN (select id from order_history where location = 'Banshankari')";
      break;

      case 'SVD_002':
        $sql="select * from litre WHERE date ='$today' AND delivery_status_m='N'AND active_m='0' AND orderid  IN (select id from order_history where location = 'Koramangala' or location = 'Banshankari')";
        break;

        case 'SVD_003':
          $sql="select * from litre WHERE date ='$today' AND delivery_status_m='N'AND active_m='0' AND orderid  IN (select id from order_history where location = 'HSRLayout' or location = 'Devarachikkanahalli')";
          break;
    default:
      # code...
      break;
  }

  $result=mysqli_query($db,$sql);



  $final=array();
  $final["user"]=array();


   while ($row=mysqli_fetch_assoc($result)) {

  $orderid=$row['orderid'];
  $sql2="select * from order_history where id= $orderid";
  $result2=mysqli_query($db,$sql2);

  while ($row2=mysqli_fetch_assoc($result2)) {
  $address= $row2['address'];
  }

    $id= $row['userid'];
     $sql1="select * from user where id= $id ";
    $result1=mysqli_query($db,$sql1);
  if ($row['morning_litre']!='0') {
    while($row1=mysqli_fetch_assoc($result1)){
       $user=array(
         "userid" => $row['userid'],
         "name"=>$row1['name'],
         "mobile"=>$row1['mobile'],
         "orderid" => $row['orderid'],
         "dateid" => $row['id'],
         "morning_litre" => $row['morning_litre'],
         "address"=>$address
       );
       array_push($final["user"], $user);
    }
  }




   }
}
else
{

  switch ($DBOYID) {
    case 'SVD_001':
      $sql="select * from litre WHERE date ='$today' AND delivery_status_e='N' AND active_e='0' AND orderid  IN (select id from order_history where location = 'Banshankari')";
      break;

      case 'SVD_002':
        $sql="select * from litre WHERE date ='$today' AND delivery_status_e='N'AND active_e='0' AND orderid  IN (select id from order_history where location = 'Koramangala' )";
        break;

        case 'SVD_003':
          $sql="select * from litre WHERE date ='$today' AND delivery_status_e='N' AND active_e='0' AND orderid  IN (select id from order_history where location = 'HSRLayout')";
          break;
    default:
      # code...
      break;
  }

  $result=mysqli_query($db,$sql);



  $final=array();
  $final["user"]=array();


   while ($row=mysqli_fetch_assoc($result)) {

  $orderid=$row['orderid'];
  $sql2="select * from order_history where id= $orderid";
  $result2=mysqli_query($db,$sql2);

  while ($row2=mysqli_fetch_assoc($result2)) {
  $address= $row2['address'];
  }

    $id= $row['userid'];
     $sql1="select * from user where id= $id ";
    $result1=mysqli_query($db,$sql1);
    if ($row['evening_litre']!='0') {

      while($row1=mysqli_fetch_assoc($result1)){
         $user=array(
           "userid" => $row['userid'],
           "name"=>$row1['name'],
           "mobile"=>$row1['mobile'],
           "orderid" => $row['orderid'],
           "dateid" => $row['id'],
           "morning_litre" => $row['evening_litre'],
           "address"=>$address
         );
         array_push($final["user"], $user);
      }

    }



   }
}


/*switch ($DBOYID) {
  case 'SVD_001':
    $sql="select * from litre WHERE date ='$today' AND delivery_status_m='N' AND orderid  IN (select id from order_history where location = 'Banshankari')";
    break;

    case 'SVD_002':
      $sql="select * from litre WHERE date ='$today' AND delivery_status_m='N' AND orderid  IN (select id from order_history where location = 'Koramangala')";
      break;

      case 'SVD_003':
        $sql="select * from litre WHERE date ='$today' AND delivery_status_m='N' AND orderid  IN (select id from order_history where location = 'HSRLayout')";
        break;
  default:
    # code...
    break;
}

$result=mysqli_query($db,$sql);

if ($result) {
echo "success";
}else {
echo "fail";
}

$final=array();
$final["user"]=array();


 while ($row=mysqli_fetch_assoc($result)) {

$orderid=$row['orderid'];
$sql2="select * from order_history where id= $orderid";
$result2=mysqli_query($db,$sql2);

while ($row2=mysqli_fetch_assoc($result2)) {
$address= $row2['address'];
}

  $id= $row['userid'];
   $sql1="select * from user where id= $id ";
  $result1=mysqli_query($db,$sql1);
  while($row1=mysqli_fetch_assoc($result1)){
     $user=array(
       "userid" => $row['userid'],
       "name"=>$row1['name'],
       "mobile"=>$row1['mobile'],
       "orderid" => $row['orderid'],
       "dateid" => $row['id'],
       "morning_litre" => $row['morning_litre'],
       "address"=>$address
     );
     array_push($final["user"], $user);
  }


}*/



    $json = json_encode($final["user"]);
    echo $json;


 ?>
