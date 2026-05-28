<?php include "includes/header.php"; ?>
  <!-- Preloader -->

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>


<div class="header-demo-bg shadow-sm">
      <div class="container">

        <!-- # Header One Layout Start -->
        <!-- # Copy the code from here ... -->
        <div class="header-content position-relative d-flex align-items-center justify-content-between">
          <!-- Navbar Toggler -->
          <div class="navbar--toggler" id="affanNavbarToggler">

          </div>

          <!-- Logo Wrapper -->
          <div class="logo-wrapper">
            <a href="#">
              <img src="img/electrisol-img/Logo%206.png" alt="Electricsol" width="">
            </a>
          </div>

          <!-- Settings -->
          <div class="setting-wrapper">
            <div id="settingTriggerBtn2">
              <a href="home"><p><b>Skip</b></p></a>
              <span></span>
            </div>
          </div>
        </div>
        <!-- # Header One Layout End -->

      </div>
    </div>

<!--Hero Header-->
<div class="container my-5">
  <div class="welcome-card card text-white shadow-lg overflow-hidden">
    <div class="bg-img" style="background-image: url('img/electrisol-img/solar.jpg');"></div>
    <div class="overlay"></div>
    <div class="card-body p-5 position-relative text-center hero-block-content">
      <h2 class="fw-bold mb-3 animate-fade">Welcome to the ElectricSol App</h2>
      <p class="mb-4 fst-italic animate-fade-delay text-white">
        Innovating Energy for Africa... <br> The One-stop App for all your electrical needs
      </p>
      <a class="btn btn-warning btn-lg fw-bold shadow shine-button animate-fade-delay" href="login">
        Get Started <i class="bi bi-arrow-right"></i>
        <span class="shine"></span>
      </a>
    </div>
  </div>
</div>

<style>
.welcome-card {
  border-radius: 16px;
  position: relative;
  height: 380px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.welcome-card .bg-img {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  transition: transform 0.6s ease;
}

.welcome-card .overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom right, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
}

.welcome-card:hover .bg-img {
  transform: scale(1.1);
}

.welcome-card .card-body {
  position: relative;
  z-index: 2;
}

.welcome-card h2 {
  font-size: 2rem;
}

.welcome-card p {
  font-size: 1.2rem;
}

.welcome-card .btn {
  position: relative;
  overflow: hidden;
  border-radius: 50px;
  padding: 12px 28px;
  transition: all 0.3s ease;
}

.welcome-card .btn:hover {
  background-color: #ffc107;
  color: #000;
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(0,0,0,0.3);
}

/* Shine Effect */
.shine-button {
  position: relative;
  display: inline-block;
}

.shine-button .shine {
  position: absolute;
  top: 0;
  left: -75px;
  width: 50px;
  height: 100%;
  background: rgba(255, 255, 255, 0.5);
  transform: skewX(-20deg);
  animation: shineMove 3s infinite;
}

@keyframes shineMove {
  0% { left: -75px; }
  50% { left: 120%; }
  100% { left: 120%; }
}

/* Fade-in Animations */
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade {
  animation: fadeInUp 1s ease forwards;
}

.animate-fade-delay {
  opacity: 0;
  animation: fadeInUp 1.2s ease forwards;
  animation-delay: 0.5s;
}
</style>



<!--Energy Consumption-->
<?php include "includes/energy.php"; ?>
<br>

<!--Market Arena-->
<?php include "includes/market.php"; ?>
<br>

    <!--Artisan Registration-->
<?php include "includes/artisan.php"; ?>

<!--Contact Disco-->
<?php include "includes/disco.php"; ?>
<br>

<!--Customer Review-->
<?php include "includes/review.php"; ?>

<br>

 <?php include "includes/footer.php"; ?>