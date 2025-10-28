<?php include "includes/home_header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Header Area -->
  <div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content -->
        <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">
            
            <!-- Back Button -->
            <div class="back-button">
                <a href="shop" class="d-flex align-items-center justify-content-center rounded-circle p-2 bg-light shadow-sm" 
                   style="width: 40px; height: 40px; transition: transform 0.2s, box-shadow 0.2s;">
                    <i class="bi bi-arrow-left-short fs-4"></i>
                </a>
            </div>

            <!-- Page Title -->
            <div class="page-heading text-center flex-grow-1 px-3">
                <h6 class="mb-0 d-flex align-items-center justify-content-center gap-2">
                    <img src="img/electrisol-img/confirm.png" width="28" alt="Confirm Icon">
                    Payment & Order Confirmed
                </h6>
            </div>

            <!-- Navbar Toggler -->
            <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
                 aria-controls="affanOffcanvas">
                <span class="d-block bg-dark mb-1" style="width: 25px; height: 3px; border-radius: 2px;"></span>
                <span class="d-block bg-dark mb-1" style="width: 25px; height: 3px; border-radius: 2px;"></span>
                <span class="d-block bg-dark" style="width: 25px; height: 3px; border-radius: 2px;"></span>
            </div>

        </div>
    </div>
</div>

<style>
/* Back button hover effect */
.back-button a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Header responsive spacing */
@media (max-width: 576px) {
    .page-heading h6 {
        font-size: 0.9rem;
    }
    .back-button a {
        width: 36px;
        height: 36px;
    }
}
</style>


  <!-- # Sidenav Left -->
  <?php include "includes/home_side_nav_left.php"; ?>

  <!-- Order/Payment Success -->
  <div class="order-success-wrapper py-5">
  <div class="custom-container d-flex justify-content-center flex-column align-items-center">
    
    <!-- Confirmation Card -->
    <div class="order-done-content text-center p-4 bg-white rounded-4 shadow-lg position-relative mb-4" 
         style="max-width: 480px; width: 100%;">
      
      <!-- Animated Success Icon -->
      <i class="bi bi-check-circle-fill text-success mb-3 display-1 animate__animated animate__bounceIn"></i>

      <!-- Heading -->
      <h5 class="mb-3 fw-bold">Your Payment is Confirmed!</h5>

      <!-- Reference ID -->
      <p class="mb-4">
        Your Reference ID is 
        <strong class="badge bg-light text-dark shadow-sm px-3 py-2 fz-14" 
                style="transition: transform 0.2s, box-shadow 0.2s; cursor: pointer;"
                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.1)';">
          <?php if(isset($_GET['ref'])){ $ref = $_GET['ref']; echo $ref; } ?>
        </strong>
        Keep this ID for future reference. Thank you!
      </p>

      <!-- Action Button -->
      <a class="btn btn-success btn-lg w-100 fw-semibold" href="shop" 
         style="transition: transform 0.2s, box-shadow 0.2s;">
        <i class="bi bi-shop me-2"></i> Go to Market Place
      </a>
    </div>

    <!-- Invoice Section -->
    

  </div>
</div>


<!-- Optional: Animate.css for bounce effect -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
.order-done-content:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}

.fz-14 { font-size: 0.875rem; }

@media (max-width: 576px) {
    .order-done-content {
        padding: 2rem 1.5rem;
    }
    .display-1 {
        font-size: 4rem;
    }
}
</style>


  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>