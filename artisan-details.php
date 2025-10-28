<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>

<?php 
if(!isset($_SESSION['verify_status'])){
    if($_SESSION['verify_status'] !== '1'){
       header("Location:login.php"); 
    }
        
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Affan - PWA Mobile HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta name="theme-color" content="#0134d4">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <!-- Title -->
  <title>Electricsol-Mobile App</title>

  <!-- Favicon -->
    <link rel="icon" href="favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
<!--Font Awesome-->
    <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">
    
<!--RATING SECTION-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Web App Manifest -->
  <link rel="manifest" href="manifest.json">
    
<!--Summernote-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    
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
  <!-- Header Area -->
<div class="header-area shadow-sm" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content d-flex align-items-center justify-content-between py-2">
      <!-- Back Button -->
      <div class="back-button">
        <a href="view_artisan" class="text-white fs-4">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-white">Artisan's Detail</h6>
      </div>

      <!-- Navbar Toggler Placeholder -->
      <div></div>
    </div>
  </div>
</div>

<!-- # Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- Page Content -->
<div class="page-content-wrapper py-3">
  <div class="container">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body">
        <h5 class="card-title text-primary fw-bold text-center">Artisan's Detail</h5>
        <hr class="mb-4">

        <div class="row justify-content-center">
          <div class="col-md-10">
            <?php 
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM artisan WHERE artisan_id = $id";
                $view_artisan = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($view_artisan)) {
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
            <!-- Profile Card -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
              <div class="card-body">
                <h6 class="fw-bold text-secondary mb-3">Personal Details of <?php echo $name; ?></h6>
                <ul class="list-group list-group-flush mb-3">
                  <li class="list-group-item"><strong>Name:</strong> <?php echo $name; ?></li>
                  <li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
                  <li class="list-group-item"><strong>Phone:</strong> <?php echo $phone; ?></li>
                  <li class="list-group-item"><strong>State:</strong> <?php echo $state; ?></li>
                  <li class="list-group-item"><strong>LGA:</strong> <?php echo $lga; ?></li>
                  <li class="list-group-item"><strong>Address:</strong> <?php echo $address; ?></li>
                  <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo $date_of_birth; ?></li>
                </ul>

                <!-- Skills -->
                <h6 class="fw-bold text-secondary mt-4">Skills</h6>
                <?php 
                if (!empty($skills)) {
                    echo "<table class='table table-sm table-bordered table-hover'>";
                    foreach (explode(',', rtrim($skills, ',')) as $td) {
                        echo "<tr><td><i class='fa fa-check-square-o text-success me-2'></i>$td</td></tr>";
                    }
                    echo "</table>";
                }
                ?>

                <!-- Certifications -->
                <h6 class="fw-bold text-secondary mt-4">Certifications</h6>
                <?php 
                if (!empty($certificate)) {
                    echo "<table class='table table-sm table-bordered table-hover'>";
                    foreach (explode(',', rtrim($certificate, ',')) as $td) {
                        echo "<tr><td><i class='fa fa-check-square-o text-success me-2'></i>$td</td></tr>";
                    }
                    echo "</table>";
                }
                ?>

                <!-- Experience -->
                <h6 class="fw-bold text-secondary mt-4">Years of Experience</h6>
                <p class="mb-0"><?php echo $years; ?> years</p>
              </div>
            </div>
            <?php } } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Extra CSS -->
<style>
  .header-area {
    background: #0134d4;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
  }
  .card {
    transition: transform 0.2s ease-in-out;
  }
  .card:hover {
    transform: translateY(-3px);
  }
  .list-group-item {
    border: none;
    padding: 10px 15px;
  }
</style>


  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>
