<?php include "includes/home_header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
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

  <!-- RTL mode switching -->
  <div class="rtl-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="rtl-mode-text text-center">
        <i class="bi bi-text-right"></i>
        <p class="mb-0">Switching to RTL mode</p>
      </div>
      <div class="ltr-mode-text text-center">
        <i class="bi bi-text-left"></i>
        <p class="mb-0">Switching to default mode</p>
      </div>
    </div>
  </div>

  <!-- Header Area-->
  <div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content -->
        <div class="header-content header-style-four position-relative d-flex align-items-center justify-content-between py-2">
            
            <!-- Back Button (optional, hidden for now) -->
            <div class="back-button">
                <!-- Uncomment below to enable back navigation -->
                <!--
                <a href="home.php" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                    <i class="bi bi-arrow-left-short"></i> Back
                </a>
                -->
            </div>

            <!-- Page Title -->
            <div class="page-heading d-flex align-items-center">
                <img src="img/electrisol-img/settings.png" alt="Settings Icon" width="30" class="me-2">
                <h6 class="mb-0 fw-bold">Settings</h6>
            </div>

            <!-- Placeholder for user profile or toggler -->
            <div class="user-profile-placeholder">
                <!-- You can add profile icon or dropdown here if needed -->
            </div>

        </div>
    </div>
</div>

<style>
.header-area {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
}

.page-heading h6 {
    font-size: 1rem;
    color: #333;
}

.page-heading img {
    display: inline-block;
}

.back-button a {
    text-decoration: none;
    color: #495057;
    font-weight: 500;
    transition: all 0.2s ease;
}
.back-button a:hover {
    color: #0d6efd;
}
</style>


  <div class="page-content-wrapper py-3">
    <div class="container">

        <!-- General Settings Card -->
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Settings</h6>

                <div class="single-setting-panel d-flex justify-content-between align-items-center py-2 px-2 border rounded mb-2">
                    <span>Dark Mode</span>
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" id="darkSwitch">
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Setup Card -->
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Account Setup</h6>

                <div class="single-setting-panel d-flex align-items-center py-2 px-2 border rounded mb-2">
                    <div class="icon-wrapper me-3 bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width:35px; height:35px;">
                        <i class="bi bi-person"></i>
                    </div>
                    <a href="update_detail" class="flex-grow-1 text-decoration-none text-dark">Update Profile</a>
                </div>

                <div class="single-setting-panel d-flex align-items-center py-2 px-2 border rounded mb-2">
                    <div class="icon-wrapper me-3 bg-info text-white rounded-circle d-flex justify-content-center align-items-center" style="width:35px; height:35px;">
                        <i class="bi bi-lock"></i>
                    </div>
                    <a href="password_change" class="flex-grow-1 text-decoration-none text-dark">Change Password</a>
                </div>

                <div class="single-setting-panel d-flex align-items-center py-2 px-2 border rounded mb-2">
                    <div class="icon-wrapper me-3 bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center" style="width:35px; height:35px;">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <a href="terms" class="flex-grow-1 text-decoration-none text-dark">Terms &amp; Conditions</a>
                </div>

                <div class="single-setting-panel d-flex align-items-center py-2 px-2 border rounded mb-2">
                    <div class="icon-wrapper me-3 bg-danger text-white rounded-circle d-flex justify-content-center align-items-center" style="width:35px; height:35px;">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <a href="privacy-policy" class="flex-grow-1 text-decoration-none text-dark">Privacy Policy</a>
                </div>
            </div>
        </div>

        <!-- Authentication Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Authentication</h6>

                <div class="single-setting-panel d-flex align-items-center py-2 px-2 border rounded mb-2">
                    <div class="icon-wrapper me-3 bg-danger text-white rounded-circle d-flex justify-content-center align-items-center" style="width:35px; height:35px;">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <a href="logout" class="flex-grow-1 text-decoration-none text-dark">Logout</a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.single-setting-panel:hover {
    background-color: #f1f3f5;
    transition: 0.2s ease-in-out;
}

.icon-wrapper i {
    font-size: 1.2rem;
}
</style>

<!-- Footer Nav -->
<?php include "includes/home_footer_nav.php"; ?>
