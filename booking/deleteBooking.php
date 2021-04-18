<?php
include "Booking.php";
include "../users/Users.php";

$booking=new Booking();
$user=new User();

//se transforma tipul serializat json intr-un array
header("Content-Type: application/json");
$data=json_decode(file_get_contents("php://input"), true);

$id=$data['id'];
$token=$data["token"];

$isAdmin=$user->isAdmin($token);

if($booking->getBookingById($id)){
  $booking->deleteBooking($id);
}
else {
    echo "Programarea care se doreste a fi stearsa nu exista.";
}

?>