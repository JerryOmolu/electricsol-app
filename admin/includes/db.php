<?php
/**
 * ULTRA-FAST PDO DATABASE CONNECTION
 * Optimized for lower server load, faster queries, and better scalability.
 */

declare(strict_types=1);

/* =========================
   DATABASE CONFIG
========================= */
$dbHost = 'localhost';
$dbName = 'electricsol';
$dbUser = 'root';
$dbPass = '';

/* =========================
   PDO CONNECTION
========================= */
try {

    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";

    $pdo = new PDO($dsn, $dbUser, $dbPass, [

        // THROW REAL ERRORS
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        // RETURN ASSOCIATIVE ARRAYS ONLY
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

        // USE NATIVE MYSQL PREPARED STATEMENTS
        PDO::ATTR_EMULATE_PREPARES => false,

        // PERSISTENT CONNECTION = LOWER SERVER LOAD
        PDO::ATTR_PERSISTENT => true,

        // AUTO-CONNECT OPTIMIZATION
        PDO::MYSQL_ATTR_INIT_COMMAND => "
            SET SESSION sql_mode='STRICT_TRANS_TABLES',
            NAMES utf8mb4,
            time_zone = '+00:00'
        "
    ]);

} catch (PDOException $e) {

    // SAFE ERROR HANDLING
    exit('Database connection failed.');

}
?>