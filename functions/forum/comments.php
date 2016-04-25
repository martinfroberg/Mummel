<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';

//Add comment(if proper form as been submitted)
//TODO Error handling/Invalid comment requirements
if (isset($_POST['user_id'], $_POST['thread_id'], $_POST['parent_id'] , $_POST['text'])){
    $user_id = $_POST['user_id'];
    $thread_id = $_POST['thread_id'];
    $parent_id = $_POST['parent_id'];
    $text = $_POST['text'];

    // Insert comment into database
    if ($insert_stmt = $mysqli->prepare('INSERT INTO comments (user_id, thread_id, parent_id, text) VALUES (?, ?, ?, ?)')) {
        $insert_stmt->bind_param('iiis', $user_id, $thread_id, $parent_id, $text);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            echo "NOPE";
        } else {
            echo "TRUE";
        }
    }
}


//Get comments for a specific thread, returns an assoc array
function get_thread_comments($thread_id, $mysqli){
    $thread_id = preg_replace("/[^0-9]/", '', $thread_id);
    $comments = array();

    $stmt = $mysqli->prepare("SELECT * FROM comments WHERE thread_id = ? ORDER BY parent_id ASC, id ASC");
    if ($stmt){
        $stmt->bind_param('s', $thread_id);
        $stmt->execute();
        $result = $stmt->get_result();

        //Get each row into $data
        while ($data = $result->fetch_assoc()){
            //Store whole assoc
            $comments[] = $data;
        }
        //Return comments.
        return $comments;
    } else {
        return false;
    }
}

//Find children for a comment id, returns array if found, else false
function find_child_comments($id, $array){
    $children = array();
    for ($i=0; $i < count($array); $i++) {
        if ($id == $array[$i]['parent_id'] && $array[$i]['id'] != $id){
            $children[] = $i;
        }
    }
    if (! empty($children)){
        return $children;
    } else {
        return false;
    }
}
