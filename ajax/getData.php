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
    if ($spno == '') {
        echo(-1);
        exit;
    }



    $SQL = "SELECT * FROM data WHERE spno = '{$spno}' LIMIT 1";
    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("error:". $SQL);
        exit;
    }

    $array = array();
    while ($row = pg_fetch_array($res)) {
        $array[] = array(
            "spno" => $row["spno"],
            "syancd" => $row["syancd"],
            "syamei" => $row["syamei"],
            "grade" => $row["grade"],
            "katas" => $row["katas"],
            "cc" => $row["cc"],
            "zeikbn" => $row["zeikbn"],
            "lstpg" => $row["lstpg"],
            "lstymd" => $row["lstymd"],
            "sortno" => $row["sortno"],
            "brandn" => $row["brandn"],
            "syames" => $row["syames"],
            "door" => $row["door"],
            "syasyu" => $row["syasyu"],
            "grades" => $row["grades"],
            "biko" => $row["biko"],
        );
    }
    $json = json_encode($array);
    echo($json);
    exit;


?>