<?php
//$encrypted = crypt(5d2639bdfb, PASSWORD_DEFAULT);
//echo "HI";
$salt = sha1(rand());
$salt = substr($salt, 0, 10); 
echo crypt(str,$salt);
//echo $salt;
?>