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
<div class="login-back-button position-absolute m-3">
  <a href="login" class="btn btn-outline-dark btn-sm rounded-circle shadow-sm">
    <i class="bi bi-arrow-left-short fs-4"></i>
  </a>
</div>

<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100">
  <div class="custom-container w-100" style="max-width: 450px;">
    
    <!-- Page Icon -->
    <div class="text-center px-4">
      <img class="login-intro-img mb-3" src="img/electrisol-img/update.png" alt="Update Password" width="120">
      <h5 class="fw-bold">Reset Your Password</h5>
      <p class="text-muted small">Please enter a new password for your account.</p>
    </div>

    <!-- Status Alert -->
    <?php if(isset($_SESSION['status'])): ?>
      <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
        <?= $_SESSION['status']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php unset($_SESSION['status']); endif; ?>

    <!-- Register Form -->
    <div class="register-form mt-4 card shadow-sm border-0">
      <div class="card-body">
        <?php
        include 'includes/db.php';

        if(isset($_POST['update_password'])){
          $email = escape($_POST['email']);
          $new_password = escape($_POST['new_password']);
          $confirm_password = escape($_POST['confirm_password']);
          $token = escape($_GET['token']);

          if(!empty($token)){
            if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
              // check token
              $check_token = "SELECT verify_token FROM register WHERE verify_token='$token' LIMIT 1";
              $check_token_run = mysqli_query($connection, $check_token);

              if(mysqli_num_rows($check_token_run) > 0){
                if($new_password == $confirm_password){
                  $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]);

                  $update_password = "UPDATE register SET password='$hashedPassword' WHERE verify_token='$token' LIMIT 1";
                  $update_password_run = mysqli_query($connection, $update_password);

                  if($update_password_run){
                    $new_token = md5(rand())."electricsol";
                    $update_to_new_token = "UPDATE register SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                    mysqli_query($connection, $update_to_new_token);

                    $_SESSION['status'] = "Password reset successful!";
                    header("Location: login");
                    exit(0);
                  } else {
                    $_SESSION['status'] = "Update failed. Try again.";
                    header("Location: change-password?token=$token&email=$email");
                    exit(0);
                  }
                } else {
                  $_SESSION['status'] = "Passwords do not match.";
                  header("Location: change-password?token=$token&email=$email");
                  exit(0);
                }
              } else {
                $_SESSION['status'] = "Invalid token.";
                header("Location: change-password");
                exit(0);
              }
            } else {
              $_SESSION['status'] = "All fields are required.";
              header("Location: change-password?token=$token&email=$email");
              exit(0);
            }
          } else {
            $_SESSION['status'] = "No token available.";
            header("Location: change-password");
            exit(0);
          }
        }
        ?>

        <!-- Form -->
        <form action="" method="post">
          <h6 class="mb-3 text-center fw-semibold">Update your password</h6>

          <!-- Email -->
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input class="form-control" type="email" name="email"
              value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" readonly>
          </div>

          <!-- New Password -->
          <div class="input-group mb-3 position-relative">
            <span class="input-group-text"><i class="fa fa-unlock-alt"></i></span>
            <input class="form-control" type="password" id="new_password" name="new_password" placeholder="New Password" required>
            <span class="toggle-password position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor:pointer;">
              <i class="bi bi-eye" id="toggleNewPassword"></i>
            </span>
          </div>

          <!-- Password Strength Meter -->
          <div class="mb-3" id="pswmeter"></div>

          <!-- Confirm Password -->
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa fa-unlock-alt"></i></span>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm New Password" required>
          </div>

          <!-- Submit Button -->
          <button class="btn btn-primary w-100" type="submit" name="update_password">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- All JavaScript Files -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/internet-status.js"></script>
<script src="js/dark-rtl.js"></script>
<script src="js/pswmeter.js"></script>
<script src="js/active.js"></script>
<script src="js/pwa.js"></script>

<script>
  // Toggle password visibility
  const toggleNewPassword = document.querySelector("#toggleNewPassword");
  const newPasswordInput = document.querySelector("#new_password");
  toggleNewPassword.addEventListener("click", function () {
    const type = newPasswordInput.getAttribute("type") === "password" ? "text" : "password";
    newPasswordInput.setAttribute("type", type);
    this.classList.toggle("bi-eye-slash");
  });
</script>
</body>
</html>
