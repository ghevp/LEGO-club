<?php
session_start();
// セッション変数 $_SESSION["loggedin"]を確認。ログイン済だったらウェルカムページへリダイレクト
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hi,<b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. 部員専用ページへようこそ.</h1>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="changepassword.php" class="btn btn-warning ml-3">Change Password</a>
    </p>
    
    <p>以下にあなたの持っている権限が表示されます</p>
   
    <p><?php    // ポジション情報を表示
     switch ($_SESSION["position"]) {
            case '1':
                echo "管理者権限";
                break;
            case '2':
                echo "副管理者権限";
                break;
            case '3':
                echo "部員権限";
                break;
            default:
                echo "ゲスト権限";
        }
    // 管理者権限は他の部員に権限を与えることができる
    if ($_SESSION["position"] == 1) {
        echo " - <a href='givepermission.php'>権限を与える</a>";
    }

    
     ?></p>


</body>

</html>