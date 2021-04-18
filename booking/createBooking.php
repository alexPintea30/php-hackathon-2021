<?php

include "Booking.php";


$booking=new Booking();

//se transforma tipul serializat json intr-un array
header("Content-Type: application/json");
$data=json_decode(file_get_contents("php://input"), true);
var_dump($data);

//se preiau datele in variabile
$startDate=$data["startDate"];
$endDate=$data["endDate"];
$programme_id=$data["programme_id"];
$token=$data["token"];

//se verifica daca userul incearca sa faca 2 programari care se intercaleaza ca si timp, de acelasi tip


if($booking->existInBooking($token,$startDate,$endDate,$programme_id)) {
    echo  "Nu se pot face 2 programari de acelasi tip, de catre acelasi user, care sa se intercaleze ca si timp";
}
else {
    $booking->makeBooking($startDate,$endDate,$programme_id,$token);
}
?>