<html>

<head>
    <title>PHP TEST</title>
</head>

<body>
    <?php
    require_once('testConnect.php');


    /* ①　データベースの接続情報を定数に格納する */
    $dsn = 'pgsql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';port=' . DB_PORT . ';sslmode=require';
    $dbUser = DB_USER;
    $dbPassword = DB_PASSWORD;

    try {
        $dbh = new PDO($dsn, $dbUser, $dbPassword);

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