<?php
declare(strict_types=1);

$db_host = 'localhost';
$db_name = 'electricsol';
$db_user = 'root';
$db_pass = '';

$options = [

    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,

    // ⚡ Keep persistent connection (good for performance)
    PDO::ATTR_PERSISTENT => true,

    PDO::ATTR_STRINGIFY_FETCHES => false,

    // ✅ FIX: MUST BE TRUE
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
];

try {
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_pass,
        $options
    );

} catch (PDOException $e) {
    exit('Database connection failed.');
}
?>