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
    //insereaza in db o noua programare
    public function insertNewProgramme($type,$startDate,$endDate,$maximumUsers,$room_id){
        $sql="INSERT INTO programmes SET type='$type',startDate='$startDate',endDate='$endDate',maximumUsers='$maximumUsers',room_id='$room_id'";
        $result = mysqli_query($this->db,$sql) or
        die(mysqli_connect_errno()."nu se poate insera");
        return $result;
    }
    //verifica daca exista un tip anume de programare
    public function existType($type){
       $sql="SELECT * FROM PROGRAMMES WHERE type='$type'";
        $result = mysqli_query($this->db,$sql);
        if($result->num_rows>0) {
            return true;
        }
        else {
            return false;
        }
    }
    //verifica daca exista o camera anume pentru programare
     public function existRoom($room) {
         $sql="SELECT * FROM PROGRAMMES WHERE room_id='$room'";
         $result = mysqli_query($this->db,$sql);
         if($result->num_rows>0) {
             return true;
         }
         else {
             return false;
         }
     }
     public function updateMaximumUsers($type){
        //se ia numarul din db numarul maxim de utilizatori in functie de tip
         $sql="SELECT maximumUsers FROM PROGRAMMES WHERE type='$type'";
         $result = mysqli_query($this->db,$sql);
         $row=$result->fetch_object();
         $row->maximumUsers--;
         echo  $row->maximumUsers;

        //se face update cu o valoare mai mica cu 1, deoarece s-a ocupat un loc
         $update="UPDATE PROGRAMMES SET maximumUsers='$row->maximumUsers' WHERE type='$type'";
         $result2 = mysqli_query($this->db,$update);
         return $result2;
         }
    }
