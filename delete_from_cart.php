<?php 
include "includes/db.php"; 
// expects $pdo = new PDO(...)

if(isset($_GET['id'])){

    // -------------------------
    // FAST INPUT SANITIZATION
    // -------------------------
    $id = (int)($_GET['id'] ?? 0);

    if($id > 0){

        try {

            // -------------------------
            // PDO DELETE (SAFE + FAST)
            // -------------------------
            $stmt = $pdo->prepare("
                DELETE FROM cart 
                WHERE order_id = :id 
                LIMIT 1
            ");

            $stmt->execute([':id' => $id]);

        } catch(Exception $e){
            // silent fail for performance (no UI interruption)
        }
    }

    // always redirect (same logic flow)
    header("Location: cart");
    exit;
}
?>