<?php session_start(); ?>
<?php ob_start(); ?>
<?php include "includes/db.php"; // MUST expose $pdo ?>

<?php include "includes/functions.php"; ?>

<?php 
/* =========================================================
   FIXED SESSION CHECK
========================================================= */
if (!isset($_SESSION['verify_status']) || $_SESSION['verify_status'] !== 1) {
    header("Location:login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Affan - PWA Mobile HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="theme-color" content="#0134d4">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <title>Electricsol-Mobile App</title>

  <!-- Favicon -->
  <link rel="icon" href="favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">

  <!-- RateYo -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Manifest -->
  <link rel="manifest" href="manifest.json">

  <!-- Summernote -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <style>
    body{
      background:#f5f7ff;
    }

    .header-area{
      background:#fff;
      border-bottom:1px solid #e9ecef;
    }

    .search-card{
      border:none;
      border-radius:18px;
      overflow:hidden;
    }

    .search-input{
      height:52px;
      border-radius:14px 0 0 14px !important;
      border:1px solid #dee2e6;
      box-shadow:none !important;
    }

    .search-input:focus{
      border-color:#0134d4;
    }

    .search-btn{
      border-radius:0 14px 14px 0 !important;
      width:60px;
    }

    .single-product-card{
      border:none;
      border-radius:20px;
      overflow:hidden;
      transition:all .3s ease;
      background:#fff;
    }

    .single-product-card:hover{
      transform:translateY(-5px);
      box-shadow:0 10px 30px rgba(0,0,0,.08);
    }

    .product-thumbnail{
      overflow:hidden;
      border-radius:16px;
    }

    .product-thumbnail img{
      transition:transform .4s ease;
    }

    .single-product-card:hover .product-thumbnail img{
      transform:scale(1.05);
    }

    .product-title{
      color:#111;
      text-decoration:none;
      font-size:15px;
    }

    .product-title:hover{
      color:#0134d4;
      text-decoration:none;
    }

    .badge{
      font-size:11px;
      padding:6px 10px;
      border-radius:30px;
    }

    .empty-state{
      background:#fff;
      border-radius:20px;
      padding:50px 20px;
      text-align:center;
      box-shadow:0 5px 20px rgba(0,0,0,.04);
    }

    .empty-state i{
      font-size:55px;
      color:#ced4da;
      margin-bottom:15px;
    }

    .empty-state h5{
      font-weight:700;
      margin-bottom:10px;
    }

    .search-info{
      font-size:14px;
      color:#6c757d;
    }
  </style>
</head>

<body>

<!-- Preloader -->
<div id="preloader">
  <div class="spinner-grow text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Header Area -->
<div class="header-area shadow-sm" id="headerArea">

  <div class="container">

    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">

      <!-- Back Button -->
      <div class="back-button">
        <a href="view_artisan" class="d-flex align-items-center text-dark text-decoration-none">
          <i class="bi bi-arrow-left-short fs-3 me-1"></i>
          <span class="d-none d-sm-inline">Back</span>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-truncate">Artisan Planet</h6>
      </div>

      <div style="width:40px;"></div>

    </div>

  </div>

</div>

<!-- Side Nav -->
<?php include "includes/home_side_nav_left.php"; ?>

<div class="page-content-wrapper py-3">

  <!-- Search -->
  <div class="container mb-3">

    <div class="card shadow-sm search-card">

      <div class="card-body">

        <form action="search_artisan.php" method="post">

          <div class="input-group">

            <input 
              class="form-control search-input"
              type="search"
              placeholder="Search Artisan by Skill, State, LGA or Address"
              name="search"
              value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8') : ''; ?>"
              required
            >

            <button class="btn btn-primary search-btn" type="submit" name="submit">
              <i class="fa fa-search"></i>
            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

  <!-- Artisan List -->
  <div class="top-products-area">

    <div class="container">

      <div class="row g-3">

<?php

/* =========================================================
   SEARCH LOGIC
========================================================= */

if (isset($_POST['submit'])) {

    $search = trim($_POST['search'] ?? '');

    if (!empty($search)) {

        try {

            /* =========================================================
               SEARCH TERMS
            ========================================================= */

            $searchTerm = "%" . $search . "%";
            $exactTerm  = $search . "%";

            /* =========================================================
               FIXED PDO QUERY
            ========================================================= */

            $stmt = $pdo->prepare("
                SELECT 
                    artisan_id,
                    name,
                    phone,
                    state,
                    lga,
                    skills,
                    added_on
                FROM artisan

                WHERE 
                    name LIKE ?
                    OR state LIKE ?
                    OR lga LIKE ?
                    OR address LIKE ?
                    OR skills LIKE ?

                ORDER BY
                    CASE
                        WHEN name LIKE ? THEN 1
                        WHEN skills LIKE ? THEN 2
                        WHEN lga LIKE ? THEN 3
                        WHEN state LIKE ? THEN 4
                        ELSE 5
                    END,
                    added_on DESC

                LIMIT 100
            ");

            $stmt->execute([
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,
                $searchTerm,

                $exactTerm,
                $exactTerm,
                $exactTerm,
                $exactTerm
            ]);

            $artisans = $stmt->fetchAll(PDO::FETCH_ASSOC);

            /* =========================================================
               NO RESULT
            ========================================================= */

            if (empty($artisans)) {

                echo "
                <div class='col-12'>
                    <div class='empty-state'>
                        <i class='fa fa-search'></i>

                        <h5>No Artisan Found</h5>

                        <p class='search-info'>
                            No result found for 
                            <strong>" . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . "</strong>
                        </p>
                    </div>
                </div>
                ";

            } else {

                /* =========================================================
                   RESULT COUNT
                ========================================================= */

                echo "
                <div class='col-12 mb-3'>
                    <p class='search-info'>
                        <strong>" . count($artisans) . "</strong> artisan(s) found for 
                        <strong>'" . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . "'</strong>
                    </p>
                </div>
                ";

                /* =========================================================
                   DISPLAY RESULTS
                ========================================================= */

                foreach ($artisans as $row) {

                    $artisan_id = (int)$row['artisan_id'];

                    $name   = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                    $phone  = htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8');
                    $state  = htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8');
                    $lga    = htmlspecialchars($row['lga'], ENT_QUOTES, 'UTF-8');
                    $skills = htmlspecialchars($row['skills'], ENT_QUOTES, 'UTF-8');

                    // FIRST SKILL ONLY
                    $firstSkill = explode(',', $skills);
                    $firstSkill = trim($firstSkill[0]);

?>

<div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">

    <div class="card single-product-card border-0 shadow-sm h-100 artisan-card">

        <div class="card-body p-3 d-flex flex-column align-items-center text-center">

            <!-- Thumbnail -->
            <a class="product-thumbnail d-block mb-3 position-relative w-100 rounded overflow-hidden"
               href="artisan-details?id=<?php echo $artisan_id; ?>">

                <img 
                    src="img/electrisol-img/worker1.png"
                    alt="Artisan"
                    class="img-fluid w-100"
                    style="height:200px; object-fit:cover; transition:0.4s ease;"
                >

                <span class="badge position-absolute top-0 start-0 m-2 px-3 py-2 shadow-sm" style="color: green;">
                    <i class="fa fa-check-circle me-1"></i> Verified
                </span>

            </a>

            <!-- Name -->
            <a class="product-title d-block text-truncate fw-bold mb-1 w-100 artisan-name"
               href="artisan-details?id=<?php echo $artisan_id; ?>">

                <?php echo $name; ?>

            </a>

            <!-- Location -->
            <p class="text-muted small mb-1 text-truncate w-100 artisan-meta">
                <i class="fa fa-map-marker text-danger me-1"></i>
                <?php echo $lga . ", " . $state; ?>
            </p>

            <!-- Phone -->
            <p class="text-muted small mb-2 artisan-meta">
                <i class="fa fa-phone text-primary me-1"></i>
                <?php echo $phone; ?>
            </p>

            <!-- Skill -->
            <p class="small text-primary mb-3 text-truncate w-100 artisan-skill">
                <i class="fa fa-wrench me-1"></i>
                <?php echo $firstSkill; ?>
            </p>

            <!-- Button -->
            <a href="artisan-details?id=<?php echo $artisan_id; ?>"
               class="btn btn-primary btn-sm mt-auto w-100 artisan-btn">

                View Profile

            </a>

        </div>

    </div>

</div>

<?php
                }
            }

        } catch (PDOException $e) {

            // DEBUGGING
            error_log($e->getMessage());

            echo "
            <div class='col-12'>
                <div class='alert alert-danger text-center'>
                    Search Error: " . htmlspecialchars($e->getMessage()) . "
                </div>
            </div>
            ";
        }

    } else {

        echo "
        <div class='col-12'>
            <div class='alert alert-warning text-center'>
                Please enter a search keyword.
            </div>
        </div>
        ";
    }
}
?>

      </div>

    </div>

  </div>

  <!-- Footer -->
  <?php include "includes/home_footer_nav.php"; ?>

</div>

</body>
</html>