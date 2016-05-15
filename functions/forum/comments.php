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
    if ($stmt = $mysqli->prepare('INSERT INTO comments (user_id, thread_id, parent_id, text) VALUES (?, ?, ?, ?)')) {
        if ($stmt->bind_param('iiis', $user_id, $thread_id, $parent_id, $text)){
            // Execute the prepared query.
            if ($stmt->execute()) {
                //Success

                //Echo true back to AJAX code
                echo "TRUE";

            } else {
                //Insert comment query cannot be executed

                //Devolopment
                echo INSERT_COMMENT_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Cannot bind parameters

            //Devolopment
            echo INSERT_COMMENT_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Insert comment statement is not correct

        //Devolopment
        echo INSERT_COMMENT_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}


//Get comments for a specific thread, returns an assoc array
function get_thread_comments($thread_id, $mysqli){
    //TODO Is this needed?
    //$thread_id = preg_replace("/[^0-9]/", '', $thread_id);
    $comments = [];

    // Insert comment into database
    if ($stmt = $mysqli->prepare("SELECT * FROM comments WHERE thread_id = ? ORDER BY parent_id ASC, id ASC")) {
        if ($stmt->bind_param('i', $thread_id)){
            //Successfully bound parameters

            // Execute the prepared query.
            if ($stmt->execute()) {
                //Succesfully executed

                if ($result = $stmt->get_result()){
                    //Result stored

                    //Get each row into $data
                    while ($data = $result->fetch_assoc()){
                        //Store whole assoc
                        $comments[] = $data;
                    }

                    //Success
                    return $comments;
                } else {
                    //Couldnt retrieve result

                    //Devolopment
                    echo GET_COMMENTS_QUERY_RESULT_ERROR;
                    exit();

                    //Production
                    //error_reporting(0);
                    //header("Location: error.php");
                    //exit();
                }
            } else {
                //Statement couldnt be executed

                //Devolopment
                echo GET_COMMENTS_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Couldnt bind parameters

            //Devolopment
            echo GET_COMMENTS_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Statement is not correct

        //Devolopment
        echo GET_COMMENTS_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
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
