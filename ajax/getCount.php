<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    require_once("../func.php");
    $con = connectDB();
    if (!$con) {
        echo("DB connection error.");
        exit;
    }

    $SQL = "SELECT count(*) as count FROM data";
    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("error:". $SQL);
        exit;
    }
    $row = pg_fetch_assoc($res);
    $count = $row["count"];

    echo($count);
    exit;

?>