<?php
require_once 'config.php';
// register.php ファイルのユーザー作成処理部分
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // 接続エラーの確認
    if (!$connection) {
        die("データベース接続エラー: " . mysqli_connect_error());
    }
    // フォームから送られたユーザー名とパスワードを取得
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // パスワードのハッシュ化
    $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

    // ユーザーをDBに登録する処理を記述
    // データベースに仮のユーザーデータを挿入する
    $query = "INSERT INTO users (username, password) VALUES ('$input_username', '$hashed_password')";
    $result = mysqli_query($connection, $query); // データベース操作を行う
    // 例：INSERT文を使用してユーザーをDBに登録する
    if (!$result) {
        $error_message = mysqli_error($connection);
        error_log("データベースエラー: " . $error_message);
        echo "申し訳ございません。サーバーでエラーが発生しました。";
    }
    header('Location: ?page=dashboard');
    exit;
}
?>
<main class="main">
    <div class="login-container">
        <h2>ユーザー作成ページ</h2>
        <form action="?page=register" method="post">
            <input type="text" name="username" placeholder="ユーザー名" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit">ユーザー作成</button>
        </form>
    </div>
</main>