<?php
require_once 'login.php';
require_once 'verify_session.php';


//Is user logged in?
if(!verify_session($mysqli)){
    //Does user have autologin cookie?
    if (isset($_COOKIE['mummel_auth'])){
        //Break down the cookie and login the user
        parse_str($_COOKIE['mummel_auth']);

        if ($auth_data = getUserAutologinAuth($user_id, $mysqli)){
            //User found
            if ($email === $auth_data['email']){
                //Correct email and id
                if ($token === $auth_data['auth_token']){
                    //Correct token

                    createSession($user_id, $email);
                }
            }
        }
    }
}

function getUserAutologinAuth($user_id, $mysqli){
    if ($stmt = $mysqli->prepare("SELECT email, auth_token FROM users WHERE id = ?")){
        //Successfully prepared
        if($stmt->bind_param('i' , $user_id)){
            //Successfully bound
            if ($stmt->execute()){
                //Successfully executed
                if($result = $stmt->get_result()){
                    //Successfully retrieved result
                    $auth = [];
                    while($data = $result->fetch_assoc()){
                        $auth[] = $data;
                    }

                    if(count($auth) == 1){
                        return $auth[0];
                    } else {
                        //User doesnt exist
                        return false;
                    }

                } else {
                    //Failed to retrieve result

                    //Devolopment
                    echo GET_USER_AUTOLOGIN_AUTH_RESULT_ERROR;
                    exit();

                    //Production
                    //error_reporting(0);
                    //header("Location: error.php");
                    //exit();
                }
            } else {
                //Failed to execute

                //Devolopment
                echo GET_USER_AUTOLOGIN_AUTH_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Failed to bind

            //Devolopment
            echo GET_USER_AUTOLOGIN_AUTH_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Failed to prepare

        //Devolopment
        echo GET_USER_AUTOLOGIN_AUTH_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}

function removeAuthToken($user_id, $mysqli){
    if ($stmt = $mysqli->prepare('UPDATE users SET auth_token = NULL WHERE id = ?')){
        //Successsfully prepared
        if ($stmt->bind_param('i', $user_id)){
            //Successfully bound
            if($stmt->execute()){
                //Successfully executed
            } else {
                //Failed to execute

                //Devolopment
                echo DELETE_AUTH_TOKEN_QUERY_EXECUTION_ERROR;
                exit();

                //Production
                //error_reporting(0);
                //header("Location: error.php");
                //exit();
            }
        } else {
            //Failed to bind

            //Devolopment
            echo DELETE_AUTH_TOKEN_QUERY_PARAMETERS_ERROR;
            exit();

            //Production
            //error_reporting(0);
            //header("Location: error.php");
            //exit();
        }
    } else {
        //Failed to prepare

        //Devolopment
        echo DELETE_AUTH_TOKEN_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}
