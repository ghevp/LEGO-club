<?php
require_once 'config.php';

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4';
$user = DB_USER;
$password = DB_PASSWORD;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbh = new PDO($dsn, $user, $password);

        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $input_username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($input_password, $user['password'])) {
            // ログイン成功
            echo "ログイン成功！";
            // ここでセッションなどの処理を行う
            $_SESSION['username'] = $input_username; // ユーザー名をセッションに保存
            header('Location: dashboard.php'); // ログイン後の画面にリダイレクト
            exit;
        } else {
            // ログイン失敗
            echo "ユーザー名またはパスワードが間違っています。";
        }
    } catch (PDOException $e) {
        print('Error:' . $e->getMessage());
        die();
    }

    $dbh = null;
}
?>
<main class="main">
    <div class="login-container">
        <h2>部員向けログインページ</h2>
        <form class="login-form" action="/login" method="post">
            <input type="text" name="username" placeholder="ユーザー名" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit">ログイン</button>
        </form>
    </div>
</main>