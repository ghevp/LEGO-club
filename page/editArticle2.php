<?php
// データベース接続
require_once('db_connect.php');
require_once('functions.php');
session_start();
// ユーザーがログインしているか確認 
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: log_in.php");
    exit;
}


//権限の確認
// 副管理者権限以上を持っているか確認
if ($_SESSION["position"] == 3 || $_SESSION["position"] == 0) {
    header("location: welcome.php");
    exit;
}


// 新規記事か既存記事かを判別し、新規記事の場合はそのまま、既存記事の場合は既存記事の内容を表示
if (isset($_POST['edit'])) {
    $article_id = $_POST['edit'];
    $sql = "SELECT * FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}
// 新規記事の場合は空の連想配列を作成
if (!isset($article)) {
    $article = [
        'id' => '',
        'title' => '',
        'content' => ''
    ];
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="welcome.php">ホーム</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav
                ">
                <li class="nav-item">
                    <a class="nav-link" href="articles.php">記事一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editArticle.php">記事編集</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">ユーザー一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="log_out.php">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>記事編集</h1>
        <form action="registerArticle.php" method="post">
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo h($article['title']); ?>">
            </div>
            <div class="form-group">
                <label for="content">内容</label>
                <textarea name="content" class="form-control" id="content"><?php echo h($article['content']); ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="author" value="<?php echo $_SESSION['id']; ?>">
                
            </div>
            <div class="form-group">
                <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
                <button type="submit" class="btn btn-primary">編集</button>
            </div>
        </form>
    </div>
</body>

</html>