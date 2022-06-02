<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>出品データチェック</title>
</head>
<?php
    require("./func.php");
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    $con = connectDB();

    $spno = $_GET["spno"];
?>
<body>
    <?php 
        //echo("<img id='spnhyou_origin' src='./spnhyou/S{$spno}.jpg'>");
    ?>
    <h3>USS出品データチェック</h3>
    <div id="main">
        <div id="wrapper_spnhyou">
            <div id="wrapper_spnhyou_origin">
            </div>
            <div id="wrapper_spnhyou_data">
                <img src="./blank.jpg">
                <p id="data_spno"></p>
                <p id="data_cc"></p>
                <p id="data_katas"></p>
                <p id="data_syames"></p>
                <p id="data_grade"></p>
            </div>
        </div>
        

    </div>
    
    <div id="bottom">
        <div id="wrapper_count">
            <div>
                <div class="count_name">件数</div>
            </div>
            <div>
                <div class="count_name">未登録</div><span id="count_unregistered"></span><div>件</div>
            </div>
            <div>
                <div class="count_name">登録</div><span id="count_registered"></span><div>件</div>
            </div>
        </div>
        <div id="wrappper_bottom_right">
            <div>
                出品番号 :  
            </div>
            <div id="spno">

            </div>
            <button id="check">Check</button>
        </div>      
    </div>


</body>
</html>

<script type="text/javascript">
    let spno = <?php echo($spno); ?>;
    let e_spno = document.getElementById("spno");
    e_spno.innerHTML = spno;

    let wrapper_spnhyou_origin = document.getElementById("wrapper_spnhyou_origin");
    wrapper_spnhyou_origin.innerHTML = '';

    let file = "S" + spno + ".jpg";
    img = "<img src='./spnhyou/" + file + "' id='img_spnhyou'>" ;
    wrapper_spnhyou_origin.insertAdjacentHTML('beforeend', img);

    function getData(spno) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/getData.php');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 2) {
                //console.log("HEADERS_RECEIVED");
            }
            else if (xhr.readyState == 3) {
                //console.log("LOADING");
            }
            else if (xhr.readyState == 4 && xhr.status == 200) {
                let responce = xhr.response;
                if (responce == -1) {
                    return;
                }
                else {
                    array = JSON.parse(responce);
                    console.log(responce);
                    setData(array);
                }
                
            }
        }
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.send("spno=" + spno);
    }

    function setData(array) {
        array.forEach( function (val, index) {
            let spno = val["spno"].trim();
            let cc = val["cc"].trim();
            let katas = val["katas"].trim();
            let syamei = val["syamei"].trim();
            let grade = val["grade"].trim();

            let data_spno = document.getElementById("data_spno");
            data_spno.innerHTML = spno;
            let data_cc = document.getElementById("data_cc");
            data_cc.innerHTML = cc;
            let data_katas = document.getElementById("data_katas");
            data_katas.innerHTML = katas;
            let data_syames = document.getElementById("data_syames");
            data_syames.innerHTML = syamei;
            let data_grade = document.getElementById("data_grade");
            data_grade.innerHTML = grade;
        });
    }

    getData(spno);
</script>

<style>
    body {
        width: 1800px;
        margin: auto;
    }
    #main {
        width: 1500px;
        margin: auto;
    }
    #wrapper_spnhyou {
        display: flex;
        flex-direction: row;
        margin: auto;
    }
    #wrapper_spnhyou_origin, #wrapper_spnhyou_data{
        width: 700px;
        height: 700px;
        border: solid;
    }
    #spnhyou_origin {
        width: 700px;
        height: 700px;
        border: solid;
    }
    #img_spnhyou {
        width: 700px;
        height: 700px;
        border: none;
        object-fit: cover;
        object-position: 0 -50px;
    }
    #wrapper_spnhyou_data img {
        width: 700px;
        height: 700px;
        border: none;
        object-fit: cover;
        object-position: 0 -75px;
    }
    #wrapper_spnhyou_data {
        position: relative;
    }
    #wrapper_spnhyou_data p {
        position: absolute;
        color: red;
        font-weight: bold;
    }
    #data_spno {
        font-size: 24px;
        top: 20px;
        left: 50px;
    }
    #data_cc {
        font-size: 20px;
        top: 5px;
        left: 300px;
    }
    #data_katas {
        font-size: 20px;
        top: 5px;
        left: 400px;
    }
    #data_syames {
        font-size: 16px;
        top: 65px;
        left: 220px;
    }
    #data_grade {
        font-size: 20px;
        top: 60px;
        left: 400px;
    }
    #bottom {
        display: flex;
        flex-direction: row;
    }
    #wrapper_count {
        margin: 20px;
        width: 300px;
    }
    #wrapper_count div {
        margin: 1px 10px;
        font-size: 24px;
        font-weight: bold;
        display: flex;
        flex-direction: row;
    }
    .count_name {
        width: 80px;
    }
    #count_unregistered, #count_registered {
        display: inline-block;
        text-align: right;
        width: 80px;
    }
    #wrapper_spnhyou {
        display: flex;
        flex-direction: row;
    }
    #wrappper_bottom_right {
        display: flex;
        flex-direction: row;
        width: 700px;
        height: 70px;
        line-height: 50px;
        vertical-align: middle;
        margin: 30px 30px 30px auto;
    }
    #wrappper_bottom_right div {
        margin: auto 0;
        width: 200px;
        height: 50px;
        font-size: 40px;
        text-align: center;
    }
    #check {
        margin: 0 20px; 
        font-size: 30px;
        font-weight: bold;
        width: 200px;
        height: 60px;
        line-height: 38px;
        vertical-align: middle;
        background-color: #30f030;
        border: 6px outset #30f030;
    }
    #check:active {
        font-size: 30px;
        width: 200px;
        background-color: #70f070;
        border: 6px inset #70f070;
    }
</style>
