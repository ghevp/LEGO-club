<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
require_once 'login.php';
$mail=$_POST['mail'];
$db_server = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if( mysqli_connect_errno() ) {	echo mysqli_connect_errno() . ' : ' . mysqli_connect_error();}
mysqli_set_charset($db_server,'utf8');

    $query = mysqli_prepare($db_server,'insert into checking (name,password,mail)values(?,?,?)');
    mysqli_stmt_bind_param($query,'sss',$name,$password,$mail);
    mysqli_stmt_execute($query);
    

?>
<a href="../index.php?page=enword">PUSH</a>