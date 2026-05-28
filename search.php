<?php
ob_start();

require_once "includes/db.php";
session_start();

require_once "includes/functions.php";

/* =========================================================
   SESSION VERIFICATION
========================================================= */

if (
    !isset($_SESSION['verify_status']) ||
    (int)$_SESSION['verify_status'] !== 1
) {
    header("Location: login");
    exit();
}

/* =========================================================
   ADD TO CART
========================================================= */

if (isset($_POST['add'])) {

    if (!isset($pdo) || !$pdo instanceof PDO) {
        die("Database connection failed.");
    }

    $product_id = (int)($_GET['id'] ?? 0);

    $hidden_product_name   = trim($_POST['hidden_product_name'] ?? '');
    $hidden_product_number = trim($_POST['hidden_product_number'] ?? '');
    $hidden_image_one      = trim($_POST['hidden_image_one'] ?? '');
    $hidden_price          = (float)($_POST['hidden_price'] ?? 0);
    $hidden_quantity       = (int)($_POST['hidden_quantity'] ?? 0);
    $hidden_amount         = (float)($_POST['hidden_amount'] ?? 0);
    $hidden_order_number   = trim($_POST['hidden_order_number'] ?? '');
    $hidden_stock_level    = (int)($_POST['hidden_stock_level'] ?? 0);

    $fullname = trim($_SESSION['fullname'] ?? '');

    if (
        $fullname !== '' &&
        $hidden_product_name !== '' &&
        $hidden_product_number !== '' &&
        $hidden_quantity > 0
    ) {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO cart
                (
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
                )
                VALUES
                (
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

            $success = $stmt->execute([
                ':customer_name'  => $fullname,
                ':product_name'   => $hidden_product_name,
                ':product_number' => $hidden_product_number,
                ':image_one'      => $hidden_image_one,
                ':price'          => $hidden_price,
                ':stock_level'    => $hidden_stock_level,
                ':quantity'       => $hidden_quantity,
                ':amount'         => $hidden_amount,
                ':order_number'   => $hidden_order_number
            ]);

            if (!$success) {

                $_SESSION['head'] = "Error!";
                $_SESSION['status'] = "Unable to add item to cart.";
                $_SESSION['status_code'] = "error";

                header("Location: cart");
                exit();
            }

        } catch (PDOException $e) {

            error_log($e->getMessage());

            $_SESSION['head'] = "Database Error!";
            $_SESSION['status'] = "Something went wrong. Please try again.";
            $_SESSION['status_code'] = "error";

            header("Location: cart");
            exit();
        }

    } else {

        $_SESSION['head'] = "Invalid Input!";
        $_SESSION['status'] = "Please fill all required fields correctly.";
        $_SESSION['status_code'] = "warning";

        header("Location: cart");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="Electricsol Mobile Marketplace">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="theme-color" content="#0134d4">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<title>Electricsol Marketplace</title>

<!-- Favicon -->
<link rel="icon" href="favicon/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

<!-- Font Awesome -->
<link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">

<!-- Rating -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<!-- Main CSS -->
<link rel="stylesheet" href="style.css">

<!-- Manifest -->
<link rel="manifest" href="manifest.json">

<style>

/* =========================================================
   GLOBAL
========================================================= */

body{
    background: #f5f7fb;
}

/* =========================================================
   HEADER
========================================================= */

.header-area{
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0,0,0,0.04);
    position: sticky;
    top: 0;
    z-index: 999;
}

.header-content{
    min-height: 65px;
}

.btn-back-modern{
    width: 42px;
    height: 42px;
    border-radius: 14px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.btn-back-modern:hover{
    transform: translateY(-2px);
    color: #0d6efd;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.marketplace-title{
    font-weight: 700;
    font-size: 1rem;
    color: #111827;
}

.marketplace-title img{
    border-radius: 10px;
}

.navbar--toggler span{
    width: 24px;
    height: 2px;
    background: #111;
    margin: 5px 0;
    border-radius: 20px;
    display: block;
}

/* =========================================================
   CART BUTTON
========================================================= */

.cart-btn{
    width: 48px;
    height: 48px;
    border-radius: 16px;
    border: none;
    background: linear-gradient(135deg,#0d6efd,#0134d4);
    box-shadow: 0 10px 20px rgba(13,110,253,0.2);
    transition: all 0.3s ease;
}

.cart-btn:hover{
    transform: translateY(-3px);
    box-shadow: 0 15px 25px rgba(13,110,253,0.3);
}

.cart-btn img{
    width: 24px;
}

.cart-badge{
    font-size: 0.7rem;
    padding: 6px 7px;
}

/* =========================================================
   SEARCH
========================================================= */

.search-card{
    border: none;
    border-radius: 22px;
    background: #fff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.search-input{
    height: 56px;
    border-radius: 16px 0 0 16px !important;
    border: 1px solid #eef1f5;
    font-size: 0.95rem;
    padding-left: 18px;
    background: #f9fbff;
}

.search-input:focus{
    border-color: #0d6efd;
    box-shadow: none;
    background: #fff;
}

.search-btn{
    width: 60px;
    border-radius: 0 16px 16px 0 !important;
    background: linear-gradient(135deg,#111827,#0d6efd);
    border: none;
}

/* =========================================================
   PRODUCT CARD
========================================================= */

.single-product-card{
    border: none;
    border-radius: 22px;
    overflow: hidden;
    background: #fff;
    transition: all 0.35s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    height: 100%;
}

.single-product-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 20px 35px rgba(0,0,0,0.12);
}

.product-thumbnail{
    border-radius: 18px;
    overflow: hidden;
    background: #f8f9fc;
}

.product-thumbnail img{
    width: 100%;
    height: 180px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.single-product-card:hover .product-thumbnail img{
    transform: scale(1.05);
}

.product-title{
    color: #111827;
    font-weight: 600;
    font-size: 0.92rem;
    line-height: 1.4;
    text-decoration: none;
    min-height: 42px;
}

.product-title:hover{
    color: #0d6efd;
    text-decoration: none;
}

.sale-price{
    color: #0d6efd;
    font-size: 1rem;
    font-weight: 800;
}

.add-cart-btn{
    border: none;
    border-radius: 14px;
    padding: 12px;
    font-weight: 600;
    background: linear-gradient(135deg,#0134d4,#0d6efd);
    transition: all 0.3s ease;
    box-shadow: 0 10px 18px rgba(13,110,253,0.15);
}

.add-cart-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 15px 24px rgba(13,110,253,0.25);
}

/* =========================================================
   ALERT
========================================================= */

.custom-alert{
    border-radius: 18px;
    border: none;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 576px){

    .product-thumbnail img{
        height: 140px;
    }

    .marketplace-title{
        font-size: 0.92rem;
    }

    .single-product-card{
        border-radius: 18px;
    }

    .search-input{
        height: 52px;
    }
}

</style>

</head>

<body>

<!-- PRELOADER -->
<div id="preloader">
    <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<!-- INTERNET STATUS -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- HEADER -->
<div class="header-area" id="headerArea">

    <div class="container">

        <div class="header-content d-flex align-items-center justify-content-between py-2">

            <!-- BACK -->
            <div class="back-button">
                <a href="home" class="btn-back-modern text-decoration-none">
                    <i class="bi bi-arrow-left-short fs-3"></i>
                </a>
            </div>

            <!-- TITLE -->
            <div class="page-heading text-center flex-grow-1 px-2">
                <h6 class="mb-0 d-flex align-items-center justify-content-center marketplace-title">
                    <img src="img/electrisol-img/sho.png" width="32" class="me-2">
                    Market Place
                </h6>
            </div>

            <!-- CART -->
            <div>

                <a href="cart.php" class="text-decoration-none">

                    <button class="cart-btn position-relative">

                        <img src="img/electrisol-img/cart-2.png" alt="Cart">

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">

<?php

$number_of_cart = 0;

if (!empty($_SESSION['fullname'])) {

    $fullname = trim($_SESSION['fullname']);

    try {

        $stmt = $pdo->prepare("
            SELECT COUNT(*)
            FROM cart
            WHERE customer_name = :customer_name
            AND payment_status = 'Pending'
            LIMIT 1
        ");

        $stmt->execute([
            ':customer_name' => $fullname
        ]);

        $number_of_cart = (int)$stmt->fetchColumn();

    } catch (PDOException $e) {

        error_log($e->getMessage());
        $number_of_cart = 0;
    }
}

echo $number_of_cart;

?>

                        </span>

                    </button>

                </a>

            </div>

        </div>

    </div>

</div>

<!-- SIDENAV -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- CONTENT -->
<div class="page-content-wrapper py-3">

    <!-- SEARCH -->
    <div class="shop-pagination pb-3">

        <div class="container">

            <div class="card search-card">

                <div class="card-body p-3">

                    <form action="search" method="post">

                        <div class="input-group">

                            <input
                                class="form-control search-input"
                                type="search"
                                placeholder="Search products..."
                                name="search"
                                value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>"
                                required
                            >

                            <button class="btn search-btn" type="submit" name="submit">
                                <i class="bi bi-search text-white fs-5"></i>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- PRODUCTS -->
    <div class="top-products-area">

        <div class="container">

            <div class="row g-4">

<?php

if (isset($_POST['submit'])) {

    $search = trim($_POST['search'] ?? '');

    if ($search !== '') {

        try {

            $stmt = $pdo->prepare("
                SELECT
                    product_id,
                    product_name,
                    product_number,
                    price,
                    stock_level,
                    image_one
                FROM product
                WHERE keywords LIKE :search
                LIMIT 100
            ");

            $stmt->execute([
                ':search' => "%{$search}%"
            ]);

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($products)) {

                echo "
                <div class='col-12'>
                    <div class='alert alert-danger custom-alert text-center'>
                        <i class='fa fa-search me-2'></i>
                        No results found for 
                        <strong>" . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . "</strong>
                    </div>
                </div>";

            } else {

                foreach ($products as $row) {

                    $product_id     = (int)$row['product_id'];
                    $product_name   = htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8');
                    $product_number = htmlspecialchars($row['product_number'], ENT_QUOTES, 'UTF-8');
                    $price          = number_format((float)$row['price']);
                    $raw_price      = (float)$row['price'];
                    $stock_level    = (int)$row['stock_level'];
                    $image_one      = htmlspecialchars($row['image_one'], ENT_QUOTES, 'UTF-8');

                    $order_number = mt_rand(1000000, 9999999);

?>

<div class="col-6 col-sm-6 col-md-4 col-lg-3">

    <div class="card single-product-card">

        <div class="card-body p-3 d-flex flex-column">

            <!-- IMAGE -->
            <a class="product-thumbnail d-block mb-3"
               href="shop-details?id=<?php echo $product_id; ?>">

                <img
                    src="admin/images/products/<?php echo $image_one; ?>"
                    alt="<?php echo $product_name; ?>"
                    loading="lazy"
                >

            </a>

            <!-- TITLE -->
            <a class="product-title mb-2"
               href="shop-details?id=<?php echo $product_id; ?>">

                <?php echo $product_name; ?>

            </a>

            <!-- PRICE -->
            <div class="sale-price mb-3">

                &#8358;<?php echo $price; ?>

            </div>

            <!-- FORM -->
            <form
                action="shop.php?action=add&id=<?php echo $product_id; ?>"
                method="post"
                class="mt-auto"
            >

                <input type="hidden" name="hidden_product_name" value="<?php echo $product_name; ?>">
                <input type="hidden" name="hidden_product_number" value="<?php echo $product_number; ?>">
                <input type="hidden" name="hidden_image_one" value="<?php echo $image_one; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $raw_price; ?>">
                <input type="hidden" name="hidden_quantity" value="1">
                <input type="hidden" name="hidden_amount" value="<?php echo $raw_price; ?>">
                <input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level; ?>">
                <input type="hidden" name="hidden_order_number" value="<?php echo $order_number; ?>">

                <button
                    class="btn add-cart-btn text-white w-100"
                    type="submit"
                    name="add"
                >

                    <i class="bi bi-cart-plus me-1"></i>
                    Add to Cart

                </button>

            </form>

        </div>

    </div>

</div>

<?php
                }
            }

        } catch (PDOException $e) {

            error_log($e->getMessage());

            echo "
            <div class='col-12'>
                <div class='alert alert-danger custom-alert text-center'>
                    Unable to process search at the moment.
                </div>
            </div>";
        }
    }
}
?>

            </div>

        </div>

    </div>

</div>

<!-- FOOTER -->
<?php include "includes/home_footer_nav.php"; ?>

</body>
</html>