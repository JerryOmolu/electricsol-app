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
    
<!--RATING SECTION-->
<link rel="stylesheet" href="css/star.css">

       
 
  <!-- Style CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Web App Manifest -->
  <link rel="manifest" href="manifest.json">
  
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Dark mode switching -->
  <div class="dark-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="dark-mode-text text-center">
        <i class="bi bi-moon"></i>
        <p class="mb-0">Switching to dark mode</p>
      </div>
      <div class="light-mode-text text-center">
        <i class="bi bi-brightness-high"></i>
        <p class="mb-0">Switching to light mode</p>
      </div>
    </div>
  </div>


  <!-- # Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

  <!-- Header Area -->
  <div class="header-area py-2 shadow-sm bg-white" id="headerArea">
  <div class="container">
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="home.php" class="d-flex align-items-center justify-content-center text-dark p-2 rounded-circle shadow-sm hover-scale">
          <i class="bi bi-arrow-left-short fs-4"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-semibold d-flex align-items-center justify-content-center">
          <img src="img/electrisol-img/star.png" width="30" class="me-2"> Service Review
        </h6>
      </div>

      <!-- Placeholder for Navbar Toggler -->
      <div class="navbar--toggler d-none d-md-block">
        <span class="d-block"></span>
        <span class="d-block"></span>
        <span class="d-block"></span>
      </div>
    </div>
  </div>
</div>

<style>
/* Hover scale effect for back button */
.hover-scale:hover {
    transform: scale(1.1);
    transition: all 0.2s ease-in-out;
}

/* Subtle shadow effect for header */
#headerArea {
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .page-heading h6 {
        font-size: 1rem;
    }
}
</style>


  <div class="page-content-wrapper py-4">
  <div class="container">
    <div class="card shadow-sm rounded-3 border-0">
      <div class="card-body">

        <!-- Review Form -->
        <form action="" method="post">
          <h5 class="mb-3 text-center">Leave Your Review</h5>

          <!-- Name Input -->
          <div class="form-group mb-3">
            <label class="form-label fw-semibold" for="author"><b>Your Name:</b></label>
            <input class="form-control form-control-clicked rounded-2 shadow-sm" id="author" type="text" placeholder="Enter your name" name="author" required>
          </div>

          <!-- Review Content -->
          <div class="form-group mb-3">
            <label class="form-label fw-semibold" for="content"><b>Your Review:</b></label>
            <textarea name="content" class="form-control rounded-2 shadow-sm" id="content" rows="4" placeholder="Write your review here..." required></textarea>
          </div>

          <!-- Star Rating -->
          <div class="form-group mb-3">
            <label class="form-label fw-semibold"><b>Star Rating:</b></label>
            <div class="stars mb-2">
              <span class="star" data-value="1">★</span>
              <span class="star" data-value="2">★</span>
              <span class="star" data-value="3">★</span>
              <span class="star" data-value="4">★</span>
              <span class="star" data-value="5">★</span>
            </div>
            <input type="hidden" name="rating" id="rating" required> <!-- Hidden field for rating value -->
          </div>

          <!-- Submit Button -->
          <div class="form-group text-center">
            <button class="btn btn-dark btn-lg w-100 rounded-2 shadow-sm hover-scale" type="submit" name="review">
              Submit Review
            </button>
          </div>
        </form>
	
		  <?php
if (isset($_POST['review'])) {
    if (!$connection) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    $review_author = mysqli_real_escape_string($connection, $_POST['author']);
    $review_content = mysqli_real_escape_string($connection, $_POST['content']);
    $review_rating = (int)$_POST['rating']; // Get the rating value

    if (!empty($review_author) && !empty($review_content) && $review_rating >= 1 && $review_rating <= 5) {
        $query = "INSERT INTO review (review_author, review_content, review_rating, review_date, review_status) 
                  VALUES (?, ?, ?, NOW(), 'Unapproved')";
        
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssi', $review_author, $review_content, $review_rating);

        $create_review = mysqli_stmt_execute($stmt);

        if ($create_review) {
            $_SESSION['head'] = "Thank You!";
            $_SESSION['status'] = "Your review has been submitted successfully";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['head'] = "Error!";
            $_SESSION['status'] = "Something went wrong. Please try again.";
            $_SESSION['status_code'] = "error";
            header('Location: review');
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger'><strong>Fields cannot be empty and rating must be between 1 and 5.</strong></div>";
    }
}
?>
		  

      </div>
    </div>
  </div>
</div>

<style>
/* Card hover effect */
.card:hover {
    transform: translateY(-3px);
    transition: all 0.3s ease-in-out;
}

/* Input focus effect */
.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 5px rgba(255,193,7,0.3);
    transition: all 0.2s ease-in-out;
}

/* Star rating */
.stars {
    font-size: 1.5rem;
    color: #ddd;
    cursor: pointer;
}
.stars .star:hover,
.stars .star.hovered,
.stars .star.selected {
    color: #ffc107;
    transition: color 0.2s;
}

/* Submit button hover */
.hover-scale:hover {
    transform: scale(1.05);
    transition: all 0.2s ease-in-out;
}
</style>

<script>
// Star rating functionality
const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('rating');

stars.forEach((star, idx) => {
  star.addEventListener('mouseover', () => {
    stars.forEach((s, i) => s.classList.toggle('hovered', i <= idx));
  });
  star.addEventListener('mouseout', () => {
    stars.forEach(s => s.classList.remove('hovered'));
  });
  star.addEventListener('click', () => {
    ratingInput.value = star.dataset.value;
    stars.forEach((s, i) => s.classList.toggle('selected', i < star.dataset.value));
  });
});
</script>

 
<!--Rating JS-->
<script src="js/star.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>


<!--Sweet Alert  -->
<script src="js/sweetalert.js"></script>
<?php 
if(isset($_SESSION['status']) && $_SESSION['status'] != '')
{
	?>
	<script>
		swal({
			title: "<?php echo $_SESSION['head']; ?>",
			icon: "<?php echo $_SESSION['status_code']; ?>",
			text: "<?php echo $_SESSION['status']; ?>",
			button: "OK",
		}).then(function() {
			window.location = "review";
			});
	</script>
	<?php
		unset($_SESSION['status']);
}
?>

 <?php include "includes/home_footer_nav.php"; ?> 