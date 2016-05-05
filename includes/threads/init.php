<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/forum/threads.php'; ?>

<div class="threads-container">
    <?php

    //Create new thread
    if(verify_session($mysqli) == true){
        //User logged in, show reply to thread button
        echo '<button id="new_thread" class="open-modal">' . CREATE_NEW_THREAD . '</button>';
        echo '<br>';
    } else {
        //User not logged in
        //TODO hide button? Grey button?
    }

    if (! $threads = getTopThreads($mysqli)) :
        echo SELECT_FROM_DATABASE_FAILURE;
    else :
        for ($i=0; $i < count($threads); $i++) :

            echo '<div id="'.$threads[$i]['id'].'" class="thread" style="background-color:#' . $categories[$threads[$i]['category_id'] - 1]['color'] . '">';
            echo '<h3>' . $threads[$i]['title'] . '</h3>';
            echo '<p> url: ' . $threads[$i]['url'] . '</p>';
            echo '<p> text: ' . $threads[$i]['text'] . '</p>';
            echo '<button class="comments-btn">' . COMMENTS . '</button>';
            echo '</div>';
        endfor;
    endif;  ?>
</div>
