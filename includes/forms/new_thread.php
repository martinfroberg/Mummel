<?php
include $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';
include $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/forum/threads.php';
?>

<form id="new_thread_form" action="" method="post" onsubmit="return false">


    <select name="category_id">
        <?php $categories = get_categories($mysqli);
        foreach($categories as $option) {
            echo '<option value"' . $option['id'] . '">' . $option['name'] . '</option>';
        } ?>
    </select>

    <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id" />

    <label>Title</label>
    <input type="text" name="title">

    <label>Link</label>
    <input type="text" name="url">

    <textarea name="text" rows="8" cols="40" />

    <input type="submit" value="<?php echo 'SKICKA IN SKITEN'; ?>" />
</form>

<button class="close-modal" style="cursor: pointer"><?php echo CLOSE; ?></button>
