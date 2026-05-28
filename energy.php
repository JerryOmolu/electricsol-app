<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>

<?php
// Ensure session phone exists
$phone = $_SESSION['phone'] ?? null;

// Default values
$total_energy = 0;
$weekly_energy = 0;
$monthly_energy = 0;

if ($phone) {
    // PDO single optimized query
    $stmt = $pdo->prepare("SELECT COALESCE(SUM(energy_consumed),0) AS total_energy 
                           FROM device 
                           WHERE phone = :phone");
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_energy = (float)$row['total_energy'];

    // Calculate derived values in PHP (faster than SQL repeats)
    $weekly_energy  = $total_energy * 7;
    $monthly_energy = $total_energy * 30;
}
?>


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

<?php include "includes/home_side_nav_left.php"; ?>

<!-- Header Area -->
<div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">

      <div class="back-button">
        <a href="home" class="btn-back">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-primary">
          <img src="img/electrisol-img/batt.png" width="28px" class="me-1">
          Energy Consumption Calculator
        </h6>
      </div>

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

        <div class="card modern-device-card border-0 mt-3">
  <div class="card-body p-3 p-md-4">

    <!-- Top Heading -->
    <div class="text-center mb-4">
      <div class="device-icon-wrapper mb-2">
        <i class="bi bi-cpu-fill"></i>
      </div>

      <h5 class="fw-bold text-white mb-1">
        Device Management
      </h5>

      <p class="text-white-50 mb-0">
        Add and manage your connected appliances easily
      </p>
    </div>

    <!-- Modern Switch Tabs -->
    <div class="modern-switch-tabs">

      <ul class="nav nav-pills nav-justified mb-4" id="affanTab3" role="tablist">

        <li class="nav-item me-2" role="presentation">

          <button class="nav-link active"
                  data-bs-toggle="tab"
                  data-bs-target="#creative"
                  type="button">

            <i class="bi bi-plus-circle-fill me-2"></i>
            Add Device

          </button>

        </li>

        <li class="nav-item" role="presentation">

          <button class="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#modern"
                  type="button">

            <i class="bi bi-grid-3x3-gap-fill me-2"></i>
            My Devices

          </button>

        </li>

      </ul>

      <!-- Tab Content -->
      <div class="tab-content" id="affanTab3Content">

        <!-- Add Device -->
        <div class="tab-pane fade show active" id="creative">

          <div class="glass-card text-center">

            <div class="mb-3">
              <div class="tab-icon add-bg">
                <i class="bi bi-plus-circle"></i>
              </div>
            </div>

            <h6 class="fw-bold text-white mb-2">
              Add a New Device
            </h6>

            <p class="text-white-50 small mb-4">
              Register a new appliance and monitor its energy consumption.
            </p>

            <a href="add_device"
               class="btn btn-light rounded-pill px-4 fw-semibold">

              <i class="bi bi-plus-lg me-2"></i>
              Add Device

            </a>

          </div>

        </div>

        <!-- View Devices -->
        <div class="tab-pane fade" id="modern">

          <div class="glass-card text-center">

            <div class="mb-3">
              <div class="tab-icon view-bg">
                <i class="bi bi-hdd-stack-fill"></i>
              </div>
            </div>

            <h6 class="fw-bold text-white mb-2">
              Manage Your Devices
            </h6>

            <p class="text-white-50 small mb-4">
              View all connected appliances and manage them easily.
            </p>

            <a href="view_device"
               class="btn btn-light rounded-pill px-4 fw-semibold">

              <i class="bi bi-grid-3x3-gap me-2"></i>
              View Devices

            </a>

          </div>

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
                <?= $total_energy ?> kWH
              </h6>
            </div>
          </div>

          <!-- Weekly -->
          <div class="col-4">
            <div class="single-counter-wrap text-center mb-4">
              <i class="bi bi-battery-charging text-primary"></i>
              <p>Weekly</p>
              <h6 class="text-primary">
                <?= $weekly_energy ?> kWH
              </h6>
            </div>
          </div>

          <!-- Monthly -->
          <div class="col-4">
            <div class="single-counter-wrap text-center mb-4">
              <i class="bi bi-battery-charging text-danger"></i>
              <p>Monthly</p>
              <h6 class="text-danger">
                <?= $monthly_energy ?> kWH
              </h6>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<style>

/* HEADER */
.modern-header{
  background: linear-gradient(135deg, #ffffff, #f8f9ff);
  backdrop-filter: blur(10px);
}

.text-gradient{
  background: linear-gradient(135deg, #0d6efd, #6f42c1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* CARD */
.modern-card{
  border: none;
  border-radius: 18px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  background: #fff;
}

/* BACK BUTTON */
.btn-back{
  font-size: 1.6rem;
  color: #333;
  transition: 0.3s;
}
.btn-back:hover{
  color: #0d6efd;
  transform: translateX(-4px);
}

/* DEVICE BOX */
.device-box{
  background: linear-gradient(135deg, #0d6efd, #000);
  border-radius: 16px;
  padding: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* BUTTON GROUP */
.btn-group-modern{
  display: inline-flex;
  gap: 10px;
  flex-wrap: wrap;
}

.btn-modern{
  border: none;
  padding: 10px 18px;
  border-radius: 30px;
  background: rgba(255,255,255,0.15);
  color: #fff;
  font-weight: 600;
  transition: 0.3s;
  backdrop-filter: blur(10px);
}

.btn-modern.active,
.btn-modern:hover{
  background: #fff;
  color: #000;
}

/* DEVICE LINK */
.device-link{
  display: inline-block;
  margin-top: 10px;
  padding: 10px 18px;
  background: rgba(255,255,255,0.2);
  border-radius: 12px;
  color: #fff;
  text-decoration: none;
  transition: 0.3s;
}

.device-link:hover{
  background: #fff;
  color: #000;
}

/* STATS CARDS */
.stat-card{
  padding: 20px;
  border-radius: 16px;
  background: #fff;
  box-shadow: 0 8px 20px rgba(0,0,0,0.06);
  text-align: center;
  transition: 0.3s;
}

.stat-card:hover{
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.stat-card i{
  font-size: 28px;
  margin-bottom: 10px;
}

.stat-card p{
  margin: 0;
  font-size: 13px;
  color: #666;
}

.stat-card h5{
  margin-top: 5px;
  font-weight: 700;
}

/* COLORS */
.stat-green i, .stat-green h5{ color: #28a745; }
.stat-blue i, .stat-blue h5{ color: #0d6efd; }
.stat-red i, .stat-red h5{ color: #dc3545; }

/* DIVIDER */
.divider{
  height: 1px;
  background: rgba(0,0,0,0.08);
  width: 100%;
}
/* Main Card */
.modern-device-card {
  border-radius: 28px;
  overflow: hidden;
  background:
    linear-gradient(rgba(5, 15, 40, 0.82), rgba(5, 15, 40, 0.92)),
    url('img/core-img/2.png');
  background-size: cover;
  background-position: center;
  box-shadow: 0 12px 40px rgba(0,0,0,0.18);
}

/* Top Icon */
.device-icon-wrapper {
  width: 75px;
  height: 75px;
  margin: auto;
  border-radius: 24px;
  background: rgba(255,255,255,0.12);
  backdrop-filter: blur(10px);
  display: flex;
  align-items: center;
  justify-content: center;
}

.device-icon-wrapper i {
  color: #fff;
  font-size: 2rem;
}

/* Modern Tabs */
.modern-switch-tabs .nav-pills {
  background: rgba(255,255,255,0.08);
  padding: 8px;
  border-radius: 20px;
  backdrop-filter: blur(10px);
}

.modern-switch-tabs .nav-link {
  border-radius: 16px;
  padding: 14px 16px;
  color: rgba(255,255,255,0.75);
  font-weight: 600;
  transition: all 0.3s ease;
  border: none;
}

.modern-switch-tabs .nav-link:hover {
  color: #fff;
  transform: translateY(-2px);
}

.modern-switch-tabs .nav-link.active {
  background: linear-gradient(135deg, #ffffff, #e9ecef);
  color: #111827;
  box-shadow: 0 8px 20px rgba(255,255,255,0.2);
}

/* Glass Card */
.glass-card {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 24px;
  padding: 35px 25px;
  backdrop-filter: blur(14px);
  transition: all 0.3s ease;
}

.glass-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 15px 30px rgba(0,0,0,0.18);
}

/* Tab Icons */
.tab-icon {
  width: 70px;
  height: 70px;
  margin: auto;
  border-radius: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.tab-icon i {
  color: #fff;
  font-size: 1.8rem;
}

.add-bg {
  background: linear-gradient(135deg, #0d6efd, #0134d4);
}

.view-bg {
  background: linear-gradient(135deg, #198754, #20c997);
}

/* Buttons */
.glass-card .btn {
  min-width: 180px;
  height: 48px;
  transition: all 0.3s ease;
}

.glass-card .btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(255,255,255,0.15);
}

/* Mobile */
@media (max-width: 576px) {

  .modern-switch-tabs .nav-link {
    font-size: 0.85rem;
    padding: 12px 10px;
  }

  .glass-card {
    padding: 28px 18px;
  }

  .device-icon-wrapper {
    width: 65px;
    height: 65px;
  }

  .tab-icon {
    width: 60px;
    height: 60px;
  }

}
	

</style>

<?php include "includes/home_footer_nav.php"; ?>