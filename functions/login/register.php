<?php
require_ONCE $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/messages.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/database/connect.php';


//Check if user can be registered and register them if successful
//Return error message, or 'TRUE' if successfull to javascript
if (isset($_POST['email'], $_POST['password'])) {
    $password = $_POST['password'];
    //Check valid email.
    if (!$email = valid_email($_POST['email'])) {
        echo EMAIL_IS_NOT_VALID;
    } else {
        if (email_exists($email, $mysqli)) {
            echo EMAIL_ALREADY_EXISTS;
        } else {
            if(!password_length($_POST['password'])){
                echo PASSWORD_TOO_SHORT;
            } else {
                if (register_user($email, $password, $mysqli)) {
                    echo 'TRUE';
                } else {
                    echo INSERT_INTO_DATABASE_FAILURE;
                }
            }
        }
    }
}

//Check if email is valid, false if invalid, return email on success
function valid_email($email)
{
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        return false;
    } else {
        //valid email
        return $email;
    }
}

//Check if email is already in database(true/false)
function email_exists($email, $mysqli)
{
    $stmt = $mysqli->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Email exists in database.
            return true;
        } else {
            //Email doesnt exist.
            return false;
        }
    }
}

//Check if password is correct length(true/false)
//TODO Other password requirements?
function password_length($password){
    if (count($password) >= 6){
        return true;
    } else {
        return false;
    }
}

//Register user in database(true/false)
function register_user($email, $password, $mysqli)
{
    // Create hashed password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Insert the new user into the database
    if ($insert_stmt = $mysqli->prepare('INSERT INTO users (email, password_hash) VALUES (?, ?)')) {
        $insert_stmt->bind_param('ss', $email, $password);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            return false;
        } else {
            return true;
        }
    }
}
