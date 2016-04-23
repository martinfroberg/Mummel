<?php

function get_top_threads($mysqli){
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

function create_thread($mysqli){

}

function delete_thread($user_id, $mysqli){

}
