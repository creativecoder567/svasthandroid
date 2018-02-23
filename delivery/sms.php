<?php
 ini_set("display_errors", "1");
  error_reporting(E_ALL);
 
require 'dbconnection1.php';
//$txnid=null;
$ORDERID="339";
    $sql2="select * from order_history where id= $ORDERID";
    $result2=mysqli_query($db,$sql2);
  
       while($row2=mysqli_fetch_assoc($result2)){
         $tnxid= json_decode($row2['result'],true);     
         //print_r($tnxid); 
         var_dump($row2['result']);
	}
	
	foreach($tnxid as $key=>$value){
	if($key=="txnid"){
	//echo $key. '<br>';
	$txnid= $value;
	//$txnid = 'SVO1234567890123';
	var_dump($txnid);
	}
	
	}
echo $txnid;
?>