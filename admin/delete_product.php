<?php 
include "includes/db.php";

if (isset($_GET['id'])) {

    $id = (int) $_GET['id']; // enforce integer (faster + safer DB execution)

    try {

        $stmt = $pdo->prepare("DELETE FROM product WHERE product_id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);

    } catch (Exception $e) {
        // optional logging can be added here
    }

    header("Location: view_products");
    exit();

}
?>