<?php

include_once ('../user/user.php');
include_once ('../user/authentication.php');

$auth = new \user\Authentication();
//$auth->storeOrderData($_POST,$user_id);


$userStatus = $auth->isUserValidToLogin();


//var_dump($_POST);
 $data = json_decode(file_get_contents('php://input'), true);
 //$val=explode('=',$_SERVER['QUERY_STRING']);

$val=array();
$pay=array();
$val=explode('&',$_SERVER['QUERY_STRING']);

$pay=explode('=',$val[0]);
//$response['message']=$pay[1];

$pay1=explode('=',$val[1]);
//$response['message']=$pay1[1];

    $order = $auth->storeOrderData($data,$pay[1],$pay1[1] );
    $json['success'] = 1;
    $json['message'] = 'test';
    
    if($userStatus == true) {
}else {
    $json['success'] = 0;
    $json['message'] = 'Not Logged In';

    echo json_encode($json);
}
