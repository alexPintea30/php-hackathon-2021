<?php

include "../connectDb/connect.php";

class User
{
    public $db;

    //se verifica daca conexiunea cu baza de date se realizeaza
    //am realizat conexiunea in constructor deoarece acesta se apeleaza la instantierea unui obiect din clasa
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Conectarea cu baza de date nu s-a realizat";
        } else {
            echo "Conectarea cu db-ul este ok";
        }
    }
    public function insertNewUser($token,$CNP,$isAdmin,$programme_id){
        $sql="INSERT INTO users SET token='$token',CNP='$CNP',isAdmin='$isAdmin',programme_id='$programme_id'";
        $result = mysqli_query($this->db,$sql) or
        die(mysqli_connect_errno()."nu se poate insera angajatul");
        return $result;
    }
    public function retriveProgrameAvailable(){
        $sql='SELECT * FROM PROGRAMMES WHERE maximumUsers>0';
        $result=mysqli_query($this->db,$sql);

        //afiseaza fiecare programare disponibila: tipul ei, data si ora inceperii, daca nu returneaza false
        if($result->num_rows>0) {
            while ($row = $result->fetch_object()) {
               echo "Mai sunt locuri disponibile pentru".$row->type;
               echo $row->startDate;
               echo $row->endDate;
            }
            return true;
        }
        else {
            echo "Nu mai sunt locuri disponibile";
            return false;
        }
    }
    public function updateMaximumUsers($maximumUsers,$type){
        $sql="UPDATE PROGRAMMES SET maximumUsers='$maximumUsers' WHERE type='$type'";
        $result=mysqli_query($this->db,$sql);
    }
}
?>