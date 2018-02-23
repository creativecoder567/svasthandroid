<?php
require 'dbconnection1.php';


$host = 'localhost';
$user = 'svasth';
$db = 'svasth_enquiry';
$pass = 'svasth@2017';
$conn;



$conn = new PDO("mysql:host=".$host.";dbname=".$db, $user, $pass);
//$conn = mysqli_connect($host, $user, $pass, $db);
//  function __construct() {
//
// $this -> conn = new PDO("mysql:host=".$this -> host.";dbname=".$this -> db, $this -> user, $this -> pass);
//
// }


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
//  $response['message'] = var_dump($data);
//  echo json_encode($response['message']);


//  if(isset($data -> operation)){


  //  if (array_key_exists('operation', $data))
  //       $response["message"] = $data['operation'];

//$operation= $data['operation'];
   $operation = $data -> operation;
  	if(!empty($operation)){

       if ($operation == 'resPassReq') {

        // $email =$data-> $user -> email;
        // $response["result"] = "echo mail";
        // $response["message"] =var_dump($data);
        // echo json_encode($response);
      //  $data=var_dump($data);
        if(isset($data -> user) && !empty($data -> user) &&isset($data -> user -> email)){

          $user = $data -> user;
          $email = $user -> email;


          echo  resetPasswordRequest($email,$conn);
          // $response["result"] = "failure";
          // $response["message"] = $user -> email;
          // echo json_encode($response);
        }else {
          $response["result"] = "failure";
          $response["message"] = "Entered else";
          echo json_encode($response);

                }
      }else if ($operation == 'resPass') {

        if(isset($data -> user) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> password)
          && isset($data -> user -> code)){

          $user = $data -> user;
          $email = $user -> email;
          $code = $user -> code;
          $password = $user -> password;

          echo  resetPassword($email,$code,$password,$conn);

            }

          }
        }    else {

                  // $response["result"] = "failure";
                  // $response["message"] = $data -> operation;
                  // echo json_encode($response);
      }
}





 function resetPasswordRequest($email,$conn){

//  $db = $this -> db;

  if (checkUserExist($email,$conn)) {

    $result =  passwordResetRequest($email,$conn);

    if(!$result){

      $response["result"] = "failure";
      $response["message"] = "Reset Password Failure test";
      return json_encode($response);

    } else {

      $mail_result = sendEmail($result["email"],$result["temp_password"]);

      $dbcode=$result["temp_password"];

      $insert_sql = 'UPDATE user SET email =:email,code =:code WHERE email =:email';
      $insert_query = $conn ->prepare($insert_sql);
      $insert_query->execute(array(':email'=>$email,':code' => $dbcode));


      if($mail_result){

        $response["result"] = "success";
        $response["message"] = "Check your mail for reset password code.";
        echo json_encode($response);

      } else {

        $response["result"] = "failure";
        //$response["message"] = "Reset Password Failure";
        $response["message"] = "Mail Result Failure";
        echo json_encode($response);
      }
    }


  } else {

    $response["result"] = "failure";
    $response["message"] = "Email does not exist";
    return json_encode($response);

  }

}



 function resetPassword($email,$code,$password,$conn){

//  $db = $this -> db;

  if (checkUserExist($email,$conn)) {

    $sql = 'SELECT * FROM user WHERE email = :email';
    $query = $conn -> prepare($sql);
    $query -> execute(array(':email' => $email));
    $data = $query -> fetchObject();
    $salt = $data -> salt;
    $dbcode=$data-> code;
    $db_encrypted_temp_password = $data -> password;

    $old = new DateTime($data -> created_at);
    $now = new DateTime(date("Y-m-d H:i:s"));
    $diff = $now->getTimestamp() - $old->getTimestamp();

if (strcmp($dbcode,$code)==0) {
    $old = new DateTime($data -> created_at);
    $now = new DateTime(date("Y-m-d H:i:s"));
    $diff = $now->getTimestamp() - $old->getTimestamp();

        if($diff > 60) {

            return changePassword($email, $password,$conn);

        } else {

          $response["result"] = "failure";
          $response["message"] = "Timeout Proceed Again";
          return json_encode($response);
        }
          }else {
        $response["result"] = "failure";
        $response["message"] = "Code Mismatching";
        return json_encode($response);
      }



    //$result = resetPassword($email,$code,$password);
    //
    // if(!$result){
    //
    //   $response["result"] = "failure";
    //   $response["message"] = "Reset Password Failure";
    //   return json_encode($response);
    //
    // } else {
    //
    //   $response["result"] = "success";
    //   $response["message"] = "Password Changed Successfully";
    //   return json_encode($response);
    //
    // }


  } else {

    $response["result"] = "failure";
    $response["message"] = "Email does not exist";
    return json_encode($response);

  }

}



 function sendEmail($email,$temp_password){


  $to=$email;
  $subject = 'Password Reset Request';
  $message_body    = 'Hi,<br><br> Your password reset code is <b>'.$temp_password.'</b> . This code expires in 120 seconds. Enter this code within 120 seconds to reset your password.<br><br>Thanks,<br>SvasthLife.';
$mail=  mail($to, $subject, $message_body);

  if ($mail) {
  $response["result"] = "success";
  $response["message"] ="check your mail for code";
  echo json_encode($response);
  return true;
}else {
  return false;
}

}

 function checkUserExist($email,$conn){

   $sql = 'SELECT COUNT(*) from user WHERE email =:email';
   $query = $conn->prepare($sql);
   $query -> execute(array('email' => $email));

   if($query){

       $row_count = $query -> fetchColumn();

       if ($row_count == 0){

           return false;

       } else {

           return true;

       }
   } else {

       return false;
   }
}



 function passwordResetRequest($email,$conn){

   $random_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
   $hash = getHash($random_string);
   $encrypted_temp_password = $hash["encrypted"];
   $salt = $hash["salt"];

   $sql = 'SELECT COUNT(*) from user WHERE email =:email';
   $query = $conn -> prepare($sql);
   $query -> execute(array('email' => $email));

   if($query){

       $row_count = $query -> fetchColumn();

       if ($row_count == 0){


           $insert_sql = 'INSERT INTO user SET email =:email,password =:encrypted_temp_password,created_at = :created_at';
           $insert_query = $conn ->prepare($insert_sql);
           $insert_query->execute(array(':email' => $email, ':encrypted_temp_password' => $encrypted_temp_password,
           ':created_at' => date("Y-m-d H:i:s")));

           if ($insert_query) {

               $user["email"] = $email;
               $user["temp_password"] = $random_string;

               return $user;

           } else {

               return false;

           }

//,mobile ="789098765",flat="sdvsd",apartment="dfdf",street="ggge",area="gfgfg",pincode="sdffwf",city="banglore",fcm_token="sdsfsf"
       } else {
//,created_at = :created_at
//,':created_at' => date("Y-m-d H:i:s")
           //$encrypted_temp_password='123';
           $update_sql = 'UPDATE user SET email =:email,password =:encrypted_temp_password where email=:email';
           $update_query = $conn -> prepare($update_sql);
           $update_query -> execute(array(':email' => $email, ':encrypted_temp_password' => $encrypted_temp_password));

           if ($update_query) {

               $user["email"] = $email;
               $user["temp_password"] = $random_string;
               return $user;

           } else {

               return false;

           }

       }
   } else {

       return false;
   }


}


 function changePassword($email, $password,$conn){


   $hash = getHash($password);
   $encrypted_password = $hash["encrypted"];
   $salt = $hash["salt"];

   $sql = 'UPDATE user SET password = :encrypted_password,salt = :salt WHERE email = :email';
   $query = $conn -> prepare($sql);
   $query -> execute(array(':email' => $email, ':encrypted_password' => $encrypted_password, ':salt' => $salt));

   if ($query) {
     $response["result"] = "success";
     $response["message"] = "Password Changed Successfully";
     return json_encode($response);
      // return true;

   } else {
     $response["result"] = "failure";
     $response["message"] = 'Error Updating Password';
     return json_encode($response);
    //   return false;

   }

}

 function getHash($password) {

    $salt = sha1(rand());
    $salt = substr($salt, 0, 10);
      $encrypted = crypt($password.$salt, PASSWORD_DEFAULT);
    $hash = array("salt" => $salt, "encrypted" => $encrypted);

    return $hash;

}

 ?>
