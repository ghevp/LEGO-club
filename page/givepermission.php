<?php
session_start();
require_once 'db_connect.php';
require_once "functions.php";
// セッション変数 $_SESSION["loggedin"]を確認。ログイン済だったらウェルカムページへリダイレクト
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//セッション関数　$_SESSION{"position"}を確認。管理者権限以外だったらウェルカムページへリダイレクト
if ($_SESSION["position"] != 1) {
    header("location: welcome.php");
    exit;
}
//POSTされてきたデータを格納する変数の定義と初期化を行う

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    checkToken();
    
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
    //ユーザー名が入力されているか確認
    if (empty($name)) {
        $_SESSION['message'] = 'Please enter a name';
        header('location: givepermission.php');
        exit;
    }
    //権限が選択されているか確認
    if (empty($position)) {
        $_SESSION['message'] = 'Please select a position';
        header('location: givepermission.php');
        exit;
    }
    //本人の権限変更を防ぐ
    if ($_SESSION['name'] == $name) {
        $_SESSION['message'] = 'You cannot change your own permission';
        header('location: givepermission.php');
        exit;
    }
    //データベースの中に同一ユーザー名が存在しているか確認
    
    $sql = "SELECT id FROM users WHERE name = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->execute();


    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //ユーザーが存在していた場合、権限を更新
        $sql = "UPDATE positions SET postion = :position WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':position', $position, PDO::PARAM_INT);
        $stmt->bindValue(':id', $row['id'], PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['message'] = 'Permission given successfully';
        header('location: givepermission.php');
        exit;
    } else {
        $_SESSION['message'] = 'User not found';
    }
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <title>Give Permission</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['message'];
    endif;
        ?>
    
        </div>
        <?php unset($_SESSION['message']); ?>
        <h1 class="my-5">Hi,<b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. 部員に権限を与えるページへようこそ.</h1>
        <p>
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
            <a href="welcome.php" class="btn btn-warning ml-3">Back to Welcome Page</a>
        </p>
        <p>以下に権限を与える部員を選択してください</p>
       
        <form action="givepermission.php" method="post" >
            <div class="form-group">
                <label>部員名</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>権限</label>
                <select name="position" class="form-control">
                    <option value="1">管理者権限</option>
                    <option value="2">副管理者権限</option>
                    <option value="3">部員権限</option>
                </select>
            </div>
            
            <div class="form-group">
                <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
           
        </form>
      
</body>

</html>