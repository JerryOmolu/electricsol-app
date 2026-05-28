<?php session_start(); ?>
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

<?php include "includes/home_side_nav_left.php"; ?>

<!-- Header Area -->
<div class="header-area bg-white shadow-sm sticky-top" id="headerArea">
  <div class="container">
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">

      <!-- Back Button -->
      <div class="back-button">
        <a href="energy"
           class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center back-btn">
          <i class="bi bi-arrow-left-short fs-3"></i>
        </a>
      </div>

      <!-- Heading -->
      <div class="page-heading text-center flex-grow-1 px-2">
        <h6 class="mb-0 fw-bold d-flex align-items-center justify-content-center gap-2">
          <img src="img/electrisol-img/batt.png" width="28" alt="">
          Device Management
        </h6>
        <small class="text-muted">My Devices & Appliances</small>
      </div>

      <!-- Menu -->
      <div class="navbar--toggler modern-toggler"
           id="affanNavbarToggler"
           data-bs-toggle="offcanvas"
           data-bs-target="#affanOffcanvas"
           aria-controls="affanOffcanvas">

        <span></span>
        <span></span>
        <span></span>

      </div>

    </div>
  </div>
</div>

<!-- Page Content -->
<div class="page-content-wrapper py-3">
  <div class="container">

    <!-- Top Banner -->
    <div class="card border-0 shadow-sm mb-4 overflow-hidden device-banner-card">
      <div class="card-body p-4">

        <div class="d-flex align-items-center justify-content-between flex-wrap">

          <div class="mb-3 mb-md-0">
            <h5 class="fw-bold text-white mb-1">
              Smart Energy Monitoring
            </h5>

            <p class="text-white-50 mb-0">
              Manage and monitor all your connected appliances easily.
            </p>
          </div>

          <div>
            <a href="add_device.php" class="btn btn-light btn-lg rounded-pill px-4 fw-semibold add-device-btn">
              <i class="bi bi-plus-circle-fill me-2"></i>
              Add Device
            </a>
          </div>

        </div>

      </div>
    </div>

    <!-- Section Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">

      <div>
        <h6 class="fw-bold mb-1 text-dark">
          All My Devices / Appliances
        </h6>

        <small class="text-muted">
          View, manage and monitor your energy devices.
        </small>
      </div>

      <div class="device-count-badge">
        <i class="bi bi-hdd-network me-1"></i>
        Active Devices
      </div>

    </div>

    <!-- Device Table Card -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden device-table-card">

      <div class="card-body p-0">

        <div class="table-responsive">

          <table class="table align-middle table-hover mb-0" id="dataTable">

            <thead>
              <tr>
                <th class="ps-4">Device Name</th>
                <th>Energy Usage</th>
                <th class="text-center">View</th>
                <th class="text-center pe-4">Delete</th>
              </tr>
            </thead>

            <tbody>

<?php
/* =========================
   SESSION DATA (SAFE)
========================= */
$fullname = $_SESSION['fullname'] ?? null;
$phone    = $_SESSION['phone'] ?? null;

if ($phone) {

    /* =========================
       PDO OPTIMIZED QUERY
    ========================= */
    $stmt = $pdo->prepare("
        SELECT device_id,
               device_name_one,
               device_name_two,
               energy_consumed,
               remaining_time
        FROM device
        WHERE phone = ?
        ORDER BY added_on DESC
    ");

    $stmt->execute([$phone]);
    $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($devices) {

        foreach ($devices as $row) {

            $device_id        = (int)$row['device_id'];
            $name_one         = htmlspecialchars($row['device_name_one']);
            $name_two         = htmlspecialchars($row['device_name_two']);
            $energy_consumed  = htmlspecialchars($row['energy_consumed']);
            $remaining_time   = htmlspecialchars($row['remaining_time']);

            echo "
            <tr>

              <td class='ps-4'>
                <div class='d-flex align-items-center'>

                  <div class='device-icon me-3'>
                    <i class='bi bi-cpu-fill'></i>
                  </div>

                  <div>
                    <h6 class='mb-0 fw-semibold text-dark'>
                      {$name_one} {$name_two}
                    </h6>

                    <small class='text-muted'>
                      Smart Energy Device
                    </small>
                  </div>

                </div>
              </td>

              <td>
                <span class='energy-badge'>
                  <i class='bi bi-lightning-charge-fill me-1'></i>
                  {$energy_consumed} kWH
                </span>
              </td>

              <td class='text-center'>

                <a href='view_detail?id={$device_id}&counter={$remaining_time}'
                   class='action-btn view-btn'
                   data-bs-toggle='tooltip'
                   title='View Device'>

                  <i class='bi bi-eye-fill'></i>

                </a>

              </td>

              <td class='text-center pe-4'>

                <a href='delete_device?id={$device_id}'
                   onclick=\"return confirm('Are you sure you want to delete this device?');\"
                   class='action-btn delete-btn'
                   data-bs-toggle='tooltip'
                   title='Delete Device'>

                  <i class='bi bi-trash-fill'></i>

                </a>

              </td>

            </tr>
            ";
        }

    } else {

        echo "
        <tr>
          <td colspan='4' class='text-center py-5'>

            <div class='empty-state'>

              <div class='empty-icon mb-3'>
                <i class='bi bi-hdd-stack'></i>
              </div>

              <h5 class='fw-bold mb-2'>
                No Devices Added Yet
              </h5>

              <p class='text-muted mb-4'>
                Start monitoring your energy usage by adding your first device.
              </p>

              <a href='add_device.php'
                 class='btn btn-dark rounded-pill px-4'>

                 <i class='bi bi-plus-circle me-2'></i>
                 Add Device

              </a>

            </div>

          </td>
        </tr>
        ";
    }
}
?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>
</div>

<style>

/* Header */
#headerArea {
  border-bottom: 1px solid #f1f1f1;
  z-index: 1030;
}

.back-btn {
  width: 42px;
  height: 42px;
  transition: all 0.3s ease;
}

.back-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important;
}

.modern-toggler {
  width: 26px;
  height: 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  cursor: pointer;
}

.modern-toggler span {
  display: block;
  width: 100%;
  height: 3px;
  border-radius: 10px;
  background: #111;
  transition: all 0.3s ease;
}

/* Banner */
.device-banner-card {
  border-radius: 24px;
  background: linear-gradient(135deg, #0134d4 0%, #001d7a 100%);
}

.add-device-btn {
  transition: all 0.3s ease;
}

.add-device-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(255,255,255,0.25);
}

/* Device Count Badge */
.device-count-badge {
  background: #f1f4ff;
  color: #0134d4;
  padding: 10px 16px;
  border-radius: 30px;
  font-size: 0.85rem;
  font-weight: 600;
}

/* Table Card */
.device-table-card {
  border-radius: 24px;
}

.device-table-card table thead {
  background: #111827;
}

.device-table-card table thead th {
  color: #fff;
  font-size: 0.9rem;
  font-weight: 600;
  border: none;
  padding-top: 18px;
  padding-bottom: 18px;
}

.device-table-card table tbody tr {
  transition: all 0.25s ease;
}

.device-table-card table tbody tr:hover {
  background: #f8fbff;
}

.device-table-card table tbody td {
  border-color: #f1f1f1;
  vertical-align: middle;
  padding-top: 18px;
  padding-bottom: 18px;
}

/* Device Icon */
.device-icon {
  width: 50px;
  height: 50px;
  border-radius: 16px;
  background: linear-gradient(135deg, #0134d4, #0d6efd);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 1.2rem;
  box-shadow: 0 8px 20px rgba(1,52,212,0.18);
}

/* Energy Badge */
.energy-badge {
  display: inline-flex;
  align-items: center;
  background: #ecfdf3;
  color: #0f9d58;
  padding: 8px 14px;
  border-radius: 30px;
  font-size: 0.85rem;
  font-weight: 700;
}

/* Action Buttons */
.action-btn {
  width: 42px;
  height: 42px;
  border-radius: 14px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 1rem;
}

.view-btn {
  background: rgba(13,110,253,0.12);
  color: #0d6efd;
}

.view-btn:hover {
  background: #0d6efd;
  color: #fff;
  transform: translateY(-2px);
}

.delete-btn {
  background: rgba(220,53,69,0.12);
  color: #dc3545;
}

.delete-btn:hover {
  background: #dc3545;
  color: #fff;
  transform: translateY(-2px);
}

/* Empty State */
.empty-state {
  padding: 30px 20px;
}

.empty-icon {
  width: 90px;
  height: 90px;
  margin: auto;
  border-radius: 50%;
  background: #f4f6ff;
  display: flex;
  align-items: center;
  justify-content: center;
}

.empty-icon i {
  font-size: 2.5rem;
  color: #0134d4;
}

/* Mobile */
@media (max-width: 576px) {

  .page-heading h6 {
    font-size: 0.92rem;
  }

  .device-banner-card .card-body {
    padding: 1.5rem !important;
  }

  .device-table-card table thead th,
  .device-table-card table tbody td {
    font-size: 0.85rem;
  }

  .device-icon {
    width: 42px;
    height: 42px;
    font-size: 1rem;
  }

  .action-btn {
    width: 38px;
    height: 38px;
  }

}

</style>

<?php include "includes/home_footer_nav.php"; ?>