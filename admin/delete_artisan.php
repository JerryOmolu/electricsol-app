<?php 
include "includes/db.php";

if (isset($_GET['id'])) {

    $id = (int) $_GET['id']; // force integer for safety + speed

    try {

        $stmt = $pdo->prepare("DELETE FROM artisan WHERE artisan_id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);

    } catch (Exception $e) {
        // silently fail or log if needed
    }

    header("Location: view_artisans");
    exit();

}
?>