<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <title>車名検索</title>
</head>
<?php
/*
    require("./func.php");
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    $con = connectDB();
    $spno = $_GET["spno"];
*/
?>
<body>
    <h3>USS車名検索</h3>
    <div id="main">
        <div id="main_left">
            <div id="wrapper_spnhyou">

                <div id="wrapper_spnhyou_origin">
                </div>
                <div id="wrapper_spnhyou_data">
                    <img src="./blank.jpg">
                    <div id="wrapper_p_data_spno">
                        <p id="p_data_spno"></p>
                    </div>
                    <div id="wrapper_p_data_cc">
                        <p id="p_data_cc"></p>
                    </div>
                    <div id="wrapper_p_data_katas">
                        <p id="p_data_katas"></p>
                    </div>
                    <div id="wrapper_p_data_syamei">
                        <p id="p_data_syamei"></p>
                    </div>
                    <div id="wrapper_p_data_door">
                        <p id="p_data_door"></p>
                    </div>
                    <div id="wrapper_p_data_grades">
                        <p id="p_data_grades"></p>
                    </div>                    

                    <form id="form_register">
                        <input type="hidden" id="input_data_syancd" name="syancd" readonly>
<!--
                        <input type="hidden" id="input_data_spno" name="spno" readonly>
                        <input type="hidden" id="input_data_cc" name="cc" readonly>
                        <input type="hidden" id="input_data_katas" name="katas" readonly>
                        <input type="hidden" id="input_data_syames" name="syams" readonly>
                        <input type="hidden" id="input_data_door" name="door" readonly>
                        <input type="hidden" id="input_data_grades" name="grades" readonly>
-->
                    </form>
                </div>

            </div>
            <div class="wrapper_form">
                <form id="form_search" onsubmit="return false;" autocomplete="off">
<!--
                    <div id="wrapper_inputs_top">
                        <div id="wrapper_input_katas">
                            <span>型式(F1)</span><input type="tel" id="katas" name="katas" oninput="search();" autofocus>
                        </div>
                        <div class="wrapper_match">
                            <select id="katas_match" class="select_match" name="katas_match" onchange="search(); getMatchChange('katas_match');">
                                <option value="0">前方一致</option>
                                <option value="1">後方一致</option>
                                <option value="2">部分一致</option>
                                <option value="3">完全一致</option>
                                <option value="4">含まない</option>
                            </select>
                        </div>
                        <div class="wrapper_input_question">
                            <label><input type="checkbox" id="question" name="question"><span>？</span></label>
                        </div>
                    </div>
-->
                    <div id="wrapper_inputs">
                        <div>
                            <div>
                                <span class="span_name">型式(F1)</span><input type="tel" id="katas" name="katas" oninput="search();" autofocus>
                                <div class="wrapper_match">
                                    <select id="katas_match" class="select_match" name="katas_match" onchange="search(); getMatchChange('katas_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input class="question" type="checkbox" id="katas_question" name="katas_question"><span>？</span></label>
                                </div>
                            </div>
                            <div>
                                <span class="span_name">排気量(F2)</span><input type="tel" id="cc" name="cc" class="input_search" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="cc_match" class="select_match" name="cc_match" onchange="search(); getMatchChange('cc_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="cc_question" name="cc_question"><span>？</span></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <span class="span_name">車名(F3)</span><input type="text" id="syamei" name="syamei" class="input_search" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="syamei_match" class="select_match" name="syamei_match" onchange="search(); getMatchChange('syamei_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="syamei_question" name="syamei_question"><span>？</span></label>
                                </div>
                            </div>
                            <div>
                                <span class="span_name">正式車名(F4)</span><input type="text" id="syames" name="syames" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="syames_match" class="select_match" name="syames_match" onchange="search(); getMatchChange('syames_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="syames_question" name="syames_question"><span>？</span></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <span class="span_name">グレード(F5)</span><input type="text" id="grade" name="grade" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="grade_match" class="select_match" name="grade_match" onchange="search(); getMatchChange('grade_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="grade_question" name="grade_question"><span>？</span></label>
                                </div>
                            </div>
                            <div>
                                <span class="span_name">正式グレード(F6)</span><input type="text" id="grades" name="grades" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="grades_match" class="select_match" name="grades_match" onchange="search(); getMatchChange('grades_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="grades_question" name="grades_question"><span>？</span></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <span class="span_name">車名コード(F7)</span><input type="text" id="syancd" name="syancd" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="syancd_match" class="select_match" name="syancd_match" onchange="search(); getMatchChange('syancd_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="syancd_question" name="syancd_question"><span>？</span></label>
                                </div>
                            </div>
                            <div>
                                <span class="span_name">自税区分(F8)</span><input type="text" id="zeikbn" name="zeikbn" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="zeikbn_match" class="select_match" name="zeikbn_match" onchange="search(); getMatchChange('zeikbn_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="zeikbn_question" name="zeikbn_question"><span>？</span></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <span class="span_name">備考(F9)</span><input type="text" id="biko" name="biko" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="biko_match" class="select_match" name="biko_match" onchange="search(); getMatchChange('biko_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="biko_question" name="biko_question"><span>？</span></label>
                                </div>
                            </div>
                            <div>
                                <span class="span_name">ブランド(F10)</span><input type="text" id="brandn" name="brandn" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="brandn_match" class="select_match" name="brandn_match" onchange="search(); getMatchChange('brandn_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <label><input type="checkbox" id="brandn_question" name="brandn_question"><span class="span_question">？</span></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <span class="span_name">フリーワード</span><input type="text" id="freeword" name="freeword" oninput="search();">
                                <div class="wrapper_match">
                                    <select id="freeword_match" class="select_match" name="freeword_match" onchange="search(); getMatchChange('freeword_match');">
                                        <option value="0">前方一致</option>
                                        <option value="1">後方一致</option>
                                        <option value="2">部分一致</option>
                                        <option value="3">完全一致</option>
                                        <option value="4">含まない</option>
                                    </select>
                                </div>
                                <div class="wrapper_input_question">
                                    <div style="width: 30px;"></div>
                                </div>
                            </div>
                           <div>
                                <span class="span_name">メモ</span><input type="text" id="memo" name="memo">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <div id="list" name="list">
                    <div id="list_header">
                    </div>
                    <div id="wrapper_list_row">
                    </div>
                </div>
                <div id="wrapper_fontSize" >
                    <span>文字サイズ</span>
                    <input type="number" id="fontSize" name="fontSize">
                    <button onclick="changeFontSize();">変更</button>
                </div>  
            </div>
                    
        </div>
        
        <div id="main_right">
            <div id="wrapper_counts">
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
            <button id="wrapper_spnhyou_full" onclick="displaySpnhyouLarge();"></button>
            <button id="wrapper_spnhyou_full_large" onclick="closeSpnhyouLarge();"></button>
            <div id="bottom">
                <div>
                    出品番号 : <span id="spno">17004</span>
                </div>
    
                <button id="register" onclick="register()">登録</button>
            </div>




        </div>
        
    </div>
    


</body>
</html>

<script type="text/javascript">
    let cookie = getCookieArray(document.cookie);
    let list_header_order = cookie["list_header_order"];
    if (!list_header_order) {
        list_header_order = "syancd,syamei,katas,cc,zeikbn,grade,grades,syames,brandn,syasyu,door,biko";
    }

    //出品番号取得
    //const spno = <?php //echo($spno); ?>;
    let url = new URL(window.location.href);
    let params = url.searchParams;
    const spno = parseInt(params.get('spno'));

    //出品番号の表示
    let e_spno = document.getElementById("spno");
    e_spno.innerHTML = spno;
    let p_data_spno = document.getElementById("p_data_spno");
    p_data_spno.innerHTML = spno;
    //let input_data_spno = document.getElementById("input_data_spno");
    //input_data_spno.value = spno;

    //セッションからsortName取得
    let sortName = window.sessionStorage.getItem(['sortName']);
    if (!sortName) {
        sortName = "katas";
    }
    //セッションからsortDirection取得
    let sortDirection = window.sessionStorage.getItem(['sortDirection']);
    if (!sortDirection) {
        sortDirection = "ASC";
    }

    let focused_form_id = document.activeElement.id;    //現在（または直前に）フォーカスがあるフォーム
    let focused_button_id = "";     //現在（または直前に）フォーカスがあるリスト内のデータ

    
    let list_row_fontSize = Number(cookie["fontSize"]);
    if (!list_row_fontSize) {
        list_row_fontSize = 18;
    }
    let list_row_height = list_row_fontSize + 4;
    document.getElementById("fontSize").value = list_row_fontSize;

    displayListHeader();
    setHeaderWidth();
    displaySpnhyou();
    //imgPost();
    //register();
    keyboard();
    focusInputs();
    focusForm();
    headerWidthChange()
    setMatch();

       
    function displayListHeader() {
        let array_headername = list_header_order.split(',');
        let list_header = document.getElementById("list_header");
        list_header.innerHTML = "";
        //list_header.style.height = list_row_height + "px";
        //list_header.style.lineHeight = list_row_height + "px";
        let style = "style='font-size: " + list_row_fontSize + "px; height: " + list_row_height + "px; line-height: " + list_row_height + "px;'"
        style = "style='font-size: " + list_row_fontSize + "px;'";
        //style = "style=''";
        array_header = {
            syancd: "<div id=\"header_syancd\" data-headername=\"syancd\"><button " + style + " type=\"button\" onclick=\"sortList('katas')\">車名コード</button></div>",
            syamei: "<div id=\"header_syamei\" data-headername=\"syamei\"><button " + style + " type=\"button\" onclick=\"sortList('syamei')\">車名</button></div>",
            katas: "<div id=\"header_katas\" data-headername=\"katas\"><button " + style + " type=\"button\" onclick=\"sortList('katas')\">型式</button></div>",
            cc: "<div id=\"header_cc\" data-headername=\"cc\"><button " + style + " type=\"button\" onclick=\"sortList('cc')\">排気量</button></div>",
            zeikbn: "<div id=\"header_zeikbn\" data-headername=\"zeikbn\"><button " + style + " type=\"button\" onclick=\"sortList('zeikbn')\">自税</button></div>",
            grade: "<div id=\"header_grade\" data-headername=\"grade\"><button " + style + " type=\"button\" onclick=\"sortList('grade')\">グレード</button></div>",
            grades: "<div id=\"header_grades\" data-headername=\"grades\"><button " + style + " type=\"button\" onclick=\"sortList('grades')\">正式グレード</button></div>",
            syames: "<div id=\"header_syames\" data-headername=\"syames\"><button " + style + " type=\"button\" onclick=\"sortList('syames')\">正式車名</button></div>",
            brandn: "<div id=\"header_brandn\" data-headername=\"brandn\"><button " + style + " type=\"button\" onclick=\"sortList('brandn')\">ブランド</button></div>",
            syasyu: "<div id=\"header_syasyu\" data-headername=\"syasyu\"><button " + style + " type=\"button\" onclick=\"sortList('syasyu')\">車種</button></div>",
            door: "<div id=\"header_door\" data-headername=\"door\"><button " + style + " type=\"button\" onclick=\"sortList('door')\">ドア</button></div>",
            biko: "<div id=\"header_biko\" data-headername=\"biko\"><button " + style + " type=\"button\" onclick=\"sortList('biko')\">備考</button></div>",
        }
        array_headername.forEach( function(val) {
            let element = array_header[val];
            list_header.insertAdjacentHTML('beforeend', element);
        }) 
    }

    function getCookieArray(){
        let array = new Array();
        if (document.cookie != ''){
            let tmp = document.cookie.split('; ');
            for (let i = 0; i < tmp.length; i++){
                let data = tmp[i].split('=');
                array[data[0]] = decodeURIComponent(data[1]);
            }
        }
        return array;
    }

    function setCookie(name, value) {
        let days = 365;   //cookieの期限(日)
        let date = new Date();  //現在の日付データを取得
        date.setTime(date.getTime() + days*24*60*60*1000);    //30日後の日付データを作成
        let cookie_expire_date = date.toGMTString();    //GMT形式に変換

        document.cookie = name + "=" + value + "; expires=" + cookie_expire_date; 
        cookie = getCookieArray(document.cookie); //配列cookieを更新
    }


    function setHeaderWidth () {
        let array = ["syancd", "syamei", "katas", "cc", "zeikbn", "grade", "grades", "syames", "brandn", "syasyu", "door", "biko"];
        array.forEach( function (val) {
            if (!val) {
                return;
            }
            let element = document.getElementById("header_" + val);
            element.style.width = cookie[val] + "px";
        })
    }

    //出品票表示
    function displaySpnhyou() {
        let wrapper_spnhyou_origin = document.getElementById("wrapper_spnhyou_origin");
        let file = "S" + spno + ".jpg";
        let img = "<img src='./spnhyou/" + file + "' id='img_spnhyou'>" ;
        wrapper_spnhyou_origin.insertAdjacentHTML('beforeend', img);

        let spnhyou_full = document.getElementById("wrapper_spnhyou_full");
        let img2 = "<img src='./spnhyou/" + file + "' id='spnhyou_full'>";
        spnhyou_full.insertAdjacentHTML('beforeend', img2);

        let spnhyou_full_large = document.getElementById("wrapper_spnhyou_full_large");
        let img3 = "<img src='./spnhyou/" + file + "' id='spnhyou_full_large'>";
        spnhyou_full_large.insertAdjacentHTML('beforeend', img3);
    }

    function displaySpnhyouLarge() {
        let spnhyou_full_large = document.getElementById("wrapper_spnhyou_full_large");
        spnhyou_full_large.style.display = "block";
    }

    function closeSpnhyouLarge() {
        let spnhyou_full_large = document.getElementById("wrapper_spnhyou_full_large");
        spnhyou_full_large.style.display = "none";
    }

    //出品票画像をサーバーにPOST
    function imgPost() {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/imgPost.php');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 2) {
                //console.log("HEADERS_RECEIVED");
            }
            else if (xhr.readyState == 3) {
                //console.log("LOADING");
            }
            else if (xhr.readyState == 4 && xhr.status == 200) {
                let responce = xhr.response;
                //console.log(responce);

            }
        }
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.send("spno=" + spno);
    }
    
    //検索の処理
    function search() {
        let form = document.getElementById('form_search');
        let formData = new FormData(form);
        let syamei = replaceKatakanaFtoH(formData.get("syamei"));
        formData.set("syamei", syamei);
        let grade = replaceKatakanaFtoH(formData.get("grade"));
        formData.set("grade", grade);
        let grades = replaceAlphabetHtoF(formData.get("grades"));
        formData.set("grades", grades);

        formData.set("sortName", sortName);
        window.sessionStorage.setItem(['sortName'],[sortName]);
        formData.set("sortDirection", sortDirection);
        window.sessionStorage.setItem(['sortDirection'],[sortDirection]);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/search.php');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 2) {
                //console.log("HEADERS_RECEIVED");
            }
            else if (xhr.readyState == 3) {
                //console.log("LOADING");
            }
            else if (xhr.readyState == 4 && xhr.status == 200) {
                let responce = xhr.response;
                console.log(responce);
                if (responce == -1) {
                    let array = [];
                    displayList(array);
                    return;
                }
                else {
                    let array = JSON.parse(responce);
                    displayList(array);
                }
                focused_button_id = "";
                focused_form_id = document.activeElement.id;
                //console.log(json);
            }
        }
        //xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.send(formData);
    };

    function getCount() {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/getCount.php');
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
                    setCount(responce);
                }
            }
        }
        //xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.send();
    };

    function setCount(count) {
        let count_registered = document.getElementById("count_registered");
        count_registered.innerHTML = count;
    }
   
    //リストを表示
    function displayList(array) {
        let wrapper_list_row = document.getElementById("wrapper_list_row");
        wrapper_list_row.innerHTML = '';
        let i = 1;

        array.forEach( function (val, index) {
            let id = "id_" + i;
            if (list_header_order) {
                array_lho = list_header_order.split(',');
            }
            else {
                array_lho = ["syancd", "syamei", "katas", "cc", "zeikbn", "grade", "grades", "syames", "brandn", "syasyu", "door", "biko"];
            }
            let row_add = "";
            array_lho.forEach( function (name) {
                let data = val[name].trim();
                let width = cookie[name];
                //console.log(name + ":" + data + " : " + width);
                if (width) {
                    row_add += "<div class='" + name + "' style='width: " + width + "px;'>" + data + "</div>";
                }
                else {
                    row_add += "<div class='" + name + "'>" + data + "</div>";
                }
            })
            let syancd = val["syancd"].trim();
            let katas = val["katas"].trim();
            let cc = val["cc"].trim();
            let syamei = val["syamei"].trim();
            let style = "";
            if (syamei.indexOf("4W") > 0) {
                style = "style='color: #1c00ff; line-height: " + list_row_height + "px; height: " + list_row_height + "px; font-size: " + list_row_fontSize + "px;'"
            }
            else {
                style = "style='line-height: " + list_row_height + "px; height: " + list_row_height + "px; font-size: " + list_row_fontSize + "px;'"
            }

            let grades = val["grades"].trim();
            let door = val["door"].trim();
            let row = "<button " + style + "class='list_row' id='" + id + "' onclick='setData(\"" + syancd + "\", \"" + katas + "\", \"" + cc + "\", \""  + syamei + "\", \"" + grades +  "\", \"" + door + "\")'>";
            row += row_add;
            row += "</button>";
            wrapper_list_row.insertAdjacentHTML('beforeend', row);
            i++;
        });
    };

    //登録
    function register() {
        let form = document.getElementById("form_register");
        let formData = new FormData(form);
        formData.append("spno", spno);
        let syancd = formData.get("syancd");
        if (!syancd) {
            window.alert("データが入力されていません。");
            //フォーカスを戻す
            focusById(focused_form_id);
            return;
        }
        console.log(spno);
        jumpToNextSpno(spno);
        return;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/register.php');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 2) {
                //console.log("HEADERS_RECEIVED");
            }
            else if (xhr.readyState == 3) {
                //console.log("LOADING");
            }
            else if (xhr.readyState == 4 && xhr.status == 200) {
                let responce = xhr.response;
                if (responce == 0) {
                    getCount();
                    //console.log(responce);
                }
                else {
                    //console.log(responce);
                }
            }
        }
        //xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.send(formData);
    }

    //登録用のデータをセット
    function setData(syancd, katas, cc, syamei, grades, door) {
        resetFontSize();

        let input_data_syancd = document.getElementById("input_data_syancd");
        input_data_syancd.value = syancd;

        let p_data_katas = document.getElementById("p_data_katas");
        p_data_katas.innerHTML = katas;

        let p_data_cc = document.getElementById("p_data_cc");
        p_data_cc.innerHTML = cc;

        let p_data_syamei = document.getElementById("p_data_syamei");
        p_data_syamei.innerHTML = syamei;
        let w_syamei = getStrWidth(syamei);
        if (w_syamei > 130) {
            p_data_syamei.style.fontSize = "12px";
        }

        let p_data_grades = document.getElementById("p_data_grades");
        p_data_grades.innerHTML = grades;
        let w_grades = getStrWidth(grades);
        if (w_grades > 215) {
            p_data_grades.style.fontSize = "12px";
        }

        let p_data_door = document.getElementById("p_data_door");
        p_data_door.innerHTML = door;

        //マウスでリストをクリックした後、自動でフォームにフォーカスを戻す
        focusById(focused_form_id);
    };

    //リスト内のデータの色を変更する
    function changeButtonColor(id) {
        clearButtonColor();
        let button = document.getElementById(id);
        button.style.backgroundColor = "#ffdada";
    }

    //リスト内のデータの色を元に戻す
    function clearButtonColor() {
        let wrapper_list_row = document.getElementById("wrapper_list_row");
        let button = wrapper_list_row.children;
        for (let i = 0; i < button.length; i++){
			button[i].style.backgroundColor = "#ffeeee";
		}
    }
    
    //文字列の表示幅を取得
    function getStrWidth(str) {
        // spanを生成.
        let span = document.createElement('span');

        // 現在の表示要素に影響しないように、画面外に飛ばしておく.
        span.style.position = 'absolute';
        span.style.top = '-1000px';
        span.style.left = '-1000px';

        // 折り返しはさせない.
        span.style.whiteSpace = 'nowrap';

        // 計測したい文字を設定する.
        span.innerHTML = str;

        // 必要に応じてスタイルを適用する.
        span.style.fontSize = '14px';
        //span.style.letterSpacing = '2em';

        // DOMに追加する（追加することで、ブラウザで領域が計算されます）
        document.body.appendChild(span);

        // 横幅を取得します.
        let width = span.clientWidth;
        //console.log('width:', width)

        // 終わったらDOMから削除します.
        span.parentElement.removeChild(span);

        return width;
    }

    //フォントサイズを元に戻す
    function resetFontSize() {
        let p_data_syamei = document.getElementById("p_data_syamei");
        p_data_syamei.style.fontSize = "16px";

        let p_data_grades = document.getElementById("p_data_grades");
        p_data_grades.style.fontSize = "16px";
    }

    //カタカナを全角から半角に変換
    function replaceKatakanaFtoH(str){
        let kanaMap = {
            "ガ": "ｶﾞ", "ギ": "ｷﾞ", "グ": "ｸﾞ", "ゲ": "ｹﾞ", "ゴ": "ｺﾞ",
            "ザ": "ｻﾞ", "ジ": "ｼﾞ", "ズ": "ｽﾞ", "ゼ": "ｾﾞ", "ゾ": "ｿﾞ",
            "ダ": "ﾀﾞ", "ヂ": "ﾁﾞ", "ヅ": "ﾂﾞ", "デ": "ﾃﾞ", "ド": "ﾄﾞ",
            "バ": "ﾊﾞ", "ビ": "ﾋﾞ", "ブ": "ﾌﾞ", "ベ": "ﾍﾞ", "ボ": "ﾎﾞ",
            "パ": "ﾊﾟ", "ピ": "ﾋﾟ", "プ": "ﾌﾟ", "ペ": "ﾍﾟ", "ポ": "ﾎﾟ",
            "ヴ": "ｳﾞ", "ヷ": "ﾜﾞ", "ヺ": "ｦﾞ",
            "ア": "ｱ", "イ": "ｲ", "ウ": "ｳ", "エ": "ｴ", "オ": "ｵ",
            "カ": "ｶ", "キ": "ｷ", "ク": "ｸ", "ケ": "ｹ", "コ": "ｺ",
            "サ": "ｻ", "シ": "ｼ", "ス": "ｽ", "セ": "ｾ", "ソ": "ｿ",
            "タ": "ﾀ", "チ": "ﾁ", "ツ": "ﾂ", "テ": "ﾃ", "ト": "ﾄ",
            "ナ": "ﾅ", "ニ": "ﾆ", "ヌ": "ﾇ", "ネ": "ﾈ", "ノ": "ﾉ",
            "ハ": "ﾊ", "ヒ": "ﾋ", "フ": "ﾌ", "ヘ": "ﾍ", "ホ": "ﾎ",
            "マ": "ﾏ", "ミ": "ﾐ", "ム": "ﾑ", "メ": "ﾒ", "モ": "ﾓ",
            "ヤ": "ﾔ", "ユ": "ﾕ", "ヨ": "ﾖ",
            "ラ": "ﾗ", "リ": "ﾘ", "ル": "ﾙ", "レ": "ﾚ", "ロ": "ﾛ",
            "ワ": "ﾜ", "ヲ": "ｦ", "ン": "ﾝ",
            "ァ": "ｧ", "ィ": "ｨ", "ゥ": "ｩ", "ェ": "ｪ", "ォ": "ｫ",
            "ッ": "ｯ", "ャ": "ｬ", "ュ": "ｭ", "ョ": "ｮ",
            "。": "｡", "、": "､", "ー": "ｰ", "「": "｢", "」": "｣", "・": "･"
        };
        let reg = new RegExp('(' + Object.keys(kanaMap).join('|') + ')', 'g');
        return str.replace(reg, function(s){
            return kanaMap[s];
        }).replace(/゛/g, 'ﾞ').replace(/゜/g, 'ﾟ');
    }

    //アルファベットを半角から全角に変換
    function replaceAlphabetHtoF(str) {
        return str.replace(/[A-Za-z0-9]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
        });
    }

    //次の出品番号へ
    function jumpToNextSpno(spno) {
        let array = [17007, 17008, 17009, 17018, 17022, 17023, 17024, 17025, 17028, 17030, 17032];
        let len = array.length;
        let i = array.indexOf(spno);
        if (i == len - 1) {
            next_spno = array[0];
        }
        else {
            next_spno = array[i + 1];
        }

        window.location.href = "./search.php?spno=" + next_spno;
    }

    //リストをソート
    function sortList(name) {
        if (sortName == name) {
            if (sortDirection == "ASC") {
                sortDirection = "DESC";
            }
            else {
                sortDirection = "ASC";
            }
        }
        else {
            sortName = name;
            sortDirection = "ASC";
        }
        console.log("sort : " + sortName + " sortDirection : " + sortDirection);
        search();
        focusById(focused_form_id);
    }

    //エンターキー、ファンクションキーなどの処理
    function keyboard() {
        window.addEventListener("keydown", function(e) {
            let keycode = e.keyCode;
            if (keycode == 13) {    //Enter
                document.getElementById("register").click();
            }
            else if (keycode == 32 || keycode == 229) {     //Space(229:全角スペース)
                if (focused_button_id != "") {
                    document.getElementById(focused_button_id).click();
                }
                else {
                    return;
                }
            }
            else if (keycode == 38) {   //↑
                clickUp();
            }
            else if (keycode == 40) {   //↓
                clickDown();
            }
            else if (keycode == 112) {   //F1
                focusById("katas");
            }
            else if (keycode == 113) {   //F2
                focusById("cc");
            }
            else if (keycode == 114) {   //F3
                focusById("syamei");
            }
            else if (keycode == 115) {   //F4
                focusById("syames");
            }
            else if (keycode == 116) {   //F5
                focusById("grade");
            }
            else if (keycode == 117) {   //F6
                focusById("grades");
            }
            else if (keycode == 118) {   //F7
                focusById("syancd");
            }
            else if (keycode == 119) {   //F8
                focusById("zeikbn");
            }
            else if (keycode == 120) {   //F9
                focusById("biko");
            }
            else if (keycode == 121) {   //F10
                focusById("brandn");
            }
            else if (keycode == 122) {   //F12
                let question = document.getElementById("question");
                if (question.checked == true) {
                    question.checked = false;
                }
                else if (question.checked == false) {
                    question.checked = true;
                }
            }
            else {
                return;
            }
            //ファンクションキーの機能を無効化
            event.keyCode = null;
            event.returnValue = false;
            return;
        }); 
    }
    

    //[↑]ボタンが押されたとき
    function clickUp() {
        if (focused_button_id == "") {
            let id_1 = document.getElementById("id_1");
            if (id_1) {
                focusList(id_1);
            }
            else {
                return;
            }
        }
        else {
            let e_previous = document.getElementById(focused_button_id).previousElementSibling;
            if (e_previous) {
                focusList(e_previous);
            }
            else {
                return;
            }
        }
    }

    //[↓]ボタンが押されたとき
    function clickDown() {
        if (focused_button_id == "") {
            let id_1 = document.getElementById("id_1");
            if (id_1) {
                focusList(id_1);
            }
            else {
                return;
            }
        }
        else {
            let e_next = document.getElementById(focused_button_id).nextElementSibling;
            if (e_next) {
                focusList(e_next);
            }
            else {
                return;
            }
        }
    }

    //リスト内でクリックされたとき
    function focusList(e) {
        e.focus();  //クリックされたデータにフォーカス
        clearButtonColor();
        e.style.backgroundColor = "#ffb0b0";
        focused_button_id = e.id;
        focusById(focused_form_id); //直前のフォームにフォーカスを戻す
    }

    //idの要素にフォーカス
    function focusById(id) {
        if (!id) {
            //処理中に何もない場所をクリックされるとfocused_button_idがNullになるため
            id = "katas";
        }
        document.getElementById(id).focus();
    }

    //何もない場所をクリックするなどでフォーカスが外れた時にフォームに戻す
    function focusForm() {
        window.addEventListener("click", function() {
            let tagName = document.activeElement.tagName;
            if (tagName == "BODY") {
                focusById(focused_form_id);
            }
        }); 
    }

    //input要素がフォーカスされたときの処理
    function focusInputs() {
        let inputs = document.querySelectorAll("input");
        inputs.forEach(function(input) {
            if (input.id == "question") {
                focusById(focused_form_id);
                return;
            }
            input.addEventListener("focus", function(e) {
                let id = document.activeElement.id;
                focused_form_id = id;
            });
        });
    }
    
    //リストのヘッダーの幅の変更を取得
    function headerWidthChange() {
        let list_header = document.getElementById('list_header');
        let elements = list_header.children;
        for (let i = 0; i < elements.length; i++){
            let element = elements[i];
            getWidthChange(element);
        }
    }

    function getWidthChange(element) {
        //要素のリサイズイベント取得
        let observer = new MutationObserver(() => {
            //要素のサイズ確認
            let width = element.getBoundingClientRect().width;
            let height = element.getBoundingClientRect().height;
            //console.log('size(w,h): ', width, height);
            let className = element.dataset.headername;
            changeWidth(className, width);
        })
        observer.observe(element, {
            attriblutes: true,
            attributeFilter: ["style"]
        })

    }

    function changeWidth(className, width) {
        let elements = document.getElementsByClassName(className);
        for (let i = 0; i < elements.length; i++){
            elements[i].style.width = width + "px";
        }
        setCookie(className, width);
    }

    new Sortable(list_header,{
        animation: 300,
        ghostClass: 'ghost',
        chosenClass: 'light-green',
        delay: 100,
        onSort: function () {
            getListHeaderOrder();
            search();
            focusById(focused_form_id);
        },
    });

    function getListHeaderOrder() {
        let headers = document.querySelectorAll('#list_header div');
        list_header_order = "";
        for(let i = 0; i < headers.length; i++) {
            let headername = headers[i].dataset.headername;
            list_header_order = list_header_order + headername;
            if (i != headers.length - 1) {
                list_header_order = list_header_order + ",";
            }
        }
        setCookie("list_header_order", list_header_order);
    }

    //検索の一致条件を設定
    function setMatch () {
        let array = ["katas", "cc", "syamei", "syames", "syames", "grade", "grades", "syancd", "zeikbn", "biko", "brandn", "freeword"];
        array.forEach(function(val) {
            let id = val + "_match";
            let match = cookie[id];
            if (!match) {   //クッキーがセットされていなければ（デフォルト）
                //match = 0;
                return;
            }
            let element = document.getElementById(id);
            element.value = match;
        })
    }
    //検索の一致条件の変更を取得（してcookieをセット）
    function getMatchChange(id) {
        let element = document.getElementById(id);
        let match = element.value;
        console.log(id + " :: " + match);
        setCookie(id, match);
        focusById(focused_form_id); //フォーカスをフォームに戻す
    }

    function changeFontSize() {
        let fontSize = document.getElementById("fontSize").value;
        fontSize = Number(fontSize);
        list_row_height = fontSize + 2;
        list_row_fontSize =  fontSize;
        setCookie("fontSize", fontSize);
        displayListHeader();
        setHeaderWidth();
        headerWidthChange();
        search();
    }
</script>

<style>
    body {
        width: 1800px;
        margin: auto;
    }
    #main {
        display: flex;
        flex-direction: row;
    }
    #main_left {
        width: 1500px;
    }
    #main_right {
        width: 300px;
    }
    #main_left div {
    }
    #wrapper_counts div {
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
    #wrapper_spnhyou_full {
        padding: 0;
        border: solid;
    }
    #spnhyou_full {
        width: 330px;
    }
    #wrapper_spnhyou_full_large {
        display: none;
        position: absolute;
        top: 50px;
        right: 10px;
        z-index: 10;
        padding: 0;
        border: solid;
    }
    #spnhyou_full_large {
        width: 600px;
    }
    #wrapper_spnhyou {
        margin: auto;
        width: 1410px;
        display: flex;
        flex-direction: row;
    }
    #wrapper_spnhyou_origin, #wrapper_spnhyou_data{
        width: 700px;
        height: 125px;
        border: solid;
    }
    #wrapper_spnhyou_data {
        position: relative;
    }
    #spnhyou_origin {
        width: 700px;
        height: 125px;
        border: solid;
    }
    #img_spnhyou {
        width: 700px;
        height: 125px;
        border: none;
        object-fit: cover;
        object-position: 0 -50px;
    }
    #wrapper_spnhyou_data img {
        width: 700px;
        height: 125px;
        border: none;
        object-fit: cover;
        object-position: 0 -70px;
    }
    #wrapper_spnhyou_data div {
        position: absolute;
        color: red;
        font-weight: bold;
        border: solid;
        border-color: rgba(0,0,0,0);
        display: flex;
        justify-content: center; /*左右中央揃え*/;
    }
    #wrapper_spnhyou_data div p{
        background-color: rgba(0,0,0,0);
        margin: auto; 
        color: red;
        font-weight: bold;
        overflow-wrap: break-word;
    }
    #wrapper_p_data_spno {
        width: 80px;
        top: 45px;
        left: 47px;   
    }
    #p_data_spno {
        font-size: 22px;
        text-align: center;
    }
    #wrapper_p_data_cc {
        width: 115px;
        height: 25px;
        top: 29px;
        left: 273px;
    }
    #p_data_cc {
        font-size: 20px;
        text-align: center;
    }
    #wrapper_p_data_katas {
        width: 170px;
        height: 25px;
        top: 29px;
        left: 395px;
    }
    #p_data_katas {
        font-size: 20px;
        text-align: left;
    }
    #wrapper_p_data_syamei {
        width: 120px;
        height: 35px;
        top: 75px;
        left: 220px;
    }
    #p_data_syamei {
        font-size: 16px;
        line-height: 18px;
        text-align: left;
        overflow-wrap: normal;
    }
    #wrapper_p_data_door {
        width: 35px;
        height: 35px;
        top: 75px;
        left: 350px;
    }
    #p_data_door {
        font-size: 20px;
        text-align: center;
    }
    #wrapper_p_data_grades {
        width: 135px;
        height: 35px;
        top: 75px;
        left: 395px;
    }
    #p_data_grades {
        font-size: 16px;
        line-height: 18px;
        text-align: left;
        overflow-wrap: normal;
    }
    .wrapper_form {
        width: 1400px;
        margin: 10px auto;
    }
    #form_search {
        margin: 20px 15px;
    }
/*
    #form_search div span {
        display: inline-block;
        text-align: left;
        font-size: 20px;
        width: 140px;
        height: 30px;
    }
*/   
    .wrapper_match {
        display: flex;
        align-items: center;
        margin: 0 5px;
    }

    #wrapper_inputs {
        display: flex;
        flex-direction: column;
    }
    #wrapper_inputs > div {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    #wrapper_inputs > div > div {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 3px 25px;
    }
    .span_name {
        display: inline-block;
        text-align: left;
        font-size: 16px;
        width: 140px;
        height: 26px;
    }
    #wrapper_inputs > div > div > input {
        font-size: 16px;
        width: 250px;
        height: 26px;
    }
    .wrapper_input_question {
        display: flex;
        flex-direction: row;
        margin: 0 5px;
        height: 30px;
        line-height: 30px;
        vertical-align: middle;
    }
    .wrapper_input_question span {
        font-size: 18px;
        width: 140px;
    }


    #list {
        position: relative;
        margin: auto;
        width: 1377px;
        height: 400px;
        overflow: scroll;  /* スクロールバーを表示(※) */
        border: black 2px solid;    /* 枠線を追加 */
        background-color: #ffffff; /* 背景色を追加 */
    }
    .list_row {
        height: 20px;
        line-height: 20px;
        font-size: 15px;
        color: black;
        background-color: #ffeeee;
        display: flex;
        flex-direction: row;
        border: none;
        border-bottom: rgba(100,0,0,0.3) 1px dotted;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0px;
        margin: 0;
    }
    .list_row:hover {
        background-color: #ffc0d0 !important;
    }
    .list_row div {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0 3px;
        padding: 0px;
    }
    #header_syancd {
        width: 100px;
        text-align: center;
    }
    .syancd {
        width: 100px;
        text-align: center;
    }
    #header_syamei {
        width: 100px;
        text-align: left;
    }
    .syamei {
        width: 100px;
        text-align: left;
    }
    #header_katas {
        width: 100px;
        text-align: left;
    }
    .katas {
        width: 100px;
        text-align: left;
    }
    #header_cc {
        width: 50px;
        text-align: center;
    }
    .cc {
        width: 50px;
        text-align: right;
    }
    #header_zeikbn {
        width: 50px;
        text-align: center;
    }
    .zeikbn {
        width: 50px;
        text-align: center;
    }
    #header_grade {
        width: 150px;
        text-align: left;
    }
    .grade {
        width: 150px;
        text-align: left;
    }
    #header_grades {
        width: 250px;
        text-align: left;
    }
    .grades {
        width: 250px;
        text-align: left;
    }
    #header_syames {
        width: 200px;
        text-align: left;
    }
    .syames {
        width: 200px;
        text-align: left;
    }
    #header_brandn {
        width: 100px;
        text-align: left;
    }
    .brandn {
        width: 100px;
        text-align: left;
    }
    #header_syasyu {
        width: 250px;
        text-align: left;
    }
    .syasyu {
        width: 250px;
        text-align: left;
    }
    #header_door {
        width: 40px;
        text-align: center;
    }
    .door {
        width: 40px;
        text-align: center;
    }
    #header_biko {
        width: 200px;
        text-align: left;
    }
    .biko {
        width: 200px;
        text-align: left;
    }

    #list_header {
        color: black;
        background-color: #f4f4f4;
        display: inline-flex;
        flex-direction: row;
        border: none;
        border-bottom: rgba(100,100,100,0.3) 1px solid;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        position: sticky;
        top: 0;
    }
    #list_header div {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0 3px;
        padding: 0px;
        border: none;
        box-sizing: content-box;
        resize: horizontal;
        overflow: hidden;
    }
    #list_header div button{
        font-size: 15px;
        margin: 0px;
        padding: 0px;
        border: none;
    }
    #bottom {
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        margin-top: 100px;
    }
    #bottom div {

        height: 50px;
        margin: 10px auto;
        font-size: 36px;
        text-align: center;
    }
    #register {
        margin: 20px auto;
        font-size: 30px;
        font-weight: bold;
        width: 200px;
        line-height: 50px;
        vertical-align: middle;
        background-color: #30f030;
        border: 6px outset #30f030;
    }
    #register:active {
        font-size: 30px;
        width: 200px;
        background-color: #70f070;
        border: 6px inset #70f070;
    }

    .select_match {
        width: 80px;
        height: 30px;
    }

    .wrapper_input_question label input {
       display: none;
    }
    .wrapper_input_question label span {
        text-align: center;
        width: 30px;
        height: 30px;
        color: white;
        background-color: #cccccc;
        font-size: 24px; 
        border: none;
        border-radius: 10px;
        display: inline-block;
    }
    .wrapper_input_question input:checked + span {
        color: white; 
        background-color: #ff0000;
    }
    #wrapper_fontSize {
        margin-left: 60px;
    }
    #fontSize {
        width: 35px;
        height: 20px;
        font-size: 16px;
    }
    #wrapper_fontSize button {
        color: white;
        background-color: #898989;
        border: none;
        border-radius: 3px;
    }
</style>
