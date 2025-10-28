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
    <a href="index">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
      <div class="text-center px-4">
        <img class="login-intro-img" src="img/electrisol-img/register-2.png" alt="" width="100px">
      </div>
    
<!--Register Code-->
<?php
        
include 'includes/db.php';

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

		require 'vendor/autoload.php';

		function sendemail_verify($name,$email,$phone){
		$mail = new PHPMailer(true);

		$mail = new PHPMailer(true);

		$mail->isSMTP(); 
		$mail->SMTPAuth   = true; 
		$mail->Host       = 'electricsol.com.ng'; 
		$mail->Username   = 'info@electricsol.com.ng';     //SMTP username
		$mail->Password   = '@electric123';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465; 
		$mail->setFrom('info@electricsol.com.ng', 'Electricsol');
		$mail->addAddress($email); 
		$mail->isHTML(true);
		$mail->Subject = 'Artisan Registration Confirmation from Electricsol';

		$email_template = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Welcome Email</title>
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
        }
        h2 {
            color: #0d6efd;
            margin-bottom: 20px;
        }
        h3 {
            font-weight: 400;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class='email-container text-center'>
        <h2>Welcome, $name!</h2>
        <h3>We're thrilled to have you on board! Get ready to connect with one of the largest client bases in Africa. We're here to support you every step of the way.</h3>
    </div>
</body>
</html>
";

            
		$mail->Body    = $email_template;
		$mail->send();
		}        
        
        
        
	if(isset($_POST['register'])){
            $name = escape($_POST['name']);
            $gender = escape($_POST['gender']);
            $birth = escape($_POST['birth']);
            $email = escape($_POST['email']);
            $phone = escape($_POST['phone']);
            $state = escape($_POST['state']);
            $lga = escape($_POST['lga']);
            $address = escape($_POST['address']);
            $experience = escape($_POST['experience']);
        
//        Services
        $checkbox1 = $_POST['services'];

        $chk="";  
        foreach($checkbox1 as $chk1)  
        {  
        $chk .= $chk1.",";  
        }
        
//Cerificate
        $checkbox2 = $_POST['certificate'];

        $check="";  
        foreach($checkbox2 as $chk2)  
        {  
        $check .= $chk2.",";  
        }
        
        $errors = array();
    
        $e = "SELECT email FROM artisan WHERE email = '$email' LIMIT 1";
        $ee = mysqli_query($connection,$e);
    
        if(empty($email)){
            $errors['e'] = "Email Cannot be Empty, Please Enter email address";
        }else if(mysqli_num_rows($ee) > 0){
            $errors['e'] = "Email Address already exists for another Artisan";
        }
		
		
		$p = "SELECT phone FROM artisan WHERE phone = '$phone' LIMIT 1";
        $pp = mysqli_query($connection,$p);
    
        if(empty($phone)){
            $errors['p'] = "Phone Number Cannot be Empty, Please Enter a Phone Number";
        }else if(mysqli_num_rows($pp) > 0){
            $errors['p'] = "Phone Number already exists for another Artisan.";
        }	
        
        if(count($errors)==0 && !empty ($name) && !empty ($gender) && !empty ($birth) && !empty ($email) && !empty ($phone) && !empty ($state) && !empty ($lga) && !empty ($address) && !empty ($experience) && !empty ($chk) && !empty ($check)){
            
           $query = "INSERT INTO artisan (name,gender,date_of_birth,email,phone,state,lga,address,skills,certificate,years,added_on)VALUES('{$name}','{$gender}','{$birth}','{$email}','{$phone}','{$state}','{$lga}','{$address}','{$chk}','{$check}','{$experience}',now())";
            
        $register_new_artisan = mysqli_query($connection, $query);
            
            if($register_new_artisan){
                
                sendemail_verify("$name","$email","$phone");
                
                $_SESSION['head'] = "Thank You!";
                $_SESSION['status'] = "Your registration as an Artisan with Electricsol is successful.";
                $_SESSION['status_code'] = "success";
                }
                else{
                $_SESSION['head'] = "Error!";
                $_SESSION['status'] = "Something Went Wrong";
                $_SESSION['status_code'] = "error";
                header('Location:artisan_register.php');
            }
        }
        
        
    }
    
                ?>        
      
      
<!--End of Register Code-->
      <!-- Register Form -->
      <div class="register-form mt-5 p-4 shadow-sm rounded bg-white">
    <h5 class="mb-4 text-center fw-bold">Artisan Registration</h5>
    
    <div class="divider border-dark mb-4"></div>

    <form action="" method="post" enctype="multipart/form-data">

        <!-- Personal Information -->
        <h6 class="text-center fw-semibold mb-3">Personal Information</h6>

        <div class="form-group mb-3">
            <label for="Fullname" class="form-label fw-bold text-dark">Fullname</label>
            <input class="form-control" type="text" placeholder="Enter Your Full Name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="Gender" class="form-label fw-bold text-dark">Gender</label>
                <select name='gender' id='gender' class='form-select' required>
                    <option value='' selected>-Select Gender-</option>
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="Date of Birth" class="form-label fw-bold text-dark">Date of Birth</label>
                <input class="form-control" type="date" name="birth" value="<?php echo isset($_POST['birth']) ? $_POST['birth'] : '' ?>" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="Email Address" class="form-label fw-bold text-dark">Email Address</label>
            <input class="form-control" type="email" placeholder="Enter Your Email address" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
            <small class="text-danger"><?php if(isset($errors['e'])) echo $errors['e']; ?></small>
        </div>

        <div class="form-group mb-3">
            <label for="Phone Number" class="form-label fw-bold text-dark">Phone Number</label>
            <input class="form-control" type="text" placeholder="Enter Your Phone Number" name="phone" maxlength="11" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" required>
            <small class="text-danger"><?php if(isset($errors['p'])) echo $errors['p']; ?></small>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="State of Origin" class="form-label fw-bold text-dark">State of Origin</label>
                <select onchange='toggleLGA(this);' name='state' id='state' class='form-select' required>
                    <option value='' selected>-Select State of Origin-</option>
                    <!-- States list -->
                    <option value='Abia'>Abia</option>
                    <option value='Adamawa'>Adamawa</option>
                    <option value='AkwaIbom'>AkwaIbom</option>
                    <option value='Anambra'>Anambra</option>
                    <option value='Bauchi'>Bauchi</option>
                    <option value='Bayelsa'>Bayelsa</option>
                    <option value='Benue'>Benue</option>
                    <option value='Borno'>Borno</option>
                    <option value='Cross River'>Cross River</option>
                    <option value='Delta'>Delta</option>
                    <option value='Ebonyi'>Ebonyi</option>
                    <option value='Edo'>Edo</option>
                    <option value='Ekiti'>Ekiti</option>
                    <option value='Enugu'>Enugu</option>
                    <option value='FCT'>FCT</option>
                    <option value='Gombe'>Gombe</option>
                    <option value='Imo'>Imo</option>
                    <option value='Jigawa'>Jigawa</option>
                    <option value='Kaduna'>Kaduna</option>
                    <option value='Kano'>Kano</option>
                    <option value='Katsina'>Katsina</option>
                    <option value='Kebbi'>Kebbi</option>
                    <option value='Kogi'>Kogi</option>
                    <option value='Kwara'>Kwara</option>
                    <option value='Lagos'>Lagos</option>
                    <option value='Nasarawa'>Nasarawa</option>
                    <option value='Niger'>Niger</option>
                    <option value='Ogun'>Ogun</option>
                    <option value='Ondo'>Ondo</option>
                    <option value='Osun'>Osun</option>
                    <option value='Oyo'>Oyo</option>
                    <option value='Plateau'>Plateau</option>
                    <option value='Rivers'>Rivers</option>
                    <option value='Sokoto'>Sokoto</option>
                    <option value='Taraba'>Taraba</option>
                    <option value='Yobe'>Yobe</option>
                    <option value='Zamfara'>Zamfara</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="LGA" class="form-label fw-bold text-dark">LGA</label>
                <select name='lga' id='lga' class='form-select select-lga' required></select>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="Contact Address" class="form-label fw-bold text-dark">Precise Location</label>
            <input class="form-control" type="text" placeholder="Enter Your Contact Address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" required>
            <small class="text-danger">**Ensure you enter your precise location for easy search**</small>
        </div>

        <div class="divider border-dark mb-4"></div>

        <!-- Skills & Expertise -->
        <h6 class="text-center fw-semibold mb-3">Skills and Expertise</h6>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td><input type="checkbox" name="services[]" value="Electrical Appliances Installation" /> Electrical Appliances Installation</td>
                    <td><input type="checkbox" name="services[]" value="Solar Panel Installation and Maintenance" /> Solar Panel Installation and Maintenance</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="services[]" value="Circuit breaker installation and maintenance" /> Circuit breaker installation</td>
                    <td><input type="checkbox" name="services[]" value="Electrical panel upgrades" /> Electrical panel upgrades</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="services[]" value="Industrial electrical maintenance" /> Industrial electrical maintenance</td>
                    <td><input type="checkbox" name="services[]" value="Reading and interpreting blueprints & schematics" /> Reading and interpreting blueprints & schematics</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="services[]" value="Electrical wiring and installations" /> Electrical wiring and installations</td>
                    <td><input type="checkbox" name="services[]" value="Electrical troubleshooting and repairs" /> Electrical troubleshooting and repairs</td>
                </tr>
            </table>
        </div>

        <div class="divider border-dark mb-4"></div>

        <!-- Certifications -->
        <h6 class="text-center fw-semibold mb-3">Certifications and Training</h6>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td><input type="checkbox" name="certificate[]" value="Electrical Technician Certificate" /> Electrical Technician Certificate</td>
                    <td><input type="checkbox" name="certificate[]" value="Licensed Electrician" /> Licensed Electrician (If Applicable)</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="certificate[]" value="Occupational Safety and Health Administration (OSHA) Certification" /> OSHA Certification</td>
                    <td><input type="checkbox" name="certificate[]" value="Solar Installation Training Certification" /> Solar Installation Training Certification</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="certificate[]" value="Apprenticeship Training Programs" /> Apprenticeship Training Programs</td>
                    <td><input type="checkbox" name="certificate[]" value="First Aid/CPR Certification" /> First Aid/CPR Certification</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="certificate[]" value="COREN" /> COREN</td>
                    <td><input type="checkbox" name="certificate[]" value="NEMSA" /> NEMSA</td>
                </tr>
            </table>
        </div>

        <div class="divider border-dark mb-4"></div>

        <!-- Working Experience -->
        <h6 class="text-center fw-semibold mb-3">Working Experience</h6>
        <div class="form-group mb-4">
            <label for="experience" class="form-label fw-bold text-dark">Work Experience</label>
            <select name='experience' id='experience' class='form-select' required>
                <option value='' selected>-Select Years of Experience-</option>
                <option value='Less Than 5 Yrs'>Less Than 5 Yrs</option>
                <option value='5 Years'>5 Years</option>
                <option value='5-10 Years'>5-10 Years</option>
                <option value='More than 10 Years'>More than 10 Years</option>
            </select>
        </div>

        <div class="divider border-dark mb-4"></div>

        <!-- Privacy Policy -->
        <div class="form-check mb-4">
            <input class="form-check-input" id="checkedCheckbox" type="checkbox" required>
            <label class="form-check-label text-dark" for="checkedCheckbox">
                I agree with the <a href="terms">Terms & Conditions</a> and 
                <a href="privacy-policy">Privacy Policy</a>
            </label>
        </div>

        <button class="btn btn-primary w-100 py-2 fw-bold" type="submit" name="register">Register</button>

    </form>
</div>


    </div>
  </div>

  <!-- All JavaScript Files -->

<!--Sweet Alert  -->
<script src="js/sweetalert.js"></script>
<?php 
if(isset($_SESSION['status']) && $_SESSION['status'] != '')
{
	?>
	<script>
		swal({
			title: "<?php echo $_SESSION['head']; ?>",
			icon: "<?php echo $_SESSION['status_code']; ?>",
			text: "<?php echo $_SESSION['status']; ?>",
			button: "OK",
		}).then(function() {
			window.location = "artisan_register.php";
			});
	</script>
	<?php
		unset($_SESSION['status']);
}
?>

    <script src="js/lga.js"></script>
    <script src="js/lga.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/internet-status.js"></script>
    <script src="js/dark-rtl.js"></script>
    <script src="js/pswmeter.js"></script>
    <script src="js/active.js"></script>
    <script src="js/pwa.js"></script>
  
  
  
</body>

</html>