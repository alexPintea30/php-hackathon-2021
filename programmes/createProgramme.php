<?php
include "Programme.php";
$programme=new Programme();

header("Content-Type: application/json");
$data=json_decode(file_get_contents("php://input"), true);
var_dump($data);


$startDate=$data['startDate'];
$endDate=$data["endDate"];


//verificam daca tipurile si camerele solicitate pentru programari exista in db, deoarece aceasta trebuie sa fie fixe.
//daca nu, se vor afisa mesaje corespunzatoare
if($programme->existType($data['type'])) {
    $type=$data['type'];
    if($programme->existRoom($data['room_id'])) {
        $room_id=$data['room_id'];
        if($programme->busyRoom($room_id,$startDate)) {

        }
        //scade numarul de locuri la un tip de programare cand se ocupa un loc
        $programme->updateMaximumUsers($type);
    }
    else {
       echo "Aceasta camera nu exista in cladirea noastra";
    }
}
else {
    echo "Acest tip de programare nu exista";
}
?>