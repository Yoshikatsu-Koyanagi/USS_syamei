<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    require_once("../func.php");
    $con = connectDB();
    if (!$con) {
        echo("DB connection error.");
        exit;
    }
    $img = $_FILES["img"];
    if (!$img) {
        echo("ERROR");
        exit;
    }
    else {
        echo("OK");
        var_dump($img);
        exit;
    }


?>