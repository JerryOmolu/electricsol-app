<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<?php 
// STRICT LOGIN CHECK (FIXED LOGIC)
if (!isset($_SESSION['verify_status']) || $_SESSION['verify_status'] !== 1) {
    header("Location: login");
    exit;
}

// GET USER
$fullname = $_SESSION['fullname'] ?? '';
?>

<?php 
/* =========================================================
   ADD TO CART (PDO OPTIMIZED)
========================================================= */
if (isset($_POST['add'])) {

    $product_id = $_GET['id'] ?? null;

    $hidden_product_name   = $_POST['hidden_product_name'];
    $hidden_product_number = $_POST['hidden_product_number'];
    $hidden_image_one      = $_POST['hidden_image_one'];
    $hidden_price          = $_POST['hidden_price'];
    $hidden_quantity       = $_POST['hidden_quantity'];
    $hidden_amount         = $_POST['hidden_amount'];
    $hidden_order_number   = $_POST['hidden_order_number'];
    $hidden_stock_level    = $_POST['hidden_stock_level'];

    $errors = [];

    // CHECK DUPLICATE CART ITEM (FAST COUNT QUERY)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM cart 
        WHERE product_number = :product_number 
        AND customer_name = :customer_name 
        AND payment_status = 'Pending'
    ");
    $stmt->execute([
        ':product_number' => $hidden_product_number,
        ':customer_name'  => $fullname
    ]);

    if ($stmt->fetchColumn() > 0) {
        $errors['n'] = "$hidden_product_name already exists in your cart";
    }

    // INSERT INTO CART (ONLY IF NO ERROR)
    if (count($errors) == 0) {

        $insert = $pdo->prepare("
            INSERT INTO cart (
                customer_name,
                product_name,
                product_number,
                image_one,
                price,
                stock_level,
                quantity,
                amount,
                order_number,
                payment_status
            ) VALUES (
                :customer_name,
                :product_name,
                :product_number,
                :image_one,
                :price,
                :stock_level,
                :quantity,
                :amount,
                :order_number,
                'Pending'
            )
        ");

        $insert->execute([
            ':customer_name'   => $fullname,
            ':product_name'    => $hidden_product_name,
            ':product_number'  => $hidden_product_number,
            ':image_one'       => $hidden_image_one,
            ':price'           => $hidden_price,
            ':stock_level'     => $hidden_stock_level,
            ':quantity'        => $hidden_quantity,
            ':amount'          => $hidden_amount,
            ':order_number'    => $hidden_order_number
        ]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Affan - PWA Mobile HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="theme-color" content="#0134d4">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <title>Electricsol-Mobile App</title>

  <link rel="icon" href="favicon/favicon.ico">

  <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="style.css">
  <link rel="manifest" href="manifest.json">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

<div id="preloader">
  <div class="spinner-grow text-primary" role="status"></div>
</div>

<div class="internet-connection-status" id="internetStatus"></div>

<!-- HEADER (UNCHANGED UI) -->
<div class="header-area shadow-sm py-2 mb-3" id="headerArea" style="background-color: #ffffff;">
  <div class="container">
    <div class="header-content header-style-five d-flex align-items-center justify-content-between position-relative">

      <div class="back-button">
        <a href="home" class="d-flex align-items-center justify-content-center p-2 rounded-circle hover-shadow">
          <i class="bi bi-arrow-left-short fs-3 text-dark"></i>
        </a>
      </div>

      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 d-flex align-items-center justify-content-center gap-2">
          <img src="img/electrisol-img/bell.png" width="30px">
          Notifications
        </h6>
      </div>

      <div class="header-extra"></div>

    </div>
  </div>
</div>

<?php include "includes/home_side_nav_left.php"; ?>

<div class="page-content-wrapper py-3">
<div class="notification-area py-3">
<div class="container">

<?php
$current_time = date('F j, Y H:i:s A');

/* =========================
   1. CART NOTIFICATIONS (FAST COUNT)
========================= */
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM cart 
    WHERE customer_name = :name 
    AND payment_status = 'Pending'
");
$stmt->execute([':name' => $fullname]);
$cart_count = $stmt->fetchColumn();

if ($cart_count > 0) {
    echo "
    <div class='notification-card d-flex align-items-center mb-3 shadow-sm'>
        <div class='notification-icon bg-primary text-white p-3 rounded-circle me-3'>
            <i class='fa fa-shopping-cart fa-lg'></i>
        </div>
        <div class='notification-content flex-grow-1'>
            <h6 class='mb-1'>You have $cart_count items in your Shopping Cart</h6>
            <p class='mb-0'>Kindly check out and pay for your order.</p>
            <small class='text-muted'>$current_time</small>
        </div>
    </div>";
}

/* =========================
   2. DEVICE NOTIFICATIONS (COUNT)
========================= */
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM device 
    WHERE device_owner_name = :name
");
$stmt->execute([':name' => $fullname]);
$device_count = $stmt->fetchColumn();

if ($device_count > 0) {
    echo "
    <div class='notification-card d-flex align-items-center mb-3 shadow-sm unread'>
        <div class='notification-icon bg-success text-white p-3 rounded-circle me-3'>
            <i class='fa fa-check-circle fa-lg'></i>
        </div>
        <div class='notification-content flex-grow-1'>
            <h6 class='mb-1'>You have added $device_count devices</h6>
            <p class='mb-0'>Go to Device Management to check energy usage.</p>
            <small class='text-muted'>$current_time</small>
        </div>
    </div>";
}

/* =========================
   3. PAYMENT NOTIFICATIONS (TODAY COUNT)
========================= */
$today = date("Y-m-d");

$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM payment 
    WHERE customer_name = :name 
    AND payment_date = :today
");
$stmt->execute([
    ':name' => $fullname,
    ':today' => $today
]);

$payment_count = $stmt->fetchColumn();

if ($payment_count > 0) {
    echo "
    <div class='notification-card d-flex align-items-center mb-3 shadow-sm'>
        <div class='notification-icon bg-warning text-white p-3 rounded-circle me-3'>
            <i class='fa fa-money fa-lg'></i>
        </div>
        <div class='notification-content flex-grow-1'>
            <h6 class='mb-1'>You have successfully made payment for your order(s)</h6>
            <p class='mb-0'>Check your invoice.</p>
            <small class='text-muted'>$current_time</small>
        </div>
    </div>";
}
?>

</div>
</div>
</div>

<style>
.notification-card {
    background-color: #fff;
    padding: 15px 20px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.notification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.notification-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.unread {
    border-left: 4px solid #198754;
}

.notification-content h6 { font-weight: 600; }
.notification-content p { font-size: 0.9rem; }
.notification-content small { font-size: 0.75rem; }
</style>

<?php include "includes/home_footer_nav.php"; ?>

</body>
</html>