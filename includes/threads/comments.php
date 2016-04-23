<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/forum/comments.php';

if (isset($_POST['get_thread_comments'])){
    $comments = get_thread_comments($_POST['get_thread_comments'], $mysqli);
    if ($comments === false) {
        echo SELECT_FROM_DATABASE_FAILURE;
    } else {
        if (! $children = find_child_comments(0, $comments)){
            echo NO_COMMENTS;
        } else {
            print_comments(0,$comments);
        }
    }
}else{
    echo INVALID_POST_REQUEST;
}

function print_comments($comment_id, $array){
    $children = find_child_comments($comment_id,$array);
    if(! empty($children)){
        echo '<ul>';
        for ($i=0; $i < count($children); $i++) {
            echo '<li>' . $array[$children[0]]['text'] . '</li>';

            print_comments($array[$children[0]]['id'], $array);

            unset($array[$children[0]]);
            $array = array_values($array);
        }
        echo '</ul>';
    }
}
