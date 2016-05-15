<div class="navbarli">
  <div class="mummel">
    <h3>Mummel</h3>
  </div>
  <div class="loggedinname"><?php echo htmlentities($_SESSION['email']); ?>
  </div>
  <div class="buttons">
    <button><a href="/mummel/logout.php"><?php echo LOGOUT; ?></a></button>
    <button id="profil" class="open-modal">Profil</button>
  </div>

</div>
