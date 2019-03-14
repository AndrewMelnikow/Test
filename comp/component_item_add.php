<?php
if (!empty($_POST['add_item'])) {
    require_once "comp/model_item.php";

    if ($_SESSION['user'] == 'admin') {  
        $newitem = new Item\AddItem($_POST['item']);
        $newitem->uploadImages($_FILES['file_upload']);
        $newitem->checkInputData();    
        $newitem->imageHandler();
        try {
            $newitem->insertInDB();  
        } catch (PDOException $e) {
            echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
        }  
    } else {
        exit('Jums nav tiesību apskatīt šo lapu!');
    }
}