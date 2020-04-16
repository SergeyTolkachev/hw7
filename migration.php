<?php

try {
    $pdo = new PDO(
        'mysql:dbname=hw_7_Tolkachev;host=mysql',
        'root',
        'secret'
    );
} catch (Exception $e) {
    die('Database connection failed');
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'create table if not exists test_users (
    id int auto_increment,
    email varchar(100),
    status varchar(100),
    created_at date,
    primary key (id)
)';

try {
    $pdo->exec($sql);
} catch (Exception $error) {
    die('Cannot create userTest table. Reason: ' . $error->getMessage());
}

//$sql = 'insert into userTest set
//        email = :email,
//        status = :status,
//        createdAt = :createdAt';

$sql2 = '
    insert into test_users set
        email = "sergei.tolkachev@ukr.net",
        status = "student",
        created_at = "2020-04-01"
';

$sql3 = '
    insert into test_users set
        email = "egor.petrov@i.ua",
        status = "coach",
        created_at = "2020-04-05"
';

$sql4 = '
    insert into test_users set
        email = "emma.wotson@gmail.com",
        status = "admin",
        created_at = "2020-04-15"
';

try {
    //$pdo->exec($sql);
    $pdo->exec($sql2);
    $pdo->exec($sql3);
    $pdo->exec($sql4);
} catch (Exception $error) {
    die('Cannot create test users. Reason: ' . $error->getMessage());
}

echo 'Migrate success';