<?php

include_once ('../user/user.php');
include_once ('../user/authentication.php');

$auth = new \user\Authentication();
$auth->prepare($_POST);

$userStatus = $auth->isUserExisted();

if ($userStatus == false) {
    $user = new \user\User();
    $user->prepare($_POST);
    $user->insertNewUserIntoDB();
}else {
    $json['success'] = 0;
    $json['message'] = 'User exist';

    echo json_encode($json);
}
?>