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

    public function updateMaximumUsers($maximumUsers,$type){
        $sql="UPDATE PROGRAMMES SET maximumUsers='$maximumUsers' WHERE type='$type'";
        $result=mysqli_query($this->db,$sql);
    }
    public function existUser($cnp){
        $sql="SELECT * FROM USERS WHERE CNP='$cnp'";
        $result=mysqli_query($this->db,$sql);
        $row=$result->fetch_object();
        if($row!=null) {
            return true;
        }
    }

}
?>