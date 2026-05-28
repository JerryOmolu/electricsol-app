<?php ob_start(); ?>
<?php
require_once "includes/db.php";
session_start();
require_once "includes/functions.php";

/* =========================================================
   SESSION VALIDATION
========================================================= */

if (
    !isset($_SESSION['verify_status']) ||
    $_SESSION['verify_status'] != '1'
) {
    header("Location: login");
    exit();
}

/* =========================================================
   USER INFO
========================================================= */

$fullname = trim($_SESSION['fullname'] ?? '');

/* =========================================================
   ADD TO CART SYSTEM
========================================================= */

$errors = [];

if (isset($_POST['add'])) {

    $product_id            = (int)($_GET['id'] ?? 0);
    $hidden_product_name   = trim($_POST['hidden_product_name'] ?? '');
    $hidden_product_number = trim($_POST['hidden_product_number'] ?? '');
    $hidden_image_one      = trim($_POST['hidden_image_one'] ?? '');
    $hidden_price          = (float)($_POST['hidden_price'] ?? 0);
    $hidden_quantity       = (int)($_POST['hidden_quantity'] ?? 1);
    $hidden_amount         = (float)($_POST['hidden_amount'] ?? 0);
    $hidden_order_number   = trim($_POST['hidden_order_number'] ?? '');
    $hidden_stock_level    = (int)($_POST['hidden_stock_level'] ?? 0);

    try {

        $checkStmt = $pdo->prepare("
            SELECT EXISTS(
                SELECT 1
                FROM cart
                WHERE product_number = :product_number
                AND customer_name = :customer_name
                AND payment_status = 'Pending'
                LIMIT 1
            )
        ");

        $checkStmt->execute([
            ':product_number' => $hidden_product_number,
            ':customer_name'  => $fullname
        ]);

        $exists = (bool)$checkStmt->fetchColumn();

        if ($exists) {

            $errors['n'] = $hidden_product_name . " already exists in your cart";

        } else {

            $insertStmt = $pdo->prepare("
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

            $insertStmt->execute([
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
        }

    } catch (PDOException $e) {

        error_log($e->getMessage());

        $errors['n'] = "Unable to add product to cart.";
    }
}

/* =========================================================
   FAST CART COUNT
========================================================= */

$number_of_cart = 0;

try {

    $cartStmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM cart
        WHERE customer_name = :customer_name
        AND payment_status = 'Pending'
    ");

    $cartStmt->execute([
        ':customer_name' => $fullname
    ]);

    $number_of_cart = (int)$cartStmt->fetchColumn();

} catch (PDOException $e) {

    error_log($e->getMessage());
}

/* =========================================================
   PAGINATION
========================================================= */

$perpage = 20;

$page = isset($_GET['page']) && is_numeric($_GET['page'])
    ? (int)$_GET['page']
    : 1;

$page = max($page, 1);

$page_1 = ($page - 1) * $perpage;

/* =========================================================
   FAST TOTAL PRODUCTS COUNT
========================================================= */

try {

    $totalStmt = $pdo->query("
        SELECT COUNT(product_id)
        FROM product
    ");

    $total_products = (int)$totalStmt->fetchColumn();

    $total_pages = ceil($total_products / $perpage);

} catch (PDOException $e) {

    error_log($e->getMessage());

    $total_pages = 1;
}

/* =========================================================
   FAST PRODUCT FETCH
========================================================= */

try {

    $productStmt = $pdo->prepare("
        SELECT
            product_id,
            product_name,
            product_number,
            price,
            stock_level,
            image_one
        FROM product
        ORDER BY added_on DESC
        LIMIT :offset, :perpage
    ");

    $productStmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
    $productStmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);

    $productStmt->execute();

    $products = $productStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    error_log($e->getMessage());

    $products = [];
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

<title>Electricsol - Market Place</title>

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

<!-- RateYo -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

<!-- Main CSS -->
<link rel="stylesheet" href="style.css">

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<style>

/* =========================================================
   GLOBAL
========================================================= */

body{
    background: #f4f7fb;
    color: #111827;
}

/* =========================================================
   HEADER
========================================================= */

#headerArea{
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    z-index: 1050;
}

.header-content{
    min-height: 68px;
}

.back-btn-modern{
    width: 44px;
    height: 44px;
    border-radius: 14px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
}

.back-btn-modern:hover{
    transform: translateY(-2px);
    background: #f8f9ff;
}

.page-heading h6{
    font-weight: 700;
    color: #111827;
    font-size: 1rem;
}

.market-badge{
    background: linear-gradient(135deg,#0134d4,#0d6efd);
    color: #fff;
    border-radius: 16px;
    padding: 12px;
    border: none;
    box-shadow: 0 12px 25px rgba(13,110,253,0.22);
    transition: all 0.3s ease;
}

.market-badge:hover{
    transform: translateY(-3px);
}

#cart-badge{
    min-width: 22px;
    height: 22px;
    line-height: 22px;
    font-size: 0.72rem;
}

/* =========================================================
   SEARCH
========================================================= */

.search-card{
    border: none;
    border-radius: 24px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 12px 30px rgba(0,0,0,0.05);
}

.search-input{
    border: none;
    background: #f8faff;
    height: 54px;
    border-radius: 16px;
    font-size: 0.95rem;
    box-shadow: none !important;
}

.search-btn{
    width: 54px;
    height: 54px;
    border-radius: 16px;
    border: none;
    background: linear-gradient(135deg,#111827,#0134d4);
    color: #fff;
    transition: all 0.3s ease;
}

.search-btn:hover{
    transform: scale(1.04);
}

/* =========================================================
   PRODUCT CARD
========================================================= */

.single-product-card{
    border: none;
    border-radius: 24px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    transition: all 0.35s ease;
}

.single-product-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.product-image-wrapper{
    position: relative;
    overflow: hidden;
    border-radius: 18px;
}

.product-image-wrapper img{
    width: 100%;
    height: 210px;
    object-fit: cover;
    transition: all 0.4s ease;
}

.single-product-card:hover .product-image-wrapper img{
    transform: scale(1.06);
}

.sale-badge{
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(0,0,0,0.75);
    color: #fff;
    padding: 6px 12px;
    border-radius: 30px;
    font-size: 0.72rem;
    backdrop-filter: blur(5px);
}

.product-title{
    color: #111827;
    font-weight: 700;
    font-size: 0.95rem;
    text-decoration: none;
    line-height: 1.5;
}

.product-title:hover{
    color: #0d6efd;
    text-decoration: none;
}

.product-price{
    color: #0134d4;
    font-size: 1.05rem;
    font-weight: 800;
}

.add-cart-btn{
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg,#111827,#0134d4);
    color: #fff;
    font-weight: 600;
    height: 42px;
    transition: all 0.3s ease;
}

.add-cart-btn:hover{
    transform: translateY(-2px);
}

/* =========================================================
   ALERT
========================================================= */

.alert-modern{
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(220,53,69,0.08);
}

/* =========================================================
   PAGINATION
========================================================= */

.pagination .page-link{
    width: 42px;
    height: 42px;
    border-radius: 14px !important;
    margin: 0 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    color: #111827;
    background: #fff;
    box-shadow: 0 6px 16px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.pagination .page-link:hover{
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link{
    background: linear-gradient(135deg,#0134d4,#0d6efd);
    color: #fff;
}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 576px){

    .product-image-wrapper img{
        height: 170px;
    }

    .page-heading h6{
        font-size: 0.92rem;
    }

    .single-product-card{
        border-radius: 20px;
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
<div class="header-area sticky-top" id="headerArea">

<div class="container">

<div class="header-content d-flex align-items-center justify-content-between py-2">

<!-- BACK -->
<div class="back-button">

<a href="home" class="back-btn-modern text-decoration-none">

<i class="bi bi-arrow-left-short fs-3 text-dark"></i>

</a>

</div>

<!-- TITLE -->
<div class="page-heading text-center flex-grow-1">

<h6 class="mb-0 d-flex align-items-center justify-content-center">

<img src="img/electrisol-img/sho.png" width="28" class="me-2">

Market Place

</h6>

</div>

<!-- CART -->
<div>

<a href="cart.php" class="text-decoration-none">

<button class="market-badge position-relative" type="button">

<img src="img/electrisol-img/cart-2.png" width="28">

<span id="cart-badge"
class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

<?php echo $number_of_cart; ?>

</span>

</button>

</a>

</div>

</div>

</div>

</div>

<!-- AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

function updateCartBadge() {

    $.ajax({
        url: 'cart_count.php',
        method: 'GET',
        cache: false,
        success: function(data) {
            $('#cart-badge').text(data);
        }
    });
}

updateCartBadge();

setInterval(updateCartBadge, 5000);

</script>

<!-- SIDENAV -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- CONTENT -->
<div class="page-content-wrapper py-4">

<div class="container">

<!-- SEARCH -->
<div class="card search-card mb-4">

<div class="card-body p-3">

<form class="d-flex align-items-center"
      action="search"
      method="post">

<input class="form-control search-input me-2"
       type="search"
       placeholder="Search products, solar items, accessories..."
       name="search"
       value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8') : ''; ?>"
       required>

<button class="search-btn"
        type="submit"
        name="submit">

<i class="bi bi-search"></i>

</button>

</form>

</div>

</div>

<!-- ERROR -->
<?php if(isset($errors['n'])): ?>

<div class="alert alert-danger alert-modern">

<?php echo htmlspecialchars($errors['n'], ENT_QUOTES, 'UTF-8'); ?>

</div>

<?php endif; ?>

<!-- PRODUCTS -->
<div class="row g-4">

<?php foreach($products as $row):

$product_id     = (int)$row['product_id'];
$product_name   = htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8');
$product_number = htmlspecialchars($row['product_number'], ENT_QUOTES, 'UTF-8');
$price          = (float)$row['price'];
$stock_level    = (int)$row['stock_level'];
$image_one      = htmlspecialchars($row['image_one'], ENT_QUOTES, 'UTF-8');

?>

<div class="col-6 col-sm-4 col-lg-3">

<div class="card single-product-card h-100">

<div class="card-body p-3 d-flex flex-column">

<!-- BRAND -->
<div class="d-flex align-items-center justify-content-between mb-3">

<img src="img/electrisol-img/Logo%206.png"
     width="52"
     alt="Electricsol">

<span class="sale-badge">

Popular

</span>

</div>

<!-- IMAGE -->
<a href="shop-details?id=<?php echo $product_id; ?>"
   class="product-image-wrapper d-block mb-3">

<img src="admin/images/products/<?php echo $image_one; ?>"
     alt="<?php echo $product_name; ?>">

</a>

<!-- NAME -->
<a href="shop-details?id=<?php echo $product_id; ?>"
   class="product-title mb-2">

<?php echo $product_name; ?>

</a>

<!-- PRICE -->
<div class="product-price mb-3">

&#8358;<?php echo number_format($price, 0); ?>

</div>

<!-- FORM -->
<form action="shop.php?action=add&id=<?php echo $product_id; ?>"
      method="post"
      class="mt-auto">

<input type="hidden" name="hidden_product_name" value="<?php echo $product_name; ?>">
<input type="hidden" name="hidden_product_number" value="<?php echo $product_number; ?>">
<input type="hidden" name="hidden_image_one" value="<?php echo $image_one; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $price; ?>">
<input type="hidden" name="hidden_quantity" value="1">
<input type="hidden" name="hidden_amount" value="<?php echo $price; ?>">
<input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level; ?>">
<input type="hidden" name="hidden_order_number" value="<?php echo mt_rand(1000000, 9999999); ?>">

<button class="btn add-cart-btn w-100"
        type="submit"
        name="add">

<i class="bi bi-cart-plus me-1"></i>

Add to Cart

</button>

</form>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<!-- PAGINATION -->
<nav class="mt-5">

<ul class="pagination justify-content-center flex-wrap">

<?php
$Previous = max($page - 1, 1);
$Next = min($page + 1, $total_pages);
?>

<li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">

<a class="page-link"
   href="shop?page=<?php echo $Previous; ?>">

<i class="bi bi-chevron-left"></i>

</a>

</li>

<?php for($i = 1; $i <= $total_pages; $i++): ?>

<li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">

<a class="page-link"
   href="shop?page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

</li>

<?php endfor; ?>

<li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">

<a class="page-link"
   href="shop?page=<?php echo $Next; ?>">

<i class="bi bi-chevron-right"></i>

</a>

</li>

</ul>

</nav>

</div>

<!-- FOOTER -->
<?php include "includes/home_footer_nav.php"; ?>

</div>

</body>
</html>