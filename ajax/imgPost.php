<?php
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );

    $spno = $_POST["spno"];
    $file_dir = "/var/www/html/syamei2/spnhyou/";
    $filename = "S{$spno}.jpg";
    $api_url = '122.215.245.192/syamei2/ajax/img_return.php';   // 絶対URLでないとダメ
    //$api_url = 'http://192.168.80.131:5500/detect';
    
    $curl = curl_init();
    
    $cfile = new CURLFile($file_dir.$filename, 'image/jpeg', 'img_katas.jpg');   // 第一パラメータのアップロードするファイル名は、絶対パスでないとダメ！！
    $params = array('img' => $cfile);

    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params );

    $data = curl_exec($curl);
    echo($data);

?>