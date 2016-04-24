<?php
include $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/messages.php';
?>

<div class="modal-login">
    <form id="login_form" action="" method="post" onsubmit="return false">
        
        <label><?php echo EMAIL ?></label>
        <input type="text" name="email" placeholder="<?php echo EMAIL; ?>" />

        <label><?php echo PASSWORD; ?></label>
        <input type="text" name="password" placeholder="<?php echo PASSWORD; ?>" />

        <input type="submit" value="<?php echo LOGIN; ?>" />

        <!-- Better error handling? -->
        <p id="login_response"></p>

        <a class="close-modal" style="cursor: pointer"><?php echo CLOSE; ?></a>
    </div>
</form>
</div>
