<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  

<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
<?php include "includes/welcome.php"; ?>   

<!--    Main Content Wrapper-->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">RESEND VERIFICATION LINK</p><hr>
                  <div class="row">
            <div class="col-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
<!--Add User Code-->
<?php 
use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

		require 'vendor/autoload.php';

		function resend_email_verify($username,$email,$verify_token){
		$mail = new PHPMailer(true);

		$mail->isSMTP(); 
		$mail->SMTPAuth   = true; 
		$mail->Host       = 'electricsol.com.ng'; 
		$mail->Username   = 'info@electricsol.com.ng';                     //SMTP username
		$mail->Password   = '@electric123';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465; 
		$mail->setFrom('info@electricsol.com.ng', 'Electricsol');
		$mail->addAddress($email); 
		$mail->isHTML(true);
		$mail->Subject = 'Email Verification link from Electricsol';

		$email_template = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Electricsol Backend User Registration</title>
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
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #0d6efd;
            margin-bottom: 15px;
        }
        h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .btn-verify {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff !important;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
        }
        .btn-verify:hover {
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
        <h2>Welcome to Electricsol!</h2>
        <h3>Your Backend Username: <strong>$username</strong></h3>
        <h3>To start using your account, please verify your email address:</h3>
        <a class='btn-verify' href='http://localhost/electricsol/admin/verify_email?token=$verify_token&email=$email&username=$username'>Verify Email</a>
        <p class='note'>If you did not register, please ignore this email.</p>
    </div>
</body>
</html>
";


		$mail->Body    = $email_template;
		$mail->send();
		}
if(isset($_POST['resend'])){
	
	if(!empty($_POST['email'])){
		
	$email = escape($_POST['email']);

	//check if email exists
	$query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
	$check_email_query = mysqli_query($connection, $query);
	
	if(mysqli_num_rows($check_email_query) > 0){
	
		$row = mysqli_fetch_array($check_email_query);
		if($row['verify_status'] == "0"){
			
			$username = escape($row['username']);
			$email = escape($row['email']);
			$verify_token = escape($row['verify_token']);
			
			resend_email_verify($username,$email,$verify_token);
			
			echo "<div class='alert alert-success'>Verification Email has been sent successfully</div>";

	}else{
			echo "<div class='alert alert-warning'>Email already verified.</div>";
		}
	
}else{
		echo "<div class='alert alert-danger'>Email is not registered. Please register email</div>";
	}
	}else{
		echo "<div class='alert alert-danger'>Email cannot be empty</div>";
	}
}
                ?>
                    
<!--End of Add User Code-->
                    
                    
                    
                    
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                     
                    <div class="form-group">
                    <div class="input-group">
                      <input type="email" class="form-control" placeholder="Recipient's Email Address" aria-label="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit" name="resend">Resend Link</button>
                      </div>
                    </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
