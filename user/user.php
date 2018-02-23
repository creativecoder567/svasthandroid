<?php
/**
 * Created by PhpStorm.
 * User: Shaon
 * Date: 2/2/2017
 * Time: 1:25 AM
 */

namespace user;


class User
{
    private $NAME;
    private $EMAIL;
    private $PASSWORD;
    private $MOBILE;
    private $FLAT;
    private $APARTMENT;
    private $STREET;
    private $AREA;
    private $PINCODE;
    private $CITY;

    private $DB_CONNECTION;
    private $serverName = "localhost";
    private $userNameForDB = "root";
    private $passwordOfUserForDB = "";
    private $databaseName = "svasth_enquiry";

    function __construct()
    {
        // $this->DB_CONNECTION = mysqli_connect($this->serverName,
        //     $this->userNameForDB, $this->passwordOfUserForDB,
        //     $this->databaseName);

          //$DB_CONNECTION = mysqli_connect("localhost","svasth","svasth@2017","svasth_enquiry");
          $DB_CONNECTION = mysqli_connect("localhost","svasth","svasth@2017","svasth_enquiry");
       $this->DB_CONNECTION = $DB_CONNECTION;
     
    }

    function prepare($data) {
        if(array_key_exists('name', $data))
            $this->NAME = $data['name'];
        if(array_key_exists('email', $data))
            $this->EMAIL = $data['email'];
        if(array_key_exists('password', $data))
            $this->PASSWORD = $data['password'];
            if(array_key_exists('mobile', $data))
                $this->MOBILE = $data['mobile'];
            if(array_key_exists('flat', $data))
                $this->FLAT = $data['flat'];
                if(array_key_exists('apartment', $data))
                    $this->APARTMENT = $data['apartment'];
                    if(array_key_exists('street', $data))
                        $this->STREET = $data['street'];
                        if(array_key_exists('area', $data))
                            $this->AREA = $data['area'];
                            if(array_key_exists('pincode', $data))
                                $this->PINCODE = $data['pincode'];
                                if(array_key_exists('city', $data))
                                    $this->CITY = $data['city'];
    }

    function insertNewUserIntoDB () {
        include 'dbconnection1.php';

        $hash = $this->getHash($this->PASSWORD);
       $encrypted_password = $hash["encrypted"];
   	   $salt = $hash["salt"];
         
           // exit();
        $sql = "INSERT INTO `user` ( `name`, `email`, `password`, `mobile`,`salt`, `flat`, `apartment`, `street`, `area`, `pincode`, `city`)
        VALUES ( '" . $this->NAME . "','" . $this->EMAIL . "', '" . $encrypted_password . "', '" . $this->MOBILE . "', '" . $salt . "','" . $this->FLAT . "', '" . $this->APARTMENT . "',
           '" . $this->STREET . "','" . $this->AREA . "','" . $this->PINCODE . "', '" . $this->CITY . "')";

          $result = mysqli_query($db, $sql);
      //  $result = mysqli_query($this->DB_CONNECTION, $sql);

        if ($result) {
        require 'dbconnection1.php';
         $json = array();
         // echo $this->EMAIL;
          $sql="select id from user where email='$this->EMAIL'";
          $result=mysqli_query($db,$sql);

          while ($row = mysqli_fetch_array($result)) {
          $json['id'] = $row['id'];
          $json['success'] = 1;
         $json['message'] ="success";
          }
            //$json['success'] = 1;
  
           //$json['message'] ="success";
            echo json_encode($json);
        } else {
            $json['success'] = 0;
            $json['message'] ="fail";
            echo json_encode($json);
        }


    }
  public function getHash($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        //$encrypted = crypt($password.$salt, PASSWORD_DEFAULT);
         $encrypted = crypt($password,$salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);

        return $hash;

   }

}
