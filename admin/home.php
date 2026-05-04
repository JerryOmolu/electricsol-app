<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
      
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
<!--Welcome-->
<?php include "includes/welcome.php"; ?> 
<hr>
    
<!--User Metrics-->
        <h4>User Statistics</h4>
          <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <h5 class="mb-4">Admins</h5>
                      <p class="fs-30 mb-2">
                          <?php 
                          $query = "SELECT * FROM user WHERE role = 'Admin'";
                          $admin_query = mysqli_query($connection, $query);
                          $number_of_admin = mysqli_num_rows($admin_query);
                          echo $number_of_admin;
                          ?>
                       </p>
                        <h2><i class="fa fa-male" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <h5 class="mb-4">Operators</h5>
                      <p class="fs-30 mb-2">
                          <?php 
                          $query = "SELECT * FROM user WHERE role = 'Operator'";
                          $manager_query = mysqli_query($connection, $query);
                          $number_of_manager = mysqli_num_rows($manager_query);
                          echo $number_of_manager;
                          ?>
                       </p>
                        <h2><i class="fa fa-user-o" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <h5 class="mb-4">Customers</h5>
                      <p class="fs-30 mb-2">
                          <?php 
                          $query = "SELECT * FROM register WHERE verify_status = '1'";
                          $customer_query = mysqli_query($connection, $query);
                          $number_of_customer = mysqli_num_rows($customer_query);
                          echo $number_of_customer;
                          ?>
                       </p>
                        <h2><i class="fa fa-users" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <h5 class="mb-4">Artisans</h5>
                      <p class="fs-30 mb-2">
                          <?php 
                          $query = "SELECT * FROM artisan";
                          $artisan_query = mysqli_query($connection, $query);
                          $number_of_artisan = mysqli_num_rows($artisan_query);
                          echo $number_of_artisan;
                          ?>
                       </p>
                      <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
          </div>
   <h4>Product Statistics</h4>  
    <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <h5 class="mb-4">Products</h5>
                      <p class="fs-30 mb-2">
                    <?php 
                          $query = "SELECT * FROM product";
                          $product_query = mysqli_query($connection, $query);
                          $number_of_product = mysqli_num_rows($product_query);
                          echo $number_of_product;
                          ?>    
                    </p>
                    <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <h5 class="mb-4">Successful Transactions</h5>
                      <p class="fs-30 mb-2">
                    <?php
                    $query = "SELECT * FROM cart WHERE payment_status = 'Paid'";
                    $success_query = mysqli_query($connection, $query);
                    $number_of_success = mysqli_num_rows($success_query);
                         echo $number_of_success;
                    ?>
                          </p>
                    <h2><i class="fa fa-credit-card" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <h5 class="mb-4">Pending Transactions</h5>
                      <p class="fs-30 mb-2">
                     <?php
                    $query = "SELECT * FROM cart WHERE payment_status = 'Pending'";
                    $pending_query = mysqli_query($connection, $query);
                    $number_of_pending = mysqli_num_rows($pending_query);
                         echo $number_of_pending;
                    ?>    
                        </p>
                    <h2><i class="fa fa-credit-card" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <h5 class="mb-4">Successful Payments</h5>
                      <p class="fs-30 mb-2">
                <?php
                    $query = "SELECT * FROM payment WHERE status = 'success'";
                    $success_query = mysqli_query($connection, $query);
                    $number_of_success = mysqli_num_rows($success_query);
                         echo $number_of_success;
                    ?>          
                    </p>
                    <h2><i class="fa fa-cc-mastercard" aria-hidden="true"></i></h2>
                    </div>
                  </div>
                </div>
          </div><hr>
          
<!--    Sales-->
            <h4>Sales Metrics</h4>
    <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Sales Overview</p><br>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Customer Name</th>
                          <th>Product</th>
                          <th>Price</th>
                          <th>QTY</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>  
                      </thead>
                      <tbody>
                    <?php          
                          
                $query = "SELECT * FROM cart ORDER BY order_id DESC LIMIT 10";
                $view_cart = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_cart)){
                    $order_id = escape($row['order_id']);
                    $customer_name = escape($row['customer_name']);
                    $product_name = escape($row['product_name']);
                    $product_number = escape($row['product_number']);
                    $image_one = escape($row['image_one']);
                    $price = escape($row['price']);
                    $stock_level = escape($row['stock_level']);
                    $quantity = escape($row['quantity']);
                    $amount = escape($row['amount']);
                    $order_number = escape($row['order_number']);
                    $payment_status = escape($row['payment_status']);
                    $date_ordered = escape($row['date_ordered']); 
                    ?>
               
                    <tr>
                          <td><?php echo $customer_name ?></td>
                          <td><?php echo $product_name ?></td>
                          <td>&#8358;<?php echo number_format($price,2) ?></td>
                          <td><?php echo $quantity ?></td>
                          <td class='font-weight-bold'>&#8358;<?php echo number_format($amount,2) ?></td>
                          <td><?php echo $date_ordered ?></td>
                        <td><?php 
                        if($payment_status == 'Paid'){
                            echo "<div class='badge badge-success'>Paid</div>";
                        }else{
                          echo "<div class='badge badge-warning'>Pending</div>";  
                        } ?></td>
                        
                      </tr>
                 
               <?php } 
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
