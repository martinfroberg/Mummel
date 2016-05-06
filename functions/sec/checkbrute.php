<?php

//Check user-tried-to-login attempts with database
//TODO remove/change system?
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time.
    $now = time();

    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
        //Successfully prepared statement
        if ($stmt->bind_param('i', $user_id)){
            //Successfully bound parameters
            if ($stmt->execute()){
                //Successfully executed statement
                if($stmt->store_result()){
                    //Succesfully stored results

                    // If there have been more than 5 failed logins
                    if ($stmt->num_rows > 5) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    //Failed to store results

                    //Devolopment
                    echo BRUTE_FORCE_QUERY_RESULT_ERROR;
                    exit();

                    //Production
                    //error_reporting(0);
                    //header("Location: error.php");
                    //exit();
                }
            } else {
                //Failed to execute statement

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
        //Prepare statement failure

        //Devolopment
        echo BRUTE_FORCE_QUERY_ERROR;
        exit();

        //Production
        //error_reporting(0);
        //header("Location: error.php");
        //exit();
    }
}
