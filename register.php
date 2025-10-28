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
    <a href="login">
      <i class="bi bi-arrow-left-short"></i>
    </a>
  </div>

  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="custom-container bg-white rounded-4 shadow-lg p-4" style="max-width: 480px; width: 100%;">
      
        <!-- Intro Image -->
        <div class="text-center mb-4">
            <img class="login-intro-img" src="img/electrisol-img/register.png" alt="Register" width="150px">
        </div>
		
		<?php
include 'includes/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Function to send verification email
function sendemail_verify($name, $email, $verify_token, $phone) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'electricsol.com.ng';
        $mail->Username   = 'info@electricsol.com.ng';
        $mail->Password   = '@electric123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('info@electricsol.com.ng', 'Electricsol');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Sign Up Confirmation Email from Electricsol';

        $verify_link = "http://localhost/electricsol/verify_email?token=$verify_token&email=$email&phone=$phone&name=$name";

        $email_template = "
<html>
<head>
  <title>Welcome Email</title>
  <meta charset='UTF-8'>
</head>
<body style='margin:0;padding:0;font-family:Arial,sans-serif;background-color:#f4f4f4;'>
  <table width='100%' cellpadding='0' cellspacing='0' border='0'>
    <tr>
      <td align='center'>
        <table width='600' cellpadding='0' cellspacing='0' border='0' style='background-color:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,0.1);margin:20px 0;'>
          <tr>
            <td style='padding:30px;text-align:center;background-color:#007bff;color:#ffffff;'>
              <h1 style='margin:0;font-size:28px;'>Welcome, $name!</h1>
            </td>
          </tr>
          <tr>
            <td style='padding:30px;text-align:center;color:#333333;'>
              <p style='font-size:16px;margin-bottom:20px;'>Thank you for registering. Your one-time verification code is:</p>
              <p style='font-size:20px;font-weight:bold;margin-bottom:30px;color:#007bff;'>$verify_token</p>
              <a href='$verify_link' style='display:inline-block;background-color:#007bff;color:#ffffff;padding:12px 25px;text-decoration:none;font-weight:bold;border-radius:5px;font-size:16px;'>Verify Account</a>
              <p style='margin-top:30px;font-size:14px;color:#777777;'>If you need help, call: <strong>07039000386</strong></p>
            </td>
          </tr>
          <tr>
            <td style='padding:15px;text-align:center;background-color:#f4f4f4;color:#999999;font-size:12px;'>
              &copy; ".date('Y')." Your Company. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
";


        $mail->Body = $email_template;
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}

// Registration handler
if (isset($_POST['submit'])) {
    $name = trim(mysqli_real_escape_string($connection, $_POST['name']));
    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($connection, $_POST['phone']));
    $password = trim(mysqli_real_escape_string($connection, $_POST['password']));
    $verify_token = rand(100000, 999999);

    $errors = [];

    // Validation
    if (empty($name)) $errors['name'] = "Name cannot be empty.";
    if (empty($email)) $errors['email'] = "Email cannot be empty.";
    if (empty($phone)) $errors['phone'] = "Phone number cannot be empty.";
    if (empty($password)) $errors['password'] = "Password cannot be empty.";

    // Check if email already exists
    $stmt = $connection->prepare("SELECT email FROM register WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) $errors['email'] = "Email address already exists.";
    $stmt->close();

    // Check if phone already exists
    $stmt = $connection->prepare("SELECT phone FROM register WHERE phone = ? LIMIT 1");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) $errors['phone'] = "Phone number already exists.";
    $stmt->close();

    // Proceed if no errors
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $stmt = $connection->prepare("INSERT INTO register (fullname, email, phone, password, verify_token, date) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $name, $email, $phone, $hashed_password, $verify_token);

        if ($stmt->execute()) {
            if (sendemail_verify($name, $email, $verify_token, $phone)) {
                $_SESSION['head'] = "Thank You!";
                $_SESSION['status'] = "Registration successful! Check your email '$email' for verification.";
                $_SESSION['status_code'] = "success";
            } else {
                $_SESSION['head'] = "Email Error!";
                $_SESSION['status'] = "Registration saved but failed to send verification email. Please contact support.";
                $_SESSION['status_code'] = "error";
            }
        } else {
            $_SESSION['head'] = "Error!";
            $_SESSION['status'] = "Something went wrong. Please try again.";
            $_SESSION['status_code'] = "error";
        }
        $stmt->close();
    } else {
        $_SESSION['head'] = "Validation Error!";
        $_SESSION['status'] = implode("<br>", $errors);
        $_SESSION['status_code'] = "error";
    }

    header("Location: register.php");
    exit();
}
?>
       
      
      
<!--End of Register Code-->
        
        <!-- Register Form -->
        <div class="register-form">
            <h5 class="mb-4 text-center fw-bold">Register to Get Started</h5>
            
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Full Name -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter Your Full Name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
                </div>

                <!-- Email -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter Your Email Address" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                </div>
                <p class="text-danger small mb-2"><?= isset($errors['e']) ? $errors['e'] : '' ?></p>

                <!-- Phone -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    <input class="form-control form-control-lg" type="text" name="phone" maxlength="11" placeholder="Enter Your Phone Number" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" required>
                </div>
                <p class="text-danger small mb-2"><?= isset($errors['p']) ? $errors['p'] : '' ?></p>

                <!-- Password -->
                <div class="input-group mb-3 position-relative">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input class="form-control form-control-lg" type="password" id="psw-input" name="password" placeholder="Enter Your Password" required>
                    <div class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" id="password-visibility">
                        <i class="bi bi-eye-slash"></i>
                        <i class="bi bi-eye d-none"></i>
                    </div>
                </div>
                <div class="mb-3" id="pswmeter"></div>

                <!-- Terms -->
                <div class="form-check mb-4">
                    <input class="form-check-input" id="checkedCheckbox" type="checkbox" required>
                    <label class="form-check-label text-muted fw-normal" for="checkedCheckbox">
                        I agree with the <a href="terms">Terms & Conditions</a> and <a href="privacy-policy">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit -->
                <button class="btn btn-primary btn-lg w-100 fw-semibold" type="submit" name="submit">Register</button>
            </form>
        </div>

        <!-- Login Meta -->
        <div class="login-meta-data text-center mt-3">
            <p class="mb-0">Already have an account? <a class="stretched-link fw-semibold" href="login">Sign In</a></p>
        </div>
    </div>
</div>

<style>
.custom-container input.form-control:focus {
    box-shadow: 0 0 10px rgba(0,123,255,0.25);
    border-color: #007bff;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    transition: all 0.2s ease;
}

#password-visibility {
    cursor: pointer;
}

.custom-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

@media (max-width: 576px) {
    .custom-container {
        padding: 2rem 1.5rem;
    }
}
</style>

<script>
// Password toggle
const toggleIcons = document.querySelectorAll('#password-visibility i');
const passwordInput = document.querySelector('#psw-input');

toggleIcons.forEach(icon => {
    icon.addEventListener('click', () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcons[0].classList.add('d-none');
            toggleIcons[1].classList.remove('d-none');
        } else {
            passwordInput.type = "password";
            toggleIcons[0].classList.remove('d-none');
            toggleIcons[1].classList.add('d-none');
        }
    });
});
</script>


  <!-- All JavaScript Files -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/internet-status.js"></script>
  <script src="js/dark-rtl.js"></script>
  <script src="js/pswmeter.js"></script>
  <script src="js/active.js"></script>
  <script src="js/pwa.js"></script>
  
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
			window.location = "register";
			});
	</script>
	<?php
		unset($_SESSION['status']);
}
?>
  
</body>

</html>