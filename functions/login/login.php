<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/sec/checkbrute.php';


//Check if valid user and log them in(start new session)
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    login($email, $password, $mysqli);
    //If "remember me" was checked, make a autologin cookie
    if (isset($_POST['autologin'])){
        $token = hash('sha512', uniqid());

        if ($stmt = $mysqli->prepare('UPDATE users SET auth_token = ? WHERE id = ?')){
            //Successfully prepared
            if ($stmt->bind_param('si', $token, $_SESSION['user_id'])){
                //Successfully bound
                if ($stmt->execute()){
                    //Successfully executed
                } else {
                    //Failed to execute

                    //Devolopment
                    echo UPDATE_AUTH_TOKEN_QUERY_EXECUTION_ERROR;
                    exit();

                    //Production
                    //error_reporting(0);
                    //header("Location: error.php");
                    //exit();
                }
            } else {
                //Failed to bind parameters

                //Devolopment
                echo UPDATE_AUTH_TOKEN_QUERY_PARAMETERS_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Failed to prepare

            //Devolopment
            echo UPDATE_AUTH_TOKEN_QUERY_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }

        $value = 'user_id=' . $_SESSION['user_id'] . '&email=' . $_SESSION['email'] . '&token=' . $token;

        setcookie('mummel_auth', $value, time()+60*60*24*30, '/'); //30 Days cookie
    }
}

function createSession($user_id, $email){
    // XSS protection as we might print this value
    $user_id = preg_replace('/[^0-9]+/', '', $user_id);
    $_SESSION['user_id'] = $user_id;

    $_SESSION['email'] = filter_var($email, FILTER_VALIDATE_EMAIL);

    // Get the ip of the user.
    $user_ip = $_SERVER['REMOTE_ADDR'];
    // Get the user-agent string of the user.
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    //Set session st ring to ip + browser
    $_SESSION['login_string'] = $user_ip . $user_browser;
}

function login($email, $password, $mysqli){
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $mysqli->prepare("SELECT id, password_hash FROM users WHERE email = ?")){
        //Successfully prepared statement
        if ($stmt->bind_param('s', $email)){
            //Successfully bound parameters
            if($stmt->execute()){
                //Successfully executed

                if($result = $stmt->get_result()){
                    //Successfully retrieved result

                    $user = [];

                    //Get each row into $data
                    while ($data = $result->fetch_assoc()){
                        //Store whole assoc
                        $user[] = $data;
                    }

                    //Check to see if multiple users??
                    if(count($user) == 1){
                        //Found user in database
                        $user_id = $user[0]['id'];
                        $db_password = $user[0]['password_hash'];

                        if (!checkbrute($user_id, $mysqli)) {
                            // Check if the password in the database matches
                            // the password the user submitted.
                            if (password_verify($password, $db_password)) {
                                // Password is correct!

                                createSession($user_id, $email);
                                //Login successful
                                echo 'TRUE';

                            } else {
                                // Password is not correct
                                // We record this attempt in the database
                                $now = time();
                                if ($stmt = $mysqli->prepare("INSERT INTO login_attempts (user_id, time) VALUES (?,?)")){
                                    //Successfully prepared
                                    if ($stmt->bind_param('is', $user_id, $now)){
                                        //Successfully bound parameters
                                        if ($stmt->execute()){
                                            //Successfully executed

                                            echo INCORRECT_EMAIL_OR_PASSWORD;
                                        } else {
                                            //Failed to execute

                                            //Devolopment
                                            echo BRUTE_FORCE_QUERY_EXECUTION_ERROR;
                                            exit();

                                            //Production
                                            //error_reporting(0);
                                            //header("Location: error.php");
                                            //exit();
                                        }
                                    } else {
                                        //Failed to bind parameters

                                        //Devolopment
                                        echo BRUTE_FORCE_QUERY_PARAMETERS_ERROR;
                                        exit();

                                        //Production
                                        //error_reporting(0);
                                        //header("Location: error.php");
                                        //exit();
                                    }
                                } else {
                                    //Failed to prepare

                                    //Devolopment
                                    echo BRUTE_FORCE_QUERY_ERROR;
                                    exit();

                                    //Production
                                    //error_reporting(0);
                                    //header("Location: error.php");
                                    //exit();
                                }
                            }
                        } else {
                            // Account is locked
                            // Send an email to user saying their account is locked
                            echo TOO_MANY_LOGIN_ATTEMPTS;
                        }
                    } else {
                        //User does not exist

                        echo USER_DOES_NOT_EXIST;
                    }
                } else {
                    //Failed to retrive results

                    //Devolopment
                    echo LOGIN_RESULT_ERROR;
                    exit();

                    //Production
                    //error_reporting(0);
                    //header("Location: error.php");
                    //exit();
                }
            } else {
                //Failed to execute statement

                //Devolopment
                echo LOGIN_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Failed to bind parameters

            //Devolopment
            echo LOGIN_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //failed to prepare statement

        //Devolopment
        echo LOGIN_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}
