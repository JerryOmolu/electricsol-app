<?php include "includes/header.php"; ?>

<?php
/**
 * =========================================================
 * ULTRA-FAST PDO LOGIN SYSTEM
 * Optimized for performance & reduced server load
 * =========================================================
 */



// Reduce unnecessary warnings in production
error_reporting(E_ALL & ~E_NOTICE);

// AUTO LOGIN USING COOKIE
if (!isset($_SESSION['id']) && !empty($_COOKIE['user_login'])) {

    try {

        static $rememberStmt = null;

        if ($rememberStmt === null) {

            $rememberStmt = $pdo->prepare("
                SELECT
                    id,
                    fullname,
                    email,
                    phone,
                    verify_token,
                    verify_status,
                    date,
                    address
                FROM register
                WHERE remember_token = ?
                LIMIT 1
            ");
        }

        $rememberStmt->execute([$_COOKIE['user_login']]);

        $user = $rememberStmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $_SESSION['id']            = $user['id'];
            $_SESSION['fullname']      = $user['fullname'];
            $_SESSION['email']         = $user['email'];
            $_SESSION['phone']         = $user['phone'];
            $_SESSION['verify_token']  = $user['verify_token'];
            $_SESSION['verify_status'] = $user['verify_status'];
            $_SESSION['date']          = $user['date'];
            $_SESSION['address']       = $user['address'];

            header("Location: home");
            exit();
        }

    } catch (PDOException $e) {
        // Silent fail for production safety
    }
}

// LOGOUT
if (isset($_GET['logout'])) {

    session_destroy();

    setcookie(
        'user_login',
        '',
        time() - 3600,
        '/',
        '',
        false,
        true
    );

    header("Location: login.php");
    exit();
}

// LOGIN
if (isset($_POST['submit'])) {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['remember']);

    try {

        // PREPARE ONCE ONLY
        static $loginStmt = null;

        if ($loginStmt === null) {

            $loginStmt = $pdo->prepare("
                SELECT
                    id,
                    fullname,
                    email,
                    phone,
                    password,
                    verify_token,
                    verify_status,
                    date,
                    address
                FROM register
                WHERE email = ?
                LIMIT 1
            ");
        }

        // EXECUTE QUERY
        $loginStmt->execute([$email]);

        // FETCH USER
        $user = $loginStmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            // EMAIL NOT VERIFIED
            if ((int)$user['verify_status'] !== 1) {

                $error_message = "
                Your email address is not verified.
                Please check your inbox or contact Admin.
                ";

            }
            // VERIFY PASSWORD
            elseif (password_verify($password, $user['password'])) {

                // CREATE SESSION
                $_SESSION['id']            = $user['id'];
                $_SESSION['fullname']      = $user['fullname'];
                $_SESSION['email']         = $user['email'];
                $_SESSION['phone']         = $user['phone'];
                $_SESSION['verify_token']  = $user['verify_token'];
                $_SESSION['verify_status'] = $user['verify_status'];
                $_SESSION['date']          = $user['date'];
                $_SESSION['address']       = $user['address'];

                // REMEMBER ME
                if ($remember) {

                    $cookie_token = bin2hex(random_bytes(32));

                    // SAVE COOKIE
                    setcookie(
                        'user_login',
                        $cookie_token,
                        [
                            'expires' => time() + (86400 * 30),
                            'path' => '/',
                            'httponly' => true,
                            'samesite' => 'Lax'
                        ]
                    );

                    // UPDATE TOKEN
                    static $tokenStmt = null;

                    if ($tokenStmt === null) {

                        $tokenStmt = $pdo->prepare("
                            UPDATE register
                            SET remember_token = ?
                            WHERE id = ?
                            LIMIT 1
                        ");
                    }

                    $tokenStmt->execute([
                        $cookie_token,
                        $user['id']
                    ]);
                }

                header("Location: home");
                exit();

            } else {

                $error_message = "Incorrect password. Please try again.";
            }

        } else {

            $error_message = "
            No user found with this email address.
            Please register or try again.
            ";
        }

    } catch (PDOException $e) {

        $error_message = "Unable to process login request.";
    }
}
?>

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

    <div class="custom-container card shadow-lg rounded-4 p-4 p-md-5 position-relative"
         style="max-width: 400px; width: 100%; background-color: #fff;">

        <!-- Logo -->
        <div class="text-center mb-4">
            <img
                class="login-intro-img"
                src="img/electrisol-img/login.png"
                alt="ElectricSol Logo"
                width="150"
                loading="lazy"
                decoding="async"
            >

            <h5 class="mt-3 fw-bold">
                Sign in to get started
            </h5>
        </div>

        <!-- SESSION STATUS -->
        <?php if (!empty($_SESSION['status'])): ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <strong>Info:</strong>

                <?php
                echo htmlspecialchars($_SESSION['status'], ENT_QUOTES, 'UTF-8');
                ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>

            </div>

            <?php unset($_SESSION['status']); ?>

        <?php endif; ?>

        <!-- ERROR MESSAGE -->
        <?php if (!empty($error_message)): ?>

            <div class="alert alert-danger" role="alert">

                <?php
                echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                ?>

            </div>

        <?php endif; ?>

        <!-- Login Form -->
        <div class="register-form mt-4">

            <form action="" method="post" autocomplete="off">

                <!-- Email -->
                <div class="mb-3">

                    <label for="email" class="form-label fw-semibold">
                        Email Address
                    </label>

                    <div class="input-group shadow-sm rounded">

                        <span class="input-group-text bg-white">
                            <i class="fa fa-envelope"></i>
                        </span>

                        <input
                            type="email"
                            class="form-control border-start-0"
                            id="email"
                            name="email"
                            placeholder="Enter Email Address"
                            value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >

                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3 position-relative">

                    <label for="psw-input" class="form-label fw-semibold">
                        Password
                    </label>

                    <div class="input-group shadow-sm rounded">

                        <span class="input-group-text bg-white">
                            <i class="fa fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            class="form-control border-start-0"
                            id="psw-input"
                            name="password"
                            placeholder="Enter Password"
                            required
                        >

                        <span class="position-absolute top-50 end-0 translate-middle-y pe-3 cursor-pointer"
                              id="togglePassword">

                            <i class="bi bi-eye fs-5 text-secondary"></i>

                        </span>

                    </div>
                </div>

                <!-- Remember -->
                <div class="mb-3 form-check">

                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="remember"
                        name="remember"
                    >

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>

                </div>

                <!-- Submit -->
                <button
                    class="btn btn-primary w-100 fw-bold shadow-sm btn-hover"
                    type="submit"
                    name="submit"
                >
                    Sign In
                </button>

            </form>
        </div>

        <!-- Login Meta -->
        <div class="login-meta-data text-center mt-4">

            <a class="d-block mb-2 text-decoration-none"
               href="forget-password">

               Forgot Password?

            </a>

            <hr>

            <p class="mb-0">

                Don't have an account?

                <a class="fw-bold text-primary"
                   href="register">

                   Register Now

                </a>

            </p>
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

// PASSWORD TOGGLE
const togglePassword = document.getElementById('togglePassword');
const passwordInput  = document.getElementById('psw-input');

togglePassword.addEventListener('click', () => {

    const type = passwordInput.getAttribute('type') === 'password'
        ? 'text'
        : 'password';

    passwordInput.setAttribute('type', type);

    togglePassword.innerHTML = type === 'password'
        ? '<i class="bi bi-eye fs-5 text-secondary"></i>'
        : '<i class="bi bi-eye-slash fs-5 text-secondary"></i>';
});

</script>

<?php include "includes/footer.php"; ?>