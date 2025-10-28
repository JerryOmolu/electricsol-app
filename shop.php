<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>

<?php 
if(!isset($_SESSION['verify_status'])){
    if($_SESSION['verify_status'] !== '1'){
       header("Location:login"); 
    }
        
    }

?>
<?php 
   if(isset($_POST['add'])){
       
       $product_id = $_GET['id']; 
       $hidden_product_name = escape($_POST['hidden_product_name']);
        $hidden_product_number = escape($_POST['hidden_product_number']);
        $hidden_image_one = escape($_POST['hidden_image_one']);
        $hidden_price = escape($_POST['hidden_price']);
        $hidden_quantity = escape($_POST['hidden_quantity']);
        $hidden_amount = escape($_POST['hidden_amount']);
        $hidden_order_number = escape($_POST['hidden_order_number']);
        $hidden_stock_level = escape($_POST['hidden_stock_level']);

        if(isset($_SESSION['fullname'])){
        $fullname = escape($_SESSION['fullname']);
        }
       
       $errors = array();
    
        $n = "SELECT product_number FROM cart WHERE product_number = '$hidden_product_number' && customer_name = '$fullname' && payment_status = 'Pending' LIMIT 1";
        $nn = mysqli_query($connection,$n);
    
        if(mysqli_num_rows($nn) > 0){
            $errors['n'] = "$hidden_product_name already exists in your cart";
        }
					
		if(count($errors)==0 ){
       
       $query1 = "INSERT INTO cart(customer_name,product_name,product_number,image_one,price,stock_level,quantity,amount,order_number,payment_status)VALUES('{$fullname}','{$hidden_product_name}','{$hidden_product_number}','{$hidden_image_one}','{$hidden_price}','{$hidden_stock_level}','{$hidden_quantity}','{$hidden_amount}','{$hidden_order_number}','Pending')";
          
    $add_to_cart = mysqli_query($connection, $query1);
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
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta name="theme-color" content="#0134d4">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <!-- Title -->
  <title>Electricsol-Mobile App</title>

  <!-- Favicon -->
    <link rel="icon" href="favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
<!--Font Awesome-->
    <link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">
    
<!--RATING SECTION-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Web App Manifest -->
  <link rel="manifest" href="manifest.json">
    
<!--Summernote-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

 <!-- Sticky Header -->
<div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
        <!-- Back Button -->
        <div class="back-button">
          <a href="home">
            <i class="bi bi-arrow-left-short"></i>
          </a>
        </div>

        <!-- Page Title -->
        <div class="page-heading">
          <h6 class="mb-0"><img src="img/electrisol-img/sho.png" width="30px"> Market Place</h6>
        </div>

        <!-- Navbar Toggler -->
        <div>
<!--
          <a href="cart.php"><img src="img/electrisol-img/cart-2.png" width="50px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Check Cart"><span class="ms-1 badge rounded-pill bg-danger"><?php 
if(isset($_SESSION['fullname'])){
$fullname = escape($_SESSION['fullname']);
}
              $query = "SELECT * FROM cart WHERE customer_name = '$fullname' && payment_status ='Pending'";
              $cart_query = mysqli_query($connection, $query);
              $number_of_cart = mysqli_num_rows($cart_query);
              echo $number_of_cart;
       
              ?></span></a>
-->
            
            <a href="cart.php"><button class="btn btn-outline-info position-relative" type="button"><img src="img/electrisol-img/cart-2.png" width="30px">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php 
if(isset($_SESSION['fullname'])){
$fullname = escape($_SESSION['fullname']);
}
              $query = "SELECT * FROM cart WHERE customer_name = '$fullname' && payment_status ='Pending'";
              $cart_query = mysqli_query($connection, $query);
              $number_of_cart = mysqli_num_rows($cart_query);
              echo $number_of_cart;
       
              ?></span>
            </button> </a>       
            
            
            
        </div>
      </div>
    </div>
  </div>

<!-- AJAX to update cart badge in real-time -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateCartBadge() {
    $.ajax({
        url: 'cart_count.php', // PHP file that returns the current cart count
        method: 'GET',
        success: function(data) {
            $('#cart-badge').text(data);
        }
    });
}

// Initial load
updateCartBadge();

// Refresh every 5 seconds (5000ms)
setInterval(updateCartBadge, 5000);
</script>

<style>
.header-area.sticky-top {
    z-index: 1030;
}

.header-area .back-button a:hover {
    background-color: #f1f3f5;
    transition: 0.2s;
}

.header-area .page-heading img {
    vertical-align: middle;
}

.header-area .btn-outline-info:hover {
    background-color: #0dcaf0;
    color: #fff;
    border-color: #0dcaf0;
}
</style>



  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>
 

  <div class="page-content-wrapper py-4">
  <div class="container">

    <!-- Search Products -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <form class="d-flex" action="search" method="post">
          <input class="form-control me-2" type="search" placeholder="Search Products" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ?>" required>
          <button class="btn btn-dark" type="submit" name="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>

    <!-- Error Messages -->
    <?php if(isset($errors['n'])): ?>
      <div class="alert alert-danger"><?php echo $errors['n']; ?></div>
    <?php endif; ?>

    <!-- Top Products -->
    <div class="row g-4">
      <?php 
        $perpage = 20;
        $page = isset($_GET['page']) ? escape($_GET['page']) : 1;
        $page_1 = ($page <= 1) ? 0 : ($page * $perpage) - $perpage;

        $query_total = "SELECT * FROM product ORDER BY added_on DESC";
        $result_total = mysqli_query($connection, $query_total);
        $total_pages = ceil(mysqli_num_rows($result_total)/$perpage);

        $query = "SELECT * FROM product ORDER BY added_on DESC LIMIT $page_1, $perpage";
        $products = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($products)):
          $product_id = escape($row['product_id']);
          $product_name = escape($row['product_name']);
          $product_number = escape($row['product_number']);
          $price = escape($row['price']);
          $stock_level = escape($row['stock_level']);
          $image_one = escape($row['image_one']);
      ?>
      <div class="col-6 col-sm-4 col-lg-3">
        <div class="card single-product-card shadow-sm h-100">
          <div class="card-body p-3 d-flex flex-column">
            <!-- Logo or Brand -->
            <div class="text-center mb-2">
              <img src="img/electrisol-img/Logo%206.png" width="60px" class="mb-2">
            </div>

            <!-- Product Thumbnail -->
            <a href="shop-details?id=<?php echo $product_id ?>" class="product-thumbnail d-block mb-2 position-relative">
              <img src="admin/images/products/<?php echo $image_one ?>" alt="<?php echo $product_name ?>" class="img-fluid rounded" style="height:200px; object-fit:cover;">
<!--              <span class="badge bg-primary position-absolute top-0 start-0 m-2">Sale</span>-->
            </a>

            <!-- Product Name & Price -->
            <a href="shop-details?id=<?php echo $product_id ?>" class="product-title d-block text-truncate mb-1 fw-semibold"><?php echo $product_name ?></a>
            <p class="text-dark fw-bold mb-3">&#8358;<?php echo number_format($price,0) ?></p>

            <!-- Add to Cart Button -->
            <form action="shop.php?action=add&id=<?php echo $product_id ?>" method="post" class="mt-auto text-center">
              <input type="hidden" name="hidden_product_name" value="<?php echo $product_name ?>">
              <input type="hidden" name="hidden_product_number" value="<?php echo $product_number ?>">
              <input type="hidden" name="hidden_image_one" value="<?php echo $image_one ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $price ?>">
              <input type="hidden" name="hidden_quantity" value="1">
              <input type="hidden" name="hidden_amount" value="<?php echo $price ?>">  
              <input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level ?>">  
              <input type="hidden" name="hidden_order_number" value="<?php echo rand(1000000, 9999999); ?>">
              <button class="btn btn-dark btn-sm w-100" type="submit" name="add"><i class="bi bi-cart-plus me-1"></i> Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example" class="mt-4">
      <ul class="pagination justify-content-center flex-wrap">
        <?php $Previous = max($page-1,1); $Next = min($page+1,$total_pages); ?>

        <li class="page-item <?php echo ($page <=1)?'disabled':''; ?>">
          <a class="page-link" href="shop?page=<?php echo $Previous; ?>" aria-label="Previous"><i class="bi bi-chevron-left"></i></a>
        </li>

        <?php for($i=1; $i<=$total_pages; $i++): ?>
          <li class="page-item <?php echo ($i==$page)?'active':''; ?>">
            <a class="page-link" href="shop?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <li class="page-item <?php echo ($page >= $total_pages)?'disabled':''; ?>">
          <a class="page-link" href="shop?page=<?php echo $Next; ?>" aria-label="Next"><i class="bi bi-chevron-right"></i></a>
        </li>
      </ul>
    </nav>

  </div>

  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>

</div>

<style>
.single-product-card {
  transition: transform 0.2s, box-shadow 0.2s;
}
.single-product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.pagination .page-item .page-link {
  border-radius: 50% !important;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.pagination .page-item.active .page-link {
  background-color: #212529;
  color: #fff;
  border-color: #212529;
}
</style>

