<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';

if (isset($_POST['user_id'], $_POST['thread_id'], $_POST['parent_id'] , $_POST['text'])){
    $user_id = $_POST['user_id'];
    $thread_id = $_POST['thread_id'];
    $parent_id = $_POST['parent_id'];
    $text = $_POST['text'];

    // Insert comment into database
    if ($insert_stmt = $mysqli->prepare('INSERT INTO comments (user_id, thread_id, parent_id, text) VALUES (?, ?, ?, ?)')) {
        $insert_stmt->bind_param('ssss', $user_id, $thread_id, $parent_id, $text);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            echo "NOPE";
        } else {
            echo "TRUE";
        }
    }
}
