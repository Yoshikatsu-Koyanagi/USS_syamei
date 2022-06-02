<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <title>登録一覧・検索・修正</title>
</head>
<?php
    require("./func.php");
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    $con = connectDB();

    //$userid = $_SESSION["userid"];
    $userid = 1;
?>
<body>
    <h3>USS車名検索</h3>
    <div id="main">
        <div id="main_left">
            <div class="wrapper_form">
                <form id="form_search" onsubmit="return false;" autocomplete="off">
                    <div id="wrapper_inputs_top">
                        <div id="wrapper_input_katas">
                            <span>型式(F1)</span><input type="tel" id="katas" name="katas" oninput="search();" autofocus>
                        </div>
                        <div id="wrapper_katas_match">
                            <input type="checkbox" id="katas_match" name="katas_match" onchange="search();"/>
                            <label class="check" for="katas_match"><div></div></label>

<!--
                            <select id="aaaaaa" name="aaaaaaaaaaaa">
                                <option value=""></option>
                                <option value="">aaa</option>
                                <option value="">aaa</option>
                            </select>
-->
                        </div>
                        <div id="wrapper_input_spno">
                            <span>出品番号</span><input type="tel" id="spno" name="spno" class="input_search" oninput="search();">
                        </div>
                        
                    </div>
                    <div id="wrapper_inputs_middle">
                        <div id="wrapper_input_date">
                            <span>入力日時</span><input type="date" id="datetime1" name="datetime1" class="input_search" oninput="search();">～<input type="date" id="datetime2" name="datetime2" class="input_search" oninput="search();">
                        </div>
                    </div>
                    <div id="wrapper_inputs_bottom">
                        <div>
                            <div>
                                <span>排気量(F2)</span><input type="tel" id="cc" name="cc" class="input_search" oninput="search();">
                            </div>
                        
                            <div>
                                <span>車名(F3)</span><input type="text" id="syamei" name="syamei" class="input_search" oninput="search();">
                            </div>
                            <div>
                                <span>正式車名(F4)</span><input type="text" id="syames" name="syames" oninput="search();">
                            </div>
<!--
                            <div>
                                <span>車種</span><input type="text" id="syasyu" name="syasyu" oninput="search();">
                            </div>
-->
                        </div>
                        <div>
                            <div>
                                <span>グレード(F5)</span><input type="text" id="grade" name="grade" oninput="search();">
                            </div>
                        
                            <div>
                                <span>正式グレード(F6)</span><input type="text" id="grades" name="grades" oninput="search();">
                            </div>
                            <div>
                                <span>車名コード(F7)</span><input type="text" id="syancd" name="syancd" oninput="search();">
                            </div>
<!--
                            <div>
                                <span>ドア</span><input type="text" id="door" name="door" oninput="search();">
                            </div>
-->
                        </div>
                        <div>
                            <div>
                                <span>自税区分(F8)</span><input type="text" id="zeikbn" name="zeikbn" oninput="search();">
                            </div>
                            <div>
                                <span>備考(F9)</span><input type="text" id="biko" name="biko" oninput="search();">
                            </div>
                            <div>
                                <span>ブランド(F10)</span><input type="text" id="brandn" name="brandn" oninput="search();">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="list" name="list">

                <div id="list_header">
                    <button type="button" class='datetime' onclick="sortList('datetime')">入力日時</button>
                    <button type="button" class='spno' onclick="sortList('spno')">出品番号</button>
                    <button type="button" class='syancd' onclick="sortList('katas')">車名コード</button>
                    <button type="button" class='syamei' onclick="sortList('syamei')">車名</button>
                    <button type="button" class='katas' onclick="sortList('katas')">型式</button>
                    <button type="button" class='cc' onclick="sortList('cc')">排気量</button>
                    <button type="button" class='zeikbn' onclick="sortList('zeikbn')">自税</button>
                    <button type="button" class='grade' onclick="sortList('grade')">グレード</button>
                    <button type="button" class='grades' onclick="sortList('grades')">正式グレード</button>
                    <button type="button" class='syames' onclick="sortList('syames')">正式車名</button>
                    <button type="button" class='brandn' onclick="sortList('brandn')">ブランド</button>
                    <button type="button" class='syasyu' onclick="sortList('syasyu')">車種</button>
                    <button type="button" class='door' onclick="sortList('door')">ドア</button>
                    <button type="button" class='biko' onclick="sortList('biko')">備考</button>
                </div>
                <div id="wrapper_list_row">
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

        </div>
        <div id="wrapper_popup">
            <div id="popup">
                
            </div>
        </div>
       
    </div>
    


</body>
</html>

<script type="text/javascript">
    //ユーザーID取得
    const userid = <?php echo($userid); ?>;

    //セッションからkatas_match取得（前方一致・後方一致の設定）
    let session_katas_match = window.sessionStorage.getItem(['katas_match']);
    if (session_katas_match == 1) {
        document.getElementById('katas_match').checked = true;
    }
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


    //let wrapper_spnhyou_origin = document.getElementById("wrapper_spnhyou_origin");
    //wrapper_spnhyou_origin.innerHTML = '';

    //register();
    search();
    keyboard();
    focusInputs();
    onclickBody();    

    //検索の処理
    function search() {
        let form = document.getElementById('form_search');
        let formData = new FormData(form);
        formData.append("userid", userid);
        let syamei = replaceKatakanaFtoH(formData.get("syamei"));
        formData.set("syamei", syamei);
        let grade = replaceKatakanaFtoH(formData.get("grade"));
        formData.set("grade", grade);
        let grades = replaceAlphabetHtoF(formData.get("grades"));
        formData.set("grades", grades);

        let katas_match = document.getElementById('katas_match');
        if (katas_match.checked == true) {
            formData.set("katas_match", 1);
            window.sessionStorage.setItem(['katas_match'],[1]);
            
        }
        else {
            formData.set("katas_match", 0);
            window.sessionStorage.setItem(['katas_match'],[0]);
        }

        formData.set("sortName", sortName);
        window.sessionStorage.setItem(['sortName'],[sortName]);
        formData.set("sortDirection", sortDirection);
        window.sessionStorage.setItem(['sortDirection'],[sortDirection]);

        //katas_match = formData.get("katas_match");
        //console.log(formData);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/list.php');
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

    //getCount();

    
    //リストを表示
    function displayList(array) {
        let wrapper_list_row = document.getElementById("wrapper_list_row");
        wrapper_list_row.innerHTML = '';
        let i = 1;

        array.forEach( function (val, index) {
            let spno = val["spno"];
            let datetime = val["datetime"];
            let syancd = val["syancd"].trim();
            let syamei = val["syamei"].trim();
            let grade = val["grade"].trim();
            let katas = val["katas"].trim();
            let cc = val["cc"].trim();
            let zeikbn = val["zeikbn"].trim();
            let lstpg = val["lstpg"].trim();
            let lstymd = val["lstymd"].trim();
            let sortno = val["sortno"].trim();
            let brandn = val["brandn"].trim();
            let syames = val["syames"].trim();
            let door = val["door"].trim();
            let syasyu = val["syasyu"].trim();
            let grades = val["grades"].trim();
            let biko = val["biko"].trim();
            let id = "id_" + i;
            
            //row = "<div class='wrapper_list_row'>";
            //row = "<button class='list_row' id='" + id + "' onclick='changeButtonColor(\"" + id + "\"); setData(\"" + katas + "\", \"" + cc + "\", \""  + syames + "\", \"" + grades +  "\", \"" + door + "\")'>";
            let row = "<button class='list_row' id='" + id + "' onclick='displayPopup(\"" + spno + "\")'>";
            row += "<div class='datetime'>" + datetime + "</div>";
            row += "<div class='spno'>" + spno + "</div>";
            row += "<div class='syancd'>" + syancd + "</div>";
            row += "<div class='syamei'>" + syamei + "</div>";
            row += "<div class='katas'>" + katas + "</div>";
            row += "<div class='cc'>" + cc + "</div>";
            row += "<div class='zeikbn'>" + zeikbn + "</div>";
            row += "<div class='grade'>" + grade + "</div>";
            row += "<div class='grades'>" + grades + "</div>";
            row += "<div class='syames'>" + syames + "</div>";
            row += "<div class='brandn'>" + brandn + "</div>";
            row += "<div class='syasyu'>" + syasyu + "</div>";
            row += "<div class='door'>" + door + "</div>";
            row += "<div class='biko'>" + biko + "</div>";
            row += "</button>";
            //row += "</div>";
            wrapper_list_row.insertAdjacentHTML('beforeend', row);
            i++;
        });
    };

    //登録
    function register() {
        let form = document.getElementById("form_register");
        let formData = new FormData(form);
        let katas = formData.get("katas");
        let grades = formData.get("grades");
        formData.append("spno", spno);
        if (!katas) {
            window.alert("データが入力されていません。");
            //フォーカスを戻す
            focusById(focused_form_id);
            return;
        }
        jumpToNextSpno(spno);
        //window.alert(spno + " : " + katas + " : " + grades);
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

    //リスト内のデータの色を変更する
    function changeButtonColor(id) {
        clearButtonColor();
        let button = document.getElementById(id);
        button.style.backgroundColor = "#77d0e0";
    }

    //リスト内のデータの色を元に戻す
    function clearButtonColor() {
        let wrapper_list_row = document.getElementById("wrapper_list_row");
        let button = wrapper_list_row.children;
        for (let i = 0; i < button.length; i++){
			button[i].style.backgroundColor = "#e0fff4";
		}
    }
    
    //文字列の表示幅を取得
    function getStrWidth(str) {
        // spanを生成.
        var span = document.createElement('span');

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
        var width = span.clientWidth;
        //console.log('width:', width)

        // 終わったらDOMから削除します.
        span.parentElement.removeChild(span);

        return width;
    }

    //フォントサイズを元に戻す
    function resetFontSize() {
        let p_data_syames = document.getElementById("p_data_syames");
        p_data_syames.style.fontSize = "16px";

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

            wrapper_popup = document.getElementById("wrapper_popup");
            wrapper_popup_display = window.getComputedStyle(wrapper_popup).display;
            //ポップアップが出ているとき
            if (wrapper_popup_display == "block") {
                if (keycode == 37) {   //←
                    focusById("popup_button_left");
                }
                else if (keycode == 38) {   //↑
                    focusById("close_popup");
                }
                else if (keycode == 39) {   //→
                    focusById("popup_button_right");
                }
                else if (keycode == 40) {   //↓
                    focusById("popup_button_right");
                }
                else if (keycode == 32 || keycode == 229) {   //Space(229:全角スペース)
                    if (document.activeElement) {
                        document.activeElement.click();; 
                    }
                    else {
                        return;
                    }
                }
                else {
                    return;
                }
            }
            else {
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
            }
            //ファンクションキーの機能を無効化
            event.keyCode = null;
            event.returnValue = false;
            return;
        }); 
    }
    

    //↑ボタンが押されたとき
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

    //↓ボタンが押されたとき
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
        e.style.backgroundColor = "#77d0e0";
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

    //何もない場所をクリックするなどでフォーカスが外れた時に戻す
    function onclickBody() {
        window.addEventListener("click", function() {
            let tagName = document.activeElement.tagName;
            if (tagName == "BODY") {
                focusById(focused_form_id);
            }
            else if (tagName == "INPUT") {
                let id = document.activeElement.id;
                if (id == "question") {
                    focusById(focused_form_id);
                    return;
                }
                focused_form_id = id;
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

    //ポップアップを表示
    function displayPopup(spno) {
        popup = document.getElementById("popup");
        popup.innerHTML = "";
        e = "<button id='close_popup' onclick='closePopup();'>×</button>";
        e += "<div class='popup_spno'>出品番号 : " + spno + "</div>";
        e += "<button id='popup_button_left' class='button_delete' onclick='displayPopupDelete(" + spno + ")'>削除</button>";
        e += "<button id='popup_button_right' class='button_update' onclick='update(" + spno + ")'>更新</button>";
        
                        
        popup.insertAdjacentHTML('beforeend', e);

        wrapper_popup = document.getElementById("wrapper_popup");
        wrapper_popup.style.display = "block";

        focusById("popup_button_right");
    }

    //削除確認ポップアップを表示
    function displayPopupDelete(spno) {
        popup = document.getElementById("popup");
        popup.innerHTML = "";
        e = "<button id='close_popup' onclick='closePopup();'>×</button>";
        e += "<div class='popup_delete_spno'>出品番号 : " + spno + "<br>本当に削除しますか？</div>";
        e += "<button id='popup_button_left' class='button_delete_yes' onclick='deleteData(" + spno + ")'>はい</button>";
        e += "<button id='popup_button_right' class='button_delete_no' onclick='displayPopup(" + spno + ")'>いいえ</button>";
        
                        
        popup.insertAdjacentHTML('beforeend', e);

        wrapper_popup = document.getElementById("wrapper_popup");
        wrapper_popup.style.display = "block";

        focusById("popup_button_right");
    }
    
    //ポップアップを閉じる
    function closePopup() {
        wrapper_popup = document.getElementById("wrapper_popup");
        wrapper_popup.style.display = "none";
        focusById(focused_form_id);
    }

    //更新ページへ移る
    function update(spno) {
        window.location.href = "./search.php?spno=" + spno;
    }

    //削除の処理
    function deleteData(spno) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './ajax/delete.php');
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
                    console.log(responce);
                    closePopup();
                    search();
                }
                else {
                    console.log(responce);
                }
            }
        }
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr.send("spno=" + spno);
    }

/*
    let list_header = document.getElementById("list_header");
    new Sortable(list_header,{
        animation: 150,
        ghostClass: 'ghost',
        chosenClass: 'light-green',
        delay: 100,
    });
*/
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
    .wrapper_form {
        width: 1400px;
        margin: 10px auto;
    }
    #form_search {
        margin: 20px 15px;
    }
    #form_search div span {
        display: inline-block;
        text-align: left;
        font-size: 20px;
        width: 140px;
        height: 30px;
    }
    #wrapper_inputs_top {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    #wrapper_input_katas {
        margin: 10px 15px;
    }
    #katas {
        font-size: 20px;
        width: 250px;
        height: 30px;
        background-color: #c7efff;
    }
    #wrapper_input_spno {
        margin: 10px auto 10px 361px;
    }
    #spno {
        font-size: 20px;
        width: 250px;
        height: 30px;
    }
    #wrapper_katas_match {
        display: flex;
        align-items: center;
    }

    #wrapper_inputs_bottom {
        display: flex;
        flex-direction: row;

    }
    #wrapper_inputs_bottom div div {
        margin: 5px 15px;
    }
    #wrapper_inputs_bottom div div span {
        display: inline-block;
        text-align: left;
        font-size: 16px;
        width: 140px;
        height: 26px;
    }
    #wrapper_inputs_bottom div div input {
        font-size: 16px;
        width: 250px;
        height: 26px;
    }

    #wrapper_input_date {
        display: flex;
        flex-direction: row;
        height: 30px;
        margin: 10px 15px;
        line-height: 30px;
        vertical-align: middle;
    }
    #wrapper_input_date span {
        font-size: 18px;
        width: 140px;
    }
    #date {
        margin: auto;
        width: 250px;
        height: 30px;
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
    #wrapper_list_row {
        font-size: 0px;
    }
    .list_row {
        height: 20px;
        line-height: 20px;
        font-size: 14px;
        color: black;
        background-color: #e0fff4;
        display: inline-flex;
        flex-direction: row;
        border: none;
        border-bottom: rgba(100,0,0,0.3) 1px dotted;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0;
        margin: 0;
        box-sizing: content-box;
    }
    .list_row:hover {
        color: black !important;
        background-color: #88e0f0 !important;
    }
    .list_row div {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0 3px;
        margin: 0px;
        border: none;
        box-sizing: content-box;
    }
    .datetime {
        width: 150px;
        text-align: center;
    }
    .spno {
        width: 60px;
        text-align: center;
    }
    .syancd {
        width: 100px;
        text-align: center;
    }
    .syamei {
        width: 100px;
        text-align: left;
    }
    .katas {
        width: 100px;
        text-align: left;
    }
    .cc {
        width: 50px;
        text-align: right;
    }
    .zeikbn {
        width: 50px;
        text-align: center;
    }
    .grade {
        width: 150px;
        text-align: left;
    }
    .grades {
        width: 250px;
        text-align: left;
    }
    .syames {
        width: 200px;
        text-align: left;
    }
    .brandn {
        width: 100px;
        text-align: left;
    }
    .syasyu {
        width: 250px;
        text-align: left;
    }
    .door {
        width: 40px;
        text-align: center;
    }
    .biko {
        width: 200px;
        text-align: left;
    }

    #list_header {
        height: 25px;
        line-height: 25px;
        color: black;
        background-color: #f0f0f0;
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
    .header_edit {
        text-align: center;
        width: 50px;
        font-size: 14px;
        color: black;
        background-color: #f0f0f0;
    }
    .header_delete {
        text-align: center;
        width: 50px;
        font-size: 14px;
        color: black;
        background-color: #f0f0f0;
    }
    #list_header button {
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0 3px;
        border: none;
        box-sizing: content-box;
    }
    #bottom {
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        margin-top: 550px;
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




    #katas_match {
        display: none;
    }

    #katas_match + label.check {
        position: relative;
        cursor: pointer;
        display: inline-block;
        width: 80px;
        height: 28px;
        color: #ffffff;
        border: 1px solid #4db4e4;
        border-radius: 3px;
        background-color: #4db4e4;
    }
    #katas_match:checked + label.check {
        border: 1px solid #ff7bf7;
        background-color: #ff7bf7;
    }
    #katas_match + label.check::before {
        content: "前方一致";
        font-size: 14px;
        position: absolute;
        top: 4px;
        left: auto;
        right: 6px;
    }
    #katas_match:checked + label.check::before {
        content: "完全一致";
        position: absolute;
        left: 6px;
        right: auto;
        color: #ffffff;
    }
    #katas_match + label.check > div {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 12px;
        height: 22px;
        border: 1px solid #ffffff;
        border-radius: 3px;
        background-color: #ffffff;
        transition: 0.2s;
    }
    #katas_match:checked + label.check > div {
        border: 1px solid transparent;
        left: 64px;
    }


    #wrapper_popup {
        display: none;
        position: absolute;
        width: 300px;
        height: 200px;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        z-index: 10;
    }
    #popup {
        width: 300px;
        height: 150px;
        text-align: center;
        background-color: #cbcbcb;
        border: solid 5px;
        border-color: white;
        border-radius: 15px;
        padding: 10px;
        margin: auto;
        box-shadow: 5px 5px 5px;
    }
    #popup button:focus {
        outline: 2px black solid;
    }
    .popup_spno {
        text-align: center;
        width: 250px;
        height: 50px;
        font-size: 25px;
        margin: 10px auto;
    }
    .button_update {
        color: white;
        background-color: #4db4e4;
        font-size: 18px;
        width: 80px;
        height: 40px;
        border: none;
        border-radius: 6px;
        margin: 5px;
    }
    .button_delete {
        color: white;
        background-color: #666666;
        font-size: 18px;
        width: 80px;
        height: 40px;
        border: none;
        border-radius: 6px;
        margin: 5px;
    }
    .popup_delete_spno {
        text-align: center;
        width: 250px;
        height: 50px;
        font-size: 18px;
        margin: 10px auto;
    }
    .button_delete_yes {
        color: white;
        background-color: #000000;
        font-size: 18px;
        width: 80px;
        height: 40px;
        border: none;
        border-radius: 6px;
        margin: 5px;
    }
    .button_delete_no {
        color: white;
        background-color: #666666;
        font-size: 18px;
        width: 80px;
        height: 40px;
        border: none;
        border-radius: 6px;
        margin: 5px;
    }
    #close_popup {
        color: white;
        background-color: #343434;
        width: 20px;
        height: 20px;
        font-size: 15px;
        border :0;
        border-radius: 10px;
        text-align: center;
    }
    

</style>
