<?php
require_once "db_connect.php";
require_once "functions.php";
session_start();
// セッション変数 $_SESSION["loggedin"]を確認。ログイン済だったらウェルカムページへリダイレクト
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    $_SESSION['nextPage'] = 'changepassword.php';
    $_SESSION['message'] = 'Please log in first';
    exit;
}

$data = [
    'current_password' => '',
    'new_password' => '',
    'confirm_password' => ''
];

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    setToken();
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    checkToken();
    foreach($data as $key => $value){
        if($value = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS)){
            $data[$key] = $value;
        }
    }
    $_SESSION['useSystem']="changePassword";
    $errors = validation($data,false);
    if(empty($errors['current_password']) && empty($errors['new_password']) && empty($errors['confirm_password'])){
        $sql = "SELECT password FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id',$_SESSION['id'],PDO::PARAM_INT);
        $stmt->execute();
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if(password_verify($data['current_password'],$row['password'])){
                if($data['new_password'] === $data['confirm_password']){
                    $sql = "UPDATE users SET password = :password WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':password',password_hash($data['new_password'],PASSWORD_DEFAULT),PDO::PARAM_STR);
                    $stmt->bindValue(':id',$_SESSION['id'],PDO::PARAM_INT);
                    $stmt->execute();
                    $_SESSION['message'] = 'Password changed successfully';
                    header('location: welcome.php');
                    exit;
                }else{
                    $errors['confirm_password'] = 'The password does not match';
                }
            }else{
                $errors['current_password'] = 'The password is incorrect';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="wrapper">
        <h2>Change Password</h2>
        
        <p>Please fill out this form to change your password.</p>
        <form action="<?php echo $_SERVER ['SCRIPT_NAME']; ?>" method="post">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control">
                <span class="text-danger"><?php echo $errors['current_password']; ?></span>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control">
                <span class="text-danger"><?php echo $errors['new_password']; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="text-danger"><?php echo $errors['confirm_password']; ?></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>