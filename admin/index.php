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
    
<!--Styles-->
    <link rel="stylesheet" href="css/styles.css"> 
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
              <h4>Hello! Admin let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
<!--Login Code-->
                
<?php
    if (isset($_SESSION['status'])) {
        ?>
        <div class="alert alert-success">
            <h5><?= htmlspecialchars($_SESSION['status']); ?></h5>
        </div>
        <?php
        unset($_SESSION['status']);
    }
?>

<?php 
error_reporting(E_ALL);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $select_user_query = $stmt->get_result();

    if ($select_user_query->num_rows > 0) {
        $row = $select_user_query->fetch_assoc();
        $db_user_id = escape($row['user_id']);
        $db_fullname = escape($row['fullname']);
        $db_username = escape($row['username']);
        $db_email = escape($row['email']);
        $db_phone = escape($row['phone']);
        $db_gender = escape($row['gender']);
        $db_password = escape($row['password']);
        $db_role = escape($row['role']);
        $db_added_on = escape($row['added_on']);
        $db_verify_status = escape($row['verify_status']);

        // Check if the user has verified their email
        if ($db_verify_status != '1') {
            echo "<div class='alert alert-danger'>Email not verified. Please verify your email before logging in.</div>";
        } elseif (password_verify($password, $db_password)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['fullname'] = $db_fullname;
            $_SESSION['username'] = $db_username;
            $_SESSION['email'] = $db_email;
            $_SESSION['phone'] = $db_phone;
            $_SESSION['gender'] = $db_gender;
            $_SESSION['role'] = $db_role;
            $_SESSION['added_on'] = $db_added_on;
            $_SESSION['verify_status'] = $db_verify_status;

            header("Location: home"); 
            exit;
        } else {
            echo "<div class='alert alert-danger'>Incorrect Username or Password</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Incorrect Username or Password</div>";
    }

    $stmt->close();
}
?>
    
                
<!--End of Login Code-->
                
            <form class="pt-3" action="" method="post">
                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                      </div>
                      <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username" required>
                    </div>
                  </div>
                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                      </div>
                      <input type="password" class="form-control form-control-lg" id="myInput" placeholder="Password" name="password" required>
                    </div>
                  </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                  <input type="checkbox" onclick="myFunction()"> Show Password
                  </div>
                  <a href="forgot_password" class="auth-link text-primary">Forgot password?</a>
                </div>
                <div class="mt-3">
                  <button class="btn btn-primary btn-block" type="submit" name="login">Sign In</button>
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
    
<!--    Show Password-->
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>

</html>
