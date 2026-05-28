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
// expects $pdo = new PDO(...)

if(isset($_POST['update_password'])){

    $email = $_POST['email'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $token = $_GET['token'] ?? '';

    if(!empty($token)){

        if(!empty($email) && !empty($new_password) && !empty($confirm_password)){

            try {
                // 1. CHECK TOKEN (FAST PREPARED QUERY)
                $stmt = $pdo->prepare("SELECT id, verify_token FROM register WHERE verify_token = :token LIMIT 1");
                $stmt->execute([':token' => $token]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if($user){

                    if($new_password === $confirm_password){

                        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]);
                        $new_token = md5(rand() . time()) . "electricsol";

                        // 2. TRANSACTION FOR SPEED + CONSISTENCY
                        $pdo->beginTransaction();

                        // UPDATE PASSWORD
                        $stmt1 = $pdo->prepare("
                            UPDATE register 
                            SET password = :password 
                            WHERE verify_token = :token
                        ");
                        $stmt1->execute([
                            ':password' => $hashedPassword,
                            ':token' => $token
                        ]);

                        // ROTATE TOKEN
                        $stmt2 = $pdo->prepare("
                            UPDATE register 
                            SET verify_token = :new_token 
                            WHERE verify_token = :token
                        ");
                        $stmt2->execute([
                            ':new_token' => $new_token,
                            ':token' => $token
                        ]);

                        $pdo->commit();

                        $_SESSION['status'] = "Password reset successful!";
                        header("Location: login");
                        exit;

                    } else {
                        $_SESSION['status'] = "Passwords do not match.";
                        header("Location: change-password?token=$token&email=$email");
                        exit;
                    }

                } else {
                    $_SESSION['status'] = "Invalid token.";
                    header("Location: change-password");
                    exit;
                }

            } catch(Exception $e){
                if($pdo->inTransaction()){
                    $pdo->rollBack();
                }

                $_SESSION['status'] = "System error. Try again.";
                header("Location: change-password?token=$token&email=$email");
                exit;
            }

        } else {
            $_SESSION['status'] = "All fields are required.";
            header("Location: change-password?token=$token&email=$email");
            exit;
        }

    } else {
        $_SESSION['status'] = "No token available.";
        header("Location: change-password");
        exit;
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