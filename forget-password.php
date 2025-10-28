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
require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

if(isset($_SESSION['status'])) {
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle"></i> '.$_SESSION['status'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['status']);
}

function send_reset_link($get_fullname, $get_phone, $token, $get_email) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'electricsol.com.ng';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@electricsol.com.ng';
        $mail->Password   = '@electric123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('info@electricsol.com.ng', 'Electricsol');
        $mail->addAddress($get_email, $get_fullname);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password Notification';
        $mail->Body = "
<html>
<head>
  <meta charset='UTF-8'>
  <title>Password Reset</title>
</head>
<body style='margin:0;padding:0;font-family:Arial,sans-serif;background-color:#f4f4f4;'>
  <table width='100%' cellpadding='0' cellspacing='0' border='0'>
    <tr>
      <td align='center'>
        <table width='600' cellpadding='0' cellspacing='0' border='0' style='background-color:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.1);margin:30px 0;'>
          <tr>
            <td style='background-color:#007bff;padding:30px;text-align:center;color:#ffffff;'>
              <h1 style='margin:0;font-size:26px;'>Hello, $get_fullname!</h1>
            </td>
          </tr>
          <tr>
            <td style='padding:30px;text-align:center;color:#333333;'>
              <p style='font-size:16px;line-height:1.5;'>We received a request to reset your password. If you didn’t request this, please ignore this email.</p>
              <p style='margin:30px 0;'>
                <a href='http://localhost/electricsol/change-password?token=$token&email=$get_email' 
                   style='display:inline-block;background-color:#007bff;color:#ffffff;font-weight:bold;text-decoration:none;padding:12px 25px;border-radius:5px;font-size:16px;'>
                   Reset Password
                </a>
              </p>
              <p style='font-size:14px;color:#555555;'>Need help? Call us at <b>07039000386</b></p>
            </td>
          </tr>
          <tr>
            <td style='padding:15px;text-align:center;background-color:#f4f4f4;color:#999999;font-size:12px;'>
              &copy; ".date('Y')." Electricsol. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
";


        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}

if (isset($_POST['submit'])) {
    $email = escape($_POST['email']);
    $token = md5(rand());
    $check_email = "SELECT * FROM register WHERE email = '$email' LIMIT 1";
    $check_email_run = mysqli_query($connection, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $get_fullname = escape($row['fullname']);
        $get_phone = escape($row['phone']);
        $get_email = escape($row['email']);

        $update_token = "UPDATE register SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($connection, $update_token);

        if ($update_token_run) {
            if (send_reset_link($get_fullname, $get_phone, $token, $get_email)) {
                $_SESSION['status'] = "Password Reset link has been sent. Please check your email.";
            } else {
                $_SESSION['status'] = "Email sending failed. Please try again.";
            }
            header("Location: forget-password");
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong. Please try again.";
            header("Location: forget-password");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Email not found in our records.";
        header("Location: forget-password");
        exit(0);
    }
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