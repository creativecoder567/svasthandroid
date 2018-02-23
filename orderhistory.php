<?php
require 'dbconnection1.php';


$EMAIL="";
  $response=array();
  $json = array();

$data =$_POST;
  if (array_key_exists('email', $data)){
        $EMAIL = $data['email'];
      }

        $sql="select * from user WHERE email = '$EMAIL' ";
      $result=mysqli_query($db,$sql);
      $row = $result->fetch_assoc();
      //echo $row['id'];
     $ID=$row['id'];

//$sql="select * from order_history WHERE user_id = '$ID' ";
$sql="select order_history.user_id,order_history.mqty_litre,order_history.eqty_litre,order_history.result,order_history.order_id,order_history.payment_mode,order_history.payment_status,products.path from order_history,products where order_history.product_id=products.id and order_history.user_id='$ID' ";
$result=mysqli_query($db,$sql);



  while ($row = mysqli_fetch_array($result)) {
    array_push($response,array('user_id'=>$row['user_id'],'mqty_litre'=>$row['mqty_litre'],'eqty_litre'=>$row['eqty_litre'],'result'=>json_decode($row['result']),'payment_status'=>$row['payment_status'],'payment_mode'=>$row['payment_mode'],'image_path'=>$row['path']));
    // $response['success']=1;
   // $response['user_id'] = $row['user_id'];
   // $response['result'] = json_decode($row['result']);
   // $response['order_id']=$row['order_id'];
   // $response['payment_mode']=$row['payment_mode'];

  }

  //echo json_encode(array('message'=>$response));
  $json = json_encode($response);
  //var_dump($response);

  echo $json;
  //print_r($json);
  //var_dump($json);
  //var_dump(json_encode($response));
  mysqli_close($db);
 ?>
