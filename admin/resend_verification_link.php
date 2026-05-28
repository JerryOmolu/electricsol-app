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

<!-- Main Content Wrapper-->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">RESEND VERIFICATION LINK</p><hr>

<div class="row">
<div class="col-6 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/* ================================
   FAST PDO EMAIL FUNCTION
================================ */
function resend_email_verify($username, $email, $verify_token){

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
    $mail->Subject = 'Email Verification link from Electricsol';

    $email_template = "
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Electricsol Backend User Registration</title>
<style>
body { background:#f8f9fa; font-family:Arial; padding:20px; }
.email-container { max-width:600px; margin:auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.1); text-align:center; }
h2 { color:#0d6efd; }
.btn-verify { display:inline-block; background:#0d6efd; color:#fff!important; padding:12px 25px; border-radius:5px; text-decoration:none; }
</style>
</head>
<body>
<div class='email-container'>
<h2>Welcome to Electricsol!</h2>
<h3>Your Backend Username: <strong>$username</strong></h3>
<h3>Please verify your email:</h3>
<a class='btn-verify' href='http://localhost/electricsol/admin/verify_email?token=$verify_token&email=$email&username=$username'>
Verify Email
</a>
<p>If you did not register, ignore this email.</p>
</div>
</body>
</html>";

    $mail->Body = $email_template;
    $mail->send();
}


/* ================================
   PDO FAST HANDLER
================================ */
if(isset($_POST['resend'])){

    if(!empty($_POST['email'])){

        $email = trim($_POST['email']);

        // PDO prepared statement (FAST + SAFE + LOW LOAD)
        $stmt = $pdo->prepare("
            SELECT username, email, verify_token, verify_status 
            FROM user 
            WHERE email = :email 
            LIMIT 1
        ");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){

            if($row['verify_status'] == "0"){

                resend_email_verify(
                    $row['username'],
                    $row['email'],
                    $row['verify_token']
                );

                echo "<div class='alert alert-success'>Verification Email has been sent successfully</div>";

            } else {
                echo "<div class='alert alert-warning'>Email already verified.</div>";
            }

        } else {
            echo "<div class='alert alert-danger'>Email is not registered. Please register email</div>";
        }

    } else {
        echo "<div class='alert alert-danger'>Email cannot be empty</div>";
    }
}
?>

<!-- FORM -->
<form class="forms-sample" action="" method="post">

<div class="form-group">
<div class="input-group">
    <input type="email" 
           class="form-control" 
           placeholder="Recipient's Email Address" 
           name="email"
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
           required>

    <div class="input-group-append">
        <button class="btn btn-sm btn-primary" type="submit" name="resend">
            Resend Link
        </button>
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

<?php include "includes/admin_footer.php"; ?>