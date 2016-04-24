<?php
require_once 'functions/init.php' ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mummel</title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/foundation.css">
    <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/threads.js"></script>
</head>
<body>
    <?php
    include 'includes/navbar/init.php'; ?>

    <div class="row">
        <div class="small-12 columns">
            <?php include 'includes/threads/init.php'; ?>
        </div>
    </div>
</body>
</html>
