<?php
include "Users.php";
header("Content-Type: application/json");

//am folosit tool-ul postman pentru a trimite datele la acest script
//am aplicat json_decode() sa transform formatul serializat json intr-un array

$data=json_decode(file_get_contents("php://input"), true);
var_dump($data);


$token=$data["token"];
$cnp=$data["cnp"];
echo $cnp;
echo mb_strlen($cnp);
$isAdmin=$data["isAdmin"];
echo $isAdmin;
$programme_id=$data["programme_id"];
$user=new User();

//verificam daca cnp-ul este numar,daca are lungime specifica cnp-urile din Ro si daca este user normal
if(is_numeric($cnp) && mb_strlen($cnp)==13 && $isAdmin==0) {
 // se trece la urmatoarea verificare, daca mai sunt locuri pentru o programare
    if($user->retriveProgrameAvailable()==true) {
        echo "isi va putea alege programarea";
    }
}
else {
    echo "Cnp-ul este invalid";
}



$user->retriveProgrameAvailable();
$user->insertNewUser($token,$cnp,$isAdmin,$programme_id);
?>