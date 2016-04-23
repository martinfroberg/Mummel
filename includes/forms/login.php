<div class="modal-login">
  <form id="login_form" action="" method="post" onsubmit="return false">

    <button id="login" class="switch-modal" type="button" name="button">Logga in</button>
    <button id="register" class="switch-modal" type="button" name="button">Registrera</button>
    <br>

    <div class="row column log-in-form">

      <h4 class="text-center"><?php echo LOGIN_WITH_YOUR_EMAIL; ?></h4>

      <label><?php echo EMAIL ?>
        <input type="text" name="email" placeholder="<?php echo EMAIL; ?>">
      </label>

      <label><?php echo PASSWORD; ?>
        <input type="text" name="password" placeholder="<?php echo PASSWORD; ?>">
      </label>

      <input type="checkbox"><label>Visa lösenord</label>

      <p><button type="submit" class="button expanded"><?php echo LOGIN; ?></button></p>

      <p class="text-center"><a style="cursor: pointer">Glömt ditt lösenord?</a></p>

      <p id="login_response"></p>

      <a class="close-modal" style="cursor: pointer"><?php echo CLOSE; ?></a>
    </div>
  </form>
</div>
