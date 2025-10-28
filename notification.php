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

  <!-- Header Area -->
  <div class="header-area shadow-sm py-2 mb-3" id="headerArea" style="background-color: #ffffff;">
    <div class="container">
        <!-- Header Content -->
        <div class="header-content header-style-five d-flex align-items-center justify-content-between position-relative">
            
            <!-- Back Button -->
            <div class="back-button">
                <a href="home" class="d-flex align-items-center justify-content-center p-2 rounded-circle hover-shadow" style="transition: all 0.3s ease;">
                    <i class="bi bi-arrow-left-short fs-3 text-dark"></i>
                </a>
            </div>

            <!-- Page Title -->
            <div class="page-heading text-center flex-grow-1">
                <h6 class="mb-0 d-flex align-items-center justify-content-center gap-2">
                    <img src="img/electrisol-img/bell.png" width="30px" alt="Notifications Icon">
                    Notifications
                </h6>
            </div>

            <!-- Placeholder for Right Icons / Toggler -->
            <div class="header-extra">
                <!-- Add icons if needed -->
            </div>
        </div>
    </div>
</div>

<style>
/* Hover shadow effect for back button */
.hover-shadow:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

/* Smooth transition for icon */
.back-button i {
    transition: transform 0.3s ease;
}

.back-button:hover i {
    transform: translateX(-2px);
}

/* Page heading font adjustments */
.page-heading h6 {
    font-weight: 600;
    font-size: 1rem;
}
</style>


  <!-- # Sidenav Left -->
 <?php include "includes/home_side_nav_left.php"; ?>
 

  <div class="page-content-wrapper py-3">
    <!-- Notifications Area -->
    <div class="notification-area py-3">
    <div class="container">
        <?php  
        if(isset($_SESSION['fullname'])){
            $fullname = escape($_SESSION['fullname']);
        }

        $current_time = date('F j, Y H:i:s A'); 

        // 1. Pending Cart Items
        $query = "SELECT * FROM cart WHERE customer_name = '$fullname' AND payment_status ='Pending'";
        $cart_query = mysqli_query($connection, $query);
        $number_of_cart = mysqli_num_rows($cart_query);
        if ($number_of_cart > 0 ){
            echo "
            <div class='notification-card d-flex align-items-center mb-3 shadow-sm'>
                <div class='notification-icon bg-primary text-white p-3 rounded-circle me-3'>
                    <i class='fa fa-shopping-cart fa-lg'></i>
                </div>
                <div class='notification-content flex-grow-1'>
                    <h6 class='mb-1'>You have $number_of_cart items in your Shopping Cart</h6>
                    <p class='mb-0'>Kindly check out and pay for your order.</p>
                    <small class='text-muted'>$current_time</small>
                </div>
            </div>";
        }  

        // 2. Devices Added
        $query = "SELECT * FROM device WHERE device_owner_name = '$fullname'";
        $device_query = mysqli_query($connection, $query);
        $number_of_device = mysqli_num_rows($device_query);
        if ($number_of_device > 0 ){
            echo "
            <div class='notification-card d-flex align-items-center mb-3 shadow-sm unread'>
                <div class='notification-icon bg-success text-white p-3 rounded-circle me-3'>
                    <i class='fa fa-check-circle fa-lg'></i>
                </div>
                <div class='notification-content flex-grow-1'>
                    <h6 class='mb-1'>You have added $number_of_device devices</h6>
                    <p class='mb-0'>Go to Device Management to check the energy consumption rate.</p>
                    <small class='text-muted'>$current_time</small>
                </div>
            </div>";
        }  

        // 3. Successful Payments
        $today = date("Y-m-d");
        $query = "SELECT * FROM payment WHERE customer_name = '$fullname' AND payment_date = '$today'";
        $payment_query = mysqli_query($connection, $query);
        $number_of_payment = mysqli_num_rows($payment_query);
        if ($number_of_payment > 0 ){
            echo "
            <div class='notification-card d-flex align-items-center mb-3 shadow-sm'>
                <div class='notification-icon bg-warning text-white p-3 rounded-circle me-3'>
                    <i class='fa fa-money fa-lg'></i>
                </div>
                <div class='notification-content flex-grow-1'>
                    <h6 class='mb-1'>You have successfully made payment for your order(s)</h6>
                    <p class='mb-0'>Check for your invoice.</p>
                    <small class='text-muted'>$current_time</small>
                </div>
            </div>";
        }  
        ?>    
    </div>
</div>

<style>
/* Notification card styling */
.notification-card {
    background-color: #fff;
    padding: 15px 20px;
    border-radius: 12px;
    transition: all 0.3s ease;
    cursor: default;
}

.notification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.notification-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.unread {
    border-left: 4px solid #198754; /* green accent for unread notifications */
}

.notification-content h6 {
    font-weight: 600;
    margin-bottom: 4px;
}

.notification-content p {
    margin-bottom: 2px;
    font-size: 0.9rem;
}

.notification-content small {
    font-size: 0.75rem;
}
</style>

  </div>
<br>
  <!-- Footer Nav -->
  <?php include "includes/home_footer_nav.php"; ?>
