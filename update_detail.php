<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>

<?php
/* =========================================================
   PDO PROFILE UPDATE OPTIMIZATION
   Ultra-Fast + Low Server Load
========================================================= */

$success_message = '';
$error_message   = '';

if (isset($_POST['update'])) {

    // Fast trimmed inputs
    $address = trim($_POST['address'] ?? '');

    // Session values
    $fullname = trim($_SESSION['fullname'] ?? '');
    $phone    = trim($_SESSION['phone'] ?? '');
    $email    = trim($_SESSION['email'] ?? '');

    if ($address !== '') {

        try {

            /* =========================================================
               OPTIMIZED UPDATE QUERY
               ---------------------------------------------------------
               - PDO Prepared Statement
               - SQL Injection Safe
               - Lower RAM Usage
               - Faster Query Parsing
            ========================================================= */

            $stmt = $pdo->prepare("
                UPDATE register
                SET address = :address
                WHERE phone = :phone
                AND email = :email
                LIMIT 1
            ");

            $updated = $stmt->execute([
                ':address' => $address,
                ':phone'   => $phone,
                ':email'   => $email
            ]);

            if ($updated) {

                $success_message = "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='bi bi-check-circle me-2'></i>
                    Profile updated successfully!
                    <button type='button'
                            class='btn-close'
                            data-bs-dismiss='alert'
                            aria-label='Close'>
                    </button>
                </div>";

            } else {

                $error_message = "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='bi bi-x-circle me-2'></i>
                    Unable to update profile
                    <button type='button'
                            class='btn-close'
                            data-bs-dismiss='alert'
                            aria-label='Close'>
                    </button>
                </div>";
            }

        } catch (PDOException $e) {

            error_log($e->getMessage());

            $error_message = "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <i class='bi bi-x-circle me-2'></i>
                Something went wrong. Please try again.
                <button type='button'
                        class='btn-close'
                        data-bs-dismiss='alert'
                        aria-label='Close'>
                </button>
            </div>";
        }

    } else {

        $error_message = "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='bi bi-x-circle me-2'></i>
            Address field cannot be empty
            <button type='button'
                    class='btn-close'
                    data-bs-dismiss='alert'
                    aria-label='Close'>
            </button>
        </div>";
    }
}
?>


<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Dark mode switching -->
<div class="dark-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">

        <div class="dark-mode-text text-center">
            <i class="bi bi-moon"></i>
            <p class="mb-0">Switching to dark mode</p>
        </div>

        <div class="light-mode-text text-center">
            <i class="bi bi-brightness-high"></i>
            <p class="mb-0">Switching to light mode</p>
        </div>

    </div>
</div>

<!-- Side Nav -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- Header Area -->
<div class="header-area sticky-top bg-light shadow-sm" id="headerArea">

    <div class="container">

        <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">

            <!-- Back Button -->
            <div class="back-button">
                <a href="settings" class="text-dark">
                    <i class="bi bi-arrow-left-short fs-3"></i>
                </a>
            </div>

            <!-- Page Title -->
            <div class="page-heading text-center flex-grow-1">
                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-person me-1"></i>
                    Update Profile
                </h6>
            </div>

            <!-- Navbar Toggler -->
            <div class="navbar--toggler d-flex align-items-center">
                <span class="d-block bg-dark rounded mb-1"
                      style="width:25px;height:3px;"></span>

                <span class="d-block bg-dark rounded mb-1"
                      style="width:25px;height:3px;"></span>

                <span class="d-block bg-dark rounded"
                      style="width:25px;height:3px;"></span>
            </div>

        </div>

    </div>

</div>

<style>
#headerArea{
    z-index:1050;
}

.navbar--toggler span:hover{
    background-color:#0d6efd;
}

.page-heading h6{
    font-size:1rem;
    color:#333;
}
</style>

<!-- Page Content -->
<div class="page-content-wrapper py-3">

    <div class="container">

        <!-- User Info Card -->
        <div class="card user-info-card mb-3 shadow-sm">

            <div class="card-body d-flex align-items-center">

                <!-- Profile Image -->
                <div class="user-profile position-relative me-3">

                    <img src="img/electrisol-img/user.png"
                         class="rounded-circle border"
                         width="80"
                         alt="User Profile">

                    <label for="profile-upload"
                           class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1 text-white cursor-pointer"
                           title="Change Profile Picture">

                        <i class="bi bi-pencil fs-6"></i>

                    </label>

                    <input id="profile-upload"
                           class="d-none"
                           type="file"
                           name="profile">

                </div>

                <!-- User Info -->
                <div class="user-info">

                    <h5 class="mb-1 fw-bold">
                        <?php echo htmlspecialchars($_SESSION['fullname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                    </h5>

                    <p class="mb-0 text-muted">
                        <?php echo htmlspecialchars($_SESSION['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                </div>

            </div>

        </div>

        <!-- User Data Card -->
        <div class="card user-data-card shadow-sm">

            <div class="card-body">

                <!-- Alerts -->
                <?php
                    echo $success_message;
                    echo $error_message;
                ?>

                <!-- Form -->
                <form action="" method="post" class="mt-3">

                    <!-- Fullname -->
                    <div class="mb-3">

                        <label for="fullname"
                               class="form-label fw-semibold">

                            Full Name

                        </label>

                        <input type="text"
                               id="fullname"
                               class="form-control"
                               value="<?php echo htmlspecialchars($_SESSION['fullname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               readonly>

                    </div>

                    <!-- Email -->
                    <div class="mb-3">

                        <label for="email"
                               class="form-label fw-semibold">

                            Email Address

                        </label>

                        <input type="email"
                               id="email"
                               class="form-control"
                               value="<?php echo htmlspecialchars($_SESSION['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               readonly>

                    </div>

                    <!-- Phone -->
                    <div class="mb-3">

                        <label for="phone"
                               class="form-label fw-semibold">

                            Phone Number

                        </label>

                        <input type="text"
                               id="phone"
                               class="form-control"
                               value="<?php echo htmlspecialchars($_SESSION['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               maxlength="11"
                               readonly>

                    </div>

                    <!-- Address -->
                    <div class="mb-3">

                        <label for="address"
                               class="form-label fw-semibold">

                            Address

                        </label>

                        <input type="text"
                               id="address"
                               class="form-control"
                               placeholder="Enter your address"
                               name="address">

                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            name="update"
                            class="btn btn-success w-100 fw-semibold">

                        Update Now

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<style>
.user-profile{
    width:80px;
    height:80px;
}

.user-profile img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.cursor-pointer{
    cursor:pointer;
}
</style>

<?php include "includes/home_footer_nav.php"; ?>