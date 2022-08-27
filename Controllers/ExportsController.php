<?php 
 header("Content-type: application/json");  
 header('Content-type: text/xml');
 include '../models/AddressBook.php'; 

  $addressBookModel = new AddressBook();

   //Export address books to JSON
    if(isset($_POST['export-data-to-json'])){
        $addressBooks = $addressBookModel->getAddressBooks();           
        $file = json_encode( $addressBooks); 
        header('Content-disposition: attachment; filename=address-books.json');         
        echo($file);                            
    }

   //Export address books to XML
    if(isset($_POST['export-data-to-xml'])){
         $addressBooks = $addressBookModel->getAddressBooks(); 
         $xml = "<root_address_book>";
         foreach($addressBooks as $singleAddressBook)
            {
            $xml .= '<address-book name="'.$singleAddressBook["name"].'" first_name="'.$singleAddressBook["first_name"].'" email="'.$singleAddressBook["email"].'" city="'.$singleAddressBook["city"].'" street="'.$singleAddressBook["street"].'" zip_code="'.$singleAddressBook["zip_code"].'" />';
            }
        $xml .= "</root_address_book>";

        $sxe = new SimpleXMLElement($xml);
        $dom = new DOMDocument('1,0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($sxe->asXML());
        header('Content-Disposition: attachment; filename="address-book.xml"');  
        echo $dom->saveXML();    
    }