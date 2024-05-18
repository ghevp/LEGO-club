<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
#require_once 'config.php';
require_once 'functions.php';
require_once 'db_connect.php';
//セッションの開始
session_start();

//POSTされてきたデータを格納する変数の定義と初期化
$datas = [
    'name'  => '',
    'password'  => '',
    'confirm_password'  => ''
];

//GET通信だった場合はセッション変数にトークンを追加
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    setToken();
}
//POST通信だった場合はDBへの新規登録処理を開始
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //CSRF対策
    checkToken();

    // POSTされてきたデータを変数に格納
    foreach ($datas as $key => $value) {
        if ($value = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $datas[$key] = $value;
        }
    }
    $_SESSION['useSystem'] = 'register';
    // バリデーション
    $errors = validation($datas);

    //データベースの中に同一ユーザー名が存在していないか確認
    if (empty($errors['name'])) {
        $sql = "SELECT id FROM users WHERE name = :name";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $datas['name'], PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $errors['name'] = 'This username is already taken.';
        }
    }
    //エラーがなかったらDBへの新規登録を実行
    if (empty($errors['name']) && empty($errors['password']) && empty($errors['confirm_password'])) {

        $params = [
            'id' => null,
            'name' => $datas['name'],
            'password' => password_hash($datas['password'], PASSWORD_DEFAULT),
            'created_at' => null
        ];

        $count = 0;
        $columns = '';
        $values = '';
        foreach (array_keys($params) as $key) {
            if ($count > 0) {
                $columns .= ',';
                $values .= ',';
            }
            $columns .= $key;
            $values .= ':' . $key;
            $count++;
        }

        $pdo->beginTransaction(); //トランザクション処理
        try {
            $sql = 'insert into users (' . $columns . ')values(' . $values . ')';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $pdo->commit();
          

            header("location: log_in.php");
            exit;
        } catch (PDOException $e) {
            echo 'ERROR: Could not register.';
            $pdo->rollBack();
        }
    } else {
        echo 'ERROR: Could not register.';
        foreach ($errors as $key => $value) {
            echo $key . ' : ' . $value . '<br>';
            echo $datas[$key] . '<br>';
        }
    }
}
?>
<main class="main">
    <div class="login-container">
        <h2>ユーザー作成ページ</h2>
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
            <div class="form-group">
                <input type="text" name="name" placeholder="ユーザー名" class="form-control <?php echo (!empty(h($errors['name']))) ? 'is-invalid' : ''; ?>" value="<?php echo h($datas['name']); ?>">
                <span class="invalid-feedback"><?php echo h($errors['name']); ?></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="パスワード" class="form-control<?php echo (!empty(h($errors['password']))) ? 'is-invalid' : ''; ?>" value="<?php echo h($datas['password']); ?>">
                <span class="invalid-feedback"><?php echo h($errors['password']); ?></span>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="再度入力" class="form-control <?php echo (!empty(h($errors['confirm_password']))) ? 'is-invalid' : ''; ?>" value="<?php echo h($datas['confirm_password']); ?>">
                <span class="invalid-feedback"><?php echo h($errors['confirm_password']); ?></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>

</main>