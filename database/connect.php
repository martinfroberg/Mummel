<?php
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/db.php';   // Database config.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); //Connect database.
