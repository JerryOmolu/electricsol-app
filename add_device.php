<?php
session_start(); 
require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_device'])) {

    header('Content-Type: application/json');

    $device_one = trim($_POST['device_one'] ?? '');
    $device_two = trim($_POST['device_two'] ?? '');
    $power      = (float)($_POST['power'] ?? 0);
    $usage      = (int)($_POST['usage'] ?? 0);

    $fullname = $_SESSION['fullname'] ?? '';
    $phone    = $_SESSION['phone'] ?? '';

    // BASIC VALIDATION
    if ($power <= 0 || $usage <= 0 || empty($fullname)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input data'
        ]);
        exit;
    }

    // ✅ FIXED DEVICE SELECTION LOGIC (CLEAN + SAFE)
    $deviceName = '';

    if (!empty($device_one)) {
        $deviceName = $device_one;
    } elseif (!empty($device_two)) {
        $deviceName = $device_two;
    }

    if (empty($deviceName)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Please select or enter a device name'
        ]);
        exit;
    }

    $usage_time_seconds = $usage * 3600;
    $energyConsumption  = ($power * $usage) / 1000;

    try {

        static $stmt = null;

        if ($stmt === null) {
            $stmt = $pdo->prepare("
                INSERT INTO device
                (device_owner_name, phone, device_name_one, device_name_two, power, usage_time, remaining_time, added_on, energy_consumed)
                VALUES
                (:fullname, :phone, :d1, :d2, :power, :usage_time, 0, NOW(), :energy)
            ");
        }

        $stmt->execute([
            ':fullname'   => $fullname,
            ':phone'      => $phone,
            ':d1'         => $device_one ?: 'N/A',
            ':d2'         => $device_two ?: 'N/A',
            ':power'      => $power,
            ':usage_time' => $usage_time_seconds,
            ':energy'     => $energyConsumption
        ]);

        echo json_encode([
            'status' => 'success',
            'device' => $deviceName,
            'energy' => $energyConsumption
        ]);

    } catch (PDOException $e) {

        echo json_encode([
            'status' => 'error',
            'message' => 'Database error occurred'
        ]);
    }

    exit;
}
?>

<?php include "includes/home_header.php"; ?>


<!-- Internet Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Dark Mode -->
<div class="dark-mode-switching">
  <div class="d-flex w-100 h-100 align-items-center justify-content-center">
    <div class="dark-mode-text text-center">
      <i class="bi bi-moon-stars-fill fs-2"></i>
      <p class="mb-0">Switching to dark mode</p>
    </div>
    <div class="light-mode-text text-center">
      <i class="bi bi-brightness-high-fill fs-2"></i>
      <p class="mb-0">Switching to light mode</p>
    </div>
  </div>
</div>

<?php include "includes/home_side_nav_left.php"; ?>

<!-- HEADER -->
<div class="header-area shadow-sm" id="headerArea">
  <div class="container">
    <div class="header-content d-flex align-items-center justify-content-between py-2">

      <a href="energy" class="btn btn-light rounded-circle shadow-sm">
        <i class="bi bi-arrow-left"></i>
      </a>

      <div class="text-center">
        <h6 class="mb-0 fw-bold">Device Manager</h6>
        <small class="text-muted">Add Appliance</small>
      </div>

      <div class="navbar--toggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas">
        <span></span><span></span><span></span>
      </div>

    </div>
  </div>
</div>

<!-- PAGE -->
<div class="page-content-wrapper py-4">
  <div class="container">

    <!-- TITLE -->
    <div class="text-center mb-4">
      <div class="icon-box mb-2">
        <i class="bi bi-cpu-fill fs-1 text-primary"></i>
      </div>
      <h5 class="fw-bold mb-1">Add New Device</h5>
      <p class="text-muted small">Estimate your daily energy usage instantly</p>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4">
      <div class="card-body p-4">

        <!-- FORM -->
 <form id="deviceForm" method="post">

  <!-- PROGRESS -->
  <div class="wizard-progress mb-4">
    <div class="d-flex justify-content-between text-center small fw-semibold mb-2">
      <div class="flex-fill text-primary">Device</div>
      <div class="flex-fill">Custom</div>
      <div class="flex-fill">Power</div>
      <div class="flex-fill">Usage</div>
    </div>

    <div class="progress" style="height:6px; border-radius:20px;">
      <div id="wizardBar" class="progress-bar bg-primary" style="width:25%"></div>
    </div>
  </div>

  <!-- STEP 1 -->
  <div class="wizard-step active">
    <div class="mb-3">
      <label class="form-label fw-semibold">Choose Device</label>
      <select class="form-select form-control-lg rounded-3" name="device_one" id="device_one">
        <option value="">-- Select Device --</option>
        <option value="Refrigerator">Refrigerator</option>
        <option value="Bulb">Bulb</option>
        <option value="Game">Game Console</option>
        <option value="Oven">Microwave Oven</option>
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
        <option value="">-- Not in list (type below) --</option>
      </select>
    </div>
	  
	  <p style="color:primary;">Please, Click Next if device is not available on the list</p>

    <button type="button" class="btn btn-primary w-100 nextBtn">Next</button>
  </div>

  <!-- STEP 2 -->
  <div class="wizard-step">
    <div class="mb-3">
      <label class="form-label fw-semibold">Custom Device</label>
      <input type="text" class="form-control form-control-lg rounded-3"
             name="device_two" placeholder="Enter device name">
    </div>

    <div class="d-flex gap-2">
      <button type="button" class="btn btn-light w-50 prevBtn">Back</button>
      <button type="button" class="btn btn-primary w-50 nextBtn">Next</button>
    </div>
  </div>

  <!-- STEP 3 -->
  <div class="wizard-step">
    <div class="mb-3">
      <label class="form-label fw-semibold">Power (Watts)</label>
      <input type="number" class="form-control form-control-lg rounded-3"
             name="power" id="power" placeholder="e.g. 1000" required>
    </div>

    <div class="d-flex gap-2">
      <button type="button" class="btn btn-light w-50 prevBtn">Back</button>
      <button type="button" class="btn btn-primary w-50 nextBtn">Next</button>
    </div>
  </div>

  <!-- STEP 4 -->
  <div class="wizard-step">
    <div class="mb-3">
      <label class="form-label fw-semibold">Daily Usage (Hours)</label>
      <select class="form-select form-control-lg rounded-3" name="usage" required>
        <?php for ($i = 1; $i <= 24; $i++): ?>
          <option value="<?= $i ?>"><?= $i ?> <?= $i==1?'Hour':'Hours' ?></option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="d-flex gap-2">
      <button type="button" class="btn btn-light w-50 prevBtn">Back</button>
      <button type="submit" name="add_device"
              class="btn btn-success w-50 fw-semibold shadow-sm">
        <i class="bi bi-check-circle me-1"></i> Submit
      </button>
    </div>
  </div>

</form>
		  
<style>
body {
  background: #f6f8fb;
}

/* CARD */
.card {
  transition: all 0.25s ease;
  border: none;
}

.card:hover {
  transform: translateY(-2px);
}

/* FORM FIELDS */
.form-control,
.form-select {
  border: 1px solid #e6e6e6;
  box-shadow: none !important;
}

.form-control:focus,
.form-select:focus {
  border-color: #0d6efd;
}

/* ICON */
.icon-box {
  width: 70px;
  height: 70px;
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 18px;
  background: rgba(13,110,253,0.08);
}

/* ===== WIZARD FIX (THIS WAS THE MAIN ISSUE) ===== */

.wizard-progress {
  position: relative;
  margin-bottom: 20px;
}

.wizard-progress .progress {
  height: 6px;
  border-radius: 50px;
  background: #e9ecef;
}

/* STEP FIX */
.wizard-step {
  display: none;
  min-height: 220px; /* prevents collapse */
  animation: fadeIn 0.25s ease-in-out;
}

.wizard-step.active {
  display: block;
}

/* smooth transition */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(6px); }
  to { opacity: 1; transform: translateY(0); }
}

/* BUTTON SPACING FIX */
.wizard-step .btn {
  padding: 12px;
  border-radius: 12px;
}

/* MOBILE IMPROVEMENT */
@media (max-width: 576px) {
  .card-body {
    padding: 20px !important;
  }
}
</style>		  		  

      </div>
    </div>

  </div>
</div>

<!--Autofocus Custom Input-->
<script>
document.getElementById('device_one').addEventListener('change', function () {
    if (this.value === '') {
        document.querySelector('input[name="device_two"]').focus();
    }
});
</script>

<!-- SCRIPT -->

<script>
let currentStep = 0;
const steps = document.querySelectorAll(".wizard-step");
const bar = document.getElementById("wizardBar");

function showStep(index) {
    steps.forEach((step, i) => {
        step.classList.toggle("active", i === index);
    });

    bar.style.width = ((index + 1) / steps.length) * 100 + "%";
}

/* NEXT BUTTON */
document.querySelectorAll(".nextBtn").forEach(btn => {
    btn.addEventListener("click", () => {

        const activeStep = steps[currentStep];
        const fields = activeStep.querySelectorAll("select, input");

        for (let el of fields) {
            if (el.hasAttribute("required") && !el.value) {
                el.style.border = "1px solid red";
                el.focus();
                return;
            } else {
                el.style.border = "1px solid #e6e6e6";
            }
        }

        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });
});

/* BACK BUTTON */
document.querySelectorAll(".prevBtn").forEach(btn => {
    btn.addEventListener("click", () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });
});

/* INIT */
showStep(0);
</script>

<script>
document.getElementById('deviceForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let btn = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';

    let formData = new FormData(this);
    formData.append('add_device', '1');

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
    .then(async res => {
        const text = await res.text();
        try {
            return JSON.parse(text);
        } catch (err) {
            console.log(text);
            throw new Error("Invalid JSON");
        }
    })
    .then(data => {

        if (data.status === 'success') {

            document.querySelector('.card-body').innerHTML = `
              <div class="text-center p-3">
                <div class="mb-3">
                  <i class="bi bi-check-circle-fill text-success fs-1"></i>
                </div>

                <h5 class="fw-bold">Device Added</h5>

                <p class="text-muted">Energy Usage:</p>
                <h4 class="text-primary">${data.energy} kWh/day</h4>

                <div class="mt-4 d-grid gap-2">
                  <a class="btn btn-dark rounded-3" href="add_device">Add Another</a>
                  <a class="btn btn-outline-dark rounded-3" href="view_device">View Devices</a>
                </div>
              </div>
            `;

        } else {
            alert(data.message);
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-plus-circle me-1"></i> Add Device';
        }
    })
    .catch(err => {
        console.error(err);
        alert('Request failed');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-plus-circle me-1"></i> Add Device';
    });
});
</script>

<?php include "includes/home_footer_nav.php"; ?>

<!-- STYLE -->
<style>
body {
  background: #f6f8fb;
}

.card {
  transition: all 0.25s ease;
  border: none;
}

.card:hover {
  transform: translateY(-4px);
}

.form-control, .form-select {
  border: 1px solid #e6e6e6;
  box-shadow: none !important;
}

.form-control:focus, .form-select:focus {
  border-color: #0d6efd;
}

.icon-box {
  width: 70px;
  height: 70px;
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 18px;
  background: rgba(13,110,253,0.08);
}
</style>