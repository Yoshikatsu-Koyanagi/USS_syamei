
cookie = getCookieArray(document.cookie)
let list_header_order = cookie.list_header_order
if (!list_header_order) {
  list_header_order = 'syancd,syamei,katas,cc,zeikbn,grade,grades,syames,brandn,syasyu,door,biko'
}

function displayListHeader () {
  array_headername = list_header_order.split(',')
  const list_header = document.getElementById('list_header')
  array_header = {
    syancd: "<div id=\"header_syancd\" data-headername=\"syancd\"><button type=\"button\" onclick=\"sortList('katas')\">車名コード</button></div>",
    syamei: "<div id=\"header_syamei\" data-headername=\"syamei\"><button type=\"button\" onclick=\"sortList('syamei')\">車名</button></div>",
    katas: "<div id=\"header_katas\" data-headername=\"katas\"><button type=\"button\" onclick=\"sortList('katas')\">型式</button></div>",
    cc: "<div id=\"header_cc\" data-headername=\"cc\"><button type=\"button\" onclick=\"sortList('cc')\">排気量</button></div>",
    zeikbn: "<div id=\"header_zeikbn\" data-headername=\"zeikbn\"><button type=\"button\" onclick=\"sortList('zeikbn')\">自税</button></div>",
    grade: "<div id=\"header_grade\" data-headername=\"grade\"><button type=\"button\" onclick=\"sortList('grade')\">グレード</button></div>",
    grades: "<div id=\"header_grades\" data-headername=\"grades\"><button type=\"button\" onclick=\"sortList('grades')\">正式グレード</button></div>",
    syames: "<div id=\"header_syames\" data-headername=\"syames\"><button type=\"button\" onclick=\"sortList('syames')\">正式車名</button></div>",
    brandn: "<div id=\"header_brandn\" data-headername=\"brandn\"><button type=\"button\" onclick=\"sortList('brandn')\">ブランド</button></div>",
    syasyu: "<div id=\"header_syasyu\" data-headername=\"syasyu\"><button type=\"button\" onclick=\"sortList('syasyu')\">車種</button></div>",
    door: "<div id=\"header_door\" data-headername=\"door\"><button type=\"button\" onclick=\"sortList('door')\">ドア</button></div>",
    biko: "<div id=\"header_biko\" data-headername=\"biko\"><button type=\"button\" onclick=\"sortList('biko')\">備考</button></div>"
  }
  array_headername.forEach(function (val) {
    element = array_header[val]
    list_header.insertAdjacentHTML('beforeend', element)
  })
}

function getCookieArray () {
  const array = new Array()
  if (document.cookie != '') {
    const tmp = document.cookie.split('; ')
    for (let i = 0; i < tmp.length; i++) {
      const data = tmp[i].split('=')
      array[data[0]] = decodeURIComponent(data[1])
    }
  }
  return array
}

function setCookie (name, value) {
  const days = 365 // cookieの期限(日)
  const date = new Date() // 現在の日付データを取得
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000) // 30日後の日付データを作成
  cookie_expire_date = date.toGMTString() // GMT形式に変換

  document.cookie = name + '=' + value + '; expires=' + cookie_expire_date
  cookie = getCookieArray(document.cookie)
}

function setHeaderWidth () {
  array = ['syancd', 'syamei', 'katas', 'cc', 'zeikbn', 'grade', 'grades', 'syames', 'brandn', 'syasyu', 'door', 'biko']
  array.forEach(function (val) {
    if (!val) {
      return
    }
    const element = document.getElementById('header_' + val)
    element.style.width = cookie[val] + 'px'
  })
}

// 出品番号取得

// 出品番号の表示
const e_spno = document.getElementById('spno')
e_spno.innerHTML = spno
const p_data_spno = document.getElementById('p_data_spno')
p_data_spno.innerHTML = spno
// let input_data_spno = document.getElementById("input_data_spno");
// input_data_spno.value = spno;

// セッションからsortName取得
let sortName = window.sessionStorage.getItem(['sortName'])
if (!sortName) {
  sortName = 'katas'
}
// セッションからsortDirection取得
let sortDirection = window.sessionStorage.getItem(['sortDirection'])
if (!sortDirection) {
  sortDirection = 'ASC'
}

let focused_form_id = document.activeElement.id // 現在（または直前に）フォーカスがあるフォーム
let focused_button_id = '' // 現在（または直前に）フォーカスがあるリスト内のデータ

displayListHeader()
setHeaderWidth()
displaySpnhyou()
// imgPost();
// register();
keyboard()
focusInputs()
onclickBody()

// 出品票表示
function displaySpnhyou () {
  const wrapper_spnhyou_origin = document.getElementById('wrapper_spnhyou_origin')
  const file = 'S' + spno + '.jpg'
  const img = "<img src='./spnhyou/" + file + "' id='img_spnhyou'>"
  wrapper_spnhyou_origin.insertAdjacentHTML('beforeend', img)

  const spnhyou_full = document.getElementById('wrapper_spnhyou_full')
  const img2 = "<img src='./spnhyou/" + file + "' id='spnhyou_full'>"
  spnhyou_full.insertAdjacentHTML('beforeend', img2)

  const spnhyou_full_large = document.getElementById('wrapper_spnhyou_full_large')
  const img3 = "<img src='./spnhyou/" + file + "' id='spnhyou_full_large'>"
  spnhyou_full_large.insertAdjacentHTML('beforeend', img3)
}

function displaySpnhyouLarge () {
  const spnhyou_full_large = document.getElementById('wrapper_spnhyou_full_large')
  spnhyou_full_large.style.display = 'block'
}

function closeSpnhyouLarge () {
  const spnhyou_full_large = document.getElementById('wrapper_spnhyou_full_large')
  spnhyou_full_large.style.display = 'none'
}

// 出品票画像をサーバーにPOST
function imgPost () {
  const xhr = new XMLHttpRequest()
  xhr.open('POST', './ajax/imgPost.php')
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 2) {
      // console.log("HEADERS_RECEIVED");
    } else if (xhr.readyState == 3) {
      // console.log("LOADING");
    } else if (xhr.readyState == 4 && xhr.status == 200) {
      const responce = xhr.response
      // console.log(responce);
    }
  }
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xhr.send('spno=' + spno)
}

// 検索の処理
function search () {
  const form = document.getElementById('form_search')
  const formData = new FormData(form)
  const syamei = replaceKatakanaFtoH(formData.get('syamei'))
  formData.set('syamei', syamei)
  const grade = replaceKatakanaFtoH(formData.get('grade'))
  formData.set('grade', grade)
  const grades = replaceAlphabetHtoF(formData.get('grades'))
  formData.set('grades', grades)

  formData.set('sortName', sortName)
  window.sessionStorage.setItem(['sortName'], [sortName])
  formData.set('sortDirection', sortDirection)
  window.sessionStorage.setItem(['sortDirection'], [sortDirection])

  console.log(formData.get('katas_match'))
  const xhr = new XMLHttpRequest()
  xhr.open('POST', './ajax/search.php')
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 2) {
      // console.log("HEADERS_RECEIVED");
    } else if (xhr.readyState == 3) {
      // console.log("LOADING");
    } else if (xhr.readyState == 4 && xhr.status == 200) {
      const responce = xhr.response
      // console.log(responce);
      if (responce == -1) {
        const array = []
        displayList(array)
        return
      } else {
        const array = JSON.parse(responce)
        displayList(array)
      }
      focused_button_id = ''
      focused_form_id = document.activeElement.id
      // console.log(json);
    }
  }
  // xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  xhr.send(formData)
};

function getCount () {
  const xhr = new XMLHttpRequest()
  xhr.open('POST', './ajax/getCount.php')
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 2) {
      // console.log("HEADERS_RECEIVED");
    } else if (xhr.readyState == 3) {
      // console.log("LOADING");
    } else if (xhr.readyState == 4 && xhr.status == 200) {
      const responce = xhr.response
      if (responce == -1) {

      } else {
        setCount(responce)
      }
    }
  }
  // xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  xhr.send()
};
function setCount (count) {
  const count_registered = document.getElementById('count_registered')
  count_registered.innerHTML = count
}

// getCount();

// リストを表示
function displayList (array) {
  const wrapper_list_row = document.getElementById('wrapper_list_row')
  wrapper_list_row.innerHTML = ''
  let i = 1

  array.forEach(function (val, index) {
    const id = 'id_' + i
    if (list_header_order) {
      array = list_header_order.split(',')
    } else {
      array = ['syancd', 'syamei', 'katas', 'cc', 'zeikbn', 'grade', 'grades', 'syames', 'brandn', 'syasyu', 'door', 'biko']
    }
    let row_add = ''
    array.forEach(function (name) {
      const data = val[name].trim()
      const width = cookie[name]

      // console.log(name + ":" + data + " : " + width);
      if (width) {
        row_add += "<div class='" + name + "' style='width: " + width + "px;'>" + data + '</div>'
      } else {
        row_add += "<div class='" + name + "'>" + data + '</div>'
      }
    })
    const syancd = val.syancd.trim()
    const katas = val.katas.trim()
    const cc = val.cc.trim()
    const syamei = val.syamei.trim()
    if (syamei.indexOf('4W') > 0) {
      bgColor = "style='color: #1c00ff;' "
    } else {
      bgColor = ''
    }

    const grades = val.grades.trim()
    const door = val.door.trim()
    let row = '<button ' + bgColor + "class='list_row' id='" + id + "' onclick='setData(\"" + syancd + '", "' + katas + '", "' + cc + '", "' + syamei + '", "' + grades + '", "' + door + "\")'>"
    row += row_add
    row += '</button>'

    /*
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

            row += "<div class='syancd'>" + syancd + "</div>";
            row += "<div class='syamei'>" + syamei + "</div>";
            row += "<div class='katas' style='width:;'>" + katas + "</div>";
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
*/
    wrapper_list_row.insertAdjacentHTML('beforeend', row)
    i++
  })
};

// 登録
function register () {
  const form = document.getElementById('form_register')
  const formData = new FormData(form)
  formData.append('spno', spno)
  const syancd = formData.get('syancd')
  if (!syancd) {
    window.alert('データが入力されていません。')
    // フォーカスを戻す
    focusById(focused_form_id)
    return
  }
  jumpToNextSpno(spno)
  return

  const xhr = new XMLHttpRequest()
  xhr.open('POST', './ajax/register.php')
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 2) {
      // console.log("HEADERS_RECEIVED");
    } else if (xhr.readyState == 3) {
      // console.log("LOADING");
    } else if (xhr.readyState == 4 && xhr.status == 200) {
      const responce = xhr.response
      if (responce == 0) {
        getCount()
        // console.log(responce);
      } else {
        // console.log(responce);
      }
    }
  }
  // xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  xhr.send(formData)
}

// 登録用のデータをセット
function setData (syancd, katas, cc, syamei, grades, door) {
  resetFontSize()

  const input_data_syancd = document.getElementById('input_data_syancd')
  input_data_syancd.value = syancd

  const p_data_katas = document.getElementById('p_data_katas')
  p_data_katas.innerHTML = katas

  const p_data_cc = document.getElementById('p_data_cc')
  p_data_cc.innerHTML = cc

  const p_data_syamei = document.getElementById('p_data_syamei')
  p_data_syamei.innerHTML = syamei
  const w_syamei = getStrWidth(syamei)
  if (w_syamei > 130) {
    p_data_syamei.style.fontSize = '12px'
  }

  const p_data_grades = document.getElementById('p_data_grades')
  p_data_grades.innerHTML = grades
  const w_grades = getStrWidth(grades)
  if (w_grades > 215) {
    p_data_grades.style.fontSize = '12px'
  }

  const p_data_door = document.getElementById('p_data_door')
  p_data_door.innerHTML = door

  // マウスでリストをクリックした後、自動でフォームにフォーカスを戻す
  focusById(focused_form_id)
};

// リスト内のデータの色を変更する
function changeButtonColor (id) {
  clearButtonColor()
  const button = document.getElementById(id)
  button.style.backgroundColor = '#ffb0b0'
}

// リスト内のデータの色を元に戻す
function clearButtonColor () {
  const wrapper_list_row = document.getElementById('wrapper_list_row')
  const button = wrapper_list_row.children
  for (let i = 0; i < button.length; i++) {
    button[i].style.backgroundColor = '#ffe0f0'
  }
}

// 文字列の表示幅を取得
function getStrWidth (str) {
  // spanを生成.
  const span = document.createElement('span')

  // 現在の表示要素に影響しないように、画面外に飛ばしておく.
  span.style.position = 'absolute'
  span.style.top = '-1000px'
  span.style.left = '-1000px'

  // 折り返しはさせない.
  span.style.whiteSpace = 'nowrap'

  // 計測したい文字を設定する.
  span.innerHTML = str

  // 必要に応じてスタイルを適用する.
  span.style.fontSize = '14px'
  // span.style.letterSpacing = '2em';

  // DOMに追加する（追加することで、ブラウザで領域が計算されます）
  document.body.appendChild(span)

  // 横幅を取得します.
  const width = span.clientWidth
  // console.log('width:', width)

  // 終わったらDOMから削除します.
  span.parentElement.removeChild(span)

  return width
}

// フォントサイズを元に戻す
function resetFontSize () {
  const p_data_syamei = document.getElementById('p_data_syamei')
  p_data_syamei.style.fontSize = '16px'

  const p_data_grades = document.getElementById('p_data_grades')
  p_data_grades.style.fontSize = '16px'
}

// カタカナを全角から半角に変換
function replaceKatakanaFtoH (str) {
  const kanaMap = {
    ガ: 'ｶﾞ',
    ギ: 'ｷﾞ',
    グ: 'ｸﾞ',
    ゲ: 'ｹﾞ',
    ゴ: 'ｺﾞ',
    ザ: 'ｻﾞ',
    ジ: 'ｼﾞ',
    ズ: 'ｽﾞ',
    ゼ: 'ｾﾞ',
    ゾ: 'ｿﾞ',
    ダ: 'ﾀﾞ',
    ヂ: 'ﾁﾞ',
    ヅ: 'ﾂﾞ',
    デ: 'ﾃﾞ',
    ド: 'ﾄﾞ',
    バ: 'ﾊﾞ',
    ビ: 'ﾋﾞ',
    ブ: 'ﾌﾞ',
    ベ: 'ﾍﾞ',
    ボ: 'ﾎﾞ',
    パ: 'ﾊﾟ',
    ピ: 'ﾋﾟ',
    プ: 'ﾌﾟ',
    ペ: 'ﾍﾟ',
    ポ: 'ﾎﾟ',
    ヴ: 'ｳﾞ',
    ヷ: 'ﾜﾞ',
    ヺ: 'ｦﾞ',
    ア: 'ｱ',
    イ: 'ｲ',
    ウ: 'ｳ',
    エ: 'ｴ',
    オ: 'ｵ',
    カ: 'ｶ',
    キ: 'ｷ',
    ク: 'ｸ',
    ケ: 'ｹ',
    コ: 'ｺ',
    サ: 'ｻ',
    シ: 'ｼ',
    ス: 'ｽ',
    セ: 'ｾ',
    ソ: 'ｿ',
    タ: 'ﾀ',
    チ: 'ﾁ',
    ツ: 'ﾂ',
    テ: 'ﾃ',
    ト: 'ﾄ',
    ナ: 'ﾅ',
    ニ: 'ﾆ',
    ヌ: 'ﾇ',
    ネ: 'ﾈ',
    ノ: 'ﾉ',
    ハ: 'ﾊ',
    ヒ: 'ﾋ',
    フ: 'ﾌ',
    ヘ: 'ﾍ',
    ホ: 'ﾎ',
    マ: 'ﾏ',
    ミ: 'ﾐ',
    ム: 'ﾑ',
    メ: 'ﾒ',
    モ: 'ﾓ',
    ヤ: 'ﾔ',
    ユ: 'ﾕ',
    ヨ: 'ﾖ',
    ラ: 'ﾗ',
    リ: 'ﾘ',
    ル: 'ﾙ',
    レ: 'ﾚ',
    ロ: 'ﾛ',
    ワ: 'ﾜ',
    ヲ: 'ｦ',
    ン: 'ﾝ',
    ァ: 'ｧ',
    ィ: 'ｨ',
    ゥ: 'ｩ',
    ェ: 'ｪ',
    ォ: 'ｫ',
    ッ: 'ｯ',
    ャ: 'ｬ',
    ュ: 'ｭ',
    ョ: 'ｮ',
    '。': '｡',
    '、': '､',
    ー: 'ｰ',
    '「': '｢',
    '」': '｣',
    '・': '･'
  }
  const reg = new RegExp('(' + Object.keys(kanaMap).join('|') + ')', 'g')
  return str.replace(reg, function (s) {
    return kanaMap[s]
  }).replace(/゛/g, 'ﾞ').replace(/゜/g, 'ﾟ')
}

// アルファベットを半角から全角に変換
function replaceAlphabetHtoF (str) {
  return str.replace(/[A-Za-z0-9]/g, function (s) {
    return String.fromCharCode(s.charCodeAt(0) + 0xFEE0)
  })
}

// 次の出品番号へ
function jumpToNextSpno (spno) {
  const array = [17007, 17008, 17009, 17018, 17022, 17023, 17024, 17025, 17028, 17030, 17032]
  const len = array.length
  const i = array.indexOf(spno)
  if (i == len - 1) {
    next_spno = array[0]
  } else {
    next_spno = array[i + 1]
  }
  window.location.href = './search.php?spno=' + next_spno
}

// リストをソート
function sortList (name) {
  if (sortName == name) {
    if (sortDirection == 'ASC') {
      sortDirection = 'DESC'
    } else {
      sortDirection = 'ASC'
    }
  } else {
    sortName = name
    sortDirection = 'ASC'
  }
  console.log('sort : ' + sortName + ' sortDirection : ' + sortDirection)
  search()
  focusById(focused_form_id)
}

// エンターキー、ファンクションキーなどの処理
function keyboard () {
  window.addEventListener('keydown', function (e) {
    const keycode = e.keyCode
    if (keycode == 13) { // Enter
      document.getElementById('register').click()
    } else if (keycode == 32 || keycode == 229) { // Space(229:全角スペース)
      if (focused_button_id != '') {
        document.getElementById(focused_button_id).click()
      } else {
        return
      }
    } else if (keycode == 38) { // ↑
      clickUp()
    } else if (keycode == 40) { // ↓
      clickDown()
    } else if (keycode == 112) { // F1
      focusById('katas')
    } else if (keycode == 113) { // F2
      focusById('cc')
    } else if (keycode == 114) { // F3
      focusById('syamei')
    } else if (keycode == 115) { // F4
      focusById('syames')
    } else if (keycode == 116) { // F5
      focusById('grade')
    } else if (keycode == 117) { // F6
      focusById('grades')
    } else if (keycode == 118) { // F7
      focusById('syancd')
    } else if (keycode == 119) { // F8
      focusById('zeikbn')
    } else if (keycode == 120) { // F9
      focusById('biko')
    } else if (keycode == 121) { // F10
      focusById('brandn')
    } else if (keycode == 122) { // F12
      const question = document.getElementById('question')
      if (question.checked == true) {
        question.checked = false
      } else if (question.checked == false) {
        question.checked = true
      }
    } else {
      return
    }
    // ファンクションキーの機能を無効化
    event.keyCode = null
    event.returnValue = false
  })
}

// ↑ボタンが押されたとき
function clickUp () {
  if (focused_button_id == '') {
    const id_1 = document.getElementById('id_1')
    if (id_1) {
      focusList(id_1)
    } else {

    }
  } else {
    const e_previous = document.getElementById(focused_button_id).previousElementSibling
    if (e_previous) {
      focusList(e_previous)
    } else {

    }
  }
}

// ↓ボタンが押されたとき
function clickDown () {
  if (focused_button_id == '') {
    const id_1 = document.getElementById('id_1')
    if (id_1) {
      focusList(id_1)
    } else {

    }
  } else {
    const e_next = document.getElementById(focused_button_id).nextElementSibling
    if (e_next) {
      focusList(e_next)
    } else {

    }
  }
}

// リスト内でクリックされたとき
function focusList (e) {
  e.focus() // クリックされたデータにフォーカス
  clearButtonColor()
  e.style.backgroundColor = '#ffb0b0'
  focused_button_id = e.id
  focusById(focused_form_id) // 直前のフォームにフォーカスを戻す
}

// idの要素にフォーカス
function focusById (id) {
  if (!id) {
    // 処理中に何もない場所をクリックされるとfocused_button_idがNullになるため
    id = 'katas'
  }
  document.getElementById(id).focus()
}

// 何もない場所をクリックするなどでフォーカスが外れた時に戻す
function onclickBody () {
  window.addEventListener('click', function () {
    const tagName = document.activeElement.tagName
    if (tagName == 'BODY') {
      focusById(focused_form_id)
    } else if (tagName == 'INPUT') {
      const id = document.activeElement.id
      if (id == 'question') {
        focusById(focused_form_id)
        return
      }
      focused_form_id = id
    }
  })
}

// input要素がフォーカスされたときの処理
function focusInputs () {
  const inputs = document.querySelectorAll('input')
  inputs.forEach(function (input) {
    if (input.id == 'question') {
      focusById(focused_form_id)
      return
    }
    input.addEventListener('focus', function (e) {
      const id = document.activeElement.id
      focused_form_id = id
    })
  })
}

const list_header = document.getElementById('list_header')
let elements = list_header.children
for (let i = 0; i < elements.length; i++) {
  element = elements[i]
  getWidthChange(element)
}

function getWidthChange (element) {
  document.addEventListener('DOMContentLoaded', () => {
    // 要素のリサイズイベント取得
    const observer = new MutationObserver(() => {
      // 要素のサイズ確認
      const width = element.getBoundingClientRect().width
      const height = element.getBoundingClientRect().height
      // console.log('size(w,h): ', width, height);
      className = element.dataset.headername
      changeWidth(className, width)
    })
    observer.observe(element, {
      attriblutes: true,
      attributeFilter: ['style']
    })
  })
}

function changeWidth (className, width) {
  elements = document.getElementsByClassName(className)
  for (let i = 0; i < elements.length; i++) {
    elements[i].style.width = width + 'px'
  }
  setCookie(className, width)
}

new Sortable(list_header, {
  animation: 300,
  ghostClass: 'ghost',
  chosenClass: 'light-green',
  delay: 100,
  onSort: function () {
    getListHeaderOrder()
    search()
    focusById(focused_form_id)
  }
})

function getListHeaderOrder () {
  const headers = document.querySelectorAll('#list_header div')
  list_header_order = ''
  for (let i = 0; i < headers.length; i++) {
    headername = headers[i].dataset.headername
    list_header_order = list_header_order + headername
    if (i != headers.length - 1) {
      list_header_order = list_header_order + ','
    }
  }
  setCookie('list_header_order', list_header_order)
  console.log(list_header_order)
}
