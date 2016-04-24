<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/forum/comments.php';

if (isset($_POST['get_thread_comments'])){
    $comments = get_thread_comments($_POST['get_thread_comments'], $mysqli);
    if ($comments === false) {
        echo SELECT_FROM_DATABASE_FAILURE;
    } else {
        echo '<a id="reply" class="open-modal">Reply to thread</a>';
        echo '<br>';
        if (! $children = find_child_comments(0, $comments)){
            echo NO_COMMENTS;
        } else {
            print_comments(0,$comments);
        }
    }
}else{
    echo INVALID_POST_REQUEST;
}

function print_comments($parent_id, $array){
    $children = find_child_comments($parent_id,$array);
    if(! empty($children)){
        echo '<ul>';
        for ($i=0; $i < count($children); $i++) {
            echo '<li id="' . $parent_id . '">' . $array[$children[0]]['text'] . '</li>';

            print_comments($array[$children[0]]['id'], $array);

            unset($array[$children[0]]);
            $array = array_values($array);
        }
        echo '</ul>';
    }
}
