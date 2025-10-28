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
  <!-- Header Area -->
<div class="header-area sticky-top shadow-sm bg-white" id="headerArea" style="z-index: 1050;">
  <div class="container">
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="home" class="text-dark">
          <i class="bi bi-arrow-left-short fs-3"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold">Artisan Planet</h6>
      </div>

      <!-- Placeholder for future buttons -->
      <div class="header-actions">
        <!-- Add search or menu button here if needed -->
      </div>
    </div>
  </div>
</div>

<style>
  /* Smooth shadow and sticky effect */
  #headerArea {
    transition: all 0.3s ease;
  }

  #headerArea.scrolled {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    background-color: #fff;
  }
</style>

<script>
  // Optional: Add shadow when user scrolls
  window.addEventListener('scroll', () => {
    const header = document.getElementById('headerArea');
    if(window.scrollY > 10){
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
</script>


  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>
 

  <div class="page-content-wrapper py-3">

  <!-- Search Form -->
  <div class="shop-pagination pb-3">
    <div class="container">
      <div class="card shadow-sm">
        <div class="card-body">
          <form class="mb-3 pb-4 border-bottom" action="search_artisan.php" method="post">
            <div class="input-group">
              <input class="form-control form-control-clicked" type="search" 
                     placeholder="Search Artisan by Location or Skills e.g. Asokoro or Wiring" 
                     name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ?>" required>
              <button class="btn btn-dark" type="submit" name="submit">
                <i class="bi bi-search fz-14"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Artisan Cards -->
  <div class="top-products-area">
    <div class="container">
      <div class="row g-3">
        <?php 
          $perpage = 20;
          $page = isset($_GET['page']) ? escape($_GET['page']) : 1;
          $page_1 = ($page <= 1) ? 0 : ($page * $perpage) - $perpage;

          $query1 = "SELECT * FROM artisan ORDER BY added_on DESC";
          $view_artisan1 = mysqli_query($connection, $query1);
          $total = ceil(mysqli_num_rows($view_artisan1)/$perpage);
          $Previous = $page - 1;
          $Next = $page + 1;

          $query = "SELECT * FROM artisan ORDER BY added_on DESC LIMIT $page_1, $perpage";
          $select_artisan_query = mysqli_query($connection, $query);
          if(!$select_artisan_query){ die('QUERY FAILED'. mysqli_error($connection)); }

          while($row = mysqli_fetch_array($select_artisan_query)):
            $artisan_id = escape($row['artisan_id']);
            $name = escape($row['name']);
            $phone = escape($row['phone']);
        ?>
        <div class="col-6 col-sm-4 col-lg-3">
          <div class="card artisan-card shadow-sm h-100">
            <div class="card-body text-center p-3">
              <a href="artisan-details.php?id=<?php echo $artisan_id ?>" class="d-block mb-2 position-relative">
                <img src="img/electrisol-img/worker1.png" alt="<?php echo $name ?>" class="img-fluid rounded-circle mb-2" style="height:120px; width:120px;">
                <span class="badge bg-success position-absolute top-0 start-100 translate-middle">Verified</span>
              </a>
              <a href="artisan-details.php?id=<?php echo $artisan_id ?>" class="d-block text-truncate fw-bold text-dark"><?php echo $name ?></a>
              <p class="text-muted mb-2"><?php echo $phone ?></p>
              <a href="artisan-details.php?id=<?php echo $artisan_id ?>" class="btn btn-primary btn-sm w-100">View Detail</a>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  <div class="shop-pagination pt-3">
    <div class="container">
      <div class="card shadow-sm">
        <div class="card-body py-3">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mb-0">
              <li class="page-item <?php echo ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="view_artisan?page=<?= $Previous; ?>" aria-label="Previous">
                  <i class="bi bi-chevron-left"></i>
                </a>
              </li>
              <?php for($i=1; $i<=$total; $i++): ?>
              <li class="page-item <?php echo ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="view_artisan?page=<?php echo $i ?>"><?php echo $i ?></a>
              </li>
              <?php endfor; ?>
              <li class="page-item <?php echo ($page >= $total) ? 'disabled' : '' ?>">
                <a class="page-link" href="view_artisan?page=<?= $Next; ?>" aria-label="Next">
                  <i class="bi bi-chevron-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

</div>

<style>
  .artisan-card {
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .artisan-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
  }
  .artisan-card .badge {
    font-size: 0.75rem;
  }
</style>


  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>
