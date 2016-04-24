<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/sessions.php';


//Start a secure session
function sec_session_start()
{
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === false) {
        header('Location: ../error.php?err=Could not initiate a safe session (ini_set)');
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams['lifetime'],
    $cookieParams['path'],
    $cookieParams['domain'],
    SECURE,
    HTTPONLY);

    // Sets the session name to the one set above.
    session_start();            // Start the PHP session
    session_regenerate_id(true);    // regenerated the session, delete the old one.
}
