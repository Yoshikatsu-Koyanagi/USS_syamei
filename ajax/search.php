<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    require_once("../func.php");
    $con = connectDB();
    if (!$con) {
        echo("DB connection error.");
        exit;
    }

    $katas_match = $_POST["katas_match"];
    $sortName = $_POST["sortName"];
    $sortDirection = $_POST["sortDirection"];

    $array = array(
        "katas" => [trim($_POST["katas"]), $_POST["katas_match"]],
        "cc" => [trim($_POST["cc"]), $_POST["cc_match"]],
        "syamei" => [trim($_POST["syamei"]), $_POST["syamei_match"]],
        "syames" => [trim(str_replace("　", "", $_POST["syames"])), $_POST["syames_match"]],
        "grade" => [trim(str_replace("　", "", $_POST["grade"])), $_POST["grade_match"]],
        "grades" => [trim(str_replace("　", "", $_POST["grades"])), $_POST["grades_match"]],
        "syancd" => [trim($_POST["syancd"]), $_POST["syancd_match"]],
        "zeikbn" => [trim($_POST["zeikbn"]), $_POST["zeikbn_match"]],
        "biko" => [trim($_POST["biko"]), $_POST["biko_match"]],
        "brandn" => [trim(str_replace("　", "", $_POST["brandn"])), $_POST["brandn_match"]],
        //"freeword" => [trim(str_replace("　", "", $_POST["freeword"])), $_POST["freeword_match"]],
    );
    $freeword = trim(str_replace("　", "", $_POST["freeword"]));
    foreach ($array as $key => $val) {
        if ($val[0] !== "") {   //空でないものがあればループを抜ける
            break;
        }
        if ($key == array_key_last($array) && $freeword == "") {       //最後まで空だったら-1を返して終了
            echo(-1);
            exit;
        }
    }
    $and = "";
    $SQL = "SELECT * FROM syamei_master ";
    $SQL .= "WHERE ";
    foreach ($array as $key => $val) {
        $input = $val[0];
        $match = $val[1];
        if ($input !== "") {
            if ($match == 0) {     //前方一致
                $SQL .= $and."trim({$key}) ILIKE '{$input}%' ";
            }
            else if ($match == 1) {     //後方一致
                $SQL .= $and."trim(replace({$key}, '　', ' ')) ILIKE '%{$input}' ";
            }
            else if ($match == 2) {     //部分一致
                $SQL .= $and."trim({$key}) ILIKE '%{$input}%' ";
            }
            else if ($match == 3) {     //完全一致
                $SQL .= $and."LOWER(trim({$key})) = LOWER('{$input}') ";
            }
            else if ($match == 4) {     //含まない
                $SQL .= $and."trim({$key}) NOT ILIKE '%{$input}%' ";
            }
            $and = "AND ";
        }
        else {
            continue;
        }
    }
    $or = "";
    if (trim(str_replace("　", "", $_POST["freeword"])) !== "") {
        $input = trim(str_replace("　", "", $_POST["freeword"]));
        $match = $_POST["freeword_match"];
        $SQL .= $and."( ";
        $and = "";
        foreach ($array as $key => $val) {
            if ($match == 0) {     //前方一致
                $SQL .= $or."trim({$key}) ILIKE '{$input}%' ";
            }
            else if ($match == 1) {     //後方一致
                $SQL .= $or."trim(replace({$key}, '　', ' ')) ILIKE '%{$input}' ";
            }
            else if ($match == 2) {     //部分一致
                $SQL .= $or."trim({$key}) ILIKE '%{$input}%' ";
            }
            else if ($match == 3) {     //完全一致
                $SQL .= $or."LOWER(trim({$key})) = LOWER('{$input}') ";
            }
            else if ($match == 4) {     //含まない
                $SQL .= $and."trim({$key}) NOT ILIKE '%{$input}%' ";
                $and = "AND ";
            }
            $or = "OR ";
            $and = "AND ";
        }
        $SQL .= ") ";
    }
/*
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
    if ($katas == "" && $cc == "" && $syamei == "" && $syames == "" && $grade == "" && $grades == "" && $syancd == "" && $zeikbn == "" && $biko == "" && $brandn == "") {
        echo(-1);
        exit;
    }

    $katas_match = $_POST["katas_match"];
    $sortName = $_POST["sortName"];
    $sortDirection = $_POST["sortDirection"];


    $and = "";
    $SQL = "SELECT * FROM syamei_master ";
    $SQL .= "WHERE ";
    if ($katas != '') {
        if ($katas_match == 0) {
            $SQL .= "trim(katas) ILIKE '{$katas}%' ";
        }
        else if ($katas_match == 1) {
            $SQL .= "trim(katas) ILIKE '%{$katas}' ";
        }
        else if ($katas_match == 2) {
            $SQL .= "trim(katas) ILIKE '%{$katas}%' ";
        }
        else if ($katas_match == 3) {
            $SQL .= "lower(trim(katas)) = LOWER('{$katas}') ";
        }
        else if ($katas_match == 4) {
            $SQL .= "trim(katas) NOT ILIKE '%{$katas}%' ";
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
*/
    $SQL .= "ORDER BY {$sortName} {$sortDirection} ";
    $SQL .= "LIMIT 300";

    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("error:". $SQL);
        exit;
    }
    $array2 = array();
    while ($row = pg_fetch_array($res)) {
        $array2[] = array(
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
    $json = json_encode($array2);
    echo($json);
    exit;

?>