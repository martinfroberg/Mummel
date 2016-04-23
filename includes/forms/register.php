<div class="modal-register">
    <!-- Switch buttons -->
    <button id="login" class="switch-modal" type="button" name="button">Logga in</button>
    <button id="register" class="switch-modal" type="button" name="button">Registrera</button>
    <br>

    <!-- Form -->
    <form id="registration_form" action="" method="post" onsubmit="return false">
        <label>Email:</label>
        <input type="text" name="email" /><br>
        <label><?php echo PASSWORD; ?>:</label>
        <input type="password" name="password" /><br>
        <label><?php echo CONFIRM_PASSWORD; ?>:</label>
        <input type="password" name="confirm_password" /><br>
        <input type="submit" value="<?php echo REGISTER; ?>" />
    </form>
    <div id="registration_response"></div>

    <!-- Close modal button -->
    <a class="close-modal" style="cursor: pointer"><?php echo CLOSE; ?></a>
</div>
