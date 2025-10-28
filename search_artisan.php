<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>

<?php 
if(!isset($_SESSION['verify_status'])){
    if($_SESSION['verify_status'] !== '1'){
       header("Location:login"); 
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
  <div class="header-area shadow-sm" id="headerArea">
  <div class="container">
    <!-- Header Content -->
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

      <!-- Placeholder for future buttons/icons -->
      <div class="d-flex align-items-center">
        <!-- You can add notification or menu icons here -->
      </div>

    </div>
  </div>
</div>

<style>
/* Header subtle shadow */
.header-area {
  background-color: #fff;
  border-bottom: 1px solid #e5e5e5;
  transition: box-shadow 0.3s ease-in-out;
}

.header-area:hover {
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

/* Page title text */
.page-heading h6 {
  font-size: 1rem;
  letter-spacing: 0.5px;
}

/* Back button hover effect */
.back-button a:hover {
  color: #0d6efd;
  text-decoration: none;
  transform: translateX(-2px);
  transition: 0.2s ease-in-out;
}
</style>


  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>
 

  <div class="page-content-wrapper py-3">
  <!-- Search Artisan -->
  <div class="shop-pagination pb-3">
    <div class="container">
      <div class="card shadow-sm">
        <div class="card-body">
          <form class="mb-3 pb-2" action="search_artisan.php" method="post">
            <div class="input-group">
              <input class="form-control form-control-clicked" type="search" placeholder="Search Artisan by Location e.g. Asokoro" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ?>" required>
              <button class="btn btn-dark" type="submit" name="submit">
                <i class="bi bi-search fz-14"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Artisan List -->
  <div class="top-products-area">
    <div class="container">
      <div class="row g-3">

        <?php     
        if(isset($_POST['submit'])){
          $search = $_POST['search'];
          $query = "SELECT * FROM artisan WHERE address LIKE '%$search%' OR skills LIKE '%$search%' ";
          $search_query= mysqli_query($connection, $query);

          if(!$search_query){
              die('QUERY FAILED'. mysqli_error($connection));
          }

          $count = mysqli_num_rows($search_query);
          if($count == 0){
            echo "<div class='alert custom-alert-three alert-danger alert-dismissible fade show' role='alert'>
                    <div class='alert-text'>
                      <h6>Oops! No Search Result(s) Found for '<strong>$search</strong>'.</h6>
                    </div>
                    <button class='btn btn-close position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
          } else {              
            while($row = mysqli_fetch_array($search_query)){
              $artisan_id = escape($row['artisan_id']);
              $name = escape($row['name']);
              $phone = escape($row['phone']);
        ?>

        <!-- Single Artisan Card -->
        <div class="col-6 col-sm-4 col-lg-3">
          <div class="card single-product-card shadow-sm h-100">
            <div class="card-body p-3 d-flex flex-column align-items-center text-center">
              
              <!-- Artisan Thumbnail -->
              <a class="product-thumbnail d-block mb-2 position-relative w-100" href="artisan-details?id=<?php echo $artisan_id ?>">
                <img src="img/electrisol-img/worker1.png" alt="Artisan" class="img-fluid rounded" style="height:180px; object-fit:cover;">
                <!-- Badge -->
                <span class="badge bg-success position-absolute top-0 start-0 m-2">Verified</span>
              </a>

              <!-- Artisan Name -->
              <a class="product-title d-block text-truncate fw-bold mb-1" href="artisan-details?id=<?php echo $artisan_id ?>">
                <?php echo $name ?>
              </a>

              <!-- Artisan Phone -->
              <p class="text-muted mb-2"><?php echo $phone ?></p>

              <!-- View Detail Button -->
              <a href="artisan-details?id=<?php echo $artisan_id ?>" class="btn btn-primary btn-sm mt-auto w-100">View Detail</a>

            </div>
          </div>
        </div>

        <?php } } } ?>

      </div>
    </div>
  </div>

  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>
</div>

<style>
/* Card hover effect */
.single-product-card {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.single-product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* Search input */
.form-control-clicked {
  border-radius: 0.5rem;
  transition: box-shadow 0.2s ease;
}
.form-control-clicked:focus {
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
  border-color: #0d6efd;
}

/* Badge styling */
.badge {
  font-size: 0.7rem;
  padding: 0.35em 0.55em;
}
</style>

