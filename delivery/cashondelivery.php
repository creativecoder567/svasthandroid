<?php
require 'dbconnection1.php';
$DBOYID="";

$data=$_POST;
$response=array();
//$response["litre:"]=array();
$json = array();

if (array_key_exists('dboyid', $data)){
    $DBOYID= $data['dboyid'];
  }
//$sql="select * from order_history WHERE location = 'Banshankari' and payment_status='2'";

switch ($DBOYID) {

  case 'SVD_001':
    $sql="select * from order_history WHERE location = 'Banshankari'  and payment_status='2'";
    break;

    case 'SVD_002':
      $sql="select * from order_history WHERE location = 'Nandi' and payment_status='2'";
      break;

      case 'SVD_003':
        $sql="select * from order_history WHERE  payment_status='2' and location in ('Devarachikkanahalli', 'HSRLayout')";
        break;
        
        case 'SVD_004':
          $sql="select * from order_history WHERE location = 'Tavarekere' and payment_status='2'";
          break;
  default:
    # code...
    break;
}
$result=mysqli_query($db,$sql);


while ($row = mysqli_fetch_array($result)) {
  $id= $row['user_id'];
   $sql1="select * from user where id= $id";
  $result1=mysqli_query($db,$sql1);

  while ($row1 = mysqli_fetch_array($result1)) {
    $name= $row1['name'];
    $mobile= $row1['mobile'];
  }

array_push($response,array('userid'=>$row['user_id'],'orderid'=>$row['id'],'name'=>$name,'mobile'=>$mobile,'address'=>$row['address'],'amount_paid'=>$row['amount_paid']));
}

$json=json_encode($response);
echo $json;
 ?>
