<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        // ログインしていない場合はログインページにリダイレクト
        header('Location: ?page=log_in&error=notloggedin');
    
        exit;
    }
?>
<p>ログインしてる人の画面</p>

