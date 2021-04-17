<?php

include "../connectDb/connect.php";

class Programme{
    public $db;

    //se verifica daca conexiunea cu baza de date se realizeaza
    //am realizat conexiunea in constructor deoarece acesta se apeleaza la instantierea unui obiect din clasa
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Conectarea cu baza de date nu s-a realizat";
        }
        else {
            echo "Conectarea cu db-ul este ok";
        }
    }
    public function insertNewProgramme($type,$startDate,$endDate,$maximumUsers,$room_id){
        $sql="INSERT INTO programmes SET type='$type',startDate='$startDate',endDate='$endDate',maximumUsers='$maximumUsers',room_id='$room_id'";
        $result = mysqli_query($this->db,$sql) or
        die(mysqli_connect_errno()."nu se poate insera");
        return $result;
    }
}