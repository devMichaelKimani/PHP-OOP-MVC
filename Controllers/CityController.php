<?php
 header('Access-Control-Allow-Origin: *');   
 header("Content-type: application/json");  
 include '../models/City.php'; 

    $cityModel = new City();
      
    $results = $cityModel->getCities();     
    echo json_encode($results);
    
 