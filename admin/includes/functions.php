<?php
/* =========================================================
   ULTRA-FAST PDO HELPER FUNCTIONS
   - Fully PDO optimized
   - Reduced SQL overhead
   - Faster query execution
   - Lower memory usage
   - Secure prepared statements
========================================================= */


/* =========================================================
   SECURE INPUT ESCAPE FUNCTION
========================================================= */
function escape(string $string): string
{
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}


/* =========================================================
   CHECK IF USER IS ADMIN
========================================================= */
function is_admin(string $username): bool
{
    global $pdo;

    try {

        /* =========================
           OPTIMIZED SQL QUERY
           FETCH ONLY ONE COLUMN
        ========================= */
        $sql = "
            SELECT role
            FROM user
            WHERE username = :username
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);

        /* =========================
           BIND PARAMETER
        ========================= */
        $stmt->bindValue(':username', trim($username), PDO::PARAM_STR);

        $stmt->execute();

        /* =========================
           FETCH SINGLE VALUE
        ========================= */
        $role = $stmt->fetchColumn();

        /* =========================
           RETURN BOOLEAN
        ========================= */
        return ($role === 'Admin');

    } catch (PDOException $e) {

        /* =========================
           FAIL SAFE
        ========================= */
        return false;
    }
}
?>