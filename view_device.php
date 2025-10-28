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
  <div class="header-area" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="energy" class="text-dark fs-4">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold">Device Management - My Device(s)</h6>
      </div>

      <!-- Navbar Toggler -->
      <div class="navbar--toggler d-flex flex-column justify-content-around" 
           id="affanNavbarToggler" 
           data-bs-toggle="offcanvas" 
           data-bs-target="#affanOffcanvas"
           aria-controls="affanOffcanvas" 
           style="width: 24px; height: 24px; cursor: pointer;">
        <span class="d-block bg-dark rounded" style="height: 3px;"></span>
        <span class="d-block bg-dark rounded" style="height: 3px;"></span>
        <span class="d-block bg-dark rounded" style="height: 3px;"></span>
      </div>

    </div>
  </div>
</div>



  <div class="page-content-wrapper py-3">
  <div class="container">
    <!-- Section Heading -->
    <div class="element-heading mb-3">
      <h6 class="fw-bold">All My Devices / Appliances</h6>
    </div>

    <!-- Add Device Button -->
    <div class="mb-3 text-end">
      <a href="add_device.php" class="btn btn-dark btn-md">
        <i class="bi bi-plus-circle me-1"></i> Add a Device
      </a>
    </div>

    <!-- Devices Table Card -->
    <div class="card shadow-sm">
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped align-middle" id="dataTable">
            <thead class="table-dark">
              <tr>
                <th>Name</th>
                <th>Energy (kWH)</th>
                <th class="text-center">View</th>
                <th class="text-center">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(isset($_SESSION['fullname'])) $fullname = escape($_SESSION['fullname']);
              if(isset($_SESSION['phone'])) $phone = escape($_SESSION['phone']);

              $query = "SELECT * FROM device WHERE phone = '{$phone}' ORDER BY added_on DESC";
              $view_device = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($view_device)){
                  $device_id = escape($row['device_id']);
                  $device_name_one = escape($row['device_name_one']);
                  $device_name_two = escape($row['device_name_two']);
                  $energy_consumed = escape($row['energy_consumed']);
                  $remaining_time = escape($row['remaining_time']);

                  echo "
                  <tr>
                    <td>{$device_name_one} {$device_name_two}</td>
                    <td>{$energy_consumed} kWH</td>
                    <td class='text-center'>
                      <a href='view_detail?id=$device_id&counter={$remaining_time}' data-bs-toggle='tooltip' title='View Detail'>
                        <i class='bi bi-eye text-primary fs-5'></i>
                      </a>
                    </td>
                    <td class='text-center'>
                      <a href='delete_device?id=$device_id' 
                         onclick=\"return confirm('Are you sure you want to delete this device?');\" 
                         data-bs-toggle='tooltip' title='Delete Device'>
                        <i class='bi bi-trash text-danger fs-5'></i>
                      </a>
                    </td>
                  </tr>
                  ";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


 <?php include "includes/home_footer_nav.php"; ?> 