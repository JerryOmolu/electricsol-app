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
$errors = [];

/* =========================================================
   ADD TO CART SYSTEM
========================================================= */

if (isset($_POST['add'])) {

    $product_id            = (int)($_GET['id'] ?? 0);
    $hidden_product_name   = trim($_POST['hidden_product_name'] ?? '');
    $hidden_product_number = trim($_POST['hidden_product_number'] ?? '');
    $hidden_image_one      = trim($_POST['hidden_image_one'] ?? '');
    $hidden_price          = (float)($_POST['hidden_price'] ?? 0);
    $hidden_quantity       = (int)($_POST['hidden_quantity'] ?? 1);
    $hidden_amount         = $hidden_price * $hidden_quantity;
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
                ':quantity'       => $hidden_quantity,
                ':amount'         => $hidden_amount,
                ':order_number'   => $hidden_order_number
            ]);
        }

    } catch (PDOException $e) {

        error_log($e->getMessage());

        $errors['n'] = "Unable to add item to cart.";
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
   PRODUCT DETAILS
========================================================= */

$product = null;

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    try {

        $productStmt = $pdo->prepare("
            SELECT
                product_id,
                product_name,
                product_details,
                product_number,
                category,
                price,
                keywords,
                image_one,
                image_two,
                image_three,
                stock_level,
                added_on,
                added_by
            FROM product
            WHERE product_id = :product_id
            LIMIT 1
        ");

        $productStmt->execute([
            ':product_id' => $id
        ]);

        $product = $productStmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        error_log($e->getMessage());
    }
}

/* =========================================================
   RELATED PRODUCTS
========================================================= */

try {

    $relatedStmt = $pdo->prepare("
        SELECT
            product_id,
            product_name,
            product_number,
            price,
            stock_level,
            image_one
        FROM product
        ORDER BY added_on DESC
        LIMIT 4
    ");

    $relatedStmt->execute();

    $related_products = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    error_log($e->getMessage());

    $related_products = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="Electricsol Marketplace">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="theme-color" content="#0134d4">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<title>Electricsol Mobile App</title>

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

<!-- Manifest -->
<link rel="manifest" href="manifest.json">

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
    background: rgba(255,255,255,0.96);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0,0,0,0.04);
    z-index: 1050;
}

.header-content{
    min-height: 65px;
}

.back-btn-modern{
    width: 44px;
    height: 44px;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111;
    transition: all 0.3s ease;
}

.back-btn-modern:hover{
    transform: translateY(-2px);
    color: #0d6efd;
    box-shadow: 0 12px 24px rgba(0,0,0,0.12);
}

.page-heading h6{
    font-weight: 700;
    font-size: 1rem;
}

.cart-btn-modern{
    width: 50px;
    height: 50px;
    border-radius: 16px;
    border: none;
    background: linear-gradient(135deg,#0d6efd,#0134d4);
    box-shadow: 0 12px 25px rgba(13,110,253,0.25);
    transition: all 0.3s ease;
}

.cart-btn-modern:hover{
    transform: translateY(-3px);
}

#cart-badge{
    font-size: 0.72rem;
    min-width: 22px;
    height: 22px;
    line-height: 22px;
}

/* =========================================================
   PRODUCT CARD
========================================================= */

.product-main-card{
    border: none;
    border-radius: 28px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 15px 35px rgba(0,0,0,0.06);
}

.product-gallery{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.product-gallery img{
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 18px;
    transition: all 0.35s ease;
}

.product-gallery img:hover{
    transform: scale(1.04);
}

.product-badge{
    top: 18px;
    left: 18px;
    z-index: 2;
    padding: 8px 14px;
    border-radius: 30px;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.product-info-card{
    border: none;
    border-radius: 24px;
    background: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.product-title{
    font-size: 1.5rem;
    font-weight: 800;
}

.product-price{
    font-size: 2rem;
    font-weight: 800;
    color: #0d6efd;
}

.product-desc{
    line-height: 1.8;
    color: #6b7280;
}

/* =========================================================
   QUANTITY SECTION
========================================================= */

.quantity-wrapper{
    background: #f8faff;
    border-radius: 20px;
    padding: 15px;
}

.qty-btn{
    width: 46px;
    height: 46px;
    border-radius: 14px;
    border: none;
    background: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    box-shadow: 0 6px 15px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
}

.qty-btn:hover{
    transform: scale(1.05);
}

.qty-input{
    height: 48px;
    border-radius: 14px;
    border: none;
    background: #fff;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    font-weight: 700;
}

.add-cart-btn{
    height: 50px;
    border: none;
    border-radius: 16px;
    background: linear-gradient(135deg,#111827,#0d6efd);
    font-weight: 700;
    box-shadow: 0 15px 25px rgba(13,110,253,0.2);
    transition: all 0.3s ease;
}

.add-cart-btn:hover{
    transform: translateY(-3px);
}

/* =========================================================
   RELATED PRODUCTS
========================================================= */

.related-card{
    border: none;
    border-radius: 22px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    transition: all 0.35s ease;
    height: 100%;
}

.related-card:hover{
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.related-card img{
    width: 100%;
    height: 150px;
    object-fit: cover;
    transition: all 0.35s ease;
}

.related-card:hover img{
    transform: scale(1.05);
}

.related-title{
    color: #111827;
    font-weight: 600;
    font-size: 0.92rem;
    text-decoration: none;
    line-height: 1.5;
}

.related-title:hover{
    color: #0d6efd;
    text-decoration: none;
}

.related-price{
    font-size: 1rem;
    font-weight: 700;
    color: #0d6efd;
}

.related-btn{
    border-radius: 14px;
    border: none;
    background: #111827;
    font-weight: 600;
    transition: all 0.3s ease;
}

.related-btn:hover{
    background: #0d6efd;
}

/* =========================================================
   ALERT
========================================================= */

.alert-modern{
    border: none;
    border-radius: 16px;
    padding: 14px 18px;
    box-shadow: 0 10px 25px rgba(220,53,69,0.08);
}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 576px){

    .product-gallery{
        grid-template-columns: repeat(2,1fr);
    }

    .product-gallery img{
        height: 120px;
    }

    .product-title{
        font-size: 1.2rem;
    }

    .product-price{
        font-size: 1.5rem;
    }

    .related-card img{
        height: 120px;
    }

    .page-heading h6{
        font-size: 0.92rem;
    }
}

</style>

<script>

function increment() {

    let quantity = document.getElementById('quantity');

    quantity.value = parseInt(quantity.value) + 1;
}

function decrement() {

    let quantity = document.getElementById('quantity');

    if(parseInt(quantity.value) > 1){

        quantity.value = parseInt(quantity.value) - 1;
    }
}

</script>

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

<a href="shop.php" class="back-btn-modern text-decoration-none">

<i class="bi bi-arrow-left-short fs-3"></i>

</a>

</div>

<!-- TITLE -->
<div class="page-heading text-center flex-grow-1">

<h6 class="mb-0 d-flex align-items-center justify-content-center">

<img src="img/electrisol-img/detail.png" width="30" class="me-2">

Product Details

</h6>

</div>

<!-- CART -->
<div class="cart-button">

<a href="cart.php" class="position-relative">

<button class="cart-btn-modern" type="button">

<img src="img/electrisol-img/cart-2.png" width="26" alt="Cart">

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
<script>

async function updateCartBadge() {

    try {

        const response = await fetch('cart_count.php');
        const data = await response.json();

        document.getElementById('cart-badge').textContent = data.count;

    } catch (err) {

        console.error(err);
    }
}

setInterval(updateCartBadge, 10000);

</script>

<!-- SIDENAV -->
<?php include "includes/home_side_nav_left.php"; ?>

<!-- CONTENT -->
<div class="page-content-wrapper py-3">

<div class="container">

<?php if(isset($errors['n'])): ?>

<div class="alert alert-danger alert-modern">

<?php echo htmlspecialchars($errors['n'], ENT_QUOTES, 'UTF-8'); ?>

</div>

<?php endif; ?>

<?php if($product):

$product_id       = (int)$product['product_id'];
$product_name     = htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8');
$product_details  = htmlspecialchars_decode($product['product_details']);
$product_number   = htmlspecialchars($product['product_number'], ENT_QUOTES, 'UTF-8');
$price            = (float)$product['price'];
$image_one        = htmlspecialchars($product['image_one'], ENT_QUOTES, 'UTF-8');
$image_two        = htmlspecialchars($product['image_two'], ENT_QUOTES, 'UTF-8');
$image_three      = htmlspecialchars($product['image_three'], ENT_QUOTES, 'UTF-8');
$stock_level      = (int)$product['stock_level'];

?>

<!-- PRODUCT GALLERY -->
<div class="card product-main-card mb-4 position-relative">

<span class="badge badge-pill badge-info product-badge">

Best Seller

</span>

<div class="card-body p-3">

<!-- PRODUCT IMAGE CAROUSEL -->
<div id="productGalleryCarousel" class="carousel slide product-gallery-carousel" data-bs-ride="carousel">

    <!-- Indicators -->
    <div class="carousel-indicators">

        <button type="button"
                data-bs-target="#productGalleryCarousel"
                data-bs-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"></button>

        <button type="button"
                data-bs-target="#productGalleryCarousel"
                data-bs-slide-to="1"
                aria-label="Slide 2"></button>

        <button type="button"
                data-bs-target="#productGalleryCarousel"
                data-bs-slide-to="2"
                aria-label="Slide 3"></button>

    </div>

    <!-- Slides -->
    <div class="carousel-inner rounded-4 overflow-hidden">

        <!-- Image One -->
        <div class="carousel-item active">

            <a href="admin/images/products/<?php echo $image_one; ?>"
               class="image-zooming-in-out d-block">

                <img src="admin/images/products/<?php echo $image_one; ?>"
                     class="d-block w-100"
                     alt="Product Image One">

            </a>

        </div>

        <!-- Image Two -->
        <div class="carousel-item">

            <a href="admin/images/products/<?php echo $image_two; ?>"
               class="image-zooming-in-out d-block">

                <img src="admin/images/products/<?php echo $image_two; ?>"
                     class="d-block w-100"
                     alt="Product Image Two">

            </a>

        </div>

        <!-- Image Three -->
        <div class="carousel-item">

            <a href="admin/images/products/<?php echo $image_three; ?>"
               class="image-zooming-in-out d-block">

                <img src="admin/images/products/<?php echo $image_three; ?>"
                     class="d-block w-100"
                     alt="Product Image Three">

            </a>

        </div>

    </div>

    <!-- Previous -->
    <button class="carousel-control-prev"
            type="button"
            data-bs-target="#productGalleryCarousel"
            data-bs-slide="prev">

        <span class="carousel-control-prev-icon"></span>

    </button>

    <!-- Next -->
    <button class="carousel-control-next"
            type="button"
            data-bs-target="#productGalleryCarousel"
            data-bs-slide="next">

        <span class="carousel-control-next-icon"></span>

    </button>

</div>

<style>

.product-gallery-carousel{
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    background: #fff;
}

.product-gallery-carousel .carousel-item img{
    width: 100%;
    height: 340px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-gallery-carousel .carousel-item img:hover{
    transform: scale(1.03);
}

.product-gallery-carousel .carousel-control-prev,
.product-gallery-carousel .carousel-control-next{
    width: 42px;
    height: 42px;
    background: rgba(0,0,0,0.45);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    margin: 0 12px;
}

.product-gallery-carousel .carousel-indicators button{
    width: 10px;
    height: 10px;
    border-radius: 50%;
    opacity: 0.6;
}

.product-gallery-carousel .carousel-indicators .active{
    opacity: 1;
}

@media (max-width: 576px){

    .product-gallery-carousel .carousel-item img{
        height: 240px;
    }

}

</style>

</div>

</div>

<!-- PRODUCT INFO -->
<div class="card product-info-card mb-4">

<div class="card-body p-4">

<h2 class="product-title mb-2">

<?php echo $product_name; ?>

</h2>

<div class="product-price mb-3">

&#8358;<?php echo number_format($price, 0); ?>

</div>

<p class="product-desc mb-0">

<?php echo $product_name; ?>

</p>

</div>

</div>

<!-- DESCRIPTION -->
<div class="card product-info-card mb-4">

<div class="card-body p-4">

<h5 class="fw-bold mb-3">

Description

</h5>

<div class="product-desc">

<?php echo $product_details; ?>

</div>

</div>

</div>

<?php endif; ?>

<!-- PRODUCT FORM -->
<div class="card product-info-card mb-4">

<div class="card-body p-4">

<form action="shop-details.php?action=add&id=<?php echo $product_id; ?>" method="post">

<input type="hidden" name="hidden_product_name" value="<?php echo $product_name; ?>">
<input type="hidden" name="hidden_product_number" value="<?php echo $product_number; ?>">
<input type="hidden" name="hidden_image_one" value="<?php echo $image_one; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $price; ?>">
<input type="hidden" name="hidden_amount" value="<?php echo $price; ?>">
<input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level; ?>">
<input type="hidden" name="hidden_order_number" value="<?php echo mt_rand(1000000, 9999999); ?>">

<div class="quantity-wrapper">

<div class="d-flex align-items-center">

<button class="qty-btn"
type="button"
onclick="decrement()">

-

</button>

<input type="number"
id="quantity"
name="hidden_quantity"
value="1"
min="1"
class="form-control qty-input text-center mx-2"
readonly>

<button class="qty-btn"
type="button"
onclick="increment()">

+

</button>

</div>

<button class="btn add-cart-btn btn-block text-white mt-4"
type="submit"
name="add">

<i class="bi bi-cart-plus me-2"></i>

Add to Cart

</button>

</div>

</form>

</div>

</div>

<!-- RELATED -->
<div class="card product-info-card mb-4">

<div class="card-body p-4">

<div class="d-flex justify-content-between align-items-center mb-3">

<h5 class="fw-bold mb-0">

Related Products

</h5>

<span class="text-muted small">

You may also like

</span>

</div>

<div class="row g-3">

<?php foreach($related_products as $row):

$related_id     = (int)$row['product_id'];
$related_name   = htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8');
$related_number = htmlspecialchars($row['product_number'], ENT_QUOTES, 'UTF-8');
$related_price  = (float)$row['price'];
$related_stock  = (int)$row['stock_level'];
$related_image  = htmlspecialchars($row['image_one'], ENT_QUOTES, 'UTF-8');

?>

<div class="col-6 col-md-4 col-lg-3">

<div class="card related-card">

<div class="card-body p-2 d-flex flex-column">

<a class="d-block mb-3 position-relative"
href="shop-details?id=<?php echo $related_id; ?>">

<img src="admin/images/products/<?php echo $related_image; ?>"
class="rounded"
alt="<?php echo $related_name; ?>">

<span class="badge badge-warning position-absolute top-0 start-0 m-2">

Sale

</span>

</a>

<a class="related-title mb-2"
href="shop-details?id=<?php echo $related_id; ?>">

<?php echo $related_name; ?>

</a>

<div class="related-price mb-3">

&#8358;<?php echo number_format($related_price, 0); ?>

</div>

<form action="shop.php?action=add&id=<?php echo $related_id; ?>"
method="post"
class="mt-auto">

<input type="hidden" name="hidden_product_name" value="<?php echo $related_name; ?>">
<input type="hidden" name="hidden_product_number" value="<?php echo $related_number; ?>">
<input type="hidden" name="hidden_image_one" value="<?php echo $related_image; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $related_price; ?>">
<input type="hidden" name="hidden_quantity" value="1">
<input type="hidden" name="hidden_amount" value="<?php echo $related_price; ?>">
<input type="hidden" name="hidden_stock_level" value="<?php echo $related_stock; ?>">
<input type="hidden" name="hidden_order_number" value="<?php echo mt_rand(1000000, 9999999); ?>">

<button class="btn related-btn btn-sm btn-block text-white"
type="submit"
name="add">

Add to Cart

</button>

</form>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</div>

</div>

<!-- FOOTER -->
<?php include "includes/home_footer_nav.php"; ?>

</body>
</html>