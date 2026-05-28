<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php"; ?>
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

  <?php
  if(isset($_SESSION['status'])){
      echo '<div class="alert alert-success"><h5>'.$_SESSION['status'].'</h5></div>';
      unset($_SESSION['status']);
  }
  ?>

<?php

if(isset($_POST['update'])){

    try {

        $email = trim($_POST['email'] ?? '');
        $new_password = trim($_POST['new_password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');
        $token = trim($_GET['token'] ?? '');

        if(empty($token)){
            $_SESSION['status'] = "No Token Available";
            header("Location: change_password");
            exit;
        }

        if(empty($email) || empty($new_password) || empty($confirm_password)){
            $_SESSION['status'] = "All fields are Mandatory";
            header("Location: change_password?token=$token&email=$email");
            exit;
        }

        if($new_password !== $confirm_password){
            $_SESSION['status'] = "New Password and Confirm Password does not match. Kindly re-enter";
            header("Location: change_password?token=$token&email=$email");
            exit;
        }

        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]);
        $new_token = bin2hex(random_bytes(16)) . "electricsol";

        // SINGLE OPTIMIZED QUERY (replaces SELECT + 2 UPDATEs)
        $stmt = $pdo->prepare("
            UPDATE user 
            SET password = :password,
                verify_token = :new_token
            WHERE verify_token = :token
            LIMIT 1
        ");

        $stmt->execute([
            ':password' => $hashedPassword,
            ':new_token' => $new_token,
            ':token' => $token
        ]);

        if($stmt->rowCount() > 0){
            $_SESSION['status'] = "Password Reset is successful!";
            header("Location: index");
            exit;
        } else {
            $_SESSION['status'] = "Invalid Token or Expired Link";
            header("Location: change_password?token=$token&email=$email");
            exit;
        }

    } catch(Exception $e){
        $_SESSION['status'] = "System error occurred. Try again.";
        header("Location: change_password");
        exit;
    }
}

?>

<!-- FORM -->
<form class="pt-3" action="" method="post">

  <div class="form-group">
    <input type="email"
           class="form-control form-control-lg"
           placeholder="Enter Email"
           name="email"
           value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>"
           readonly>
  </div>

  <div class="form-group">
    <input type="password"
           class="form-control form-control-lg"
           placeholder="Enter New Password"
           name="new_password"
           required>
  </div>

  <div class="form-group">
    <input type="password"
           class="form-control form-control-lg"
           placeholder="Confirm New Password"
           name="confirm_password"
           required>
  </div>

  <div class="mt-3">
    <button class="btn btn-primary btn-block" type="submit" name="update">
      Update Password
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