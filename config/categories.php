<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/database/connect.php';

if(!isset($categories)){
    if ($stmt = $mysqli->prepare("SELECT * FROM categories")){
        if ($stmt->execute()){
            //Success
            if ($result = $stmt->get_result()){
                while($data = $result->fetch_assoc()){
                    $categories[] = $data;
                }

                //Make categories global for easy access
                global $categories;
            } else {
                //Couldnt retrieve results

                //Devolopment
                echo GET_CATEGORIES_QUERY_RESULT_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Devolopment
            echo GET_CATEGORIES_QUERY_EXECUTION_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Devolopment
        echo GET_CATEGORIES_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}
