<?php ob_start(); ?>
<?php include "includes/db.php"; ?>
<?php session_start(); ?>
<?php include "includes/functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Electricsol-Admin</title>

  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">

  <link rel="stylesheet" href="css/vertical-layout-light/style.css">

  <link rel="icon" href="favicon/favicon.ico">

  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>

<body>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">

            <div class="brand-logo align-center">
              <center><a href="index.php"><img src="img/electrisol-img/Logo%206.png" alt="logo"></a></center>
            </div>

            <h4 class="font-weight-light"><b>Reset Your Password</b></h4>

            <?php if(isset($_SESSION['status'])): ?>
              <div class="alert alert-success">
                <h5><?= $_SESSION['status']; ?></h5>
              </div>
              <?php unset($_SESSION['status']); ?>
            <?php endif; ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/* =========================
   EMAIL SENDER FUNCTION
========================= */
function send_reset_link($get_fullname, $get_phone, $token, $get_email)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'electricsol.com.ng';
        $mail->Username   = 'info@electricsol.com.ng';
        $mail->Password   = '@electric123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('info@electricsol.com.ng', 'Electricsol');
        $mail->addAddress($get_email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password Notification';

        $resetLink = "http://localhost/electricsol/admin/change_password?token=$token&email=$get_email";

        $mail->Body = "
        <div style='font-family: Arial; padding:20px; background:#f8f9fa'>
            <div style='max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:10px;text-align:center'>
                <h2 style='color:#0d6efd'>Password Reset Request</h2>
                <p>Hello,</p>
                <p>We received a request to reset your password. Ignore if not you.</p>
                <a href='$resetLink' style='display:inline-block;padding:12px 25px;background:#0d6efd;color:#fff;text-decoration:none;border-radius:5px'>
                    Reset Password
                </a>
                <p style='font-size:12px;color:#777;margin-top:20px'>
                    Link expires in 60 minutes.
                </p>
            </div>
        </div>";

        $mail->send();

    } catch (Exception $e) {
        // silently fail or log error
    }
}

/* =========================
   RESET HANDLER (PDO OPTIMIZED)
========================= */
if (isset($_POST['reset'])) {

    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(32)); // faster & more secure than md5(rand())

    try {

        // FAST CHECK (indexed email lookup)
        $stmt = $pdo->prepare("SELECT fullname, phone, email FROM user WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            // UPDATE TOKEN (single indexed query)
            $update = $pdo->prepare("UPDATE user SET verify_token = ? WHERE email = ? LIMIT 1");
            $ok = $update->execute([$token, $email]);

            if ($ok) {

                send_reset_link(
                    $user['fullname'],
                    $user['phone'],
                    $token,
                    $user['email']
                );

                $_SESSION['status'] = "Password reset link has been sent. Please check your email.";
                header("Location: forgot_password");
                exit;

            } else {
                $_SESSION['status'] = "Something went wrong #1";
                header("Location: forgot_password");
                exit;
            }

        } else {
            $_SESSION['status'] = "Email not found";
            header("Location: forgot_password");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['status'] = "Database error occurred";
        header("Location: forgot_password");
        exit;
    }
}
?>

<!-- =========================
     FORM (UNCHANGED UI)
========================= -->
<form class="pt-3" action="" method="post">
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
      </div>
      <input type="email" class="form-control form-control-lg"
             placeholder="Enter Email Address"
             name="email" required>
    </div>
  </div>

  <div class="mt-3">
    <button class="btn btn-primary btn-block" type="submit" name="reset">
      Reset Password
    </button>
  </div>
</form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../../vendors/js/vendor.bundle.base.js"></script>
<script src="../../js/off-canvas.js"></script>
<script src="../../js/hoverable-collapse.js"></script>
<script src="../../js/template.js"></script>
<script src="../../js/settings.js"></script>
<script src="../../js/todolist.js"></script>

</body>
</html>