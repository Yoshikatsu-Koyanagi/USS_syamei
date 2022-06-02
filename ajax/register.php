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
    $syancd = $_POST["syancd"];
    $syamei = $_POST["syamei"];
    $grade = $_POST["grade"];
    $katas = $_POST["katas"];
    $cc = $_POST["cc"];
    $zeikbn = $_POST["zeikbn"];
    //$lstpg = $_POST["lstpg"];
    //$lstymd = $_POST["lstymd"];
    //$sortno = $_POST["sortno"];
    $brandn = $_POST["brandn"];
    $syames = $_POST["syames"];
    //$door = $_POST["door"];
    //$syasyu = $_POST["syasyu"];
    $grades = $_POST["grades"];
    $biko = $_POST["biko"];


    $SQL = "INSERT INTO data ";
    $SQL .= "(spno, syancd, syamei, grade, katas, cc, zeikbn, brandn, syames, grades, biko) VALUES ";
    $SQL .= "('{$spno}', '{$syancd}', '{$syamei}', '{$grade}', '{$katas}', '{$cc}', '{$zeikbn}', '{$brandn}', '{$syames}', '{$grades}', '{$biko}') ";
    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("error:". $SQL);
        exit;
    }

    echo(0);
    exit;

?>