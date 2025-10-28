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
  <div class="header-area sticky-top shadow-sm bg-white" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="view_device" class="text-dark d-flex align-items-center">
          <i class="bi bi-arrow-left-short fs-4"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold">View Device Detail</h6>
      </div>

      <!-- Placeholder for future actions (e.g., edit button) -->
      <div class="header-actions">
        <!-- Empty for now or add buttons/icons here -->
      </div>
    </div>
  </div>
</div>

<style>
  /* Optional: smooth sticky shadow transition */
  .header-area.sticky-top {
    transition: all 0.3s ease;
    z-index: 1050;
  }
</style>



  <div class="page-content-wrapper py-3">
  <div class="container">

    <!-- Section Heading -->
    <div class="element-heading mb-3">
      <h6 class="fw-bold">My Device Detail</h6>
    </div>

    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <div class="standard-tab">

<?php
if(isset($_GET['id'])){
    $id = escape($_GET['id']);
    $query = "SELECT * FROM device WHERE device_id = '$id'";
    $view_detail = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($view_detail)){
        $device_id = escape($row['device_id']);
        $device_owner_name = escape($row['device_owner_name']);
        $phone = escape($row['phone']);
        $device_name_one = escape($row['device_name_one']);
        $device_name_two = escape($row['device_name_two']);
        $power = escape($row['power']);
        $usage_time = escape($row['usage_time']);
        $remaining_time = escape($row['remaining_time']);
        $energy_consumed = escape($row['energy_consumed']);
        $usage_time_hour = round($usage_time/3600, 2);

        echo "
        <!-- Device Info Tabs -->
        <ul class='nav nav-tabs rounded mb-3 shadow-sm' id='deviceTabs' role='tablist'>
          <li class='nav-item' role='presentation'>
            <button class='nav-link active' id='energy-tab' data-bs-toggle='tab' data-bs-target='#energy'
              type='button' role='tab' aria-controls='energy' aria-selected='true'>
              Energy Consumption for {$device_name_one} {$device_name_two}
            </button>
          </li>
        </ul>

        <div class='tab-content rounded shadow-sm p-3' id='deviceTabsContent'>
          <div class='tab-pane fade show active' id='energy' role='tabpanel' aria-labelledby='energy-tab'>
            <div class='row text-center g-3'>
              <div class='col-md-4'>
                <div class='card border-light shadow-sm'>
                  <div class='card-body'>
                    <h6>Power</h6>
                    <p class='mb-0 fw-bold'>{$power} Watts</p>
                  </div>
                </div>
              </div>
              <div class='col-md-4'>
                <div class='card border-light shadow-sm'>
                  <div class='card-body'>
                    <h6>Usage Time / Day</h6>
                    <p class='mb-0 fw-bold'>{$usage_time_hour} Hours</p>
                  </div>
                </div>
              </div>
              <div class='col-md-4'>
                <div class='card border-light shadow-sm'>
                  <div class='card-body'>
                    <h6>Energy Consumed / Day</h6>
                    <p class='mb-0 fw-bold'>{$energy_consumed} kWH</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        ";
    }
}
?>

    <!-- Switch On Button -->
    <div class="text-center mt-4">
      <form id="myForm" action="" method="post">
        <button class="btn btn-success btn-lg" type="submit" name="on_device">
          <i class="fa fa-power-off me-2" aria-hidden="true"></i> Switch On
        </button>
      </form>
    </div>

<?php
if(isset($_POST['on_device'])){
    $current_time = time();
    $end_time = $current_time + $usage_time;

    $start_display = date('F j, Y H:i:s A', $current_time);
    $end_display = date('F j, Y H:i:s A', $end_time);

    echo "
    <div class='mt-4'>
      <div class='alert alert-info text-center'><strong>Start Time:</strong> $start_display</div>
      <div class='alert alert-success text-center'><strong>Usage Time:</strong> {$usage_time} Seconds</div>
      <div class='alert alert-warning text-center'><strong>End Time:</strong> $end_display</div>

      <div class='text-center mt-3'>
        <a href='https://logwork.com/countdown-timer' class='countdown-timer' 
           data-timezone='Africa/Lagos' 
           data-textcolor='#f7f4f4' 
           data-background='#111c4a' 
           data-digitscolor='#fcfcfc' 
           data-unitscolor='#111a1a' 
           data-date='$end_display'>
          Energy Countdown Timer
        </a>
      </div>
    </div>
    ";
}
?>

        </div>
      </div>
    </div>
  </div>
</div>



 <?php include "includes/home_footer_nav.php"; ?> 