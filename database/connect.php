<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/db.php';   // Database config.

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); //Connect database.

if($mysqli->connect_errno){
    //Failed database connection

    //Devolopment
    echo DATABASE_CONNECTION_ERROR;
    mysqli_close($mysqli);
    exit();

    //Production
    //error_reporting(0);
    //header("Location: error.php");
    //exit();
}
