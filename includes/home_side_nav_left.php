<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start modern-sidebar text-bg-dark"
  id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
  aria-labelledby="affanOffcanvsLabel">

  <!-- Close Button -->
  <button class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
    type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>

  <div class="offcanvas-body p-0">
    <div class="sidenav-wrapper d-flex flex-column h-100">

      <!-- Profile -->
      <div class="sidenav-profile text-center py-4 profile-glass">

        <div class="user-profile mb-2 position-relative">
          <img src="img/electrisol-img/user.png"
            class="rounded-circle border border-2 border-warning shadow-sm"
            width="82" height="82" alt="User">
          <span class="online-dot"></span>
        </div>

        <div class="user-info text-white">
          <h6 class="mb-0 fw-bold"><?php echo $_SESSION['fullname']; ?></h6>
          <div class="small text-white-50"><?php echo $_SESSION['phone']; ?></div>
          <div class="small text-white-50"><?php echo $_SESSION['email']; ?></div>
        </div>
      </div>

      <!-- Navigation -->
      <ul class="sidenav-nav list-unstyled my-3 px-3 flex-grow-1">

        <li><a href="home" class="nav-link text-white d-flex align-items-center active">
          <i class="bi bi-house-door me-2"></i> Home
        </a></li>

        <li><a href="about" class="nav-link text-white d-flex align-items-center">
          <i class="bi bi-card-text me-2"></i> About
        </a></li>

        <li>
          <a href="notification" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-bell me-2"></i> Notifications
            <span class="badge bg-danger rounded-pill ms-auto">3</span>
          </a>
        </li>

        <li><a href="review" class="nav-link text-white d-flex align-items-center">
          <i class="bi bi-star-half me-2"></i> Service Review
        </a></li>

        <li><a href="faq" class="nav-link text-white d-flex align-items-center">
          <i class="bi bi-question-octagon me-2"></i> FAQs
        </a></li>

        <li><a href="contact" class="nav-link text-white d-flex align-items-center">
          <i class="bi bi-person-lines-fill me-2"></i> Contact
        </a></li>

        <li><a href="settings" class="nav-link text-white d-flex align-items-center">
          <i class="bi bi-gear me-2"></i> Settings
        </a></li>

        <!-- Divider -->
        <li class="my-3 border-top border-secondary"></li>

        <!-- Night Mode -->
        <li class="d-flex justify-content-between align-items-center text-white px-2 py-2 rounded toggle-row">
          <span><i class="bi bi-moon me-2"></i> Night Mode</span>

          <div class="form-check form-switch m-0">
            <input class="form-check-input" id="darkSwitch" type="checkbox">
          </div>
        </li>

        <!-- Logout -->
        <li class="mt-3">
          <a href="logout" class="nav-link logout-btn d-flex align-items-center fw-bold">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
          </a>
        </li>
      </ul>

      <!-- Social -->
      <div class="social-info-wrap d-flex justify-content-center gap-3 mb-3">
        <a href="https://www.facebook.com/electricsolafrica"><i class="bi bi-facebook"></i></a>
        <a href="https://x.com/ElectricsolAf"><i class="bi bi-twitter"></i></a>
        <a href="https://www.linkedin.com/company/eletricsolafrica/"><i class="bi bi-linkedin"></i></a>
      </div>

      <!-- Footer -->
      <div class="copyright-info text-center p-3 border-top small text-white-50">
        <img src="img/electrisol-img/Logo%206.png" width="110" class="mb-2">
        <div class="fw-bold text-white">Version 1.2.0</div>
        <div>&copy; <span id="copyrightYear"></span> Electricsol Limited</div>
      </div>

    </div>
  </div>
</div>
<style>
/* Sidebar background upgrade */
.modern-sidebar {
  background: linear-gradient(180deg, #0f172a, #111827);
}

/* Profile glass card */
.profile-glass {
  background: rgba(255,255,255,0.04);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255,255,255,0.08);
}

/* Online status dot */
.online-dot {
  position: absolute;
  bottom: 8px;
  right: 30%;
  width: 10px;
  height: 10px;
  background: #28d17c;
  border-radius: 50%;
  border: 2px solid #111827;
}

/* Nav links modern feel */
.sidenav-nav .nav-link {
  padding: 0.75rem 1rem;
  border-radius: 12px;
  transition: all 0.25s ease;
  position: relative;
  font-size: 14px;
}

/* Hover + active state */
.sidenav-nav .nav-link:hover {
  background: rgba(255, 193, 7, 0.12);
  color: #ffc107 !important;
  transform: translateX(4px);
}

.sidenav-nav .nav-link.active {
  background: rgba(255, 193, 7, 0.18);
  color: #ffc107 !important;
  border-left: 3px solid #ffc107;
}

/* Toggle row polish */
.toggle-row {
  background: rgba(255,255,255,0.03);
}

/* Logout emphasis */
.logout-btn {
  color: #ff5c5c !important;
  transition: 0.3s;
}

.logout-btn:hover {
  background: rgba(255, 92, 92, 0.12);
  transform: translateX(4px);
}

/* Social icons */
.social-info-wrap a {
  color: #fff;
  font-size: 18px;
  transition: 0.3s;
}

.social-info-wrap a:hover {
  color: #ffc107;
  transform: translateY(-3px) scale(1.15);
}

/* Mobile polish */
@media (max-width: 576px) {
  .sidenav-nav .nav-link {
    font-size: 13px;
  }
}
</style>