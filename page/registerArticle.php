<?php
error_reporting(E_ALL);
require_once "functions.php";
require_once "db_connect.php";
session_start();
// ユーザーがログインしているか確認
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: log_in.php");
    exit;
}
// 権限の確認
// 副管理者権限以上を持っているか確認
if ($_SESSION["position"] == 3 || $_SESSION["position"] == 0) {
    header("location: welcome.php");
    exit;
}
$datas=[
    'id'=>'',
    'title' => '',
    'content' => ''

];

//GET通信だった場合はセッション変数にトークンを追加
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    setToken();
}
// editArticle2の記事の登録
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    checkToken();

   //POSTされてきたデータを格納する変数の定義と初期化
    foreach ($datas as $key => $value) {
        if ($value = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $datas[$key] = $value;

        }
    }
    // バリデーション
    $errors = validation($datas);
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['title'] = $title;
        $_SESSION['content'] = $content;
        header("Location: editArticle2.php");
        exit;
    }
    if (empty($id)) {
        $sql = "INSERT INTO articles (title,author ,content, created_at, updated_at) VALUES (:title, :author,:content, now(), now())";
    } else {
        $sql = "UPDATE articles SET title = :title, content = :content, updated_at = now() WHERE id = :id";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    if (!empty($id)) {
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    }
    $stmt->execute();
    header("Location: articles.php");
    exit;
}