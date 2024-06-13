<?php
// データベース接続
require_once "functions.php";
require_once "db_connect.php";
// セッション変数を初期化
session_start();
   // ユーザーがログインしているか確認 
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: log_in.php");
    exit;
}
// 副管理者権限以上を持っているか確認
if ($_SESSION["position"] ==3||$_SESSION["position"] ==0) {
    header("location: welcome.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>記事編集</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
  
    
    <h1 class="my-5">記事編集</h1>
    <p>記事を編集することができます</p>
    <form action="editArticle.php" method="post">
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">内容</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div>
        <input type="submit" value="編集" class="btn btn-primary">
    </form>
    <p><a href="welcome.php" class="btn btn-danger ml-3">戻る</a></p>
</body>
</html>