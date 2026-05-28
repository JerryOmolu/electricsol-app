<?php include "includes/header.php"; ?>

<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Custom Modern Styling -->
<style>
  :root{
    --primary-color:#0d6efd;
    --primary-soft:#edf4ff;
    --border-color:#e9ecef;
    --text-muted:#6c757d;
    --shadow-sm:0 10px 30px rgba(0,0,0,.05);
    --shadow-md:0 15px 40px rgba(13,110,253,.08);
    --radius-xl:24px;
    --radius-lg:18px;
  }

  body{
    background:#f5f7fb;
  }

  .login-back-button a{
    width:48px;
    height:48px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:#fff;
    box-shadow:var(--shadow-sm);
    color:#111;
    transition:.3s ease;
  }

  .login-back-button a:hover{
    transform:translateY(-2px);
    background:var(--primary-color);
    color:#fff;
  }

  .modern-register-card{
    background:#fff;
    border-radius:var(--radius-xl);
    box-shadow:var(--shadow-md);
    overflow:hidden;
    border:1px solid rgba(0,0,0,.04);
  }

  .register-header{
    position:relative;
    padding:35px 25px 25px;
    background:linear-gradient(135deg,#0d6efd 0%,#0b5ed7 50%,#084298 100%);
    color:#fff;
    text-align:center;
    overflow:hidden;
  }

  .register-header::before{
    content:"";
    position:absolute;
    width:200px;
    height:200px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
    top:-80px;
    right:-80px;
  }

  .register-header::after{
    content:"";
    position:absolute;
    width:150px;
    height:150px;
    background:rgba(255,255,255,.06);
    border-radius:50%;
    bottom:-60px;
    left:-60px;
  }

  .register-header img{
    position:relative;
    z-index:2;
    width:95px;
    height:95px;
    object-fit:contain;
    background:#fff;
    padding:12px;
    border-radius:24px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
  }

  .register-header h4{
    position:relative;
    z-index:2;
    margin-top:18px;
    font-weight:700;
    margin-bottom:8px;
  }

  .register-header p{
    position:relative;
    z-index:2;
    margin-bottom:0;
    opacity:.9;
    font-size:14px;
  }

  .register-body{
    padding:28px 22px 30px;
  }

  .section-title{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:22px;
    font-size:16px;
    font-weight:700;
    color:#111827;
  }

  .section-title .icon-box{
    width:40px;
    height:40px;
    border-radius:12px;
    background:var(--primary-soft);
    color:var(--primary-color);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
  }

  .form-label{
    font-size:13px;
    margin-bottom:8px;
    color:#212529;
    font-weight:600;
  }

  .form-control,
  .form-select{
    border-radius:14px;
    border:1px solid var(--border-color);
    min-height:52px;
    padding:12px 16px;
    font-size:14px;
    box-shadow:none !important;
    transition:.3s ease;
    background:#fff;
  }

  .form-control:focus,
  .form-select:focus{
    border-color:rgba(13,110,253,.45);
    box-shadow:0 0 0 4px rgba(13,110,253,.10) !important;
  }

  .modern-divider{
    height:1px;
    background:linear-gradient(to right, transparent, #dfe3eb, transparent);
    margin:28px 0;
  }

  .info-note{
    display:flex;
    align-items:flex-start;
    gap:10px;
    padding:14px;
    background:#fff8e6;
    border:1px solid #ffe7a3;
    border-radius:14px;
    font-size:13px;
    color:#856404;
  }

  .skill-table,
  .cert-table{
    border-radius:18px;
    overflow:hidden;
    border:1px solid #edf0f5;
    margin-bottom:0;
  }

  .skill-table tr td,
  .cert-table tr td{
    padding:18px 16px;
    vertical-align:middle;
    background:#fff;
    border-color:#edf0f5;
    font-size:14px;
    transition:.2s ease;
  }

  .skill-table tr td:hover,
  .cert-table tr td:hover{
    background:#f8fbff;
  }

  .skill-table input[type="checkbox"],
  .cert-table input[type="checkbox"]{
    width:18px;
    height:18px;
    margin-right:10px;
    accent-color:#0d6efd;
    position:relative;
    top:3px;
  }

  .experience-card{
    padding:18px;
    border-radius:18px;
    background:#f8fbff;
    border:1px solid #e8f0ff;
  }

  .terms-card{
    background:#f9fafc;
    border:1px solid #edf0f5;
    border-radius:16px;
    padding:18px;
  }

  .terms-card a{
    text-decoration:none;
    font-weight:600;
  }

  .btn-register{
    border:none;
    border-radius:16px;
    min-height:56px;
    font-size:15px;
    font-weight:700;
    background:linear-gradient(135deg,#0d6efd,#0b5ed7);
    box-shadow:0 12px 25px rgba(13,110,253,.25);
    transition:.3s ease;
  }

  .btn-register:hover{
    transform:translateY(-2px);
    box-shadow:0 16px 35px rgba(13,110,253,.30);
  }

  .mini-helper{
    font-size:12px;
    color:var(--text-muted);
    margin-top:6px;
  }

  @media (max-width:768px){

    .register-header{
      padding:28px 20px 22px;
    }

    .register-body{
      padding:24px 16px 28px;
    }

    .skill-table tr td,
    .cert-table tr td{
      min-width:260px;
      font-size:13px;
    }

    .form-control,
    .form-select{
      min-height:50px;
    }
  }
</style>

<!-- Back Button -->
<div class="login-back-button">
  <a href="index">
    <i class="bi bi-arrow-left-short"></i>
  </a>
</div>

<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center py-4">
  <div class="custom-container">

<?php
require_once 'includes/db.php'; // must expose $pdo

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/* =========================
   EMAIL FUNCTION (FIXED)
========================= */
function sendemail_verify($name, $email, $phone) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = 'electricsol.com.ng';
    $mail->Username   = 'info@electricsol.com.ng';
    $mail->Password   = '@electric123';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('info@electricsol.com.ng', 'Electricsol');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Artisan Registration Confirmation from Electricsol';

    $mail->Body = "
    <div style='font-family:Arial,sans-serif;padding:30px;background:#f4f7fb'>
        <div style='max-width:600px;margin:auto;background:#fff;border-radius:20px;overflow:hidden'>
            <div style='background:linear-gradient(135deg,#0d6efd,#084298);padding:30px;text-align:center;color:#fff'>
                <h2 style='margin:0'>Welcome to Electricsol</h2>
            </div>

            <div style='padding:30px'>
                <h3 style='margin-top:0;color:#111'>Hello {$name},</h3>

                <p style='font-size:15px;line-height:1.8;color:#555'>
                    Your artisan registration was successful.
                    We're excited to have you join the Electricsol network.
                </p>

                <div style='margin:25px 0;padding:20px;background:#f8fbff;border-radius:14px'>
                    <p style='margin:0 0 8px'><strong>Email:</strong> {$email}</p>
                    <p style='margin:0'><strong>Phone:</strong> {$phone}</p>
                </div>

                <p style='font-size:14px;color:#666'>
                    Thank you for choosing Electricsol.
                </p>
            </div>
        </div>
    </div>";

    $mail->send();
}

/* =========================
   REGISTER HANDLER (PDO OPTIMIZED)
========================= */
if (isset($_POST['register'])) {

    $name       = trim($_POST['name'] ?? '');
    $gender     = trim($_POST['gender'] ?? '');
    $birth      = trim($_POST['birth'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $state      = trim($_POST['state'] ?? '');
    $lga        = trim($_POST['lga'] ?? '');
    $address    = trim($_POST['address'] ?? '');
    $experience = trim($_POST['experience'] ?? '');

    $services = $_POST['services'] ?? [];
    $certs    = $_POST['certificate'] ?? [];

    $chk   = implode(",", $services);
    $check = implode(",", $certs);

    $errors = [];

    try {

        // Email check
        $stmt = $pdo->prepare("SELECT 1 FROM artisan WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $errors['e'] = "Email Address already exists for another Artisan";
        }

        // Phone check
        $stmt = $pdo->prepare("SELECT 1 FROM artisan WHERE phone = ? LIMIT 1");
        $stmt->execute([$phone]);

        if ($stmt->fetch()) {
            $errors['p'] = "Phone Number already exists for another Artisan.";
        }

        /* =========================
           VALIDATION
        ========================= */
        if (
            empty($name) || empty($gender) || empty($birth) || empty($email) ||
            empty($phone) || empty($state) || empty($lga) || empty($address) ||
            empty($experience) || empty($chk) || empty($check)
        ) {
            throw new Exception("All fields are required.");
        }

        if (count($errors) === 0) {

            $stmt = $pdo->prepare("
                INSERT INTO artisan
                (name, gender, date_of_birth, email, phone, state, lga, address, skills, certificate, years, added_on)
                VALUES
                (:name, :gender, :birth, :email, :phone, :state, :lga, :address, :skills, :certificate, :years, NOW())
            ");

            $insert = $stmt->execute([
                ':name' => $name,
                ':gender' => $gender,
                ':birth' => $birth,
                ':email' => $email,
                ':phone' => $phone,
                ':state' => $state,
                ':lga' => $lga,
                ':address' => $address,
                ':skills' => $chk,
                ':certificate' => $check,
                ':years' => $experience
            ]);

            if ($insert) {

                sendemail_verify($name, $email, $phone);

                $_SESSION['head'] = "Thank You!";
                $_SESSION['status'] = "Your registration as an Artisan with Electricsol is successful.";
                $_SESSION['status_code'] = "success";

            } else {

                throw new Exception("Insert failed.");
            }
        }

    } catch (Exception $e) {

        $_SESSION['head'] = "Error!";
        $_SESSION['status'] = $e->getMessage();
        $_SESSION['status_code'] = "error";
    }

    header("Location: artisan_register.php");
    exit;
}
?>

<div class="modern-register-card">

    <!-- Header -->
    <div class="register-header">
        <img src="img/electrisol-img/register-2.png" alt="Register">
        <h4>Artisan Registration</h4>
        <p>Join the Electricsol artisan network and grow your opportunities.</p>
    </div>

    <!-- Body -->
    <div class="register-body">

        <form action="" method="post" enctype="multipart/form-data">

            <!-- Personal Information -->
            <div class="section-title">
                <div class="icon-box">
                    <i class="bi bi-person"></i>
                </div>
                <span>Personal Information</span>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Fullname</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Your Full Name"
                    name="name"
                    value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"
                    required
                >
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Gender</label>

                    <select name='gender' id='gender' class='form-select' required>
                        <option value='' selected>-Select Gender-</option>
                        <option value='Male'>Male</option>
                        <option value='Female'>Female</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of Birth</label>

                    <input
                        class="form-control"
                        type="date"
                        name="birth"
                        value="<?php echo isset($_POST['birth']) ? $_POST['birth'] : '' ?>"
                        required
                    >
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Email Address</label>

                <input
                    class="form-control"
                    type="email"
                    placeholder="Enter Your Email Address"
                    name="email"
                    value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
                    required
                >

                <small class="text-danger">
                    <?php if(isset($errors['e'])) echo $errors['e']; ?>
                </small>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Phone Number</label>

                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Your Phone Number"
                    name="phone"
                    maxlength="11"
                    value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>"
                    required
                >

                <small class="text-danger">
                    <?php if(isset($errors['p'])) echo $errors['p']; ?>
                </small>
            </div>

            <div class="row g-3 mb-3">

                <div class="col-md-6">
                    <label class="form-label">State of Origin</label>

                    <select onchange='toggleLGA(this);' name='state' id='state' class='form-select' required>

                        <option value='' selected>-Select State of Origin-</option>

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
                    <label class="form-label">LGA</label>
                    <select name='lga' id='lga' class='form-select select-lga' required></select>
                </div>

            </div>

            <div class="form-group mb-3">
                <label class="form-label">Precise Location</label>

                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Your Contact Address"
                    name="address"
                    value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>"
                    required
                >
            </div>

            <div class="info-note mb-3">
                <i class="bi bi-geo-alt-fill"></i>
                <div>
                    Ensure you enter your precise location for easier discovery by clients nearby.
                </div>
            </div>

            <div class="modern-divider"></div>

            <!-- Skills -->
            <div class="section-title">
                <div class="icon-box">
                    <i class="bi bi-tools"></i>
                </div>
                <span>Skills & Expertise</span>
            </div>

            <div class="table-responsive mb-4">
                <table class="table skill-table align-middle">

                    <tr>
                        <td>
                            <input type="checkbox" name="services[]" value="Electrical Appliances Installation" />
                            Electrical Appliances Installation
                        </td>

                        <td>
                            <input type="checkbox" name="services[]" value="Solar Panel Installation and Maintenance" />
                            Solar Panel Installation and Maintenance
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="services[]" value="Circuit breaker installation and maintenance" />
                            Circuit breaker installation
                        </td>

                        <td>
                            <input type="checkbox" name="services[]" value="Electrical panel upgrades" />
                            Electrical panel upgrades
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="services[]" value="Industrial electrical maintenance" />
                            Industrial electrical maintenance
                        </td>

                        <td>
                            <input type="checkbox" name="services[]" value="Reading and interpreting blueprints & schematics" />
                            Reading and interpreting blueprints & schematics
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="services[]" value="Electrical wiring and installations" />
                            Electrical wiring and installations
                        </td>

                        <td>
                            <input type="checkbox" name="services[]" value="Electrical troubleshooting and repairs" />
                            Electrical troubleshooting and repairs
                        </td>
                    </tr>

                </table>
            </div>

            <div class="modern-divider"></div>

            <!-- Certifications -->
            <div class="section-title">
                <div class="icon-box">
                    <i class="bi bi-patch-check"></i>
                </div>
                <span>Certifications & Training</span>
            </div>

            <div class="table-responsive mb-4">
                <table class="table cert-table align-middle">

                    <tr>
                        <td>
                            <input type="checkbox" name="certificate[]" value="Electrical Technician Certificate" />
                            Electrical Technician Certificate
                        </td>

                        <td>
                            <input type="checkbox" name="certificate[]" value="Licensed Electrician" />
                            Licensed Electrician (If Applicable)
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="certificate[]" value="Occupational Safety and Health Administration (OSHA) Certification" />
                            OSHA Certification
                        </td>

                        <td>
                            <input type="checkbox" name="certificate[]" value="Solar Installation Training Certification" />
                            Solar Installation Training Certification
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="certificate[]" value="Apprenticeship Training Programs" />
                            Apprenticeship Training Programs
                        </td>

                        <td>
                            <input type="checkbox" name="certificate[]" value="First Aid/CPR Certification" />
                            First Aid/CPR Certification
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="certificate[]" value="COREN" />
                            COREN
                        </td>

                        <td>
                            <input type="checkbox" name="certificate[]" value="NEMSA" />
                            NEMSA
                        </td>
                    </tr>

                </table>
            </div>

            <div class="modern-divider"></div>

            <!-- Experience -->
            <div class="section-title">
                <div class="icon-box">
                    <i class="bi bi-briefcase"></i>
                </div>
                <span>Working Experience</span>
            </div>

            <div class="experience-card mb-4">

                <label class="form-label">Work Experience</label>

                <select name='experience' id='experience' class='form-select' required>
                    <option value='' selected>-Select Years of Experience-</option>
                    <option value='Less Than 5 Yrs'>Less Than 5 Yrs</option>
                    <option value='5 Years'>5 Years</option>
                    <option value='5-10 Years'>5-10 Years</option>
                    <option value='More than 10 Years'>More than 10 Years</option>
                </select>

                <div class="mini-helper">
                    Select the option that best describes your professional experience.
                </div>

            </div>

            <!-- Terms -->
            <div class="terms-card mb-4">

                <div class="form-check m-0">
                    <input class="form-check-input" id="checkedCheckbox" type="checkbox" required>

                    <label class="form-check-label text-dark" for="checkedCheckbox">
                        I agree with the
                        <a href="terms">Terms & Conditions</a>
                        and
                        <a href="privacy-policy">Privacy Policy</a>
                    </label>
                </div>

            </div>

            <!-- Submit -->
            <button class="btn btn-primary btn-register w-100" type="submit" name="register">
                <i class="bi bi-person-plus-fill me-2"></i>
                Register as Artisan
            </button>

        </form>

    </div>
</div>

  </div>
</div>

<?php if (isset($_SESSION['status'])): ?>

<script src="js/sweetalert.js"></script>

<script>
swal({
    title: "<?= $_SESSION['head'] ?>",
    text: "<?= $_SESSION['status'] ?>",
    icon: "<?= $_SESSION['status_code'] ?>",
    buttonsStyling: false,
}).then(() => {
    window.location = "artisan_register.php";
});
</script>

<?php unset($_SESSION['status']); endif; ?>

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