<html>

<head>
    <title>PHP TEST</title>
</head>

<body>
    <?php
    require_once 'config.php';



    /* ①　データベースの接続情報を定数に格納する */
    $dsn = 'mysql:dbname=test;host=mysql;charset=utf8mb4';
    $user = 'docker';
    $password = 'docker';

    try {
        $dbh = new PDO($dsn, $user, $password);

        print('接続に成功しました。<br>');

        $dbh->query('SET NAMES utf8mb4');

        $sql = 'select * from users';
        foreach ($dbh->query($sql) as $row) {
            print($row['id']);
            print($row['name'] . '<br>');
        }
    } catch (PDOException $e) {
        print('Error:' . $e->getMessage());
        die();
    }

    $dbh = null;

    ?>

</body>

</html>