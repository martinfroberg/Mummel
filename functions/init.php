<?php
require_ONCE $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/messages.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/database/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/config/categories.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/sec/sec_session.php';
sec_session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/sec/sanitize.php';
require_once $_SERVER["DOCUMENT_ROOT"] . 'mummel/functions/login/verify_session.php';
