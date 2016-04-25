<?php
include $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/messages.php';
?>

<form id="registration_form" action="" method="post" onsubmit="return false">
    <label>Email:</label>
    <input type="text" name="email" /><br>

    <label><?php echo PASSWORD; ?>:</label>
    <input type="password" name="password" /><br>

    <label><?php echo CONFIRM_PASSWORD; ?>:</label>
    <input type="password" name="confirm_password" /><br>

    <input type="submit" value="<?php echo REGISTER; ?>" />
</form>
<!-- Better way to display errors -->
<p id="registration_response"></p>

<!-- Close modal button -->
<button class="close-modal" style="cursor: pointer"><?php echo CLOSE; ?></button>
