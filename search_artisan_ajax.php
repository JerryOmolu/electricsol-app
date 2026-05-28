<?php
include 'includes/db.php';

/* =========================================================
   ULTRA-FAST PDO AUTOCOMPLETE SEARCH
   Optimized for:
   - Lower CPU usage
   - Reduced memory usage
   - Faster SQL execution
   - SQL injection protection
========================================================= */

if (isset($_POST['search'])) {

    // Fast trimmed input
    $search = trim($_POST['search']);

    // Prevent unnecessary database queries
    if ($search !== '') {

        try {

            /* =========================================================
               PERFORMANCE OPTIMIZATIONS
               ---------------------------------------------------------
               1. Select only required columns
               2. Prepared statements
               3. LIMIT results
               4. PDO associative fetch
               5. Reduced query parsing
               6. Lower RAM usage
            ========================================================= */

            $stmt = $pdo->prepare("
                SELECT
                    artisan_id,
                    name
                FROM artisan
                WHERE name   LIKE :search
                   OR skills LIKE :search
                   OR state  LIKE :search
                LIMIT 5
            ");

            $stmt->execute([
                ':search' => "%{$search}%"
            ]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($results)) {

                foreach ($results as $row) {

                    $id   = (int)$row['artisan_id'];
                    $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');

                    echo "
                    <a href='artisan-details?id={$id}'
                       class='list-group-item list-group-item-action suggestion-item'>
                        {$name}
                    </a>";
                }

            } else {

                echo "
                <span class='list-group-item'>
                    No results found
                </span>";
            }

        } catch (PDOException $e) {

            // Silent error logging
            error_log($e->getMessage());

            echo "
            <span class='list-group-item text-danger'>
                Search unavailable
            </span>";
        }
    }
}
?>
