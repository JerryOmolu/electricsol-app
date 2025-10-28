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
    <a href="settings">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>




  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
<!--
      <div class="text-center px-4">
        <img class="login-intro-img" src="img/electrisol-img/update.png" alt="" width="150px">
      </div>
-->
<br>
      <!-- Register Form -->
      <div class="login-wrapper d-flex align-items-center justify-content-center py-4">
    <div class="custom-container p-4 rounded-4 shadow-sm" style="max-width: 450px; background-color: #fff; transition: all 0.3s ease;">
        <div class="text-center px-4 mb-4">
            <img class="login-intro-img" src="img/electrisol-img/update.png" alt="Update Password" width="120px">
        </div>

        <!-- Change Password Form -->
        <div class="register-form">
           <?php

// Ensure necessary session variables are available
$fullname = isset($_SESSION['fullname']) ? escape($_SESSION['fullname']) : '';
$phone = isset($_SESSION['phone']) ? escape($_SESSION['phone']) : '';

// Check if the change password form was submitted
if (isset($_POST['change_password'])) {
    // Get user inputs and sanitize
    $password = trim($_POST['password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Check if all fields are filled
    if (!empty($password) && !empty($new_password) && !empty($confirm_password)) {
        
        // Prepare a statement to fetch user details securely
        $stmt = $connection->prepare("SELECT * FROM register WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if the user exists
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $db_password = $row['password'];

            // Verify the current password
            if (password_verify($password, $db_password)) {
                
                // Check if new password matches confirm password
                if ($new_password === $confirm_password) {
                    // Hash the new password
                    $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]);

                    // Prepare a statement to update the password
                    $update_stmt = $connection->prepare("UPDATE register SET password = ? WHERE phone = ?");
                    $update_stmt->bind_param("ss", $hashedPassword, $phone);
                    $update_stmt->execute();

                    // Display success message
                    echo "<div class='alert custom-alert-two alert-success alert-dismissible fade show' role='alert'>
                            <i class='bi bi-check-circle'></i>
                            Password Changed Successfully!
                            <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
                } else {
                    // Error if new password and confirm password don't match
                    echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                            <i class='bi bi-x-circle'></i>
                            New Password and Confirm Password Do Not Match
                            <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
                }
            } else {
                // Error if current password is incorrect
                echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                        <i class='bi bi-x-circle'></i>
                        Current Password is Incorrect
                        <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }
        } else {
            echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                    <i class='bi bi-x-circle'></i>
                    User not found. Please try again.
                    <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }

        // Close statements
        $stmt->close();
    } else {
        echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                <i class='bi bi-x-circle'></i>
                All fields are required. Please fill out the form completely.
                <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}
?>

            <form action="" method="post">
                <h6 class="mb-4 text-center fw-bold">Change Your Password</h6>

                <!-- Current Password -->
                <div class="input-group mb-3 position-relative">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="Current Password" required>
                    <span class="password-toggle position-absolute top-50 end-0 translate-middle-y me-2">
                        <i class="bi bi-eye"></i>
                        <i class="bi bi-eye-slash d-none"></i>
                    </span>
                </div>

                <!-- New Password -->
                <div class="input-group mb-3 position-relative">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input class="form-control" type="password" name="new_password" placeholder="New Password" required>
                </div>

                <!-- Password Strength Meter -->
                <div id="pswmeter" class="mb-3"></div>

                <!-- Confirm New Password -->
                <div class="input-group mb-4 position-relative">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input class="form-control" type="password" name="confirm_password" placeholder="Confirm New Password" required>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit" name="change_password">Change Password</button>
            </form>
        </div>
    </div>
</div>

<style>
/* Card hover effect */
.custom-container:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

/* Input focus effect */
input.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 8px rgba(13,110,253,0.2);
}

/* Password toggle icons */
.password-toggle {
    cursor: pointer;
    font-size: 1.1rem;
    color: #6c757d;
}
.password-toggle i {
    transition: 0.2s;
}
.password-toggle:hover i {
    color: #0d6efd;
}
</style>

<script>
// Toggle password visibility
document.querySelectorAll('.password-toggle').forEach(function(toggle){
    toggle.addEventListener('click', function(){
        const input = this.parentElement.querySelector('input');
        const eye = this.querySelector('.bi-eye');
        const eyeSlash = this.querySelector('.bi-eye-slash');
        if(input.type === 'password'){
            input.type = 'text';
            eye.classList.add('d-none');
            eyeSlash.classList.remove('d-none');
        } else {
            input.type = 'password';
            eye.classList.remove('d-none');
            eyeSlash.classList.add('d-none');
        }
    });
});
</script>

    </div>
  </div>

  <!-- All JavaScript Files -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/internet-status.js"></script>
  <script src="js/dark-rtl.js"></script>
  <script src="js/pswmeter.js"></script>
  <script src="js/active.js"></script>
  <script src="js/pwa.js"></script>
</body>

</html>