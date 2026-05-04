<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  

<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
 <?php include "includes/welcome.php"; ?>   

<!--    Main Content Wrapper-->
<div class="row">
            <div class="col-md-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">CUSTOMER DETAIL</p><hr>
    
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                   <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                          
                $query = "SELECT * FROM register WHERE id = $id";
                $view_cart = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_cart)){
                    $id = escape($row['id']);
                    $fullname = escape($row['fullname']);
                    $email = escape($row['email']);
                    $phone = escape($row['phone']);
                    $date = escape($row['date']);
                    $address = escape($row['address']);
                    ?>
                
              <div class="card">
                <div class="card-body">
                  <div class="media">
                    <img src="img/electrisol-img/customer.png" alt="profile"/ width="100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="media-body">
                    <h4 class="card-title">Customer Name: <?php echo $fullname ?></h4>
                    <h4 class="card-title">Customer Email: <?php echo $email ?></h4>
                    <h4 class="card-title">Customer Phone Number: <?php echo $phone ?></h4>
                    <h4 class="card-title">Customer Address: <?php echo $address ?></h4>
                      <p class="card-title">Date Registered: <?php echo $date ?></p>
                    </div>
                  </div>
                </div>
              </div>
        <?php } ?>
              </div>
            </div>
    
    </div>
    
    
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
