<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/forum/threads.php';
include 'filter.php'; ?>

<div class="threads-container">
    <?php
    if (! $threads = get_top_threads($mysqli)) :
        echo SELECT_FROM_DATABASE_FAILURE;
    else :
        for ($i=0; $i < count($threads); $i++) :
            echo '<div id="'.$threads[$i]['id'].'" class="thread">';
            echo '<h3>' . $threads[$i]['title'] . '</h3>';
            echo '<p> url: ' . $threads[$i]['url'] . '</p>';
            echo '<p> text: ' . $threads[$i]['text'] . '</p>';?>
            <a class="comments-btn"><?php echo COMMENTS; ?></a> <?php
            echo '</div>';
        endfor;
    endif;  ?>
</div>
