<?php
require 'dbconnection1.php';

$USERID="";
$PACK="";
$STARTDATE="";
$ROUTINE="";
$MQTY="";
$EQTY="";
$data = $_POST;


if (array_key_exists('userid', $data)){
    $USERID = $data['userid'];
  }
  
 
if (array_key_exists('pack', $data)){
    $PACK = $data['pack'];
  }
  if (array_key_exists('startdate', $data)){
      $STARTDATE = $data['startdate'];
    }
  if (array_key_exists('routine', $data)){
        $ROUTINE = $data['routine'];
      }
      if (array_key_exists('mqty', $data)){
            $MQTY = $data['mqty'];
          }
          if (array_key_exists('eqty', $data)){
                $EQTY = $data['eqty'];
              }

  //$sql = "INSERT INTO `modify` ( `pack`,`startdate`, `routine`, `mqty`, `eqty`) VALUES ('$PACK','$STARTDATE','$ROUTINE','$MQTY','$EQTY')";
   $sql = "INSERT INTO `modify` ( `userid`,`pack`,`startdate`, `routine`, `mqty`, `eqty`) VALUES ('$USERID','$PACK','$STARTDATE','$ROUTINE','$MQTY','$EQTY')";

  $result = mysqli_query($db, $sql);

  if ($result) {
      $json['success'] = 1;
     $json['message'] ="success";
      echo json_encode($json);
  } else {
      $json['success'] = 0;
      $json['message'] ="fail";
      echo json_encode($json);
  }
 ?>
