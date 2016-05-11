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
function email_exists($email, $mysqli) {
    if ($stmt = $mysqli->prepare('SELECT id FROM users WHERE email = ? LIMIT 1')){
        //Prepare statement success
        if($stmt->bind_param('s', $email)){
            //Parameters successfully bound
            if ($stmt->execute()){
                //Executed successfully
                if($stmt->store_results()){
                    //Store results successfully
                    if ($stmt->num_rows == 1) {
                        // Email exists in database.
                        return true;
                    } else {
                        //Email doesnt exist.
                        return false;
                    }
                } else {
                    //Failed to store results

                    //Devolopment
                    echo EMAIL_EXISTS_RESULT_ERROR;
                    exit();

                    //Production
                    //error_reporting(0);
                    //header("Location: error.php");
                    //exit();
                }
            } else {
                //Execution failed

                //Devolopment
                echo EMAIL_EXISTS_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Parameters bind failure

            //Devolopment
            echo EMAIL_EXISTS_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }

    } else {
        //Prepare statement failure

        //Devolopment
        echo EMAIL_EXISTS_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
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
function register_user($email, $password, $mysqli) {
    // Create hashed password
    $password = password_hash($password, PASSWORD_DEFAULT);

    if ($stmt = $mysqli->prepare('INSERT INTO users (email, password_hash) VALUES (?, ?)')){
        //Successfully prepared
        if ($stmt->bind_param('ss', $email, $password)){
            //Successfully bound parameters

            if($stmt->execute()){
                //Successfully executed
                return true;
            } else {
                //Failed to execute
                //return false;

                //Devolopment
                echo REGISTER_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Failed to bind parameters

            //Devolopment
            echo REGISTER_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Failed to prepare

        //Devolopment
        echo REGISTER_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}
