<?php

session_start();
include 'includes/db.php'; // MUST expose $pdo
include 'includes/functions.php';

if (isset($_POST['update_password'])) {

    $email = escape($_POST['email'] ?? '');
    $new_password = escape($_POST['new_password'] ?? '');
    $confirm_password = escape($_POST['confirm_password'] ?? '');
    $token = escape($_POST['password_token'] ?? '');

    /* =========================
       VALIDATE TOKEN FIRST
    ========================= */
    if (!empty($token)) {

        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {

            // FAST PDO TOKEN CHECK
            $stmt = $pdo->prepare("
                SELECT verify_token 
                FROM register 
                WHERE verify_token = :token 
                LIMIT 1
            ");

            $stmt->execute([':token' => $token]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {

                /* =========================
                   PASSWORD MATCH CHECK
                ========================= */
                if ($new_password === $confirm_password) {

                    $hashedPassword = password_hash(
                        $new_password,
                        PASSWORD_BCRYPT,
                        ['cost' => 10]
                    );

                    /* =========================
                       UPDATE PASSWORD (FAST)
                    ========================= */
                    $update = $pdo->prepare("
                        UPDATE register 
                        SET password = :password 
                        WHERE verify_token = :token 
                        LIMIT 1
                    ");

                    $result = $update->execute([
                        ':password' => $hashedPassword,
                        ':token' => $token
                    ]);

                    if ($result) {

                        /* =========================
                           ROTATE TOKEN (SECURITY BOOST)
                        ========================= */
                        $new_token = bin2hex(random_bytes(16)) . "electricsol";

                        $updateToken = $pdo->prepare("
                            UPDATE register 
                            SET verify_token = :new_token 
                            WHERE verify_token = :old_token 
                            LIMIT 1
                        ");

                        $updateToken->execute([
                            ':new_token' => $new_token,
                            ':old_token' => $token
                        ]);

                        $_SESSION['status'] = "Password Reset is successful";
                        header("Location: login");
                        exit();

                    } else {
                        $_SESSION['status'] = "Update Password failed. Something went wrong";
                        header("Location: change-password?token=$token&email=$email");
                        exit();
                    }

                } else {
                    $_SESSION['status'] = "New Password and Confirm Password does not match. Kindly re-enter";
                    header("Location: change-password?token=$token&email=$email");
                    exit();
                }

            } else {
                $_SESSION['status'] = "Invalid Token";
                header("Location: change-password?token=$token&email=$email");
                exit();
            }

        } else {
            $_SESSION['status'] = "All fields are Mandatory";
            header("Location: change-password?token=$token&email=$email");
            exit();
        }

    } else {
        $_SESSION['status'] = "No Token Available";
        header("Location: change-password");
        exit();
    }
}

?>