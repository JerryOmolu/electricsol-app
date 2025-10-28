<?php include "includes/home_header.php"; ?>
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

  <!-- RTL mode switching -->
<!--
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
-->

  <!-- # Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

  <!-- Header Area -->
  <!-- Header Area: Update Profile -->
<div class="header-area sticky-top bg-light shadow-sm" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="settings" class="text-dark">
          <i class="bi bi-arrow-left-short fs-3"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold">
          <i class="bi bi-person me-1"></i> Update Profile
        </h6>
      </div>

      <!-- Navbar Toggler (for offcanvas menu) -->
      <div class="navbar--toggler d-flex align-items-center">
        <span class="d-block bg-dark rounded mb-1" style="width: 25px; height: 3px;"></span>
        <span class="d-block bg-dark rounded mb-1" style="width: 25px; height: 3px;"></span>
        <span class="d-block bg-dark rounded" style="width: 25px; height: 3px;"></span>
      </div>

    </div>
  </div>
</div>

<style>
  /* Sticky header with shadow */
  #headerArea {
    z-index: 1050;
  }

  /* Navbar toggler bars hover effect */
  .navbar--toggler span:hover {
    background-color: #0d6efd;
  }

  /* Page title adjustments */
  .page-heading h6 {
    font-size: 1rem;
    color: #333;
  }
</style>


  <div class="page-content-wrapper py-3">
  <div class="container">

    <!-- User Info Card -->
    <div class="card user-info-card mb-3 shadow-sm">
      <div class="card-body d-flex align-items-center">
        
        <!-- Profile Picture -->
        <div class="user-profile position-relative me-3">
          <img src="img/electrisol-img/user.png" class="rounded-circle border" width="80" alt="User Profile">
          <label for="profile-upload" class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1 text-white cursor-pointer" title="Change Profile Picture">
            <i class="bi bi-pencil fs-6"></i>
          </label>
          <input id="profile-upload" class="d-none" type="file" name="profile">
        </div>

        <!-- User Info -->
        <div class="user-info">
          <h5 class="mb-1 fw-bold"><?php echo $_SESSION['fullname']; ?></h5>
          <p class="mb-0 text-muted"><?php echo $_SESSION['phone']; ?></p>
        </div>

      </div>
    </div>

    <!-- User Meta Data / Update Form -->
    <div class="card user-data-card shadow-sm">
      <div class="card-body">

        <!-- Alerts -->
        <?php 
          if(isset($_POST['update'])){
            $address = escape($_POST['address']);
            $fullname = isset($_SESSION['fullname']) ? escape($_SESSION['fullname']) : '';
            $phone = isset($_SESSION['phone']) ? escape($_SESSION['phone']) : '';
            $email = isset($_SESSION['email']) ? escape($_SESSION['email']) : '';

            if(!empty($address)){
              $query = "UPDATE register SET address = '{$address}' WHERE phone = '{$phone}' AND email = '{$email}'";
              $update_query = mysqli_query ($connection, $query);
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <i class='bi bi-check-circle me-2'></i>Profile updated successfully!
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            } else {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <i class='bi bi-x-circle me-2'></i>Address field cannot be empty
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";    
            }
          }        
        ?>

        <!-- Update Profile Form -->
        <form action="" method="post" class="mt-3">

          <div class="mb-3">
            <label for="fullname" class="form-label fw-semibold">Full Name</label>
            <input type="text" id="fullname" class="form-control" value="<?php echo $_SESSION['fullname']; ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email Address</label>
            <input type="email" id="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone Number</label>
            <input type="text" id="phone" class="form-control" value="<?php echo $_SESSION['phone']; ?>" maxlength="11" readonly>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <input type="text" id="address" class="form-control" placeholder="Enter your address" name="address">
          </div>

          <button type="submit" name="update" class="btn btn-success w-100 fw-semibold">Update Now</button>
        </form>

      </div>
    </div>

  </div>
</div>

<style>
  .user-profile {
    width: 80px;
    height: 80px;
  }

  .user-profile img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .cursor-pointer {
    cursor: pointer;
  }
</style>


 <?php include "includes/home_footer_nav.php"; ?> 