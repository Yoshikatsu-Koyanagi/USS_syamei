<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    require_once("../func.php");
    $con = connectDB();
    if (!$con) {
        echo("DB connection error.");
        exit;
    }

    $str = "NZE142";

    $SQL = "SELECT ";
    $SQL .= "trim(katas) as trim_katas, ";
/*
    $SQL .= "right(trim(katas), 1) as katas_1, ";
    $SQL .= "right(trim('{$str}'), 1) as str_1, ";
    $SQL .= "levenshtein(right(trim('{$str}'), 1), right(trim(katas), 1)) as dist_1, ";

    $SQL .= "right(trim(katas), 2) as katas_2, ";
    $SQL .= "right(trim('{$str}'), 2) as str_2, ";
    $SQL .= "levenshtein(right(trim('{$str}'), 2), right(trim(katas), 2)) as dist_2, ";
*/
    $SQL .= "right(trim(katas), 3) as katas_3, ";
    $SQL .= "right(trim('{$str}'), 3) as str_3, ";
    $SQL .= "levenshtein(right(trim('{$str}'), 3), right(trim(katas), 3)) as dist_3, ";

    $SQL .= "right(trim(katas), 4) as katas_4, ";
    $SQL .= "right(trim('{$str}'), 4) as str_4, ";
    $SQL .= "levenshtein(right(trim('{$str}'), 4), right(trim(katas), 4)) as dist_4, ";

    $SQL .= "right(trim(katas), 5) as katas_5, ";
    $SQL .= "right(trim('{$str}'), 5) as str_5, ";
    $SQL .= "levenshtein(right(trim('{$str}'), 5), right(trim(katas), 5)) as dist_5, ";

/*
    $SQL .= "levenshtein(right(trim('{$str}'), 1), right(trim(katas), 1)) + ";
    $SQL .= "levenshtein(right(trim('{$str}'), 2), right(trim(katas), 2)) + ";
*/
    $SQL .= "levenshtein(right(trim('{$str}'), 3), right(trim(katas), 3)) + ";
    $SQL .= "levenshtein(right(trim('{$str}'), 4), right(trim(katas), 4)) + ";
    $SQL .= "levenshtein(right(trim('{$str}'), 5), right(trim(katas), 5)) "; 
    $SQL .= "as dist_total ";

    $SQL .= "FROM syamei_master ";
    $SQL .= "ORDER BY dist_total ASC ";
    $SQL .= "LIMIT 100";

    //echo($SQL."<br>");

    $res = pg_query($con, $SQL);
    if (!$res) {
        echo("error:". $SQL);
        exit;
    }
    while ($row = pg_fetch_array($res)) {
        $trim_katas = $row["trim_katas"];
    /*
        $str_1 = $row["str_1"];
        $katas_1 = $row["katas_1"];
        $dist_1 = $row["dist_1"];
        $str_2 = $row["str_2"];
        $dist_2 = $row["dist_2"];
        $katas_2 = $row["katas_2"];
        $str_3 = $row["str_3"];
        $dist_3 = $row["dist_3"];
        $katas_3 = $row["katas_3"];   
        $str_4 = $row["str_4"];
        $dist_4 = $row["dist_4"];
        $katas_4 = $row["katas_4"];
    */
        $dist_total = $row["dist_total"];
        echo($trim_katas." : ".$dist_total."<br>");
    }

?>