<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    require_once("../func.php");
    $con = connectDB();
    if (!$con) {
        echo("DB connection error.");
        exit;
    }

    $spno = $_POST["spno"];
   
    $SQL = "DELETE FROM data WHERE spno = '{$spno}'";
    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("");
        exit;
    }
    echo(0);
    exit;

?>