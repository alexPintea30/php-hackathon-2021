<?php

include "Booking.php";
include "../users/Users.php";
include "../programmes/Programme.php";

$booking=new Booking();
$user=new User();
$programme=new Programme();

//se transforma tipul serializat json intr-un array
header("Content-Type: application/json");
$data=json_decode(file_get_contents("php://input"), true);
var_dump($data);
//am folosit postman pt a trimite datele prin json
//se preiau datele din array in variabile
$startDate=$data["startDate"];
$endDate=$data["endDate"];
$programme_id=$data["programme_id"];
$token=$data["token"];
$cnp=$data['cnp'];
$type=$data['type'];
//am harcodat aici userul normal
$isAdmin=0;

//daca este user normal si doreste sa isi creeze o rezervare
if($isAdmin==0 && $user->existUser($cnp)) {

    //se verifica daca userul incearca sa faca 2 programari care se intercaleaze ca si timp, de acelasi tip
    if($booking->existInBooking($token,$startDate,$endDate,$programme_id)) {
      echo  "Nu se pot face 2 programari de acelasi tip, de catre acelasi user, care sa se intercaleze ca si timp";
    }
    else {
        //cand se face o programare se verifica tipul acesteia
        if($programme->existType($type)){
            //daca mai sunt locuri la tipul respectiv
            if($programme->retriveProgrameAvailable($type)==true) {

                //se aduce id programului in functie de tipul acestuia
                $programme_id=$programme->getIdByType($type);
                //se face inserarea propiu-zisa
                $booking->makeBooking($startDate,$endDate,$programme_id,$token);
                //se scade cu -1 numarul locurilor ramase
                $programme->updateMaximumUsers($type);
            }
            else {
                echo "Pentru tipul acesta de programare s-au ocupat toate locurile";
            }
        }
        else {
            echo "Acest tip nu exista in sistem";
        }
    }
}
else {
    echo "Nu sunteti inregistrat ca si user";
}

?>