<?php include "includes/home_header.php"; ?>

<!-- Preloader -->
<div id="preloader">
  <div class="spinner-grow text-warning" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Dark Mode Switching -->
<div class="dark-mode-switching">
  <div class="d-flex w-100 h-100 align-items-center justify-content-center">
    <div class="dark-mode-text text-center">
      <i class="bi bi-moon fs-3"></i>
      <p class="mb-0 small">Switching to dark mode</p>
    </div>
    <div class="light-mode-text text-center">
      <i class="bi bi-brightness-high fs-3"></i>
      <p class="mb-0 small">Switching to light mode</p>
    </div>
  </div>
</div>

<!-- # Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- Header Area -->
<div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="home" class="text-dark fs-4">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center">
        <h6 class="mb-0 fw-bold text-dark">
          <img src="img/electrisol-img/about-1.png" width="26px" class="me-1"> About
        </h6>
      </div>

      <!-- Navbar Toggler -->
      <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
        aria-controls="affanOffcanvas">
        <span class="toggler-bar"></span>
        <span class="toggler-bar"></span>
        <span class="toggler-bar"></span>
      </div>
    </div>
  </div>
</div>

<!-- Page Content -->
<div class="page-content-wrapper py-4">
  <div class="container">
    <div class="card image-gallery-card border-0 shadow-sm">
      <div class="card-body">
        
        <!-- Hero Image -->
        <img class="mb-3 rounded w-100" src="img/electrisol-img/grid.jpg" alt="Empowering Africa">

        <!-- Section 1 -->
        <h4 class="fw-bold text-dark">Empowering the Future of Energy in Africa</h4>
        <p class="text-muted">
          We’re on a mission to power Africa’s future by delivering innovative and reliable electricity access across the continent. Through our customized clean energy solutions, we’re electrifying homes, businesses, and communities while building a sustainable tomorrow.
        </p>

        <!-- Divider -->
        <div class="divider divider-center-icon border-dark my-4">
          <i class="bi bi-journal-text"></i>
        </div>

        <!-- Section 2 -->
        <h5 class="fw-bold text-dark">Who We Are</h5>
        <p class="text-muted">
          Electricsol is an award-winning energy infrastructure and project development company specializing in renewable, gas-fired and smart grid power solutions. With expertise across the energy sector, we tackle Africa’s unique electricity access challenges with creativity and purpose.
        </p>

        <!-- Section 3 -->
        <h5 class="fw-bold text-dark">What Drives Us</h5>
        <p class="text-muted">
          Our team wakes up energized by our goal of sustainably meeting Africa’s growing power demands. By embracing the latest technologies and environmentally responsible practices, we’re determined to empower growth and prosperity from Cape to Cairo!
        </p>

        <!-- CTA -->
        <a href="contact" class="btn btn-warning mt-3 w-100 rounded-pill shadow-sm">
          <i class="bi bi-envelope me-1"></i> Contact Us
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Footer Nav -->
<?php include "includes/home_footer_nav.php"; ?>

<!-- Extra CSS -->
<style>
  /* Preloader */
  #preloader {
    background: #fff;
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
  }

  /* Toggler bars */
  .navbar--toggler {
    cursor: pointer;
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
  .navbar--toggler .toggler-bar {
    width: 24px;
    height: 3px;
    background: #333;
    border-radius: 2px;
    transition: all 0.3s;
  }
  .navbar--toggler:hover .toggler-bar {
    background: #EC8305;
    transform: scaleX(1.1);
  }
</style>
