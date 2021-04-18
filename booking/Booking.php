<?php
include "../connectDb/connect.php";
class Booking {
    public $db;
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

    public function makeBooking($startDate,$endDate,$programme_id,$token){
        $sql="INSERT INTO booking SET startDate='$startDate',endDate='$endDate',programme_id='$programme_id',token='$token'";
        $result = mysqli_query($this->db,$sql) or
        die(mysqli_connect_errno()."nu se poate insera");
        return $result;
    }
    public function existInBooking($token,$startDate,$endDate,$programme_id){
        //am implementat cele 3 cazuri in  care se suprapun 2 programari ca si timp de catre acelasi user

        $sql = "SELECT * FROM booking WHERE token='$token' and programme_id='$programme_id' 
and 
('$startDate' BETWEEN startDate AND endDate 
or '$endDate' BETWEEN startDate AND endDate
or startDate>'$startDate' AND endDate<'$endDate')";

        $result = mysqli_query($this->db, $sql);
        $row=$result->fetch_object();
        //daca programarile se vor suprapune functia returneaza true
        if($row!=null) {
            return true;
        }
    }
}
?>