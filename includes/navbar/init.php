
<?php
if (verify_session($mysqli) == true) :
    //Logged in
    include 'status/logged_in.php';
    else :
        //Not logged in.
        include 'status/logged_out.php';
    endif; ?>
