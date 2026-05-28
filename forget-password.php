<?php include "includes/header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Back Button-->
  <div class="login-back-button">
    <a href="login">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div class="custom-container shadow-lg rounded-4 p-4 bg-white" style="max-width: 450px; width: 100%;">
    
    <!-- Intro -->
    <div class="text-center mb-4">
      <img class="login-intro-img" src="img/electrisol-img/forgot.png" alt="Reset Password" width="100px">
      <h5 class="mt-3 fw-bold">Reset Your Password</h5>
      <p class="text-muted small">Enter your registered email and we’ll send you a reset link.</p>
    </div>

    <!-- Reset Password Code -->
    <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Session message display
if (isset($_SESSION['status'])) {
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle"></i> ' . $_SESSION['status'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['status']);
}

/* =========================
   EMAIL FUNCTION (UNCHANGED)
========================= */
function send_reset_link($get_fullname, $get_phone, $token, $get_email) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'electricsol.com.ng';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@electricsol.com.ng';
        $mail->Password   = '@electric123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('info@electricsol.com.ng', 'Electricsol');
        $mail->addAddress($get_email, $get_fullname);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password Notification';

        $mail->Body = "
<html>
<body>
  <div style='font-family:Arial;background:#f4f4f4;padding:20px'>
    <div style='max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden'>
      <div style='background:#007bff;color:#fff;padding:25px;text-align:center'>
        <h2>Hello, $get_fullname</h2>
      </div>
      <div style='padding:25px;text-align:center'>
        <p>We received a request to reset your password.</p>
        <a href='http://localhost/electricsol/change-password?token=$token&email=$get_email'
           style='display:inline-block;margin-top:20px;padding:12px 25px;background:#007bff;color:#fff;text-decoration:none;border-radius:5px'>
           Reset Password
        </a>
      </div>
    </div>
  </div>
</body>
</html>";

        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Mail error: " . $mail->ErrorInfo);
        return false;
    }
}

/* =========================
   RESET LOGIC (PDO OPTIMIZED)
========================= */

if (isset($_POST['submit'])) {

    $email = trim($_POST['email'] ?? '');
    $token = bin2hex(random_bytes(16)); // faster + more secure than md5(rand())

    try {

        // 1. Check user (FAST + INDEX FRIENDLY)
        $stmt = $pdo->prepare("SELECT fullname, phone, email 
                               FROM register 
                               WHERE email = :email 
                               LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            // 2. Update token (single indexed query)
            $update = $pdo->prepare("UPDATE register 
                                     SET verify_token = :token 
                                     WHERE email = :email 
                                     LIMIT 1");

            $updated = $update->execute([
                ':token' => $token,
                ':email' => $email
            ]);

            if ($updated) {

                if (send_reset_link($user['fullname'], $user['phone'], $token, $user['email'])) {
                    $_SESSION['status'] = "Password reset link sent successfully.";
                } else {
                    $_SESSION['status'] = "Email sending failed. Try again.";
                }

            } else {
                $_SESSION['status'] = "System error occurred. Try again.";
            }

        } else {
            $_SESSION['status'] = "No account found with this email.";
        }

    } catch (PDOException $e) {
        error_log("PDO error: " . $e->getMessage());
        $_SESSION['status'] = "Error: " . $e->getMessage();
    }

    header("Location: forget-password");
    exit;
}
?>

    <!-- End Reset Password Code -->

    <!-- Reset Form -->
    <form action="" method="post">
      <div class="input-group mb-3">
        <span class="input-group-text bg-primary text-white" id="basic-addon1">
          <i class="bi bi-envelope"></i>
        </span>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary w-100">
        <i class="bi bi-arrow-clockwise"></i> Reset Password
      </button>
    </form>

    <!-- Extra Links -->
    <div class="text-center mt-4">
      <a href="login" class="text-decoration-none small"><i class="bi bi-arrow-left"></i> Back to Login</a>
    </div>
  </div>
</div>


  <!-- All JavaScript Files -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/slideToggle.min.js"></script>
  <script src="js/internet-status.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/venobox.min.js"></script>
  <script src="js/countdown.js"></script>
  <script src="js/rangeslider.min.js"></script>
  <script src="js/vanilla-dataTables.min.js"></script>
  <script src="js/index.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/dark-rtl.js"></script>
  <script src="js/active.js"></script>
  <script src="js/pwa.js"></script>
</body>

</html>