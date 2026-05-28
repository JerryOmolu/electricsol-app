<?php
include "../includes/db.php";
session_start();

header('Content-Type: application/json');

/* SECURITY CHECK */
if (!isset($_SESSION['verify_status']) || $_SESSION['verify_status'] !== 1) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$search = trim($_GET['search'] ?? '');

if ($search === '') {
    echo json_encode(['status' => 'empty']);
    exit();
}

try {

    $searchTerm = "%{$search}%";
    $exactTerm  = "{$search}%";

    $stmt = $pdo->prepare("
        SELECT artisan_id, name, phone, state, lga, skills
        FROM artisan
        WHERE 
            name LIKE ?
            OR state LIKE ?
            OR lga LIKE ?
            OR address LIKE ?
            OR skills LIKE ?

        ORDER BY
            CASE
                WHEN name LIKE ? THEN 1
                WHEN skills LIKE ? THEN 2
                WHEN lga LIKE ? THEN 3
                WHEN state LIKE ? THEN 4
                ELSE 5
            END,
            added_on DESC

        LIMIT 50
    ");

    $stmt->execute([
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm,

        $exactTerm,
        $exactTerm,
        $exactTerm,
        $exactTerm
    ]);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}