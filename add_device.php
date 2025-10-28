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
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
      <!-- Back Button -->
      <div class="back-button">
        <a href="energy">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading">
        <h6 class="mb-0">Device Management - Add Device</h6>
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
    <!-- Section Heading -->
    <div class="element-heading text-center mb-3">
      <h6 class="fw-bold"><i class="bi bi-cpu"></i> Add New Device/Appliance</h6>
      <p class="text-muted small">Fill in the details below to calculate energy consumption</p>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
      <div class="card-body">

        <!-- ✅ PHP Logic -->
        <?php 
        if(isset($_POST['add_device'])){
          $device_one = escape($_POST['device_one']);
          $device_two = escape($_POST['device_two']);
          $power = escape($_POST['power']);
          $usage = escape($_POST['usage']);
       
          $usage_time_seconds = $usage * 60 * 60;
  
          if(isset($_SESSION['fullname'])){
            $fullname = escape($_SESSION['fullname']);
          } 
          if(isset($_SESSION['phone'])){
            $phone = escape($_SESSION['phone']);
          } 
       
          $energyConsumption = ($power * $usage) / 1000;
       
          if(empty($device_one) && !empty($device_two) && !empty($power) && !empty($usage)){
            $query1 = "INSERT INTO device(device_owner_name,phone,device_name_two,power,usage_time,added_on,energy_consumed)VALUES('{$fullname}','{$phone}','{$device_two}','{$power}','{$usage_time_seconds}',now(),'{$energyConsumption}')";
    
            $add_device_two = mysqli_query($connection, $query1);
       
            if($add_device_two){
              echo "<div class='alert custom-alert-two alert-success alert-dismissible fade show' role='alert'>
                      <i class='bi bi-check-circle'></i>
                      $device_two Added Successfully! 
                      <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"; 
              echo "<div class='alert custom-alert-two alert-dark alert-dismissible fade show mb-0' role='alert'>
                      <i class='bi bi-lightning-charge'></i>
                      The energy consumption of this $device_two is $energyConsumption kWH per day.
                      <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div><br>";
              echo "<a class='btn m-1 btn-dark' href='add_device'><i class='bi bi-plus-circle'></i> Add another device</a>
                    <a class='btn m-1 btn-outline-dark' href='view_device'><i class='bi bi-grid-3x3-gap'></i> View Device(s)</a>";
            }
          } 
          else if(empty($device_two) && !empty($device_one) && !empty($power) && !empty($usage)){
            $query2 = "INSERT INTO device(device_owner_name,phone,device_name_one,power,usage_time,added_on,energy_consumed)VALUES('{$fullname}','{$phone}','{$device_one}','{$power}','{$usage_time_seconds}',now(),'{$energyConsumption}')";
    
            $add_device_one = mysqli_query($connection, $query2);
            if($add_device_one){
              echo "<div class='alert custom-alert-two alert-success alert-dismissible fade show' role='alert'>
                      <i class='bi bi-check-circle'></i>
                      $device_one Added Successfully! 
                      <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"; 
              echo "<div class='alert custom-alert-two alert-dark alert-dismissible fade show mb-0' role='alert'>
                      <i class='bi bi-lightning-charge'></i>
                      The energy consumption of this $device_one is $energyConsumption kWH per day.
                      <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div><br>";
              echo "<a class='btn m-1 btn-dark' href='add_device'><i class='bi bi-plus-circle'></i> Add another device</a>
                    <a class='btn m-1 btn-outline-dark' href='view_device'><i class='bi bi-grid-3x3-gap'></i> View Device(s)</a>";
            }
          } 
          else {
            echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                    <i class='bi bi-x-circle'></i>
                    Action Not Allowed! 
                    <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>"; 
          }
        }
        ?>            

        <!-- ✅ Device Form -->
        <form action="" method="post">
          <!-- Select Device -->
          <div class="form-group mb-3">
            <label class="form-label fw-bold">Select a Device</label>
            <select class="form-select" name="device_one">
              <option value="" selected>-- Select Device -- </option>
              <option value="Refrigerator">Refrigerator</option>
              <option value="Bulb">Bulb</option>
              <option value="Game">Game Console</option>
              <option value="Oven">Microwave oven</option>
              <option value="Washing Machine">Washing Machine</option>
              <option value="Electric Fan">Electric Fan</option>
              <option value="Air Condition">Air Conditioner</option>
              <option value="Water Heater">Water Heater</option>
              <option value="Blender">Blender</option>
              <option value="Toaster">Toaster</option>
              <option value="Stove">Stove</option>
              <option value="Electric Kettle">Electric Kettle</option>
              <option value="Pressing Iron">Pressing Iron</option>
              <option value="Television">Television</option>
              <option value="Home Theater">Home Theater</option>
              <option value="Food Processor">Food Processor</option>
              <option value="Rice Cooker">Rice Cooker</option>
              <option value="Chest Freezer">Chest Freezer</option>
              <option value="">Others (Specify Below)</option>
            </select>
          </div>

          <!-- Other Device -->
          <div class="form-group mb-3">
            <label class="form-label fw-bold">Not on the List?</label>
            <input type="text" class="form-control" name="device_two" placeholder="Enter Device/Appliance">
          </div>

          <!-- Power Rating -->
          <div class="form-group mb-3">
            <label class="form-label fw-bold">Power Rating (Watts)</label>
            <input type="number" class="form-control" name="power" placeholder="Enter Power Rating" required>
            <small class="text-danger">⚡ Check device label for power rating</small>
          </div>

          <!-- Usage Time -->
          <div class="form-group mb-4">
            <label class="form-label fw-bold">Usage Time per Day (Hours)</label>
            <select class="form-select" name="usage" required>
              <?php for($i=1; $i<=24; $i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?> <?php echo ($i==1)?'Hour':'Hours'; ?></option>
              <?php } ?>
            </select>
          </div>

          <!-- Submit -->
          <div class="form-group">
            <button type="submit" name="add_device" class="btn btn-dark w-100">
              <i class="bi bi-plus-circle"></i> Add Device
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<?php include "includes/home_footer_nav.php"; ?>

<!-- ✅ CSS -->
<style>
.card {
  transition: transform 0.2s ease-in-out;
}
.card:hover {
  transform: translateY(-3px);
}
button.btn-dark {
  transition: all 0.3s ease-in-out;
}
button.btn-dark:hover {
  background-color: #000 !important;
  opacity: 0.9;
}
.alert {
  border-radius: 10px;
}
</style>
