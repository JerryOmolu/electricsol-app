<?php
session_start();
require_once 'includes/db.php'; // MUST expose $pdo

if(isset($_GET['token']) && !empty($_GET['token'])){

    $token = trim($_GET['token']);

    /* =========================
       FAST TOKEN LOOKUP
    ========================= */
    $stmt = $pdo->prepare("
        SELECT verify_token, verify_status 
        FROM user 
        WHERE verify_token = :token 
        LIMIT 1
    ");

    $stmt->execute([':token' => $token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){

        if($row['verify_status'] == "0"){

            /* =========================
               ATOMIC UPDATE (FAST + SAFE)
            ========================= */
            $update = $pdo->prepare("
                UPDATE user 
                SET verify_status = '1' 
                WHERE verify_token = :token 
                LIMIT 1
            ");

            if($update->execute([':token' => $token])){

                $_SESSION['status'] = "Verification Successful!. Please Sign In";
                header("Location: index");
                exit;

            } else {

                $_SESSION['status'] = "Verification Failed";
                header("Location: index");
                exit;
            }

        } else {

            $_SESSION['status'] = "Account already Verified. Please Sign In";
            header("Location: index");
            exit;
        }

    } else {

        $_SESSION['status'] = "This token does not exists";
        header("Location: index");
        exit;
    }

} else {

    $_SESSION['status'] = "Not Allowed";
    header("Location: index");
    exit;
}
?>