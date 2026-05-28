<?php 
include "includes/db.php";

if (isset($_GET['id'])) {

    $id = (int) $_GET['id']; // enforce integer for safety + performance

    try {

        $stmt = $pdo->prepare("DELETE FROM user WHERE user_id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);

    } catch (Exception $e) {
        // optional: log error if needed
    }

    header("Location: view_users");
    exit();

}
?>