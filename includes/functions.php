<?php

/**
 * Ultra-Fast PDO Secure Helper Functions
 * Optimized for performance, security, and low server load
 */

declare(strict_types=1);

/* =========================================================
   FAST SANITIZATION FUNCTION
========================================================= */
function escape(string $string): string
{
    // Fast trim + safe HTML encoding
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}


/* =========================================================
   PDO QUERY HELPER (PREPARED STATEMENTS)
========================================================= */
function db_query(PDO $pdo, string $sql, array $params = []): PDOStatement
{
    static $statementCache = [];

    // Reuse prepared statements (reduces SQL parsing load)
    if (!isset($statementCache[$sql])) {
        $statementCache[$sql] = $pdo->prepare($sql);
    }

    $stmt = $statementCache[$sql];
    $stmt->execute($params);

    return $stmt;
}


/* =========================================================
   FETCH SINGLE ROW
========================================================= */
function fetch_one(PDO $pdo, string $sql, array $params = []): ?array
{
    $stmt = db_query($pdo, $sql, $params);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
}


/* =========================================================
   FETCH MULTIPLE ROWS
========================================================= */
function fetch_all(PDO $pdo, string $sql, array $params = []): array
{
    return db_query($pdo, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
}


/* =========================================================
   FAST INSERT/UPDATE/DELETE EXECUTOR
========================================================= */
function execute_query(PDO $pdo, string $sql, array $params = []): bool
{
    return db_query($pdo, $sql, $params)->rowCount() > 0;
}

?>