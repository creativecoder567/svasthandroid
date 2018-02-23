<?php
/**
 * Created by PhpStorm.
 * User: Shaon
 * Date: 2/2/2017
 * Time: 1:25 AM
 */

include_once('../user/authentication.php');
use user\Authentication;

$userData = array();

$auth = new Authentication();
$auth->prepare($_POST);
$userStatus = $auth->isUserValidToLogIn();


if($userStatus) {
$userData = $auth->getLoggedUserData();
//var_dump($userData['email']);
    // user existed
    // So log him to main page
    //$json['success'] = 1;
    //$json['message'] = 'User Successfully logged';
    //$userData['success'] = 1; 
    
    //echo json_encode($userData);
   print_r($userData);
   // echo json_encode($json);
} else {
    // not existed
    // Take him to the<a class="p7CH1H1s " style="z-index: 2147483647;" title="Click to Continue > by Advertise" href="#89771760"> sign up<img src="http://cdncache-a.akamaihd.net/items/it/img/arrow-10x10.png" /></a> page
    $json['success'] = 0;
    $json['message'] = 'Wrong email or password';


    echo json_encode($json);
}
