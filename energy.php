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


  <!-- # Sidenav Left -->
<?php include "includes/home_side_nav_left.php"; ?>

  <!-- Header Area -->
  <div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="home" class="btn-back">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-primary">
          <img src="img/electrisol-img/batt.png" width="28px" class="me-1"> 
          Energy Consumption Calculator
        </h6>
      </div>

      <!-- Navbar Toggler -->
      <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
        aria-controls="affanOffcanvas">
        <span class="d-block"></span>
        <span class="d-block"></span>
        <span class="d-block"></span>
      </div>
    </div>
  </div>
</div>


  <div class="page-content-wrapper py-3">
  <div class="container">
    <div class="card image-gallery-card">
      <div class="card-body">
        
        <h6>What is an Energy Consumption Calculator?</h6>
        <p>An energy consumption calculator is a tool or application that helps you estimate the amount of energy used by an appliance or device over a specific period.</p>

        <div class="divider mt-3"></div>

        <!-- Device Management -->
        <div class="element-heading mt-4">
          <h6><i class="bi bi-hdd-stack me-1"></i> Device(s) / Appliance(s) Management</h6>
        </div>

        <div class="card bg-dark bg-img text-white mt-2" style="background-image: url('img/core-img/2.png')">
          <div class="card-body">
            <div class="colorful-tab text-center">
              <ul class="nav justify-content-center mb-3" id="affanTab3" role="tablist">
                <li class="nav-item me-2">
                  <button class="btn btn-primary active" id="creative-tab" data-bs-toggle="tab" data-bs-target="#creative" type="button" role="tab">Add Device</button>
                </li>
                <li class="nav-item">
                  <button class="btn btn-primary" id="modern-tab" data-bs-toggle="tab" data-bs-target="#modern" type="button" role="tab">View My Devices</button>
                </li>
              </ul>

              <div class="tab-content shadow-sm p-3" id="affanTab3Content">
                <div class="tab-pane fade show active" id="creative" role="tabpanel">
                  <center><a href="add_device" class="text-white"><h6><i class="bi bi-plus-circle"></i> Add Device</h6></a></center>
                </div>
                <div class="tab-pane fade" id="modern" role="tabpanel">
                  <center><a href="view_device" class="text-white"><h6><i class="bi bi-grid-3x3-gap"></i> View My Devices</h6></a></center>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="divider mt-4"></div>

        <!-- Energy Stats -->
        <div class="element-heading mt-4">
          <h6><i class="bi bi-graph-up-arrow me-1"></i> Energy Consumption Statistics</h6>
        </div>

        <div class="row">
          <!-- Daily -->
          <div class="col-4">
            <div class="single-counter-wrap text-center mb-4">
              <i class="bi bi-battery-charging text-success"></i>
              <p>Daily</p>
              <h6 class="text-success">
                <?php 
                if(isset($_SESSION['phone'])){
                  $phone = escape($_SESSION['phone']);
                } 
                $query = "SELECT SUM(energy_consumed) AS total_energy FROM device WHERE phone = '$phone'";
                $sum_query = mysqli_query($connection,$query);
                if(mysqli_num_rows($sum_query) > 0){
                  $row = mysqli_fetch_array($sum_query);
                  $total_energy = $row['total_energy'];
                  echo $total_energy;
                }
                ?> kWH
              </h6>
            </div>
          </div>

          <!-- Weekly -->
          <div class="col-4">
            <div class="single-counter-wrap text-center mb-4">
              <i class="bi bi-battery-charging text-primary"></i>
              <p>Weekly</p>
              <h6 class="text-primary">
                <?php 
                if(isset($_SESSION['phone'])){
                  $phone = escape($_SESSION['phone']);
                } 
                $query = "SELECT SUM(energy_consumed) AS total_energy FROM device WHERE phone = '$phone'";
                $sum_query = mysqli_query($connection,$query);
                if(mysqli_num_rows($sum_query) > 0){
                  $row = mysqli_fetch_array($sum_query);
                  $total_energy = $row['total_energy'];
                  echo $total_energy * 7;
                }
                ?> kWH
              </h6>
            </div>
          </div>

          <!-- Monthly -->
          <div class="col-4">
            <div class="single-counter-wrap text-center mb-4">
              <i class="bi bi-battery-charging text-danger"></i>
              <p>Monthly</p>
              <h6 class="text-danger">
                <?php 
                if(isset($_SESSION['phone'])){
                  $phone = escape($_SESSION['phone']);
                } 
                $query = "SELECT SUM(energy_consumed) AS total_energy FROM device WHERE phone = '$phone'";
                $sum_query = mysqli_query($connection,$query);
                if(mysqli_num_rows($sum_query) > 0){
                  $row = mysqli_fetch_array($sum_query);
                  $total_energy = $row['total_energy'];
                  echo $total_energy * 30;
                }
                ?> kWH
              </h6>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<style>
/* Card container beautification */
.image-gallery-card {
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  background: #fff;
  padding: 20px;
}

/* Section headings */
.element-heading h6 {
  font-weight: 700;
  color: #0134d4;
  margin-bottom: 12px;
}

/* Device Management tab buttons */
.colorful-tab .btn {
  border-radius: 25px;
  font-weight: 600;
  padding: 8px 20px;
  transition: all 0.3s ease;
}

.colorful-tab .btn:hover {
  transform: translateY(-2px);
  box-shadow: 0px 4px 10px rgba(1, 52, 212, 0.2);
}

.colorful-tab .btn.active {
  background: linear-gradient(135deg, #0134d4, #000);
  border: none;
}

/* Tab content */
.colorful-tab .tab-content {
  border-radius: 15px;
  background: rgba(0, 0, 0, 0.6);
  color: #fff;
}

/* Stats counters */
.single-counter-wrap {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 15px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.single-counter-wrap:hover {
  transform: translateY(-5px);
  box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
}

.single-counter-wrap i {
  font-size: 28px;
  margin-bottom: 8px;
}

.single-counter-wrap p {
  font-size: 13px;
  font-weight: 500;
  color: #666;
  margin-bottom: 5px;
}

.single-counter-wrap h6 {
  font-size: 18px;
  font-weight: 700;
}

	/* Header beautification */
.header-area {
  border-bottom: 1px solid #eaeaea;
  transition: all 0.3s ease;
}

/* Back button */
.btn-back {
  font-size: 1.5rem;
  color: #333;
  transition: all 0.3s ease;
}
.btn-back:hover {
  color: #0d6efd; /* Bootstrap primary */
  transform: translateX(-3px);
}

/* Page Title */
.page-heading h6 {
  font-size: 1rem;
  letter-spacing: 0.3px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Navbar toggler animation */
.navbar--toggler {
  cursor: pointer;
}
.navbar--toggler span {
  width: 22px;
  height: 2px;
  background: #333;
  margin: 4px 0;
  transition: all 0.3s ease-in-out;
  border-radius: 2px;
}
.navbar--toggler:hover span {
  background: #0d6efd;
}

</style>

 <?php include "includes/home_footer_nav.php"; ?> 