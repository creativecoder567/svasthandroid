<?php
require 'dbconnection1.php';

$NAME="";
$EMAIL="";
$MOBILE="";
$FLAT="";
$APARTMENT="";
$STREET="";
$AREA="";
$PINCODE="";
$data = $_POST;

if (array_key_exists('name', $data)){
    $NAME = $data['name'];
  }
  if (array_key_exists('email', $data)){
      $EMAIL = $data['email'];
    }
  if (array_key_exists('mobile', $data)){
      $MOBILE = $data['mobile'];
    }
    if (array_key_exists('flat', $data)){
        $FLAT = $data['flat'];
      }
      if (array_key_exists('apartment', $data)){
          $APARTMENT = $data['apartment'];
        }
        if (array_key_exists('street', $data)){
            $STREET = $data['street'];
          }
          if (array_key_exists('area', $data)){
              $AREA = $data['area'];
            }
            if (array_key_exists('pincode', $data)){
                $PINCODE = $data['pincode'];
              }


  //$sql = "INSERT INTO `enquiry` ( `user_id`,`title`, `description`) VALUES ('$ID','$TITLE','$DESCRIPTION')";

  $sql="UPDATE user SET name='$NAME', mobile='$MOBILE',flat='$FLAT',apartment='$APARTMENT',street='$STREET',area='$AREA',pincode='$PINCODE' WHERE email='$EMAIL';";

  $result = mysqli_query($db, $sql);

  if ($result) {
      $json['success'] = 1;
  //      $json['message'] =<a class="p7CH1H1s " style="z-index: 2147483647;" title="Click to Continue > by Advertise" href="#82665404"> 'Sign Up<img src="http://cdncache-a.akamaihd.net/items/it/img/arrow-10x10.png" /></a> Successful';
     $json['message'] ="success";
      echo json_encode($json);
  } else {
      $json['success'] = 0;
    //  $json['message'] =<a class="Eyqj4pXnY " style="z-index: 2147483647;" title="Click to Continue > by Advertise" href="#80760880"> 'Sign Up<img src="http://cdncache-a.akamaihd.net/items/it/img/arrow-10x10.png" /></a> was not Successful';
      $json['message'] ="fail";
      echo json_encode($json);
  }

 ?>
