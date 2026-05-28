<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php"; // MUST expose $pdo ?>
<?php include "includes/functions.php"; ?>

<?php
/* =========================
   SECURITY CHECK (FIXED LOGIC)
========================= */
if (!isset($_SESSION['verify_status']) || $_SESSION['verify_status'] !== 1) {
    header("Location: login");
    exit;
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

  <link rel="icon" href="favicon/favicon.ico">

  <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <style>
    :root{
      --primary:#0134d4;
      --primary-dark:#001f7a;
      --light-bg:#f4f7ff;
      --card-radius:22px;
    }

    body{
      background: linear-gradient(to bottom, #f7f9ff 0%, #eef3ff 100%);
      font-family: "Segoe UI", sans-serif;
      overflow-x: hidden;
    }

    /* PRELOADER */
    #preloader{
      background:#fff;
    }

    /* HEADER */
    .header-area{
      backdrop-filter: blur(14px);
      background: rgba(255,255,255,0.92)!important;
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .page-heading h6{
      font-size: 17px;
      letter-spacing: .3px;
      color:#111827;
    }

    .back-button a{
      width:40px;
      height:40px;
      display:flex;
      align-items:center;
      justify-content:center;
      border-radius:14px;
      background:#f3f6ff;
      transition:all .25s ease;
    }

    .back-button a:hover{
      background:var(--primary);
      color:#fff!important;
      transform:translateX(-2px);
    }

    /* SEARCH */
    .search-card{
      border:none;
      border-radius:28px;
      background:#fff;
      overflow:hidden;
      box-shadow:0 10px 35px rgba(1,52,212,0.08);
    }

    .search-box{
      position:relative;
    }

    .search-box .form-control{
      height:60px;
      border:none;
      border-radius:18px;
      padding-left:55px;
      padding-right:65px;
      background:#f6f8ff;
      font-size:14px;
      box-shadow:none!important;
    }

    .search-box .form-control:focus{
      background:#fff;
      border:1px solid rgba(1,52,212,.15);
      box-shadow:0 0 0 4px rgba(1,52,212,.08)!important;
    }

    .search-icon{
      position:absolute;
      left:18px;
      top:50%;
      transform:translateY(-50%);
      color:#7b88a8;
      z-index:5;
      font-size:15px;
    }

    .search-btn{
      position:absolute;
      right:7px;
      top:7px;
      bottom:7px;
      border:none;
      width:48px;
      border-radius:14px;
      background:linear-gradient(135deg,var(--primary),#2457ff);
      color:#fff;
      transition:all .3s ease;
    }

    .search-btn:hover{
      transform:scale(1.04);
      box-shadow:0 8px 20px rgba(1,52,212,.25);
    }

    /* SECTION TITLE */
    .section-heading{
      display:flex;
      align-items:center;
      justify-content:space-between;
      margin-bottom:18px;
    }

    .section-heading h5{
      margin:0;
      font-weight:700;
      color:#111827;
    }

    .section-heading span{
      font-size:13px;
      color:#6b7280;
    }

    /* ARTISAN CARD */
    .artisan-card{
      border:none;
      border-radius:var(--card-radius);
      overflow:hidden;
      background:#fff;
      transition:all .35s ease;
      position:relative;
      box-shadow:0 10px 30px rgba(17,24,39,0.06);
      height:100%;
    }

    .artisan-card::before{
      content:'';
      position:absolute;
      top:0;
      left:0;
      right:0;
      height:5px;
      background:linear-gradient(90deg,var(--primary),#5b8cff);
    }

    .artisan-card:hover{
      transform:translateY(-7px);
      box-shadow:0 20px 45px rgba(1,52,212,.14);
    }

    .artisan-card .card-body{
      padding:22px 15px;
    }

    .artisan-image-wrap{
      position:relative;
      width:120px;
      height:120px;
      margin:auto;
    }

    .artisan-image{
      width:120px;
      height:120px;
      object-fit:cover;
      border-radius:50%;
      border:5px solid #eef3ff;
      transition:all .3s ease;
      box-shadow:0 10px 25px rgba(0,0,0,.08);
    }

    .artisan-card:hover .artisan-image{
      transform:scale(1.05);
    }

    .verified-badge{
      position:absolute;
      top:5px;
      right:-2px;
      background:linear-gradient(135deg,#22c55e,#16a34a);
      color:#fff;
      border-radius:30px;
      padding:5px 10px;
      font-size:11px;
      font-weight:600;
      box-shadow:0 5px 15px rgba(34,197,94,.3);
    }

    .artisan-name{
      font-size:15px;
      font-weight:700;
      color:#111827;
      margin-bottom:6px;
      text-decoration:none!important;
    }

    .artisan-name:hover{
      color:var(--primary);
    }

    .artisan-phone{
      font-size:13px;
      color:#6b7280;
      margin-bottom:16px;
    }

    .view-btn{
      border:none;
      border-radius:14px;
      height:42px;
      background:linear-gradient(135deg,var(--primary),#295dff);
      color:#fff!important;
      font-weight:600;
      font-size:13px;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:6px;
      transition:all .3s ease;
      text-decoration:none!important;
      box-shadow:0 10px 25px rgba(1,52,212,.18);
    }

    .view-btn:hover{
      transform:translateY(-2px);
      color:#fff!important;
      box-shadow:0 15px 30px rgba(1,52,212,.28);
    }

    /* PAGINATION */
    .pagination-card{
      border:none;
      border-radius:24px;
      overflow:hidden;
      background:#fff;
      box-shadow:0 10px 35px rgba(0,0,0,.05);
    }

    .pagination{
      gap:8px;
      flex-wrap:wrap;
    }

    .page-item .page-link{
      border:none;
      min-width:42px;
      height:42px;
      border-radius:14px!important;
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:600;
      color:#111827;
      background:#f4f7ff;
      transition:all .25s ease;
    }

    .page-item .page-link:hover{
      background:rgba(1,52,212,.1);
      color:var(--primary);
      transform:translateY(-2px);
    }

    .page-item.active .page-link{
      background:linear-gradient(135deg,var(--primary),#2457ff);
      color:#fff;
      box-shadow:0 10px 20px rgba(1,52,212,.25);
    }

    .page-item.disabled .page-link{
      opacity:.5;
      cursor:not-allowed;
    }

    /* EMPTY STATE */
    .empty-state{
      background:#fff;
      border-radius:28px;
      padding:50px 20px;
      text-align:center;
      box-shadow:0 10px 35px rgba(0,0,0,.05);
    }

    .empty-state i{
      font-size:55px;
      color:#c7d2fe;
      margin-bottom:15px;
    }

    .empty-state h6{
      font-weight:700;
      margin-bottom:8px;
      color:#111827;
    }

    .empty-state p{
      color:#6b7280;
      font-size:14px;
      margin:0;
    }

    /* MOBILE */
    @media (max-width: 576px){

      .artisan-image-wrap{
        width:95px;
        height:95px;
      }

      .artisan-image{
        width:95px;
        height:95px;
      }

      .artisan-card .card-body{
        padding:18px 12px;
      }

      .artisan-name{
        font-size:14px;
      }

      .view-btn{
        height:40px;
        font-size:12px;
      }

      .search-box .form-control{
        height:56px;
        font-size:13px;
      }
    }
  </style>
</head>

<body>

<div class="internet-connection-status" id="internetStatus"></div>

<!-- HEADER -->
<div class="header-area sticky-top shadow-sm" id="headerArea" style="z-index: 1050;">
  <div class="container">
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">

      <div class="back-button">
        <a href="home" class="text-dark">
          <i class="bi bi-arrow-left-short fs-3"></i>
        </a>
      </div>

      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold">Artisan Planet</h6>
      </div>

      <div style="width:40px;"></div>

    </div>
  </div>
</div>

<?php include "includes/home_side_nav_left.php"; ?>

<div class="page-content-wrapper py-3">

<?php
/* =========================
   PAGINATION (OPTIMIZED PDO)
========================= */

$perpage = 20;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$page_1 = ($page - 1) * $perpage;

/* COUNT ONLY (FAST INDEXED QUERY) */
$countStmt = $pdo->query("SELECT COUNT(*) FROM artisan");
$total_records = (int)$countStmt->fetchColumn();

$total = (int)ceil($total_records / $perpage);

$Previous = $page - 1;
$Next = $page + 1;

/* MAIN DATA QUERY (FAST + LIMITED) */
$stmt = $pdo->prepare("
    SELECT artisan_id, name, phone
    FROM artisan
    ORDER BY added_on DESC
    LIMIT :offset, :perpage
");

$stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
$stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
$stmt->execute();

$artisans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

  <!-- SEARCH -->
  <div class="shop-pagination pb-3">
    <div class="container">

      <div class="card search-card">
        <div class="card-body p-3 p-md-4">

          <div class="section-heading">
            <div>
              <h5>Find Skilled Artisans</h5>
              <span>Search by location or professional skill</span>
            </div>
          </div>

          <input 
  id="artisanSearch"
  class="form-control search-input"
  type="search"
  placeholder="Search Artisan by Skill, State, LGA or Address"
/>

<div id="searchResults" class="row g-3 mt-2"></div>

        </div>
      </div>

    </div>
  </div>

  <!-- ARTISAN GRID -->
  <div class="top-products-area">
    <div class="container">

      <div class="section-heading mb-3">
        <div>
          <h5>Available Artisans</h5>
          <span><?= number_format($total_records) ?> artisan(s) available</span>
        </div>
      </div>

      <?php if (!empty($artisans)): ?>

      <div class="row">

        <?php foreach ($artisans as $row): ?>
          <?php
            $artisan_id = (int)$row['artisan_id'];
            $name = htmlspecialchars($row['name']);
            $phone = htmlspecialchars($row['phone']);
          ?>

          <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">

            <div class="card artisan-card">

              <div class="card-body text-center">

                <a href="artisan-details.php?id=<?= $artisan_id ?>" class="d-block text-decoration-none">

                  <div class="artisan-image-wrap mb-3">

                    <img
                      src="img/electrisol-img/worker1.png"
                      class="artisan-image"
                      alt="<?= $name ?>"
                    >

                    <span class="verified-badge">
                      <i class="fa fa-check-circle"></i> Verified
                    </span>

                  </div>

                </a>

                <a
                  href="artisan-details.php?id=<?= $artisan_id ?>"
                  class="artisan-name d-block text-truncate"
                >
                  <?= $name ?>
                </a>

                <div class="artisan-phone text-truncate">
                  <i class="fa fa-phone mr-1"></i><?= $phone ?>
                </div>

                <a
                  href="artisan-details.php?id=<?= $artisan_id ?>"
                  class="view-btn w-100"
                >
                  View Detail
                  <i class="fa fa-arrow-right"></i>
                </a>

              </div>

            </div>

          </div>

        <?php endforeach; ?>

      </div>

      <?php else: ?>

      <div class="empty-state">
        <i class="fa fa-users"></i>
        <h6>No Artisan Found</h6>
        <p>No artisan records are currently available.</p>
      </div>

      <?php endif; ?>

    </div>
  </div>

  <!-- PAGINATION -->
  <?php if ($total > 1): ?>

  <div class="shop-pagination pt-2 pb-3">
    <div class="container">

      <div class="card pagination-card">
        <div class="card-body py-3">

          <nav>
            <ul class="pagination justify-content-center mb-0">

              <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="view_artisan?page=<?= $Previous ?>">
                  <i class="fa fa-chevron-left"></i>
                </a>
              </li>

              <?php for ($i = 1; $i <= $total; $i++): ?>

                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                  <a class="page-link" href="view_artisan?page=<?= $i ?>">
                    <?= $i ?>
                  </a>
                </li>

              <?php endfor; ?>

              <li class="page-item <?= ($page >= $total) ? 'disabled' : '' ?>">
                <a class="page-link" href="view_artisan?page=<?= $Next ?>">
                  <i class="fa fa-chevron-right"></i>
                </a>
              </li>

            </ul>
          </nav>

        </div>
      </div>

    </div>
  </div>

  <?php endif; ?>

</div>
	

<?php include "includes/home_footer_nav.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    let timer;

    $('#artisanSearch').on('keyup', function () {

        clearTimeout(timer);

        let query = $(this).val();

        timer = setTimeout(function () {

            if (query.length < 1) {
                $('#searchResults').html('');
                return;
            }

            $.ajax({
                url: 'ajax/search_artisan.php',
                method: 'GET',
                data: { search: query },
                beforeSend: function () {
                    $('#searchResults').html(`
                        <div class="col-12 text-center text-muted">
                            Searching...
                        </div>
                    `);
                },
                success: function (response) {

                    if (response.status === 'empty') {
                        $('#searchResults').html('');
                        return;
                    }

                    if (response.status === 'error') {
                        $('#searchResults').html(`
                            <div class="col-12 text-center text-danger">
                                Error loading results
                            </div>
                        `);
                        return;
                    }

                    let html = '';

                    if (response.data.length === 0) {
                        html = `
                            <div class="col-12 text-center text-muted">
                                No artisan found
                            </div>
                        `;
                    } else {

                        response.data.forEach(function (row) {

                            let skill = row.skills.split(',')[0];

                            html += `
                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">

                                    <div class="card single-product-card border-0 shadow-sm h-100">

                                        <div class="card-body p-3 text-center">

                                            <a href="artisan-details?id=${row.artisan_id}">
                                                <img src="img/electrisol-img/worker1.png"
                                                     class="img-fluid rounded mb-2"
                                                     style="height:200px;width:100%;object-fit:cover;">
                                            </a>

                                            <a href="artisan-details?id=${row.artisan_id}"
                                               class="fw-bold d-block text-truncate">
                                                ${row.name}
                                            </a>

                                            <p class="text-muted small mb-1">
                                                ${row.lga}, ${row.state}
                                            </p>

                                            <p class="text-primary small mb-2">
                                                ${skill}
                                            </p>

                                            <a href="artisan-details?id=${row.artisan_id}"
                                               class="btn btn-primary btn-sm w-100">
                                                View Profile
                                            </a>

                                        </div>

                                    </div>

                                </div>
                            `;
                        });
                    }

                    $('#searchResults').html(html);
                }
            });

        }, 400); // delay for smooth typing

    });

});
</script>
</body>
</html>