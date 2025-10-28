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
<div class="login-back-button position-absolute m-3">
    <a href="index" class="text-dark fs-4">
        <i class="bi bi-arrow-left-short"></i>
    </a>
</div>

<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="custom-container card shadow-lg rounded-4 p-4 p-md-5 position-relative" style="max-width: 400px; width: 100%; background-color: #fff;">
        <!-- Logo -->
        <div class="text-center mb-4">
            <img class="login-intro-img" src="img/electrisol-img/login.png" alt="ElectricSol Logo" width="150px">
            <h5 class="mt-3 fw-bold">Sign in to get started</h5>
        </div>

        <!-- Alerts -->
        <?php
        if (isset($_SESSION['status'])) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Info:</strong> {$_SESSION['status']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
            unset($_SESSION['status']);
        }
        ?>

        <!-- Register Form -->
        <div class="register-form mt-4">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <div class="input-group shadow-sm rounded">
                        <span class="input-group-text bg-white"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="Enter Email Address" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                    </div>
                </div>

                <div class="mb-3 position-relative">
                    <label for="psw-input" class="form-label fw-semibold">Password</label>
                    <div class="input-group shadow-sm rounded">
                        <span class="input-group-text bg-white"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control border-start-0" id="psw-input" name="password" placeholder="Enter Password" required>
                        <span class="position-absolute top-50 end-0 translate-middle-y pe-3 cursor-pointer" id="togglePassword">
                            <i class="bi bi-eye fs-5 text-secondary"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button class="btn btn-primary w-100 fw-bold shadow-sm" type="submit" name="submit">Sign In</button>
            </form>
        </div>

        <!-- Login Authentication Code -->
        <?php
        if (isset($_SESSION['status'])) {
            ?>
            <div class="alert alert-success">
                <h5><?= $_SESSION['status']; ?></h5>
            </div>
            <?php
            unset($_SESSION['status']);
        }

        error_reporting(E_ALL ^ E_WARNING);

        if (isset($_POST['submit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $remember = isset($_POST['remember']);

            $stmt = $connection->prepare("SELECT * FROM register WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if ($row['verify_status'] != '1') {
                    echo "<div class='alert alert-danger' role='alert'>Your email '$email' is not verified. Please check your inbox for the verification link or contact Admin.</div>";
                } elseif (password_verify($password, $row['password'])) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['verify_token'] = $row['verify_token'];
                    $_SESSION['verify_status'] = $row['verify_status'];
                    $_SESSION['date'] = $row['date'];
                    $_SESSION['address'] = $row['address'];

                    if ($remember) {
                        $cookie_value = bin2hex(random_bytes(16));
                        setcookie('user_login', $cookie_value, time() + (86400 * 30), "/");

                        $stmt = $connection->prepare("UPDATE register SET remember_token = ? WHERE id = ?");
                        $stmt->bind_param('si', $cookie_value, $row['id']);
                        $stmt->execute();
                    }

                    header("Location: home");
                    exit();
                } else {
                    echo "<div class='alert alert-warning' role='alert'>Incorrect password. Please try again.</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>No user found with this email '$email'. Please register or try again.</div>";
            }

            $stmt->close();
        }

        if (!isset($_SESSION['id']) && isset($_COOKIE['user_login'])) {
            $cookie_value = $_COOKIE['user_login'];
            $stmt = $connection->prepare("SELECT id, fullname, email FROM register WHERE remember_token = ?");
            $stmt->bind_param('s', $cookie_value);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
            }
        }

        if (isset($_GET['logout'])) {
            session_destroy();
            setcookie('user_login', '', time() - 3600, "/");
            header("Location: login.php");
            exit;
        }
        ?>
        <!-- End of Login Authentication Code -->

        <!-- Login Meta -->
        <div class="login-meta-data text-center mt-4">
            <a class="d-block mb-2 text-decoration-none" href="forget-password">Forgot Password?</a>
            <hr>
            <p class="mb-0">Don't have an account? <a class="fw-bold text-primary" href="register">Register Now</a></p>
        </div>
    </div>
</div>

<style>
/* Card subtle animated shadow */
.login-card {
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

/* Input hover/focus effect */
.input-hover input {
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}
.input-hover input:focus {
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
    border-color: #007bff;
}

/* Button hover effect */
.btn-hover {
    position: relative;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.btn-hover:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
}
</style>

<script>
    // Password toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('psw-input');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye fs-5 text-secondary"></i>' : '<i class="bi bi-eye-slash fs-5 text-secondary"></i>';
    });
</script>

<?php include "includes/footer.php"; ?>
