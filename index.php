<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
</head>
<?php
    require("./func.php");
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );
    $con = connectDB();
?>
<body>
    <?php 

    ?>
    <h1>USS車名検索システム</h1>

    <div class="wrapper_form">
        <form>
            <div class="wrapper_input">
                <div class="form_name">社員番号</div><div class="form_input"><input type="text" name="syain_no"></div>
            </div>
            <div class="wrapper_input">
                <div class="form_name">パスワード</div><div class="form_input"><input type="password" name="password"></div>
            </div>
        </form>
    </div>
    <div>
        <button id="login">Login</button>
    </div>

</body>
</html>

<style>
    body {
        text-align: center;
    }
    h1 {
        font-size: 45px;
        margin: 200px auto;
    }
    .wrapper_form {
        margin: 100px auto;
        width: 600px;
    }

    .wrapper_input {
        display: flex;
        flex-direction: row;
    }
    .form_name {
        font-size: 30px;
        width: 200px;
    }
    .form_input {
        font-size: 30px;
        width: 400px;
    }
    .form_input input{
        font-size: 30px;
        width: 300px;
    }
    #login {
        font-size: 30px;
        width: 200px;
        height: 50px;
        background-color: #f0f0f0;
        border: 6px outset #f0f0f0;
    }
    #login:active {
        font-size: 30px;
        width: 200px;
        height: 50px;
        background-color: #e0e0e0;
        border: 6px inset #e0e0e0;
    }
</style>
