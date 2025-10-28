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
        $hidden_amount = $hidden_price * $hidden_quantity;
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
       
       $query1 = "INSERT INTO cart(customer_name,product_name,product_number,image_one,price,quantity,amount,order_number,payment_status)VALUES('{$fullname}','{$hidden_product_name}','{$hidden_product_number}','{$hidden_image_one}','{$hidden_price}','{$hidden_quantity}','{$hidden_amount}','{$hidden_order_number}','Pending')";
          
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
    
    
<script>
        function increment() {
            let value = parseInt(document.getElementById('quantity').value);
            document.getElementById('quantity').value = value + 1;
        }

        function decrement() {
            let value = parseInt(document.getElementById('quantity').value);
            if (value > 0) {
                document.getElementById('quantity').value = value - 1;
            }
        }
</script>
    
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
  <!-- Product Details Header -->
<div class="header-area sticky-top shadow-sm bg-white" id="headerArea">
  <div class="container">
    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">

      <!-- Back Button -->
      <div class="back-button">
        <a href="shop.php" class="text-dark">
          <i class="bi bi-arrow-left-short fs-3"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 d-flex align-items-center justify-content-center">
          <img src="img/electrisol-img/detail.png" width="30px" class="me-2"> Product Details
        </h6>
      </div>

      <!-- Cart Button -->
      <div class="cart-button">
        <a href="cart.php" class="position-relative">
          <button class="btn btn-outline-info rounded-circle p-2" type="button">
            <img src="img/electrisol-img/cart-2.png" width="28" alt="Cart">
            <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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

<!-- Optional JS for Smooth Cart Badge Updates -->
<script>
  // Function to update cart count dynamically (requires backend endpoint returning JSON)
  async function updateCartBadge() {
    try {
      const response = await fetch('cart_count.php'); // Returns {"count": 3} for example
      const data = await response.json();
      document.getElementById('cart-badge').textContent = data.count;
    } catch (err) {
      console.error('Error updating cart count:', err);
    }
  }

  // Refresh cart badge every 10 seconds
  setInterval(updateCartBadge, 10000);
</script>

<style>
  /* Sticky header shadow and smooth hover */
  #headerArea {
    z-index: 1050;
    transition: all 0.3s ease;
  }

  .header-content .btn:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease;
  }

  #cart-badge {
    font-size: 0.75rem;
    min-width: 20px;
    height: 20px;
    line-height: 20px;
    text-align: center;
  }
</style>


  <?php include "includes/home_side_nav_left.php"; ?>
 

  <div class="page-content-wrapper py-3">
    <div class="container">
    <p style="color:red;"><?php if(isset($errors['n']))echo $errors['n']; ?></p> 
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
        $query = "SELECT * FROM product WHERE product_id  = '$id'";
        $view_detail = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($view_detail)){
        $product_id = escape($row['product_id']);
        $product_name = escape($row['product_name']);
        $product_details = escape($row['product_details']);
        $product_number = escape($row['product_number']);
        $category = escape($row['category']);
        $price = escape($row['price']);
        $keywords = escape($row['keywords']);
        $image_one = escape($row['image_one']);
        $image_two = escape($row['image_two']);
        $image_three = escape($row['image_three']);
        $stock_level = escape($row['stock_level']);
        $added_on = escape($row['added_on']);
        $added_by = escape($row['added_by']);
            
            echo "<div class='card product-details-card mb-3 bg-light'>
        <span class='badge bg-info text-dark position-absolute product-badge'>Sales</span>
        <div class='card-body'>
          <div class='product-gallery-wrapper'>
            <div class='product-gallery gallery-img'>
              <a href='admin/images/products/{$image_one}' class='image-zooming-in-out' title='Picture One' data-gall='gallery2'>
                <img class='rounded' src='admin/images/products/{$image_one}' alt=''>
              </a>
              <a href='admin/images/products/{$image_two}' class='image-zooming-in-out' title='Picture Two' data-gall='gallery2'>
                <img class='rounded' src='admin/images/products/{$image_two}' alt=''>
              </a>
              <a href='admin/images/products/{$image_three}' class='image-zooming-in-out' title='Picture Three' data-gall='gallery2'>
                <img class='rounded' src='admin/images/products/{$image_three}' alt=''>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class='card product-details-card mb-3 direction-rtl'>
        <div class='card card-body'>
          <h3>{$product_name}</h3>
          <h1>&#8358;{$price}</h1>
          <p>{$product_name}</p>
        </div>
      </div>
      <div class='card product-details-card mb-3 direction-rtl'>
        <div class='card card-body bg-light'>
          <h5>Description</h5>
            <p>{$product_details}
            </p>
        </div>
      </div>
      ";
            
        }} ?>
        
<!-- Product Details Card -->
<div class="card product-details-card mb-4 shadow-sm">
  <div class="card-body">
    <form action="shop-details.php?action=add&id=<?php echo $product_id ?>" method="post">
      <input type="hidden" name="hidden_product_name" value="<?php echo $product_name ?>">
      <input type="hidden" name="hidden_product_number" value="<?php echo $product_number ?>">
      <input type="hidden" name="hidden_image_one" value="<?php echo $image_one ?>">
      <input type="hidden" name="hidden_price" value="<?php echo $price ?>">
      <input type="hidden" name="hidden_amount" value="<?php echo $price ?>">
      <input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level ?>">
      <input type="hidden" name="hidden_order_number" value="<?php $order_number = rand(1000000, 9999999); echo $order_number; ?>">
      
      <p class="text-danger"><?php if(isset($errors['n'])) echo $errors['n']; ?></p>

      <div class="d-flex align-items-center mb-3">
        <button class="btn btn-outline-dark me-2" type="button" onclick="decrement()">-</button>
        <input type="number" id="quantity" name="hidden_quantity" value="1" min="1" class="form-control text-center w-25" readonly>
        <button class="btn btn-outline-dark ms-2" type="button" onclick="increment()">+</button>
        <button class="btn btn-dark ms-3 flex-grow-1" type="submit" name="add">Add to Cart</button>
      </div>
    </form>
  </div>
</div>

<!-- Related Products -->
<div class="card related-product-card mb-4 shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Related Products</h5>
    <div class="row g-3">
      <?php 
        $perpage = 4;
        $page = isset($_GET['page']) ? escape($_GET['page']) : 1;
        $page_1 = ($page <= 1) ? 0 : ($page * $perpage) - $perpage;

        $query = "SELECT * FROM product ORDER BY added_on DESC LIMIT $page_1, $perpage";
        $select_product_query = mysqli_query($connection, $query);
        if(!$select_product_query) die('QUERY FAILED'. mysqli_error($connection));

        while($row = mysqli_fetch_array($select_product_query)){
          $product_id = escape($row['product_id']);
          $product_name = escape($row['product_name']);
          $price = escape($row['price']);
          $stock_level = escape($row['stock_level']);
          $image_one = escape($row['image_one']);
      ?>
      <div class="col-6 col-sm-4 col-lg-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body p-2 d-flex flex-column">
            <!-- Product Thumbnail -->
            <a class="product-thumbnail d-block mb-2" href="shop-details?id=<?php echo $product_id ?>">
              <img src="admin/images/products/<?php echo $image_one ?>" class="img-fluid rounded" alt="<?php echo $product_name ?>">
              <span class="badge bg-warning position-absolute top-0 start-0 m-2">Sale</span>
            </a>
            <!-- Product Title -->
            <a class="product-title d-block text-truncate mb-1" href="shop-details?id=<?php echo $product_id ?>"><?php echo $product_name ?></a>
            <!-- Product Price -->
            <p class="text-dark fw-bold mb-2">&#8358;<?php echo number_format($price,0) ?></p>
            
            <form action="shop.php?action=add&id=<?php echo $product_id ?>" method="post" class="mt-auto">
              <input type="hidden" name="hidden_product_name" value="<?php echo $product_name ?>">
              <input type="hidden" name="hidden_product_number" value="<?php echo $product_number ?>">
              <input type="hidden" name="hidden_image_one" value="<?php echo $image_one ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $price ?>">
              <input type="hidden" name="hidden_quantity" value="1">
              <input type="hidden" name="hidden_amount" value="<?php echo $price ?>">  
              <input type="hidden" name="hidden_stock_level" value="<?php echo $stock_level ?>">  
              <input type="hidden" name="hidden_order_number" value="<?php $order_number = rand(1000000, 9999999); echo $order_number; ?>">
              <button class="btn btn-dark btn-sm w-100" type="submit" name="add">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- Quantity Increment/Decrement Script -->
<script>
  const quantityInput = document.getElementById('quantity');

  function increment() {
    quantityInput.value = parseInt(quantityInput.value) + 1;
  }

  function decrement() {
    if(parseInt(quantityInput.value) > 1){
      quantityInput.value = parseInt(quantityInput.value) - 1;
    }
  }
</script>

<style>
  /* Card hover effect */
  .single-product-card:hover {
    transform: translateY(-4px);
    transition: transform 0.2s ease;
  }

  .product-details-card input {
    font-size: 1rem;
  }

  .related-product-card .badge {
    font-size: 0.7rem;
    padding: 0.25em 0.4em;
  }
</style>


   <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>