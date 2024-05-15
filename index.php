
<!DOCTYPE html>
<html lang="ja">
<?php

if (isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $page = "home";
}
if (isset($page)) {
} else {
    $page = "home";
};
$title = array(
    'home' => "ホーム",
    'about_us' => "弊サークルについて",
    'event' => "イベント",
    'enword' => "英語",
    'policy' => "ポリシー",
    'achievement' => "活動実績",
    'works' => "作品紹介",
    'log_in' => "ログイン",
    'config' => "設定",
    'register' => "新規アカウント作成"
);
// クロスサイトスクリプティング（XSS）を防ぐ
echo htmlspecialchars($title[$page], ENT_QUOTES, 'UTF-8');
?>

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6911517647778874" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <!-- Global site tag (gtag.js) - Google Analytics -->

    </script>
    <meta name="author" content="ぐゑ">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ghevp">
    <meta property="og:url" content="https://shizudailego.com">
    <meta property="og:title" content="浜松学生レゴサークル">
    <meta name="og:description" content="浜松を中心に活動している学生主体のレゴサークルです！！">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@500&family=Sawarabi+Gothic&family=Shippori+Mincho+B1:wght@800&family=Yuji+Syuku&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!--後でphpのif文の作成-->
    <title>
        <?php
        if (!isset($page) || $page == "home") {
            echo "浜松学生レゴサークル";
        } else {
            echo $title[$page] . " - 浜松学生レゴサークル";
        }
        ?>
    </title>

<body style="margin: 0;">
    <?php
    include('page/' . $page . ".php");
    ?>
    <header class="header">
        <div class="header_inner">
            <img src="img/logo.png">
            <a href="?page=home">浜松学生レゴサークル</a>
        </div>
    </header>
    <footer class="footer">
        <div class="footer_inner">
            <img src="img/logo.png">
            <a href="?page=home">浜松学生レゴサークル</a>
        </div>
        <div class="copyright">
            <p><small>copyright <a href="https://ghevp.com">ぐゑ</a> all rights reserved.</small><br></p>
        </div>
        <div class="log_in_page">
            <a class="log_in_button" href="/page/log_in.php">部員向けログインページ</a>
        </div>
    </footer>
</body>