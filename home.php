<?php include "includes/home_header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>
<!--Header Area-->
<?php include "includes/header_area.php"; ?> 

  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>  

  <div class="page-content-wrapper">

    <!-- Tiny Slider One Wrapper -->
<?php include "includes/home_hero.php"; ?> 

    <div class="pt-3"></div>
<!--Quick Links-->
<?php include "includes/quick_link.php"; ?>
     
<!--Energy Calculator-->
<div class="container my-4">
  <!-- Energy Calculator Card -->
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-4">
      <div class="d-flex align-items-center justify-content-between flex-wrap">
        
        <!-- Text Section -->
        <div class="flex-grow-1 pe-3">
          <h5 class="fw-bold text-dark mb-2">
            Calculate the Energy Consumed by Appliances or Devices
          </h5>
          <p class="text-muted mb-3">
            Use our Energy Consumption Calculator to quickly estimate how much energy your home or office appliances use over time.
          </p>
          
          <!-- CTA Button -->
          <a class="btn btn-warning btn-lg fw-bold px-4 shadow-sm" href="energy">
            Start Calculating <i class="bi bi-arrow-right-circle ms-2"></i>
          </a>
        </div>

        <!-- Icon Section -->
<!--
        <div class="text-center mt-3 mt-md-0">
          <img src="img/electrisol-img/energy.png" alt="Energy Icon" class="img-fluid" width="80">
        </div>
-->
      </div>
    </div>
  </div>

  <!-- Step-by-Step Guide -->
  <div class="row text-center mt-4">
    <div class="col-4">
      <div class="step-box p-3">
        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px; height:50px;">
          <i class="bi bi-laptop fs-4"></i>
        </div>
        <p class="fw-semibold mb-1">Step 1</p>
        <small class="text-muted">Choose Device</small>
      </div>
    </div>

    <div class="col-4">
      <div class="step-box p-3">
        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px; height:50px;">
          <i class="bi bi-clock fs-4"></i>
        </div>
        <p class="fw-semibold mb-1">Step 2</p>
        <small class="text-muted">Input Usage Hours</small>
      </div>
    </div>

    <div class="col-4">
      <div class="step-box p-3">
        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px; height:50px;">
          <i class="bi bi-lightning-charge fs-4"></i>
        </div>
        <p class="fw-semibold mb-1">Step 3</p>
        <small class="text-muted">Get Consumption</small>
      </div>
    </div>
  </div>
</div>

<!-- CSS for Hover Effect -->
<style>
  .step-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
  }

  .step-box:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    background-color: #f9f9f9;
  }
</style>



       <div class="pb-3"></div>
<!--Contact Disco-->
      <?php include "includes/artisan.php"; ?>
      <br>
      
<!--Contact Disco-->
<?php include "includes/disco.php"; ?><br>
    
<!--Shop-->
 <div class="pb-3"></div>
    <div class="container my-5">
  <div class="promo-card card text-white shadow-lg overflow-hidden">
    <div class="bg-img" style="background-image: url('img/electrisol-img/power.jpg');"></div>
    <div class="overlay"></div>
    <div class="card-body p-5 position-relative text-center">
      <h2 class="fw-bold mb-3">Over 2000 Energy Saving Electrical Products</h2>
      <p class="mb-4 text-white">Shop high-quality electrical products with our user-friendly mobile app.</p>
      <a class="btn btn-warning btn-lg fw-bold shadow" href="shop">
        Shop Now <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</div>

<style>
.promo-card {
  border-radius: 16px;
  position: relative;
  height: 320px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.promo-card .bg-img {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  transition: transform 0.5s ease;
}

.promo-card .overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom right, rgba(0,0,0,0.5), rgba(0,0,0,0.3));
}

.promo-card:hover .bg-img {
  transform: scale(1.1);
}

.promo-card .card-body {
  position: relative;
  z-index: 2;
}

.promo-card h2 {
  font-size: 1.8rem;
}

.promo-card p {
  font-size: 1.1rem;
}

.promo-card .btn {
  transition: all 0.3s ease;
  border-radius: 50px;
  padding: 12px 24px;
}

.promo-card .btn:hover {
  background-color: #ffc107;
  color: #000;
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(0,0,0,0.3);
}
</style>

      


    <!--Customer Review-->
<?php include "includes/review.php"; ?>

    <div class="pb-3"></div>
  </div>


<?php include "includes/home_footer_nav.php"; ?>
 