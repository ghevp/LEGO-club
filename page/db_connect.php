<?php
require_once 'config.php';



/* ①　データベースの接続情報を定数に格納する */
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4';
$dbUser = DB_USER;
$dbPassword = DB_PASSWORD;

//②　例外処理を使って、DBにPDO接続する
try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    echo 'ERROR: Could not connect.' . $e->getMessage() . "\n";
    exit();
}
