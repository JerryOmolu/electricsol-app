<?php include "includes/admin_header.php"; ?>
<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home');
}

?>

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
                  <p class="card-title">ADD NEW ADMIN USER</p>
                <hr>
                  <div class="row">
            <div class="col-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
<!--Add User Code-->
<?php 
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

		require 'vendor/autoload.php';

		function sendemail_verify($username,$email,$verify_token){
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
    <title>Email Verification</title>
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
        h3 {
            font-weight: 400;
            line-height: 1.5;
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
    </style>
</head>
<body>
    <div class='email-container'>
        <h2>You are now registered with Electricsol as a Backend User</h2>
        <h3>Your Username: <strong>$username</strong></h3>
        <h3>Please verify your email address to login using the link below:</h3>
        <a class='btn-verify' href='http://localhost/electricsol/admin/verify_email?token=$verify_token&email=$email&username=$username'>Verify Email</a>
    </div>
</body>
</html>
";


		$mail->Body    = $email_template;
		$mail->send();
		}
  
					
        if(isset($_POST['add_user'])){
            $name = escape($_POST['name']);
            $username = escape($_POST['username']);
            $email = escape($_POST['email']);
            $phone = escape($_POST['phone']);
            $gender = escape($_POST['gender']);
            $password = escape($_POST['password']);
            $role = escape($_POST['role']);
            $verify_token = md5(rand());
						
	$password= password_hash ($password, PASSWORD_BCRYPT, array('cost' => 10));
                       
		$errors = array();
    
        $e = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
        $ee = mysqli_query($connection,$e);
    
        if(empty($email)){
            $errors['e'] = "Email Cannot be Empty, Please Enter email address";
        }else if(mysqli_num_rows($ee) > 0){
            $errors['e'] = "Email already exists for another User";
        }
		
		$u = "SELECT username FROM user WHERE username = '$username' LIMIT 1";
        $uu = mysqli_query($connection,$u);
    
        if(empty($username)){
            $errors['u'] = "Username Cannot be Empty, Please Enter a Username";
        }else if(mysqli_num_rows($uu) > 0){
            $errors['u'] = "Username Already Exists";
        }
		
		$p = "SELECT phone FROM user WHERE phone = '$phone' LIMIT 1";
        $pp = mysqli_query($connection,$p);
    
        if(empty($phone)){
            $errors['p'] = "Phone Number Cannot be Empty, Please Enter a Phone Number";
        }else if(mysqli_num_rows($pp) > 0){
            $errors['p'] = "Phone Number Already Exists.";
        }				
		
            if(isset($_SESSION['fullname'])){
            $fullname = escape($_SESSION['fullname']);
            }
		
		if(count($errors)==0 && !empty ($name) && !empty ($username) && !empty ($email) && !empty ($phone) && !empty ($gender) && !empty ($password) && !empty ($role)){

	$query = "INSERT INTO user (fullname,username,email,phone,gender,password,role,added_on,added_by,verify_token)VALUES('{$name}','{$username}','{$email}','{$phone}','{$gender}','{$password}','{$role}',now(),'{$fullname}','{$verify_token}')";
                        
    $add_new_user = mysqli_query($connection, $query);
	
		if($add_new_user){
			
			sendemail_verify("$username","$email","$verify_token");
			
			echo " <div class='alert alert-success'><b>User Registered Successfully &nbsp;&nbsp;&nbsp;<a href='view_users'><button class='btn btn-success'>View Users</button></a></b></div>";
			
		}
		else{

			echo " <div class='alert alert-danger'>Registration not successful</div>";
		}
     
                    }
					}
                ?>
                    
<!--End of Add User Code-->
                    
                    
                    
                    
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Full Name" name="name" maxlength="50" autocomplete="off" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUserName1">Username</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Prefered Username" name="username" maxlength="50" autocomplete="off" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
                    <b><p class="text-danger"><?php if(isset($errors['u']))echo $errors['u']; ?></p></b>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email Address" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                    <b><p class="text-danger"><?php if(isset($errors['e']))echo $errors['e']; ?></p></b>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPhone">Phone Number</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Phone Number" name="phone" maxlength="11" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" required>
                    <b><p class="text-danger"><?php if(isset($errors['p']))echo $errors['p']; ?></p></b>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender" name="gender" required>
                          <option value="">-Select Gender-</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">User Role</label>
                      <select class="form-control" id="exampleSelectRole" name="role" required>
                          <option value="">-Select Role-</option>
                          <option value="Admin">Admin</option>
                          <option value="Operator">Operator</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block col-6 mr-2" name="add_user"><i class="fa fa-floppy-o" aria-hidden="true"></i> Add User</button>
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
