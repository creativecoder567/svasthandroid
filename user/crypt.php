<?php
// secure hashing of passwords using bcrypt, needs PHP 5.3+
// see http://codahale.com/how-to-safely-store-a-password/
// salt for bcrypt needs to be 22 base64 characters (but just [./0-9A-Za-z]), see http://php.net/crypt
$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
$salt = sha1(rand());
        $salt = substr($salt, 0, 10);

echo $salt;
// 2y is the bcrypt algorithm selector, see http://php.net/crypt
// 12 is the workload factor (around 300ms on my Core i7 machine), see http://php.net/crypt
$hash = crypt('foo', 'y$' . $salt);
// we can now use the generated hash as the argument to crypt(), since it too will contain y$... with a variation of the hash. No need to store the salt anymore, just the hash is enough!
var_dump($hash == crypt('foo', $hash)); // true
var_dump($hash == crypt('bar', $hash)); // false
?>