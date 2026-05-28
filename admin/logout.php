<?php
session_start();

/* =========================================================
   ULTRA-FAST SECURE LOGOUT SYSTEM
   - Optimized session cleanup
   - Reduced memory usage
   - Faster execution
   - More secure session destruction
========================================================= */

/* =========================
   CLEAR ALL SESSION DATA
========================= */
$_SESSION = [];

/* =========================
   DESTROY SESSION COOKIE
========================= */
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

/* =========================
   DESTROY SESSION
========================= */
session_destroy();

/* =========================
   PREVENT CACHE
========================= */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/* =========================
   REDIRECT USER
========================= */
header("Location: index");
exit;
?>