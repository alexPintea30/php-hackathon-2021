<?php
header("Content-Type: application/json");
$data=json_decode(file_get_contents("php://input"), true);
var_dump($data);

//se creaaza instante din clasele user,programe si booking
include "Users.php";
$user= new User();


include "../programmes/Programme.php";
$programme=new Programme();

include "../booking/Booking.php";
$booking=new Booking();

//se genereaza un token pt user
$token=md5(microtime().mt_rand());
$cnp=$data["cnp"];

//se inregistreaza user normal deoarece admini sunt harcodati deja in sistem
$isAdmin=0;
//tipul programarii
$type=$data["type"];

$startDate=$data['startDate'];
$endDate=$data['endDate'];

//verificam daca cnp-ul este numar,daca are lungime specifica cnp-urile din Ro si daca este user normal
//validari ierarhice
if(is_numeric($cnp) && mb_strlen($cnp)==13 && $isAdmin==0) {

    if($user->existUser($cnp)){
        echo "Suntenti deja inregistrat in sistem";
    }
    //daca nu exista userul se trece la urmatoarea validare
    //daca mai sunt locuri pentru o programare si daca tipul respectiv exista la noi in sistem
    else {
        //se verifica daca tipul exista, daca da se verifica daca mai sunt locuri pentru tipul respectiv
        if($programme->existType($type)){
            if($programme->retriveProgrameAvailable($type)==true) {
                //se aduce id programului in functie de tipul acestuia
                $programme_id=$programme->getIdByType($type);
                $user->insertNewUser($token,$cnp,$isAdmin,$programme_id);
                $programme->updateMaximumUsers($type);
                $booking->makeBooking($startDate,$endDate,$programme_id,$token);
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
    echo "Cnp-ul este invalid";
}
?>

