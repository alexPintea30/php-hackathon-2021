<?php
include "Programme.php";
$programme= new Programme();

header("Content-Type: application/json");
$data=json_decode(file_get_contents("php://input"), true);
var_dump($data);

$type=$data['type'];
$startDate=$data['startDate'];
$endDate=$data["endDate"];
$maximumUsers=$data["maximumUsers"];
$room_id=$data['room_id'];

$programme->insertNewProgramme($type,$startDate,$endDate,$maximumUsers,$room_id);
?>