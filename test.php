<?php
$status="";
$message="";
//$data = $_POST;
// $response['message']=$data;
// $json = json_encode($response);
//
// echo $json;
// exit;
// if (array_key_exists('status', $data)){
//
//
//     $status = $data['status'];
//    //var_dump($data);
//   }
//   if (array_key_exists('status', $data)){
//
//
//       $message = $data['status'];
//      //var_dump($data);
//     }
// $payuResponse=json_decode($data,true);
// $status=$payuResponse['status'];
// $message=$payuResponse['message'];
// $response['success']=$status;
// $response['message']=$message;
// $json = json_encode($response);
// echo $json;
// $response['message']=$_POST;
//$query=$_GET['product_type'];

$data = json_decode(file_get_contents('php://input'), true);
$response['success']= $data['status'];
//$response['message']=$_SERVER['QUERY_STRING'];
//$val=explode('=',$_SERVER['QUERY_STRING']);
//$response['message']=$val[1];
//$response['message']=$val;
//$response['message']=$_POST['payment_mode'];

$val=array();
$pay=array();
$val=explode('&',$_SERVER['QUERY_STRING']);

$pay=explode('=',$val[0]);
//$response['message']=$pay[1];

$pay1=explode('=',$val[1]);
$response['message']=$pay[1];

// $response['success']=1;
// $response['message']='success';
$json = json_encode($response);
echo $json;
 ?>
