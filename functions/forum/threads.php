<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';

if(isset($_POST['category_id'], $_POST['user_id'], $_POST['title'], $_POST['text'])){
    $category_id = $_POST['category_id'];
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $text = $_POST['text'];

    // Insert comment into database
    if ($stmt = $mysqli->prepare('INSERT INTO threads (category_id, user_id, title, url, text) VALUES (?, ?, ?, ?, ?)')) {
        if ($stmt->bind_param('iisss', $category_id, $user_id, $title, $url, $text)){
            //Successfully bound parameters

            // Execute the prepared query.
            if ($stmt->execute()) {
                //Success

                echo "TRUE";

            } else {
                //Insert thread execution statement failed

                //Devolopment
                echo INSERT_THREAD_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Failed to bound parameters

            //Devolopment
            echo INSERT_THREAD_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Couldnt prepare statement

        //Devolopment
        echo INSERT_THREAD_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}


//Get top voted threads from database, returns and assoc array
//TODO make thread voting system
function getTopThreads($mysqli){
    //Get threads
    if ($stmt = $mysqli->prepare("SELECT * FROM threads ORDER BY id ASC")){
        //Succesfully prepared statement
        if ($stmt->execute()){
            //Successfully executed statement

            //get statement result into $result
             if ($result = $stmt->get_result()){
                 //Successfully retrived result

                 //Get each row into $data
                 while ($data = $result->fetch_assoc()){
                     //Store whole assoc
                     $threads[] = $data;
                 }

                 //Success
                 return $threads;
             } else {
                 //Failed to get result from executed statement

                 //Devolopment
                 echo GET_COMMENTS_QUERY_RESULT_ERROR;
                 exit();

                 //Production
                 //error_reporting(0);
                 //header("Location: error.php");
                 //exit();
             }
        } else {
            //Failed to execute statement

            //Devolopment
            echo GET_COMMENTS_QUERY_EXECUTION_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Failed to prepare statement

        //Devolopment
        echo GET_COMMENTS_QUERY_ERROR;;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}
