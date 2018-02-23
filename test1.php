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
//  echo $row['id'];
 $ID=$row['id'];
//$sql="select * from order_history WHERE user_id = '$ID' ";
$sql="select order_history.user_id,order_history.result,order_history.order_id,order_history.payment_mode,products.path from order_history,products where order_history.product_id=products.id";
$result=mysqli_query($db,$sql);



  while ($row = mysqli_fetch_array($result)) {
    array_push($response,array('user_id'=>$row['user_id'],'result'=>json_decode($row['result']),'order_id'=>$row['order_id'],'payment_mode'=>$row['payment_mode'],'image_path'=>$row['path']));
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
<?php
$someJSON ='[{"date":"31-Dec-2017","litre":0.5},{"date":"10-Jan-2018","litre":0.5},{"date":"22-Dec-2017","litre":0.5},{"date":"19-Dec-2017","litre":0.5},{"date":"20-Dec-2017","litre":0.5}]';
$someArray = json_decode($someJSON, true);
foreach ($someArray as $key => $value) {
  // echo $value["date"] . ", " . $value["litre"] . "<br>";
$date=$value["date"];
$litre=$value["litre"];
//echo $date.",".$litre . "<br>";
 }
 ?>
 <?php
 require 'dbconnection1.php';
 //$params = (array) json_decode(file_get_contents('php://input'), TRUE);
 //print_r($params);

 //echo json_encode($params);
 $datamain = file_get_contents("php://input", TRUE);
 //$data = json_decode($json);
 //print_r($data);
 //echo json_encode($data);

 $data = json_decode($datamain , true);


 $morning=json_encode($data["morning"]);
 $evening=json_encode($data["evening"]);


 $val=explode('&',$_SERVER['QUERY_STRING']);
 //$id=24;
 //$id=$val[0];
 $num=explode('=',$val[0]);
 $id=$num[1];
 if ($data!=null) {
 //$sql="INSERT INTO `modify` ( `mqty_cal`) VALUES ('$data') ";
 $sql= " UPDATE  `modify` SET  `mqty_cal` =  '$morning',`eqty_cal` =  '$evening' WHERE  `id` ='$id'";
 }
 //$sql="INSERT INTO `modify` ( `mqty_cal`) VALUES ('$morning') ";
 $result=mysqli_query($db,$sql);

 if ($result) {
     $json['success'] = 1;
    $json['message'] =$morning;
     echo json_encode($json);
 } else {
     $json['success'] = 0;
     $json['message'] =$$morning;
     echo json_encode($json);
     }

  ?>
