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
  <a href="settings">
    <i class="bi bi-arrow-left-short"></i>
  </a>
</div>



<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center">
  <div class="custom-container">

<br>

<div class="login-wrapper d-flex align-items-center justify-content-center py-4">
<div class="custom-container p-4 rounded-4 shadow-sm" style="max-width: 450px; background-color: #fff; transition: all 0.3s ease;">

    <div class="text-center px-4 mb-4">
        <img class="login-intro-img" src="img/electrisol-img/update.png" alt="Update Password" width="120px">
    </div>

    <div class="register-form">
		
<?php
// SESSION SAFETY
$fullname = $_SESSION['fullname'] ?? '';
$phone = $_SESSION['phone'] ?? '';

// =========================
// CHANGE PASSWORD (PDO OPTIMIZED)
// =========================
if (isset($_POST['change_password'])) {

    $password = trim($_POST['password'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if ($password !== '' && $new_password !== '' && $confirm_password !== '') {

        // FETCH ONLY PASSWORD (FAST QUERY)
        $stmt = $pdo->prepare("
            SELECT password 
            FROM register 
            WHERE phone = :phone 
            LIMIT 1
        ");

        $stmt->execute([':phone' => $phone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $db_password = $user['password'];

            // VERIFY CURRENT PASSWORD
            if (password_verify($password, $db_password)) {

                // CHECK NEW PASSWORD MATCH
                if ($new_password === $confirm_password) {

                    $hashedPassword = password_hash(
                        $new_password,
                        PASSWORD_BCRYPT,
                        ['cost' => 10]
                    );

                    // UPDATE PASSWORD (FAST + INDEX FRIENDLY)
                    $update = $pdo->prepare("
                        UPDATE register 
                        SET password = :password 
                        WHERE phone = :phone
                        LIMIT 1
                    ");

                    $update->execute([
                        ':password' => $hashedPassword,
                        ':phone'    => $phone
                    ]);

                    echo "<div class='alert custom-alert-two alert-success alert-dismissible fade show' role='alert'>
                            <i class='bi bi-check-circle'></i>
                            Password Changed Successfully!
                            <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert'></button>
                          </div>";

                } else {
                    echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                            <i class='bi bi-x-circle'></i>
                            New Password and Confirm Password Do Not Match
                            <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert'></button>
                          </div>";
                }

            } else {
                echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                        <i class='bi bi-x-circle'></i>
                        Current Password is Incorrect
                        <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert'></button>
                      </div>";
            }

        } else {
            echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                    <i class='bi bi-x-circle'></i>
                    User not found. Please try again.
                    <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert'></button>
                  </div>";
        }

    } else {
        echo "<div class='alert custom-alert-two alert-danger alert-dismissible fade show' role='alert'>
                <i class='bi bi-x-circle'></i>
                All fields are required. Please fill out the form completely.
                <button class='btn btn-close btn-close-white position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert'></button>
              </div>";
    }
}
?>		

        <form action="" method="post">
            <h6 class="mb-4 text-center fw-bold">Change Your Password</h6>

            <!-- Current Password -->
            <div class="input-group mb-3 position-relative">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input class="form-control" type="password" name="password" placeholder="Current Password" required>
                <span class="password-toggle position-absolute top-50 end-0 translate-middle-y me-2">
                    <i class="bi bi-eye"></i>
                    <i class="bi bi-eye-slash d-none"></i>
                </span>
            </div>

            <!-- New Password -->
            <div class="input-group mb-3 position-relative">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input class="form-control" type="password" name="new_password" placeholder="New Password" required>
            </div>

            <!-- Password Strength -->
            <div id="pswmeter" class="mb-3"></div>

            <!-- Confirm Password -->
            <div class="input-group mb-4 position-relative">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm New Password" required>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit" name="change_password">
                Change Password
            </button>
        </form>

    </div>
</div>
</div>

<style>
.custom-container:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

input.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 8px rgba(13,110,253,0.2);
}

.password-toggle {
    cursor: pointer;
    font-size: 1.1rem;
    color: #6c757d;
}

.password-toggle i {
    transition: 0.2s;
}

.password-toggle:hover i {
    color: #0d6efd;
}
</style>

<script>
document.querySelectorAll('.password-toggle').forEach(function(toggle){
    toggle.addEventListener('click', function(){
        const input = this.parentElement.querySelector('input');
        const eye = this.querySelector('.bi-eye');
        const eyeSlash = this.querySelector('.bi-eye-slash');

        if(input.type === 'password'){
            input.type = 'text';
            eye.classList.add('d-none');
            eyeSlash.classList.remove('d-none');
        } else {
            input.type = 'password';
            eye.classList.remove('d-none');
            eyeSlash.classList.add('d-none');
        }
    });
});
</script>

  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/internet-status.js"></script>
<script src="js/dark-rtl.js"></script>
<script src="js/pswmeter.js"></script>
<script src="js/active.js"></script>
<script src="js/pwa.js"></script>

</body>
</html>