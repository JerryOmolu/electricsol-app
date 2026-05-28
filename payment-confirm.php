<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>

<!-- Preloader -->
<div id="preloader">
  <div class="spinner-grow text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<!-- Internet Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- HEADER -->
<div class="header-area modern-header" id="headerArea">
  <div class="container">
    <div class="header-content d-flex align-items-center justify-content-between py-2">

      <div class="back-button">
        <a href="shop" class="btn-back">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <div class="page-heading text-center flex-grow-1 px-2">
        <h6 class="mb-0 d-flex align-items-center justify-content-center gap-2 fw-bold">
          <img src="img/electrisol-img/confirm.png" width="26" alt="">
          Payment Confirmed
        </h6>
      </div>

      <div class="navbar--toggler" id="affanNavbarToggler"
        data-bs-toggle="offcanvas"
        data-bs-target="#affanOffcanvas">
        <span></span>
        <span></span>
        <span></span>
      </div>

    </div>
  </div>
</div>

<!-- SIDE NAV -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- SUCCESS SECTION -->
<div class="success-wrapper py-5">
  <div class="container d-flex justify-content-center">

    <div class="success-card text-center">

      <!-- ICON -->
      <div class="icon-wrapper mb-3">
        <i class="bi bi-check-circle-fill"></i>
      </div>

      <!-- TITLE -->
      <h4 class="fw-bold mb-2">Payment Successful 🎉</h4>
      <p class="text-muted mb-4">
        Your order has been processed successfully and confirmed.
      </p>

      <!-- REF -->
      <div class="ref-box mb-4">
        <small class="text-muted d-block mb-1">Reference ID</small>

        <span class="ref-id"
              onmouseover="this.style.transform='scale(1.05)'"
              onmouseout="this.style.transform='scale(1)'">

          <?php if(isset($_GET['ref'])){ $ref = $_GET['ref']; echo $ref; } ?>

        </span>

        <small class="text-muted d-block mt-2">
          Save this ID for tracking your order
        </small>
      </div>

      <!-- BUTTON -->
      <a href="shop" class="btn btn-modern w-100">
        <i class="bi bi-shop me-2"></i>
        Continue Shopping
      </a>

    </div>

  </div>
</div>

<!-- OPTIONAL ANIMATE.CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>

/* HEADER */
.modern-header{
  background: linear-gradient(135deg, #ffffff, #f4f7ff);
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

.btn-back{
  width: 42px;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: #f8f9fa;
  color: #333;
  transition: 0.3s;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.btn-back:hover{
  transform: translateX(-3px);
  box-shadow: 0 6px 15px rgba(0,0,0,0.12);
  color: #0d6efd;
}

/* BACKGROUND */
.success-wrapper{
  background: radial-gradient(circle at top, #eef3ff, #ffffff);
  min-height: 70vh;
  display: flex;
  align-items: center;
}

/* CARD */
.success-card{
  max-width: 460px;
  width: 100%;
  background: rgba(255,255,255,0.9);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 30px 25px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.08);
  transition: 0.3s;
}

.success-card:hover{
  transform: translateY(-5px);
  box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

/* ICON */
.icon-wrapper i{
  font-size: 4.5rem;
  color: #28a745;
  animation: pop 1s ease;
}

@keyframes pop{
  0%{transform: scale(0.5); opacity: 0;}
  100%{transform: scale(1); opacity: 1;}
}

/* REF BOX */
.ref-box{
  background: #f8f9ff;
  border: 1px dashed #d0d7ff;
  padding: 15px;
  border-radius: 12px;
}

.ref-id{
  display: inline-block;
  padding: 8px 15px;
  background: #ffffff;
  border-radius: 10px;
  font-weight: 600;
  color: #333;
  box-shadow: 0 3px 10px rgba(0,0,0,0.08);
  transition: 0.3s;
  cursor: pointer;
}

/* BUTTON */
.btn-modern{
  background: linear-gradient(135deg, #28a745, #0d6efd);
  color: #fff;
  border: none;
  padding: 12px;
  border-radius: 12px;
  font-weight: 600;
  transition: 0.3s;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.btn-modern:hover{
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.15);
  color: #fff;
}

/* RESPONSIVE */
@media (max-width: 576px){
  .success-card{
    padding: 22px 18px;
  }

  .icon-wrapper i{
    font-size: 3.8rem;
  }

  .page-heading h6{
    font-size: 0.9rem;
  }
}

</style>

<?php include "includes/home_footer_nav.php"; ?>