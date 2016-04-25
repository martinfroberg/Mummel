<?php
include $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';
?>

<form id="reply_form" action="" method="post" onsubmit="return false">
    <textarea name="text" rows="8" cols="40" />

    <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id" />

    <input type="submit" value="<?php echo 'SKICKA IN SKITEN'; ?>" />
</form>

<button class="close-modal" style="cursor: pointer"><?php echo CLOSE; ?></button>
