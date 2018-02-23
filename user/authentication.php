<?php
/**
 * Created by PhpStorm.
 * User: Shaon
 * Date: 2/2/2017
 * Time: 1:25 AM
 */

namespace user;

class Authentication
{
    private $EMAIL;
    private $PASSWORD = "";
    private $user_id = "";
    private $errorCode = "";
    private $message = "";
    private $status ="";
    private $responseCode = "";
    private $results = "";
    private $order_id = "";
    private $payment_mode = "";


     private $DB_CONNECTION;
    // private $servername = "localhost";
    // private $username = "root";
    // private $password = "";
    // private $dbname = "register_login";

    function __construct()
    {
       $DB_CONNECTION = mysqli_connect("localhost","svasth","svasth@2017","svasth_enquiry");
       $this->DB_CONNECTION = $DB_CONNECTION;
     // $this->EMAIL = $EMAIL;
        // $this->DB_CONNECTION = mysqli_connect($this->servername, $this->username,
        //     $this->password, $this->dbname);
        //
        //     if ($DB_CONNECTION) {
        //      echo "Connected Successfully";
        //     }
        //     else {
        //     echo "Connection fail";
        //     }

    //    $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //  if (mysqli_connect_errno($this->connect))
    //  {
    //      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //  }

    }

    public function prepare($data)
    {
        if (array_key_exists('email', $data))
            $this->EMAIL = $data['email'];

        if (array_key_exists('password', $data))
            $this->PASSWORD = $data['password'];

    }

    function isUserExisted() {
      include 'dbconnection1.php';
        $sql = "SELECT `email` FROM `user` WHERE email = '". $this->EMAIL."' ";

        $result = mysqli_query($db, $sql);
          //return false;
         //$rowcount=mysqli_num_rows($result);
        // if ($rowcount > 0) {
        //   return true;
        // }else {
        //   return false;
        // }




        if(mysqli_num_rows($result) > 0) {
            return true;
            //return $row;
        }else {
            return false;
        }

      //   if ( $result->num_rows == 0 ){
      //      // User doesn't exist
      //    return false;
      //  }else {
      //    return true;
      //  }
    }

    function getLoggedUserData(){
        include 'dbconnection1.php';
        $row = array();
        $sql = "SELECT * FROM `user` WHERE email = '". $this->EMAIL."' ";
        $result = mysqli_query($db, $sql);
        $row = $result->fetch_assoc();
        $row['success']=1;
        $row['message']='User Successfully logged';
        return json_encode($row);
       //return $row;  ". $this->EMAIL."
    }

     function getLoggedUserId($email){
        include 'dbconnection1.php';
        $row = array();
        $sql = "SELECT * FROM `user` WHERE email = '$email' ";
        $result = mysqli_query($db, $sql);
        $row = $result->fetch_assoc();
        $row['success']=440;
        return json_encode($row);
       //return $row;
    }

    function storeOrderData($orderResponse,$val,$email){
    //var_dump($orderResponse);
     include 'dbconnection1.php';
    $user = json_decode($this->getLoggedUserId($email),true);
    $this->user_id = $user['id'];

    $this->order_id = $user['id'].'_SVO_'.time();
    //$order = json_decode($orderResponse,true);
    $order =$orderResponse;

      if($val=='cod'){
      $this->message = "Pay by cash";
      $this->errorCode = "";
      $this->responseCode = "";
      //$this->result = "test";
      $this->result = json_encode($order['result']);
      $this->status = "1";
      $this->payment_mode = $val;

       $sql = "INSERT INTO `order_history`(`user_id`, `message`, `errorCode`, `responseCode`, `result`, `status`,`order_id`, `payment_mode`) VALUES ('".$this->user_id."','".$this->message."','".$this->errorCode."','".$this->responseCode."','".$this->result."','".$this->status."','".$this->order_id."','".$this->payment_mode."')";
      } else {

      $this->message = $order['message'];
      $this->errorCode = $order['errorCode'];
      $this->responseCode = $order['responseCode'];
      $this->result = json_encode($order['result']);
      $this->status = $order['status'];


      $sql = "INSERT INTO `order_history`(`user_id`, `message`, `errorCode`, `responseCode`, `result`, `status`,`order_id`) VALUES ('".$this->user_id."','".$this->message."','".$this->errorCode."','".$this->responseCode."','".$this->result."','".$this->status."','".$this->order_id."')";
      }

      $results = mysqli_query($db, $sql);

        if ($results) {
            $json['success'] = 1;
           $json['message'] ="success";
            echo json_encode($json);
        } else {
            $json['success'] = 0;
            $json['message'] ="fail";
            echo json_encode($json);
        }
    }


    function isUserValidToLogin() {
      include 'dbconnection1.php';
       //$DB_CONNECTION = mysqli_connect("localhost","svasth","svasth@2017","register_login");
        $sql = "SELECT * FROM `user` WHERE email = '". $this->EMAIL."' ";
        $result = mysqli_query($db, $sql);
      //  $result = mysqli_query($this->DB_CONNECTION, $sql);
     
        if(mysqli_num_rows($result) > 0) {

        $user = $result->fetch_assoc();
        $encrypted_password = $user['password'];
             
        $pass= $this->PASSWORD;
        $salt =$user['salt'];
        //$test=$this->verifyHash($pass.$salt,$encrypted_password);
         // $match = (crypt($pass.$salt, PASSWORD_DEFAULT) === $encrypted_password);
          $match =(crypt($pass,$encrypted_password)===$encrypted_password);   
         //$match = hash_equals($encrypted_password, crypt($password, $salt));
       

          if($match ) {

          return true;
        } else {

        //   $json['message'] = "verification failed";
        //  echo json_encode($json);
            return false;
        }
           // return true;
        }else {
            return false;
        }
    }
        public function verifyHash($password, $hash) {
        
        

        return password_verify($password, $hash);
    }
}
