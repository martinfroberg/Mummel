<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/database/connect.php';

if(!isset($categories)){
    $stmt = $mysqli->prepare("SELECT * FROM categories");
    if($stmt){
        $stmt->execute();
        $result = $stmt->get_result();

        while($data = $result->fetch_assoc()){
            $categories[] = $data;
        }

        global $categories;
    } else {

        //ERROR HANDLING -- CANNOT GET CATEGORIES FROM DATABASE
        return false;
    }
}
