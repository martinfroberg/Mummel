<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/sec/checkbrute.php';


//Check if valid user and log them in(start new session)
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Using prepared statements means that SQL injection is not possible.
    $stmt = $mysqli->prepare("SELECT id, password_hash FROM users WHERE email = ? LIMIT 1");

    if ($stmt) {
        $stmt->bind_param('s', $email);  // Bind '$email' to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($user_id, $db_password);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts

            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                echo YOUR_ACCOUNT_HAS_BEEN_LOCKED;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if (password_verify($password, $db_password)) {
                    // Password is correct!

                    // XSS protection as we might print this value
                    $user_id = preg_replace('/[^0-9]+/', '', $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value

                    // $username = preg_replace('/[^a-zA-Z0-9_\-]+/', '', $username);
                    $_SESSION['email'] = $email;

                    // Get the ip of the user.
                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    //Set session st ring to ip + browser
                    $_SESSION['login_string'] = $user_ip . $user_browser;

                    //Login successful
                    echo 'TRUE';
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $stmt = $mysqli->prepare("INSERT INTO login_attempts (user_id, time) VALUES (?,?)");
                    $stmt->bind_param('ss', $user_id, $now);
                    $stmt->execute();
                    echo INCORRECT_EMAIL_OR_PASSWORD;
                }
            }
        } else {
            // No user exists.
            echo INCORRECT_EMAIL_OR_PASSWORD;
        }
    }
}
