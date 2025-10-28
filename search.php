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
       
       $query1 = "INSERT INTO cart(customer_name,product_name,product_number,image_one,price,stock_level,quantity,amount,order_number,payment_status)VALUES('{$fullname}','{$hidden_product_name}','{$hidden_product_number}','{$hidden_image_one}','{$hidden_price}','{$hidden_stock_level}','{$hidden_quantity}','{$hidden_amount}','{$hidden_order_number}','Pending')";
          
    $add_device_two = mysqli_query($connection, $query1);
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

  <!-- Header Area -->
  <div class="header-area" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">

      <!-- Back Button -->
      <div class="back-button">
        <a href="home" class="text-decoration-none text-dark d-flex align-items-center">
          <i class="bi bi-arrow-left-short fs-3"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 d-flex align-items-center justify-content-center">
          <img src="img/electrisol-img/sho.png" width="30px" class="me-2"> Market Place
        </h6>
      </div>

      <!-- Cart Button -->
      <div>
        <a href="cart.php" class="text-decoration-none">
          <button class="btn btn-outline-info position-relative shadow-sm hover-scale" type="button">
            <img src="img/electrisol-img/cart-2.png" width="30px" alt="Cart">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php 
              if(isset($_SESSION['fullname'])){
                  $fullname = escape($_SESSION['fullname']);
              }
              $query = "SELECT * FROM cart WHERE customer_name = '$fullname' && payment_status ='Pending'";
              $cart_query = mysqli_query($connection, $query);
              $number_of_cart = mysqli_num_rows($cart_query);
              echo $number_of_cart;
              ?>
            </span>
          </button>
        </a>
      </div>

    </div>
  </div>
</div>

<style>
/* Cart button hover effect */
.hover-scale:hover {
  transform: scale(1.1);
  transition: all 0.2s ease-in-out;
}

/* Badge styling */
.badge {
  font-size: 0.75rem;
  padding: 0.35em 0.5em;
}

/* Smooth icon and text alignment */
.page-heading img {
  vertical-align: middle;
}
</style>


  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>
 

  <div class="page-content-wrapper py-3">
  <!-- Search Bar -->
  <div class="shop-pagination pb-3">
    <div class="container">
      <div class="card shadow-sm">
        <div class="card-body">
          <form class="mb-3 pb-2" action="search" method="post">
            <div class="input-group">
              <input class="form-control form-control-lg" type="search" placeholder="Search Products" name="search" 
                     value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ?>" required>
              <button class="btn btn-dark" type="submit" name="submit">
                <i class="bi bi-search fs-5"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Top Products -->
  <div class="top-products-area">
    <div class="container">
      <div class="row g-4">
        <?php     
        if(isset($_POST['submit'])){
          $search = $_POST['search'];
          $query = "SELECT * FROM product WHERE keywords LIKE '%$search%' ";
          $search_query= mysqli_query($connection, $query);
          if(!$search_query){ die('QUERY FAILED'. mysqli_error($connection)); }

          $count = mysqli_num_rows($search_query);
          if($count == 0){
            echo "<div class='alert custom-alert-three alert-danger alert-dismissible fade show text-center' role='alert'>
                    <i class='fa fa-smile-o me-2'></i>
                    Oops! There are no results for '<strong>$search</strong>'.<br>
                    <small>- Ensure correct spelling.<br>- Use brief keywords.<br>- Try more generic keywords.</small>
                    <button class='btn btn-close position-relative p-1 ms-auto' type='button' data-bs-dismiss='alert'></button>
                  </div>";
          } else {
            while($row = mysqli_fetch_array($search_query)){
              $product_id = escape($row['product_id']);
              $product_name = escape($row['product_name']);
              $product_number = escape($row['product_number']);
              $price = escape($row['price']);                
              $stock_level = escape($row['stock_level']);                
              $image_one = escape($row['image_one']);                                
        ?>
        <div class="col-6 col-sm-4 col-lg-3">
          <div class="card single-product-card shadow-sm h-100 hover-shadow">
            <div class="card-body p-3 d-flex flex-column">
              <!-- Product Thumbnail -->
              <a class="product-thumbnail d-block mb-2 position-relative" href="shop-details?id=<?php echo $product_id ?>">
                <img src="admin/images/products/<?php echo $image_one ?>" class="img-fluid rounded" alt="<?php echo $product_name ?>">
                <span class="badge bg-warning position-absolute top-0 start-0 m-2">Sale</span>
              </a>
              <!-- Product Title -->
              <a class="product-title d-block text-truncate mb-1" href="shop-details?id=<?php echo $product_id ?>">
                <?php echo $product_name ?>
              </a>
              <!-- Product Price -->
              <p class="sale-price fw-bold mb-3">&#8358;<?php echo $price ?></p>

              <form action="shop.php?action=add&id=<?php echo $product_id ?>" method="post" class="mt-auto">
                <input type="hidden" name="hidden_product_name" value="<?php echo $product_name ?>">
                <input type="hidden" name="hidden_product_number" value="<?php echo $product_number ?>">
                <input type="hidden" name="hidden_image_one" value="<?php echo $image_one ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $price ?>">
                <input type="hidden" name="hidden_quantity" value="1">
                <input type="hidden" name="hidden_amount" value="<?php echo $price ?>">  
                <input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level ?>">  
                <input type="hidden" name="hidden_order_number" value="<?php $order_number = rand(1000000, 9999999); echo $order_number; ?>">
                <button class="btn btn-primary w-100 rounded-pill btn-sm" type="submit" name="add">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>
        <?php } } } ?>
      </div>
    </div>
  </div>

  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>
</div>

<style>
/* Product card hover effect */
.hover-shadow:hover {
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  transition: 0.3s ease-in-out;
}

/* Search input focus effect */
input.form-control:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
}

/* Product thumbnail badge */
.single-product-card .badge {
  font-size: 0.75rem;
  padding: 0.3em 0.5em;
}
</style>

