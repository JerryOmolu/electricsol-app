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
</head>
<body>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-center">
                <center><img src="img/electrisol-img/Logo%206.png" alt="logo"></center>
              </div>
             
              <h4 class="font-weight-light">Update Your Password</h4>
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

if(isset($_POST['update'])){
	$email = escape($_POST['email']);
	$new_password = escape($_POST['new_password']);
	$confirm_password = escape($_POST['confirm_password']);
    $token = escape($_GET['token']);
	
    if(!empty($token)){
        if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
        
        //check if token exists
		$check_token = "SELECT verify_token FROM user WHERE verify_token='$token' LIMIT 1";
		$check_token_run = mysqli_query($connection, $check_token);
            if(mysqli_num_rows($check_token_run) > 0){
                
            if($new_password == $confirm_password){
               
            $hashedPassword= password_hash ($new_password, PASSWORD_BCRYPT, array('cost' => 10));

            $update_password = "UPDATE user SET password='$hashedPassword' WHERE verify_token='$token' LIMIT 1";
            $update_password_run = mysqli_query($connection, $update_password);
                
            if($update_password_run){
                $new_token = md5(rand())."electricsol";
				$update_to_new_token = "UPDATE user set verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
				$update_to_new_token_run = mysqli_query($connection, $update_to_new_token);
					
					$_SESSION['status'] = "Password Reset is successful!";
					header("Location: index");
					exit(0);           
            }else{
					$_SESSION['status'] = "Update Password failed. Something went wrong";
					header("Location: change_password?token=$token&email=$email");
					exit(0);
				}
                
            }else{
				
				$_SESSION['status'] = "New Password and Confirm Password does not match. Kindly re-enter";
				header("Location: change_password?token=$token&email=$email");
				exit(0);
			} 
                
            }else{
		$_SESSION['status'] = "Invalid Token";
		header("Location: change_password?token=$token&email=$email");
		exit(0);
		}
            
        }else{
		$_SESSION['status'] = "All fields are Mandatory";
		header("Location: change_password?token=$token&email=$email");
		exit(0);
		}
    }else{
		$_SESSION['status'] = "No Token Available";
		header("Location: change_password");
		exit(0);

}
}

?>
                
<!--End of Reset Password Code-->
                
            <form class="pt-3" action="" method="post">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter Email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" readonly>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter New Password" name="new_password" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Confirm New Password" name="confirm_password" required>
                </div>
                
                <div class="mt-3">
                  <button class="btn btn-primary btn-block" type="submit" name="update">Update Password</button>
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
