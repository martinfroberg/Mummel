<?php
require_once 'functions/login/autologin.php';


//Remove autologin cookie
if (isset($_COOKIE['mummel_auth'])){
    unset($_COOKIE['mummel_auth']);
    setcookie('mummel_auth','', time() - 3600, '/');
}

//Remove auth_token from database?
removeAuthToken($_SESSION['user_id'], $mysqli);

session_start();
// Unset all session values
$_SESSION = array();

// get session parameters
$params = session_get_cookie_params();

// Delete the actual cookie.
setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

// Destroy session
session_unset();
session_destroy();

header('Location: index.php');
exit(); ?>
