<?php
session_start();

require_once "includes/db.php";

/**
 * ===================================
 * ULTRA-FAST SECURE LOGOUT SYSTEM
 * ===================================
 */

// Reduce warnings in production
error_reporting(E_ALL & ~E_NOTICE);

/**
 * REMOVE REMEMBER TOKEN FROM DATABASE
 */
if (!empty($_COOKIE['user_login'])) {

    try {

        static $logoutStmt = null;

        if ($logoutStmt === null) {

            $logoutStmt = $pdo->prepare("
                UPDATE register
                SET remember_token = NULL
                WHERE remember_token = ?
                LIMIT 1
            ");
        }

        $logoutStmt->execute([
            $_COOKIE['user_login']
        ]);

    } catch (PDOException $e) {
        // Silent fail for production safety
    }
}

/**
 * CLEAR SESSION VARIABLES
 */
$_SESSION = [];

/**
 * DESTROY SESSION COOKIE
 */
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/**
 * REMOVE REMEMBER ME COOKIE
 */
setcookie(
    'user_login',
    '',
    [
        'expires'  => time() - 3600,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

/**
 * DESTROY SESSION
 */
session_destroy();

/**
 * OPTIONAL SUCCESS MESSAGE
 */
session_start();

$_SESSION['status'] = "You have been logged out successfully.";

/**
 * REDIRECT TO LOGIN
 */
header("Location: login.php");
exit();
?>