<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start text-bg-dark" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
  aria-labelledby="affanOffcanvsLabel">

  <!-- Close Button -->
  <button class="btn-close btn-close-white position-absolute top-0 end-0 m-3" type="button" data-bs-dismiss="offcanvas"
    aria-label="Close"></button>

  <div class="offcanvas-body p-0">
    <div class="sidenav-wrapper d-flex flex-column h-100">

      <!-- Sidenav Profile -->
      <div class="sidenav-profile text-center py-4 bg-gradient">
        <div class="user-profile mb-2">
          <img src="img/electrisol-img/user.png" alt="User" class="rounded-circle border border-3 border-warning"
            width="80" height="80">
        </div>
        <div class="user-info text-white">
          <h6 class="user-name mb-0 fw-bold"><?php echo $_SESSION['fullname']; ?></h6>
          <span class="d-block small"><?php echo $_SESSION['phone']; ?></span>
          <p class="small mb-0"><?php echo $_SESSION['email']; ?></p>
        </div>
      </div>

      <!-- Sidenav Nav -->
      <ul class="sidenav-nav list-unstyled my-3 px-3 flex-grow-1">
        <li><a href="home" class="nav-link text-white d-flex align-items-center"><i class="bi bi-house-door me-2"></i> Home</a></li>
        <li><a href="about" class="nav-link text-white d-flex align-items-center"><i class="bi bi-card-text me-2"></i> About</a></li>
        <li><a href="notification" class="nav-link text-white d-flex align-items-center position-relative">
          <i class="bi bi-bell me-2"></i> Notifications
          <span class="badge bg-danger rounded-pill ms-auto">3</span>
        </a></li>
        <li><a href="review" class="nav-link text-white d-flex align-items-center"><i class="bi bi-star-half me-2"></i> Service Review</a></li>
        <li><a href="faq" class="nav-link text-white d-flex align-items-center"><i class="bi bi-question-octagon me-2"></i> FAQs</a></li>
        <li><a href="contact" class="nav-link text-white d-flex align-items-center"><i class="bi bi-person-lines-fill me-2"></i> Contact</a></li>
        <li><a href="settings" class="nav-link text-white d-flex align-items-center"><i class="bi bi-gear me-2"></i> Settings</a></li>

        <!-- Night Mode -->
        <li class="d-flex justify-content-between align-items-center text-white mt-2 px-2">
          <span><i class="bi bi-moon me-2"></i> Night Mode</span>
          <div class="form-check form-switch mb-0">
            <input class="form-check-input" id="darkSwitch" type="checkbox">
          </div>
        </li>

        <li class="mt-3">
          <a href="logout" class="nav-link text-danger fw-bold d-flex align-items-center">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
          </a>
        </li>
      </ul>

      <!-- Social Info -->
      <div class="social-info-wrap d-flex justify-content-center gap-3 mb-3">
        <a href="https://www.facebook.com/electricsolafrica" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
        <a href="https://x.com/ElectricsolAf" class="text-white fs-5"><i class="bi bi-twitter"></i></a>
        <a href="https://www.linkedin.com/company/eletricsolafrica/" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
      </div>

      <!-- Copyright -->
      <div class="copyright-info text-center p-3 border-top small text-white-50">
        <img src="img/electrisol-img/Logo%206.png" width="120" class="mb-2"><br>
        <h6 class="fw-bold text-white">Version 1.2.0</h6>
        <p class="mb-0">&copy; <span id="copyrightYear"></span> Electricsol Limited <br>All rights reserved</p>
      </div>

    </div>
  </div>
</div>

<!-- Custom Styles -->
<style>
  .bg-gradient {
    background: linear-gradient(135deg, #212529, #343a40);
  }

  .sidenav-nav .nav-link {
    padding: 0.75rem 1rem;
    border-radius: 10px;
    transition: all 0.3s ease;
  }

  .sidenav-nav .nav-link:hover,
  .sidenav-nav .nav-link.active {
    background-color: rgba(255, 193, 7, 0.15);
    color: #ffc107 !important;
  }

  .social-info-wrap a:hover {
    color: #ffc107 !important;
    transform: scale(1.2);
    transition: all 0.3s ease;
  }
</style>
