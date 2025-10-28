<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>
<?php
if(isset($_POST['update_quantity'])){
    $order_id = escape($_POST['order_id']);
    $new_quantity = (int)$_POST['quantity'];

    $query = "SELECT price FROM cart WHERE order_id = '$order_id' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $price = $row['price'];

    $new_amount = $price * $new_quantity;

    $update_query = "UPDATE cart SET quantity = '$new_quantity', amount = '$new_amount' WHERE order_id = '$order_id'";
    mysqli_query($connection, $update_query);
}
?>

<?php 
if(!isset($_SESSION['verify_status'])){
    if($_SESSION['verify_status'] !== '1'){
       header("Location:login.php"); 
    }
        
    }

?>

<?php
if(isset($_GET["action"]) && $_GET["action"] == "delete"){
    $product_name = $_GET["name"];
    $query = "DELETE FROM cart WHERE product_name = '$product_name'";
    $delete_query = mysqli_query($connection,$query);
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
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Header Area -->
  <div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="shop" class="btn btn-sm btn-outline-dark rounded-circle shadow-sm">
          <i class="bi bi-arrow-left-short fs-4"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center">
        <h6 class="mb-0 fw-bold d-flex align-items-center gap-2">
          <img src="img/electrisol-img/cart-2.png" width="28" class="me-1" alt="Cart Icon">
          My Cart
        </h6>
      </div>

      <!-- Navbar Toggler -->
      <div class="navbar--toggler" id="affanNavbarToggler" 
           data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
           aria-controls="affanOffcanvas">
        <span class="d-block"></span>
        <span class="d-block"></span>
        <span class="d-block"></span>
      </div>

    </div>
  </div>
</div>


<?php include "includes/home_side_nav_left.php"; ?>

  <div class="page-content-wrapper py-3">
  <div class="container">
    <!-- Cart Wrapper -->
    <div class="cart-wrapper-area">
      <div class="card shadow-lg border-0 mb-3">
        <div class="card-header bg-dark text-white">
          <h5 class="mb-0"><i class="bi bi-cart-check"></i> Your Shopping Cart</h5>
        </div>

        <div class="table-responsive card-body">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(isset($_SESSION['fullname'])){
                  $fullname = escape($_SESSION['fullname']);
              } 
              
              $total = 0;
              $query = "SELECT * FROM cart WHERE customer_name = '$fullname' && payment_status = 'Pending'";
              $select_product_query = mysqli_query($connection, $query);
              if(!$select_product_query){
                  die('QUERY FAILED' . mysqli_error($connection));
              }

              while($row = mysqli_fetch_array($select_product_query)){
                  $order_id = escape($row['order_id']);
                  $product_name = escape($row['product_name']);
                  $image_one = escape($row['image_one']);
                  $price = escape($row['price']);                
                  $quantity = escape($row['quantity']);                 
                  $amount = escape($row['amount']);                 
              ?>
              <tr>
                <td><img src="admin/images/products/<?php echo $image_one ?>" class="img-fluid rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;" alt=""></td>
                <td>
                  <h6 class="fw-bold mb-1"><?php echo $product_name ?></h6>
                  <small class="text-muted">&#8358;<?php echo number_format($price,2) ?> × <?php echo $quantity ?></small>
                </td>
                <td>
  <form method="post" class="d-flex justify-content-center align-items-center">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

    <!-- Minus Button -->
    <button type="submit" name="update_quantity" class="btn btn-sm btn-outline-secondary me-1"
      onclick="this.form.quantity.value=Math.max(1, parseInt(this.form.quantity.value)-1)">
      -
    </button>

    <!-- Quantity Input -->
    <input type="number" name="quantity" value="<?php echo $quantity ?>" min="1" class="form-control form-control-sm text-center" style="width:50px;">

    <!-- Plus Button -->
    <button type="submit" name="update_quantity" class="btn btn-sm btn-outline-secondary ms-1"
      onclick="this.form.quantity.value=parseInt(this.form.quantity.value)+1">
      +
    </button>
  </form>
</td>

                <td><h6 class="text-success fw-bold mb-0">&#8358;<?php echo number_format($amount,2) ?></h6></td>
                <td>
                  <a class="remove-product btn btn-sm btn-outline-danger" href="cart.php?action=delete&name=<?php echo $product_name; ?>">
                    <i class="bi bi-x-lg"></i>
                  </a>
                </td>
              </tr>
              <?php 
                $total = $total + $amount;
              } ?>
              <tr class="table-warning fw-bold">
                <td colspan="2"></td>
                <td><h6 class="mb-0">Total</h6></td>
                <td><h6 class="mb-0">&#8358;<?php echo number_format($total, 2);  ?></h6></td>
                <td></td>
              </tr>
            </tbody>
          </table>

          <!-- Coupon -->
          <div class="mt-4">
            <h6 class="mb-1">Have a coupon?</h6>
            <p class="text-muted mb-2">Enter your coupon code here &amp; get awesome discounts!</p>
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Enter Coupon Code">
              <button class="btn btn-dark" type="submit">Apply</button>
            </div>
          </div>

          <!-- Checkout -->
          <div class="mt-4">
            <a href="checkout?total=<?php echo $total ?>&<?php echo $fullname ?>" class="btn btn-warning w-100 fw-bold">
              Proceed to Checkout <i class="bi bi-arrow-right-circle"></i>
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<style>
/* Cart Page Beautification */
.cart-wrapper-area .card {
  border-radius: 12px;
  overflow: hidden;
}

.cart-wrapper-area table th, 
.cart-wrapper-area table td {
  vertical-align: middle;
}

@media (max-width: 768px) {
  .cart-wrapper-area table thead {
    display: none; /* hide table header on mobile */
  }
  .cart-wrapper-area table tbody tr {
    display: block;
    margin-bottom: 15px;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 10px;
  }
  .cart-wrapper-area table tbody tr td {
    display: flex;
    justify-content: space-between;
    padding: 8px 5px;
  }
  .cart-wrapper-area table tbody tr td:before {
    content: attr(data-label);
    font-weight: bold;
    color: #555;
  }
}
	
/* Header Area Styling */
.header-area {
  border-bottom: 1px solid #eee;
  z-index: 1030;
}

.header-area .back-button a {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.header-area .page-heading h6 {
  font-size: 1rem;
  color: #333;
}

.navbar--toggler {
  cursor: pointer;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.navbar--toggler span {
  width: 20px;
  height: 2px;
  background: #333;
  border-radius: 2px;
}
	
</style>
	
<br><br>
  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>