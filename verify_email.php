<?php include "includes/header.php"; ?>

<?php
/* =========================================================
   PDO OTP VERIFICATION SYSTEM
   Ultra-Fast + Optimized SQL
========================================================= */

require_once 'includes/db.php';

if (isset($_POST['verify'])) {

    // Fast sanitized inputs
    $token = trim($_GET['token'] ?? '');
    $phone = trim($_GET['phone'] ?? '');

    $one   = trim($_POST['one'] ?? '');
    $two   = trim($_POST['two'] ?? '');
    $three = trim($_POST['three'] ?? '');
    $four  = trim($_POST['four'] ?? '');
    $five  = trim($_POST['five'] ?? '');
    $six   = trim($_POST['six'] ?? '');

    // Combined OTP
    $verify_token = $one . $two . $three . $four . $five . $six;

    try {

        /* =========================================================
           FAST TOKEN VALIDATION
           ---------------------------------------------------------
           SELECT ONLY REQUIRED FIELDS
           LIMIT 1 FOR PERFORMANCE
        ========================================================= */

        $stmt = $pdo->prepare("
            SELECT verify_status
            FROM register
            WHERE verify_token = :token
            LIMIT 1
        ");

        $stmt->execute([
            ':token' => $token
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Token Exists
        if ($user) {

            // Not Yet Verified
            if ($user['verify_status'] == '0') {

                /* =========================================================
                   FAST UPDATE QUERY
                ========================================================= */

                $updateStmt = $pdo->prepare("
                    UPDATE register
                    SET verify_status = '1'
                    WHERE verify_token = :verify_token
                    LIMIT 1
                ");

                $updated = $updateStmt->execute([
                    ':verify_token' => $verify_token
                ]);

                if ($updated && $updateStmt->rowCount() > 0) {

                    $_SESSION['status'] = "Verification Successful! Please Sign In";

                    header("Location: login");
                    exit();

                } else {

                    $_SESSION['status'] = "Verification Failed";

                    header("Location: login");
                    exit();
                }

            } else {

                $_SESSION['status'] = "Account already Verified. Please Sign In";

                header("Location: login");
                exit();
            }

        } else {

            $_SESSION['status'] = "This token does not exist";

            header("Location: login");
            exit();
        }

    } catch (PDOException $e) {

        error_log($e->getMessage());

        $_SESSION['status'] = "Something went wrong. Please try again.";

        header("Location: login");
        exit();
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
<div class="login-back-button">
    <a href="login">
        <i class="bi bi-arrow-left-short"></i>
    </a>
</div>

<!-- Login Wrapper -->
<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 bg-light">

    <div class="custom-container p-4 rounded shadow-sm"
         style="max-width:400px;width:100%;">

        <!-- Header -->
        <div class="text-center mb-4">

            <img src="img/electrisol-img/verify.png"
                 alt="Verify"
                 width="150"
                 class="mx-auto d-block mb-3">

            <h3 class="fw-bold">
                Verify Your Registration
            </h3>

            <p class="text-muted mb-0">
                Enter the OTP code sent to your email
            </p>

        </div>

        <!-- OTP Form -->
        <div class="otp-verify-form mt-4">

            <form action="" method="post" class="mt-3">

                <div class="d-flex justify-content-between mb-3 otp-input-group">

                    <?php
                    $otp_fields = ['one','two','three','four','five','six'];

                    foreach($otp_fields as $field):
                    ?>

                    <input type="text"
                           name="<?php echo $field; ?>"
                           maxlength="1"
                           class="form-control text-center fs-5 mx-1 otp-input"
                           placeholder="-"
                           required>

                    <?php endforeach; ?>

                </div>

                <button type="submit"
                        name="verify"
                        class="btn btn-primary w-100 fw-semibold">

                    Verify &amp; Proceed

                </button>

            </form>

        </div>

        <!-- Resend OTP -->
        <div class="login-meta-data text-center mt-3">

            <p class="text-muted mb-0">

                Didn't receive OTP?

                <span class="otp-sec text-primary cursor-pointer"
                      id="resendOTP">

                    Resend

                </span>

            </p>

        </div>

    </div>

</div>

<style>
.otp-input-group input{
    width:45px;
    height:55px;
    font-size:1.5rem;
    text-align:center;
    border-radius:8px;
    border:1px solid #ced4da;
    transition:border-color 0.2s;
}

.otp-input-group input:focus{
    border-color:#0d6efd;
    outline:none;
    box-shadow:0 0 3px rgba(13,110,253,0.3);
}

.cursor-pointer{
    cursor:pointer;
}
</style>

<script>
/* =========================================================
   AUTO OTP INPUT SWITCHING
========================================================= */

const inputs = document.querySelectorAll('.otp-input');

inputs.forEach((input, idx) => {

    input.addEventListener('input', () => {

        if (
            input.value.length === 1 &&
            idx < inputs.length - 1
        ) {
            inputs[idx + 1].focus();
        }
    });

    input.addEventListener('keydown', (e) => {

        if (
            e.key === 'Backspace' &&
            idx > 0 &&
            !input.value
        ) {
            inputs[idx - 1].focus();
        }
    });

});
</script>

<!-- All JavaScript Files -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/internet-status.js"></script>
<script src="js/dark-rtl.js"></script>
<script src="js/otp-timer.js"></script>
<script src="js/otp-input-switch.js"></script>
<script src="js/active.js"></script>
<script src="js/pwa.js"></script>

</body>
</html>