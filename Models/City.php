<?php
require '../db/dbcon.php';

class City extends Dbcon{
    public function getCities(){
        $sql = "SELECT * from cities";
        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    } 
}