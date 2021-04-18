<?php

include "../connectDb/connect.php";

class Programme
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

    public function retriveProgrameAvailable($type)
    {
        $sql = "SELECT * FROM PROGRAMMES WHERE maximumUsers>0 and type='$type'";
        $result = mysqli_query($this->db, $sql);

        //afiseaza fiecare programare disponibila: tipul ei, data si ora inceperii, daca nu returneaza false
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                echo "Mai sunt locuri disponibile pentru" . $row->type;
            }
            return true;
        }
    }

    //verifica daca exista un tip anume de programare
    public function existType($type)
    {
        $sql = "SELECT * FROM PROGRAMMES WHERE type='$type'";
        $result = mysqli_query($this->db, $sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //verifica daca exista o camera anume pentru programare
    public function existRoom($room)
    {
        $sql = "SELECT * FROM PROGRAMMES WHERE room_id='$room'";
        $result = mysqli_query($this->db, $sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function busyRoom($room_id, $newProgrammeStartDate)
    {
        $sql = "SELECT * FROM PROGRAMMES WHERE room_id='$room_id'";
        $result = mysqli_query($this->db, $sql);
        $row = $result->fetch_object();
        if ($row->endDate < $newProgrammeStartDate) {
            echo "mesaj";
        }
    }

    public function getIdByType($type)
    {
        $sql = "SELECT id FROM PROGRAMMES WHERE type='$type'";
        $result = mysqli_query($this->db, $sql);
        $row = $result->fetch_object();
        return $row->id;
    }

    public function updateMaximumUsers($type)
    {
        //se ia numarul din db numarul maxim de utilizatori in functie de tip
        $sql = "SELECT maximumUsers FROM PROGRAMMES WHERE type='$type'";
        $result = mysqli_query($this->db, $sql);
        $row = $result->fetch_object();
        $row->maximumUsers--;

        //se face update cu o valoare mai mica cu 1, deoarece s-a ocupat un loc
        $update = "UPDATE PROGRAMMES SET maximumUsers='$row->maximumUsers' WHERE type='$type'";
        $result2 = mysqli_query($this->db, $update);
        return $result2;
    }
}
