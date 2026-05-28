<?php 
include "includes/db.php"; 
// expects $pdo = new PDO(...)

if(isset($_GET['id'])){

    // -------------------------
    // FAST INPUT VALIDATION
    // -------------------------
    $id = $_GET['id'];

    // force integer (prevents SQL injection + faster execution path)
    $id = (int)$id;

    if($id > 0){

        try {

            // -------------------------
            // PDO PREPARED DELETE (FAST + SAFE)
            // -------------------------
            $stmt = $pdo->prepare("
                DELETE FROM device 
                WHERE device_id = :id 
                LIMIT 1
            ");

            $stmt->execute([':id' => $id]);

        } catch(Exception $e){
            // fail silently (keeps UI fast and uninterrupted)
        }
    }

    // always redirect (keeps original flow)
    header("Location: view_device");
    exit;
}
?>