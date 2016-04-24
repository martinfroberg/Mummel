<?php

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
