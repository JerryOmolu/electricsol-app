<?php ob_start(); ?>
<?php include "includes/db.php"; // MUST now expose $pdo (PDO instance) ?>
<?php session_start(); ?>
<?php include "includes/functions.php"; ?>

<?php 
// FIXED SESSION CHECK (safer + correct logic)
if (!isset($_SESSION['verify_status']) || $_SESSION['verify_status'] !== 1) {
    header("Location:login.php");
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

  <link rel="icon" href="favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="style.css">
  <link rel="manifest" href="manifest.json">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <style>
    :root{
      --primary:#0134d4;
      --primary-dark:#00279e;
      --light-bg:#f4f7ff;
      --card-radius:24px;
      --text-dark:#111827;
      --text-muted:#6b7280;
    }

    body{
      background: linear-gradient(to bottom, #f5f7ff 0%, #eef3ff 100%);
      font-family: "Segoe UI", sans-serif;
      overflow-x:hidden;
      color:var(--text-dark);
    }

    /* PRELOADER */
    #preloader{
      background:#fff;
    }

    /* HEADER */
    .header-area{
      background: linear-gradient(135deg, var(--primary), #2458ff);
      border-bottom-left-radius:30px;
      border-bottom-right-radius:30px;
      padding-bottom:15px;
      position:sticky;
      top:0;
      z-index:1050;
      overflow:hidden;
    }

    .header-area::before{
      content:'';
      position:absolute;
      width:180px;
      height:180px;
      background:rgba(255,255,255,.08);
      border-radius:50%;
      top:-80px;
      right:-50px;
    }

    .header-area::after{
      content:'';
      position:absolute;
      width:120px;
      height:120px;
      background:rgba(255,255,255,.05);
      border-radius:50%;
      bottom:-40px;
      left:-20px;
    }

    .header-content{
      position:relative;
      z-index:2;
    }

    .back-button a{
      width:42px;
      height:42px;
      border-radius:14px;
      background:rgba(255,255,255,.14);
      display:flex;
      align-items:center;
      justify-content:center;
      transition:.3s ease;
      backdrop-filter:blur(10px);
    }

    .back-button a:hover{
      background:#fff;
      color:var(--primary)!important;
      transform:translateX(-2px);
    }

    .page-heading h6{
      font-size:17px;
      letter-spacing:.3px;
    }

    /* MAIN CARD */
    .main-card{
      border:none;
      border-radius:32px;
      overflow:hidden;
      background:#fff;
      box-shadow:0 20px 50px rgba(1,52,212,.08);
    }

    .card-title{
      font-size:24px;
      font-weight:800;
      color:var(--primary);
    }

    /* PROFILE TOP */
    .profile-top{
      position:relative;
      text-align:center;
      padding:30px 20px 20px;
      border-radius:28px;
      background:linear-gradient(to bottom right,#f6f8ff,#edf2ff);
      margin-bottom:25px;
      overflow:hidden;
    }

    .profile-top::before{
      content:'';
      position:absolute;
      width:220px;
      height:220px;
      background:rgba(1,52,212,.04);
      border-radius:50%;
      top:-120px;
      right:-60px;
    }

    .profile-image{
      width:130px;
      height:130px;
      border-radius:50%;
      object-fit:cover;
      border:6px solid #fff;
      box-shadow:0 15px 35px rgba(1,52,212,.15);
      margin-bottom:15px;
      position:relative;
      z-index:2;
      transition:.3s ease;
    }

    .profile-image:hover{
      transform:scale(1.03);
    }

    .profile-name{
      font-size:24px;
      font-weight:800;
      margin-bottom:5px;
      color:var(--text-dark);
      position:relative;
      z-index:2;
    }

    .profile-role{
      color:var(--text-muted);
      font-size:14px;
      margin-bottom:15px;
      position:relative;
      z-index:2;
    }

    .verified-badge{
      display:inline-flex;
      align-items:center;
      gap:6px;
      background:rgba(34,197,94,.12);
      color:#16a34a;
      border-radius:50px;
      padding:7px 14px;
      font-size:13px;
      font-weight:700;
      position:relative;
      z-index:2;
    }

    /* SECTION CARD */
    .info-card{
      border:none;
      border-radius:26px;
      overflow:hidden;
      background:#fff;
      box-shadow:0 12px 35px rgba(17,24,39,.05);
      margin-bottom:24px;
      transition:.3s ease;
    }

    .info-card:hover{
      transform:translateY(-4px);
      box-shadow:0 20px 45px rgba(1,52,212,.08);
    }

    .info-card .card-body{
      padding:24px;
    }

    .section-title{
      display:flex;
      align-items:center;
      gap:10px;
      font-size:18px;
      font-weight:700;
      color:var(--text-dark);
      margin-bottom:22px;
    }

    .section-title i{
      width:38px;
      height:38px;
      border-radius:12px;
      background:rgba(1,52,212,.1);
      color:var(--primary);
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:16px;
    }

    /* INFO LIST */
    .info-list{
      display:flex;
      flex-direction:column;
      gap:14px;
    }

    .info-item{
      display:flex;
      align-items:flex-start;
      gap:14px;
      padding:16px;
      border-radius:18px;
      background:#f8faff;
      transition:.3s ease;
    }

    .info-item:hover{
      background:#eef3ff;
      transform:translateX(2px);
    }

    .info-icon{
      width:42px;
      height:42px;
      min-width:42px;
      border-radius:14px;
      background:#fff;
      color:var(--primary);
      display:flex;
      align-items:center;
      justify-content:center;
      box-shadow:0 4px 14px rgba(1,52,212,.08);
      font-size:15px;
    }

    .info-label{
      font-size:12px;
      font-weight:700;
      text-transform:uppercase;
      letter-spacing:.5px;
      color:#94a3b8;
      margin-bottom:4px;
    }

    .info-value{
      font-size:15px;
      font-weight:600;
      color:var(--text-dark);
      word-break:break-word;
    }

    /* SKILL TAGS */
    .tag-wrapper{
      display:flex;
      flex-wrap:wrap;
      gap:12px;
    }

    .skill-tag{
      background:linear-gradient(135deg,#eef3ff,#f8fbff);
      color:var(--primary-dark);
      border:1px solid rgba(1,52,212,.08);
      padding:12px 16px;
      border-radius:16px;
      font-size:14px;
      font-weight:600;
      display:flex;
      align-items:center;
      gap:8px;
      transition:.3s ease;
    }

    .skill-tag:hover{
      transform:translateY(-2px);
      background:#fff;
      box-shadow:0 10px 25px rgba(1,52,212,.08);
    }

    .skill-tag i{
      color:#16a34a;
    }

    /* EXPERIENCE BOX */
    .experience-box{
      background:linear-gradient(135deg,var(--primary),#2458ff);
      border-radius:24px;
      padding:28px 20px;
      text-align:center;
      color:#fff;
      position:relative;
      overflow:hidden;
    }

    .experience-box::before{
      content:'';
      position:absolute;
      width:180px;
      height:180px;
      background:rgba(255,255,255,.08);
      border-radius:50%;
      top:-90px;
      right:-50px;
    }

    .experience-box h2{
      font-size:48px;
      font-weight:800;
      margin-bottom:5px;
      position:relative;
      z-index:2;
    }

    .experience-box p{
      margin:0;
      opacity:.9;
      position:relative;
      z-index:2;
    }

    /* EMPTY */
    .empty-state{
      text-align:center;
      padding:50px 20px;
    }

    .empty-state i{
      font-size:60px;
      color:#cbd5e1;
      margin-bottom:15px;
    }

    .empty-state h5{
      font-weight:700;
      margin-bottom:8px;
    }

    .empty-state p{
      color:var(--text-muted);
      margin:0;
    }

    /* MOBILE */
    @media(max-width:576px){

      .main-card{
        border-radius:24px;
      }

      .profile-image{
        width:110px;
        height:110px;
      }

      .profile-name{
        font-size:20px;
      }

      .info-card .card-body{
        padding:20px;
      }

      .info-item{
        padding:14px;
      }

      .experience-box h2{
        font-size:38px;
      }
    }
  </style>
</head>

<body>

<div id="preloader">
  <div class="spinner-grow text-primary" role="status"></div>
</div>

<div class="internet-connection-status" id="internetStatus"></div>

<!-- HEADER -->
<div class="header-area shadow-sm" id="headerArea">
  <div class="container">

    <div class="header-content d-flex align-items-center justify-content-between py-3">

      <div class="back-button">
        <a href="view_artisan" class="text-white fs-4">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-white">Artisan's Detail</h6>
      </div>

      <div style="width:42px;"></div>

    </div>

  </div>
</div>

<?php include "includes/home_side_nav_left.php"; ?>

<div class="page-content-wrapper py-4">

  <div class="container">

    <div class="card main-card">
      <div class="card-body p-3 p-md-4">

<?php 
if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    // PDO FAST PREPARED QUERY (OPTIMIZED)
    $stmt = $pdo->prepare("SELECT * FROM artisan WHERE artisan_id = :id LIMIT 1");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {

        $id = escape($row['artisan_id']);
        $name = escape($row['name']);
        $gender = escape($row['gender']);
        $date_of_birth = escape($row['date_of_birth']);
        $email = escape($row['email']);
        $phone = escape($row['phone']);
        $state = escape($row['state']);
        $lga = escape($row['lga']);
        $address = escape($row['address']);
        $skills = escape($row['skills']);
        $certificate = escape($row['certificate']);
        $years = escape($row['years']);
        $added_on = escape($row['added_on']);
?>

        <!-- PROFILE TOP -->
        <div class="profile-top">

          <img src="img/electrisol-img/worker1.png" class="profile-image" alt="<?php echo $name; ?>">

          <h3 class="profile-name"><?php echo $name; ?></h3>

          <div class="profile-role">
            Skilled Artisan Professional
          </div>

          <div class="verified-badge">
            <i class="fa fa-check-circle"></i>
            Verified Artisan
          </div>

        </div>

        <!-- PERSONAL DETAILS -->
        <div class="card info-card">
          <div class="card-body">

            <div class="section-title">
              <i class="fa fa-user"></i>
              Personal Information
            </div>

            <div class="info-list">

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-user"></i>
                </div>

                <div>
                  <div class="info-label">Full Name</div>
                  <div class="info-value"><?php echo $name; ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-envelope"></i>
                </div>

                <div>
                  <div class="info-label">Email Address</div>
                  <div class="info-value"><?php echo $email; ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-phone"></i>
                </div>

                <div>
                  <div class="info-label">Phone Number</div>
                  <div class="info-value"><?php echo $phone; ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-map-marker"></i>
                </div>

                <div>
                  <div class="info-label">Location</div>
                  <div class="info-value">
                    <?php echo $lga . ", " . $state; ?>
                  </div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-home"></i>
                </div>

                <div>
                  <div class="info-label">Address</div>
                  <div class="info-value"><?php echo $address; ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-calendar"></i>
                </div>

                <div>
                  <div class="info-label">Date of Birth</div>
                  <div class="info-value"><?php echo $date_of_birth; ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon">
                  <i class="fa fa-venus-mars"></i>
                </div>

                <div>
                  <div class="info-label">Gender</div>
                  <div class="info-value"><?php echo $gender; ?></div>
                </div>
              </div>

            </div>

          </div>
        </div>

        <!-- SKILLS -->
        <div class="card info-card">
          <div class="card-body">

            <div class="section-title">
              <i class="fa fa-wrench"></i>
              Skills & Expertise
            </div>

            <div class="tag-wrapper">

              <?php 
              if (!empty($skills)) {

                  foreach (explode(',', rtrim($skills, ',')) as $td) {

                      $td = trim($td);

                      if (!empty($td)) {
              ?>

                <div class="skill-tag">
                  <i class="fa fa-check-circle"></i>
                  <?php echo $td; ?>
                </div>

              <?php 
                      }
                  }

              } else {
                  echo "<p class='text-muted mb-0'>No skills added.</p>";
              }
              ?>

            </div>

          </div>
        </div>

        <!-- CERTIFICATIONS -->
        <div class="card info-card">
          <div class="card-body">

            <div class="section-title">
              <i class="fa fa-certificate"></i>
              Certifications
            </div>

            <div class="tag-wrapper">

              <?php 
              if (!empty($certificate)) {

                  foreach (explode(',', rtrim($certificate, ',')) as $td) {

                      $td = trim($td);

                      if (!empty($td)) {
              ?>

                <div class="skill-tag">
                  <i class="fa fa-award"></i>
                  <?php echo $td; ?>
                </div>

              <?php 
                      }
                  }

              } else {
                  echo "<p class='text-muted mb-0'>No certifications added.</p>";
              }
              ?>

            </div>

          </div>
        </div>

        <!-- EXPERIENCE -->
        <div class="experience-box mt-4">

          <h2><?php echo $years; ?>+</h2>

          <p>Years of Professional Experience</p>

        </div>

<?php 
    } else {
?>

        <div class="empty-state">
          <i class="fa fa-user-times"></i>
          <h5>Artisan Not Found</h5>
          <p>The artisan record you are looking for does not exist.</p>
        </div>

<?php
    }
} else {
?>

        <div class="empty-state">
          <i class="fa fa-exclamation-circle"></i>
          <h5>Invalid Request</h5>
          <p>No artisan ID was provided.</p>
        </div>

<?php
}
?>

      </div>
    </div>

  </div>

</div>

<?php include "includes/home_footer_nav.php"; ?>

</body>
</html>