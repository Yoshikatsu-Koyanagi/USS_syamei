<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    require_once("../func.php");
    $con = connectDB();
    if (!$con) {
        echo("DB connection error.");
        exit;
    }

    $userid = $_POST["userid"];
    $datetime1 = $_POST["datetime1"];
    $datetime2 = $_POST["datetime2"];
    $spno = trim($_POST["spno"]);
    $katas = trim($_POST["katas"]);
    $cc = trim($_POST["cc"]);
    $syamei = trim($_POST["syamei"]);
    $syames = trim(str_replace("　", "", $_POST["syames"]));
    $grade = trim(str_replace("　", "", $_POST["grade"]));
    $grades = trim(str_replace("　", "", $_POST["grades"]));
    $syancd = trim($_POST["syancd"]);
    $zeikbn = trim($_POST["zeikbn"]);
    $biko = trim($_POST["biko"]);
    $brandn = trim(str_replace("　", "", $_POST["brandn"]));
    //$syasyu = trim(str_replace("　", "", $_POST["syasyu"]));
    //$door = trim($_POST["door"]);
    $katas_match = $_POST["katas_match"];
    $sortName = $_POST["sortName"];
    $sortDirection = $_POST["sortDirection"];
/*
    if ($katas == "" && $cc == "" && $syamei == "" && $syames == "" && $grade == "" && $grades == "" && $syancd == "" && $zeikbn == "" && $biko == "" && $brandn == "") {
        echo(-1);
        exit;
    }
*/
    $SQL = "SELECT * FROM data ";
    $SQL .= "INNER JOIN syamei_master ";
    $SQL .= "ON data.syancd = syamei_master.syancd ";
    $SQL .= "WHERE userid = '{$userid}' ";
    if ($spno != '') {
        $SQL .= "AND spno::text LIKE '{$spno}%' ";
    }

    if ($datetime1 != '') {
        $SQL .= "AND datetime >= '{$datetime1}' ";
    }
    if ($datetime2 != '') {
        $SQL .= "AND (datetime - interval '1 day') < '{$datetime2}' ";
    }

    $and = "AND ";
    if ($katas != '') {
        if ($katas_match == 1) {
            $SQL .= $and."lower(trim(katas)) = LOWER('{$katas}') ";
        }
        else {
            $SQL .= $and."trim(katas) ILIKE '{$katas}%' ";
        }   
        $and = "AND ";
    }
    if ($cc != '') {
        $SQL .= $and."trim(cc) ILIKE '{$cc}%' ";
        //$SQL .= $and."cast(cc as text) ILIKE '{$cc}%' ";
        $and = "AND ";
    }
    if ($syamei != '') {
        $SQL .= $and."trim(syamei) ILIKE '{$syamei}%' ";
        $and = "AND ";
    }
    if ($syames != '') {
        $SQL .= $and."trim(syames) ILIKE '{$syames}%' ";
        $and = "AND ";
    }
    if ($grade != '') {
        $SQL .= $and."trim(grade) ILIKE '{$grade}%' ";
        $and = "AND ";
    }
    if ($grades != '') {
        $SQL .= $and."trim(grades) ILIKE '{$grades}%' ";
        $and = "AND ";
    }
    if ($syancd != '') {
        $SQL .= $and."trim(syancd) ILIKE '{$syancd}%' ";
        $and = "AND ";
    }
    if ($zeikbn != '') {
        $SQL .= $and."trim(zeikbn) ILIKE '{$zeikbn}%' ";
        $and = "AND ";
    }
    if ($biko != '') {
        $SQL .= $and."trim(biko) ILIKE '{$biko}%' ";
        $and = "AND ";
    }
    if ($brandn != '') {
        $SQL .= $and."trim(brandn) ILIKE '{$brandn}%' ";
        //$and = "AND ";
    }
/*
    if ($syasyu != '') {
        $SQL .= $and."trim(syasyu) ILIKE '{$syasyu}%' ";
        $and = "AND ";
    }
    if ($door != '') {
        $SQL .= $and."trim(door) ILIKE '{$door}%' ";
        //$and = "AND ";
    }
*/
    $SQL .= "ORDER BY {$sortName} {$sortDirection} ";
    $SQL .= "LIMIT 300";


    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("error:". $SQL);
        exit;
    }
    $array = array();
    while ($row = pg_fetch_array($res)) {
        $array[] = array(
            "spno" => $row["spno"],
            "datetime" => date("Y-m-d H:i", strtotime($row["datetime"])),
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