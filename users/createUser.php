<?php
header("Content-Type: application/json");
$body = file_get_contents('php://input');
json_decode($body);
var_dump($body);

include "Users.php";
$user= new User();

$token=md5(microtime().mt_rand());
$cnp=1990788553322;
$isAdmin=0;
$programme_id=7;

$user->insertNewUser($token,$cnp,$isAdmin,$programme_id);

?>

