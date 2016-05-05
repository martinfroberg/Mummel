<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';

if(isset($_POST['category_id'], $_POST['user_id'], $_POST['title'], $_POST['text'])){
    $category_id = $_POST['category_id'];
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $text = $_POST['text'];

    // Insert comment into database
    if ($insert_stmt = $mysqli->prepare('INSERT INTO threads (category_id, user_id, title, url, text) VALUES (?, ?, ?, ?, ?)')) {
        $insert_stmt->bind_param('iisss', $category_id, $user_id, $title, $url, $text);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            echo "NOPE";
        } else {
            echo "TRUE";
        }
    }
}


//Get top voted threads from database, returns and assoc array
//TODO make thread voting system
function getTopThreads($mysqli){
    //Get threads
    $stmt = $mysqli->prepare("SELECT * FROM threads ORDER BY id ASC");
    if ($stmt){
        //$stmt->bind_param('s', 'threads');
        $stmt->execute();
        //get statement result into $result
        $result = $stmt->get_result();

        //Get each row into $data
        while ($data = $result->fetch_assoc()){
            //Store whole assoc
            $threads[] = $data;
        }
        //Return threads
        return $threads;
    } else {
        return false;
    }
}
