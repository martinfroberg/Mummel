<?php


//Is user logged in?(true/false)
function verify_session($mysqli)
{
    //Check to see if all parameters are entered.
    if (isset($_SESSION['user_id'], $_SESSION['email'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $email = $_SESSION['email'];

        // Get the ip of the user.
        $user_ip = $_SERVER['REMOTE_ADDR'];
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $login_check = $user_ip.$user_browser;

        if ($login_check == $login_string) {
            //Logged in
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
