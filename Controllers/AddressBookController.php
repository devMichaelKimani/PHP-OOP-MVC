<?php
 header('Access-Control-Allow-Origin: *');   
 header("Content-type: application/json");  
 include '../models/AddressBook.php'; 

    $addressBookModel = new AddressBook();

    $action = 'read';  
    if(isset($_GET['action'])){
         $action= $_GET['action'];
     }   

     //get all address books   
     if($action == 'read'){       
        $results = $addressBookModel->getAddressBooks();     
        echo json_encode($results);
    }

    //create an address book.
    if($action == 'create'){
        $name =  $_POST['name'];
        $first_name =  $_POST['first_name'];
        $email =  $_POST['email'];
        $city_id =  $_POST['city_id'];
        $street =  $_POST['street'];
        $zip_code =  $_POST['zip_code']; 

        $addressBookModel->createAddressBook($name, $first_name, $email, $city_id, $street, $zip_code);
        
        $msg = "Address book was added successfully";           
        echo json_encode($msg);               
    }

     //Update an address book
     if($action == 'update')  {
        $id = $_POST['id'];
        $name =  $_POST['name'];
        $first_name =  $_POST['first_name'];
        $email =  $_POST['email'];
        $city_id =  $_POST['city_id'];
        $street =  $_POST['street'];
        $zip_code =  $_POST['zip_code'];

        $addressBookModel->updateAddressBook($name, $first_name, $email, $city_id, $street, $zip_code, $id);

        $reponse = "Address book was updated successfully";           
        echo json_encode($reponse);          
                     
    }
 