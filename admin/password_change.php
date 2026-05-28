<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->

<div class="container-fluid page-body-wrapper">

<?php include "includes/sidenav.php"; ?>      

<div class="main-panel">
<div class="content-wrapper">

<!-- Welcome -->
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">
          Welcome! <?php echo $_SESSION['fullname']; ?>
        </h3>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">Change Password</p>

<div class="row">
<div class="col-6 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<?php
// ===============================
// SESSION SAFE INIT
// ===============================
$fullname = $_SESSION['fullname'] ?? '';
$phone = $_SESSION['phone'] ?? '';

// ===============================
// HANDLE PASSWORD CHANGE (PDO)
// ===============================
if (isset($_POST['change_password'])) {

    $password = $_POST['password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!empty($password) && !empty($new_password) && !empty($confirm_password)) {

        // FAST QUERY: fetch ONLY needed fields
        $stmt = $pdo->prepare("
            SELECT fullname, username, email, phone, gender, password, role, added_on, verify_status
            FROM user
            WHERE phone = :phone
            LIMIT 1
        ");
        $stmt->execute(['phone' => $phone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            if ($new_password === $confirm_password) {

                // HASH PASSWORD (secure + optimized)
                $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, [
                    'cost' => 10
                ]);

                // UPDATE PASSWORD (FAST PDO)
                $update = $pdo->prepare("
                    UPDATE user 
                    SET password = :password 
                    WHERE phone = :phone
                ");

                $update->execute([
                    'password' => $hashedPassword,
                    'phone' => $phone
                ]);

                // Refresh session (no extra DB call needed)
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['added_on'] = $user['added_on'];
                $_SESSION['verify_status'] = $user['verify_status'];

                echo "<div class='alert alert-success'>Password Changed Successfully!</div>";

            } else {
                echo "<div class='alert alert-danger'>New Password and Confirm Password do not match!</div>";
            }

        } else {
            echo "<div class='alert alert-danger'>Current Password is Incorrect</div>";
        }
    }
}
?>

<!-- ================= FORM ================= -->
<form class="forms-sample" action="" method="post">

  <div class="form-group">
    <label>Current Password</label>
    <input type="password" class="form-control"
           placeholder="Current Password"
           name="password" required>
  </div>

  <div class="form-group">
    <label>New Password</label>
    <input type="password" class="form-control"
           placeholder="New Password"
           name="new_password" required>
  </div>

  <div class="form-group">
    <label>Confirm New Password</label>
    <input type="password" class="form-control"
           placeholder="Confirm New Password"
           name="confirm_password" required>
  </div>

  <button type="submit"
          class="btn btn-primary mr-2"
          name="change_password">
    Change Password
  </button>

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