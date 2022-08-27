<?php
require '../db/dbcon.php';
class AddressBook extends Dbcon{

   public function getAddressBooks(){
        $sql = "SELECT a.id, a.name, a.first_name, a.email, cities.name AS city, cities.id AS city_id, a.street, a.zip_code FROM address_books a 
                INNER JOIN cities ON a.city_id=cities.id";
        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    } 

   public function createAddressBook($name, $first_name , $email, $city_id,  $street, $zip_code){
        $sql = "INSERT INTO address_books (name,first_name,email,city_id,street,zip_code) VALUES(?, ?, ?, ?, ?, ?)"; 
        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute([$name, $first_name, $email, $city_id, $street, $zip_code]);
    } 

   public function updateAddressBook($name, $first_name , $email, $city_id,  $street, $zip_code, $id){
        $sql = "UPDATE address_books SET name=?, first_name=?, email=?, city_id=?, street=?, zip_code=? WHERE id=?";
        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute([$name, $first_name, $email, $city_id, $street, $zip_code, $id]);
    } 
}