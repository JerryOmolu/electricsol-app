<?php include "includes/header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Back Button -->
  <div class="login-back-button">
    <a href="login">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div class="custom-container p-4 rounded shadow-sm" style="max-width: 400px; width: 100%;">
    
    <!-- Header -->
    <div class="text-center mb-4">
      <img src="img/electrisol-img/verify.png" alt="Verify" width="150" class="mx-auto d-block mb-3">
      <h3 class="fw-bold">Verify Your Registration</h3>
      <p class="text-muted mb-0">Enter the OTP code sent to your email</p>
    </div>
    
    <!-- OTP Verify Form -->
    <div class="otp-verify-form mt-4">

      <!-- Verification Logic -->
      <?php
      include 'includes/db.php';

      if(isset($_POST['verify'])) {
          $token = $_GET['token'];
          $phone = $_GET['phone'];
          $one = escape($_POST['one']);
          $two = escape($_POST['two']);
          $three = escape($_POST['three']);
          $four = escape($_POST['four']);
          $five = escape($_POST['five']);
          $six = escape($_POST['six']);
          
          $verify_token = $one.$two.$three.$four.$five.$six;
          
          $verify_query = "SELECT verify_token, verify_status FROM register WHERE verify_token='$token' LIMIT 1";
          $verify_query_run = mysqli_query($connection, $verify_query);
          
          if(mysqli_num_rows($verify_query_run) > 0){
              $row = mysqli_fetch_array($verify_query_run);
              if($row['verify_status'] == "0"){
                  $update_query = "UPDATE register SET verify_status='1' WHERE verify_token='$verify_token' LIMIT 1";
                  $update_query_run = mysqli_query($connection, $update_query);
                  if($update_query_run){
                      $_SESSION['status'] = "Verification Successful! Please Sign In";
                      header("Location: login");
                      exit(0);
                  } else {
                      $_SESSION['status'] = "Verification Failed";
                      header("Location: login");
                      exit(0);
                  }
              } else {
                  $_SESSION['status'] = "Account already Verified. Please Sign In";
                  header("Location: login");
              }
          } else {
              $_SESSION['status'] = "This token does not exist";
              header("Location: login");
          }
      }
      ?>

      <!-- OTP Input Form -->
      <form action="" method="post" class="mt-3">
        <div class="d-flex justify-content-between mb-3 otp-input-group">
          <?php for($i=1; $i<=6; $i++): ?>
            <input type="text" name="<?php echo ['one','two','three','four','five','six'][$i-1]; ?>" maxlength="1" class="form-control text-center fs-5 mx-1 otp-input" placeholder="-" required>
          <?php endfor; ?>
        </div>
        <button type="submit" name="verify" class="btn btn-primary w-100 fw-semibold">Verify &amp; Proceed</button>
      </form>
    </div>

    <!-- Resend OTP -->
    <div class="login-meta-data text-center mt-3">
      <p class="text-muted mb-0">
        Didn't receive OTP? <span class="otp-sec text-primary cursor-pointer" id="resendOTP">Resend</span>
      </p>
    </div>
  </div>
</div>

<style>
  .otp-input-group input {
    width: 45px;
    height: 55px;
    font-size: 1.5rem;
    text-align: center;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: border-color 0.2s;
  }

  .otp-input-group input:focus {
    border-color: #0d6efd;
    outline: none;
    box-shadow: 0 0 3px rgba(13, 110, 253, 0.3);
  }

  .cursor-pointer {
    cursor: pointer;
  }
</style>

<script>
  // Optional: auto-focus next input
  const inputs = document.querySelectorAll('.otp-input');
  inputs.forEach((input, idx) => {
    input.addEventListener('input', () => {
      if(input.value.length === 1 && idx < inputs.length - 1){
        inputs[idx + 1].focus();
      }
    });
    input.addEventListener('keydown', (e) => {
      if(e.key === 'Backspace' && idx > 0 && !input.value){
        inputs[idx - 1].focus();
      }
    });
  });
</script>


  <!-- All JavaScript Files -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/internet-status.js"></script>
  <script src="js/dark-rtl.js"></script>
  <script src="js/otp-timer.js"></script>
  <script src="js/otp-input-switch.js"></script>
  <script src="js/active.js"></script>
  <script src="js/pwa.js"></script>
</body>

</html>