<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Electricsol-Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <!-- Favicon -->
    <link rel="icon" href="favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
<!--Font Awesome-->
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
<!--Reset Password Code-->
  <?php
	if(isset($_SESSION['status'])){
		
	?>
	<div class="alert alert-success">
		<h5><?= $_SESSION['status']; ?></h5>
	</div>
	<?php
	unset($_SESSION['status']);
	}
?>
                     
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
            
function send_reset_link($get_fullname,$get_phone,$token,$get_email){
$mail = new PHPMailer(true);

$mail->isSMTP(); 
$mail->SMTPAuth   = true; 
$mail->Host       = 'electricsol.com.ng'; 
$mail->Username   = 'info@electricsol.com.ng';                     //SMTP username
$mail->Password   = '@electric123';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465; 
$mail->setFrom('info@electricsol.com.ng', 'Electricsol');
$mail->addAddress($get_email); 
$mail->isHTML(true);
$mail->Subject = 'Reset Password Notification';

$email_template = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Password Reset</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #0d6efd;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .btn-reset {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff !important;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-reset:hover {
            background-color: #0b5ed7;
        }
        .note {
            font-size: 14px;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class='email-container'>
        <h2>Password Reset Request</h2>
        <p>Hello,</p>
        <p>You are receiving this email because we received a password reset request for your account. If you did not request this, please ignore this email.</p>
        <a class='btn-reset' href='http://localhost/electricsol/admin/change_password?token=$token&email=$get_email'>Reset Password</a>
        <p class='note'>This password reset link will expire in 60 minutes.</p>
    </div>
</body>
</html>
";


$mail->Body    = $email_template;
$mail->send();
}

if(isset($_POST['reset'])){
	
	$email = escape($_POST['email']);
	$token = md5(rand());
	
	$check_email = "SELECT * FROM user WHERE email ='$email' LIMIT 1";
	$check_email_run = mysqli_query($connection, $check_email);
	
	if(mysqli_num_rows($check_email_run) > 0){
		
		$row = mysqli_fetch_array($check_email_run);
		$get_fullname = escape($row['fullname']);
        $get_phone = escape($row['phone']);
		$get_email = escape($row['email']);
		
$update_token = "UPDATE user SET verify_token='$token' WHERE email='$get_email' LIMIT 1"; 
$update_token_run = mysqli_query($connection, $update_token);
		
		if($update_token_run){
			
            send_reset_link("$get_fullname","$get_phone","$token","$get_email");
			$_SESSION['status'] = "Password Reset link has been sent. Please check your email";
			header("Location: forgot_password");
			exit(0);
			
		}else{
		$_SESSION['status'] = "Something went wrong #1";
		header("Location: forgot_password");
		exit(0);
		}
	}else{
		$_SESSION['status'] = "Email not found";
		header("Location: forgot_password");
		exit(0);	
	}
	
}			  

?>                 
    
                
<!--End of Reset Password Code-->
                
            <form class="pt-3" action="" method="post">
                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                      </div>
                      <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter Email Address" name="email" required>
                    </div>
                  </div>
                
                <div class="mt-3">
                  <button class="btn btn-primary btn-block" type="submit" name="reset">Reset Password</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
