<?php
//XSS対策
function h($s)
{
    return htmlspecialchars($s ?? '', ENT_QUOTES, "UTF-8");
}

//セッションにトークンセット
function setToken()
{
    $token = sha1(uniqid(mt_rand(), true));
    $_SESSION['token'] = $token;
}

//セッション変数のトークンとPOSTされたトークンをチェック
function checkToken()
{
    if (empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])) {
        echo 'Invalid POST', PHP_EOL;
        exit;
    }
}

//POSTされた値のバリデーション
function validation($datas, $confirm = true)
{
  
    //エラーメッセージの初期化

    switch ($_SESSION['useSystem']) {
        case 'register':
            $errors= validationRegister($datas, $confirm);
            break;
        case 'changePassword':
            $errors= validationChangePassword($datas, $confirm);
            break;
        default:
            $errors= validationLogin($datas);
            break;
    }
  

   return $errors;
}
function validationRegister($datas, $confirm = true)
{
    //エラーメッセージの初期化
    $errors = [
        'name' => '',
        'password' => '',
        'confirm_password' => ''
    ];

    //ユーザー名のチェック
    if (empty($datas['name'])) {
        $errors['name'] = 'Please enter username.';
    } else if (mb_strlen($datas['name']) > 20) {
        $errors['name'] = 'Please enter up to 20 characters.';
    }

    //パスワードのチェック（正規表現）
    if (empty($datas["password"])) {
        $errors['password']  = "Please enter a password.";
        
    } else if(!preg_match('/\A[a-z\d]{8,100}+\z/i',$datas["password"])){
        $errors['password'] = "Please set a password with at least eight characters.";
        echo $datas["password"] ,"<br>";
    }
    //パスワード入力確認チェック（ユーザー新規登録時のみ使用）
    if ($confirm) {
        if (empty($datas["confirm_password"])) {
            $errors['confirm_password']  = "Please confirm password.";
        } else if (empty($errors['password']) && ($datas["password"] != $datas["confirm_password"])) {
            $errors['confirm_password'] = "Password did not match.";
        }
    }

    return $errors;
}
function validationChangePassword($datas)
{
    //エラーメッセージの初期化
    $errors = [
        'current_password' => '',
        'new_password' => '',
        'confirm_password' => ''
    ];

    //現在のパスワードのチェック
    if (empty($datas['current_password'])) {
        $errors['current_password'] = 'Please enter current password.';
    } 

    //新しいパスワードのチェック
    if (empty($datas['new_password'])) {
        $errors['new_password'] = 'Please enter new password.';
    } else if (!preg_match('/\A[a-z\d]{8,100}\z/i', $datas['new_password'])) {
        $errors['new_password'] = 'Please set a password with at least 8 characters.';
    }

    //新しいパスワード入力確認チェック
    if (empty($datas['confirm_password'])) {
        $errors['confirm_password'] = 'Please confirm password.';
    } else if (empty($errors['new_password']) && ($datas['new_password'] != $datas['confirm_password'])) {
        $errors['confirm_password'] = 'Password did not match.';
    }

    return $errors;
}
function validationLogin($datas, $confirm = true)
{
    //エラーメッセージの初期化
    $errors = [
        'name' => '',
        'password' => '',
        'confirm_password' => ''
    ];

    //ユーザー名のチェック
    if (empty($datas['name'])) {
        $errors['name'] = 'Please enter username.';
    } else if (mb_strlen($datas['name']) > 20) {
        $errors['name'] = 'Please enter up to 20 characters.';
    }

    //パスワードのチェック（正規表現）
    if (empty($datas["password"])) {
        $errors['password']  = "Please enter a password.";
    } else if (!preg_match('/\A[a-z\d]{8,100}\z/i', $datas["password"])) {
        $errors['password'] = "Please set a password with at least 8 characters.";
    }
      //パスワード入力確認チェック（ユーザー新規登録時のみ使用）
      if ($confirm) {
        if (empty($datas["confirm_password"])) {
            $errors['confirm_password']  = "Please confirm password.";
        } else if (empty($errors['password']) && ($datas["password"] != $datas["confirm_password"])) {
            $errors['confirm_password'] = "Password did not match.";
        }
    }
    return $errors;
}