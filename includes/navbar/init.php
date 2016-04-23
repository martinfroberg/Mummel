<div class="top-bar" id="main-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">Mummel</li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
      <?php
      if (verify_session($mysqli) == true) :
      //Logged in
      include 'status/logged_in.php';
      else :
      //Not logged in.
      include 'status/logged_out.php';
    endif; ?>
    </ul>
  </div>
</div>
