<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>


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

<!-- Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- Header Area -->
<div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">

      <div class="back-button">
        <a href="home" class="text-dark fs-4 back-btn">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <div class="page-heading text-center">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center justify-content-center gap-2">
          <img src="img/electrisol-img/about-1.png" width="26px">
          About
        </h6>
      </div>

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

    <div class="card image-gallery-card border-0 shadow-lg about-card">

      <div class="card-body p-4">

        <!-- Hero Image -->
        <img class="mb-4 rounded-4 w-100 hero-img" src="img/electrisol-img/grid.jpg" alt="Empowering Africa">

        <!-- Section 1 -->
        <h4 class="fw-bold text-dark mb-2">Empowering the Future of Energy in Africa</h4>
        <p class="text-muted mb-4">
          We’re on a mission to power Africa’s future by delivering innovative and reliable electricity access across the continent. Through our customized clean energy solutions, we’re electrifying homes, businesses, and communities while building a sustainable tomorrow.
        </p>

        <!-- Divider -->
        <div class="divider my-4 text-center">
          <span><i class="bi bi-journal-text"></i></span>
        </div>

        <!-- Section 2 -->
        <h5 class="fw-bold text-dark mb-2">Who We Are</h5>
        <p class="text-muted mb-4">
          Electricsol is an award-winning energy infrastructure and project development company specializing in renewable, gas-fired and smart grid power solutions. With expertise across the energy sector, we tackle Africa’s unique electricity access challenges with creativity and purpose.
        </p>

        <!-- Section 3 -->
        <h5 class="fw-bold text-dark mb-2">What Drives Us</h5>
        <p class="text-muted mb-3">
          Our team wakes up energized by our goal of sustainably meeting Africa’s growing power demands. By embracing the latest technologies and environmentally responsible practices, we’re determined to empower growth and prosperity from Cape to Cairo!
        </p>

        <!-- CTA -->
        <a href="contact" class="btn btn-warning w-100 rounded-pill shadow-sm cta-btn">
          <i class="bi bi-envelope me-1"></i> Contact Us
        </a>

      </div>
    </div>

  </div>
</div>

<!-- Footer Nav -->
<?php include "includes/home_footer_nav.php"; ?>

<!-- EXTRA MODERN UI POLISH -->
<style>

/* Page background upgrade */
body{
  background: #f6f8fb;
  font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

/* Preloader */
#preloader {
  background: #ffffff;
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2000;
}

/* Header upgrade */
.header-area{
  border-bottom: 1px solid #eef0f3;
  backdrop-filter: blur(10px);
  background: rgba(255,255,255,0.92) !important;
}

/* Back button polish */
.back-btn{
  display: flex;
  align-items: center;
  justify-content: center;
  width: 38px;
  height: 38px;
  border-radius: 10px;
  background: #f3f4f6;
  transition: 0.25s;
}

.back-btn:hover{
  background: #e9ecf3;
  transform: translateX(-2px);
}

/* Card modern look */
.about-card{
  border-radius: 18px;
  overflow: hidden;
  transition: 0.3s ease;
}

.about-card:hover{
  transform: translateY(-3px);
}

/* Hero image polish */
.hero-img{
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  transition: 0.3s ease;
}

.hero-img:hover{
  transform: scale(1.01);
}

/* Divider upgrade */
.divider{
  position: relative;
  height: 20px;
}

.divider span{
  display: inline-block;
  background: #fff;
  padding: 0 12px;
  position: relative;
  z-index: 2;
  color: #f59e0b;
  font-size: 18px;
}

.divider::before{
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  height: 1px;
  background: #e5e7eb;
  z-index: 1;
}

/* Text improvements */
h4, h5{
  letter-spacing: -0.2px;
}

.text-muted{
  line-height: 1.7;
  font-size: 14.5px;
}

/* CTA upgrade */
.cta-btn{
  background: linear-gradient(135deg, #ffb703, #fb8500);
  border: none;
  font-weight: 600;
  padding: 12px;
  transition: 0.25s;
}

.cta-btn:hover{
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(251,133,0,0.25);
}

/* Navbar toggler polish */
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
  border-radius: 3px;
  transition: all 0.3s ease;
}

.navbar--toggler:hover .toggler-bar {
  background: #fb8500;
  transform: scaleX(1.1);
}

/* Mobile tuning */
@media (max-width: 768px){
  .about-card{
    border-radius: 14px;
  }

  h4{
    font-size: 18px;
  }
}

</style>